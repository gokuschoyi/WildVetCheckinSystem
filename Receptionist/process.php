<!-- This is where all the processong for the receptionist side takes place -->
<?php
session_start();
error_reporting();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../includes/dbConn.php';
include('../includes/gmailCredentials.php');
include "../allVendor/simple_html_dom.php";
include '../allVendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../allVendor/tecnickcom/tcpdf/tcpdf.php';
require '../allVendor/autoload.php';
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer

//(1) Assign doctors to specific client #error pop-up done
if (isset($_POST['assigndoc'])) {
    $opt = $_POST['option'];
    $id = $_POST['cidd'];
    $stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
    $stmt->bind_param("si", $opt, $id);
    $stmt->execute();
    if ($stmt) {
        $_SESSION['status'] = "Dr." . $opt . " assigned to client";
        $_SESSION['status_code'] = "success";
        header("Location: rToday.php");
        exit();
    } else {
        $_SESSION['status'] = "Cannot assign doctor";
        $_SESSION['status_code'] = "error";
        header("Location: rToday.php");
        exit();
    }
}

//(2) Delete a single client record from all clients page #error pop-up done
if (isset($_POST['deleteuser'])) {
    $cid = $_POST['cid'];

    $query2 = $conn->prepare("DELETE FROM petinfo WHERE petKey = ?");
    $query2->bind_param("i", $cid);
    $query2->execute();

    $query = $conn->prepare("DELETE FROM clientinfo WHERE clientId = ?");
    $query->bind_param("i", $cid);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Client Record Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: rAllclients.php");
        exit();
    } else {
        $_SESSION['status'] = "Cannot Delete Client Record";
        $_SESSION['status_code'] = "error";
        header("Location: rAllclients.php");
        exit();
    }
}

//(3) Update client info (today page) #error pop-up done
if (isset($_POST['updateclient'])) {
    $u_id = $_POST['cidd'];
    $u_mobile = $_POST['mobileUpdate'];
    $u_othContact = $_POST['otherContact'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_suburb = $_POST['suburb'];
    $u_postcode = $_POST['postcode'];

    $u_petname = $_POST['petname'];
    $u_pettype = $_POST['pettype'];
    $u_breed = $_POST['breed'];
    $u_sex = $_POST['sex'];
    $u_color = $_POST['color'];
    $u_age = $_POST['age'];
    $u_weight = $_POST['weight'];
    $u_microchip = $_POST['microchip'];
    $u_insurance = $_POST['insurance'];
    $u_medication = $_POST['medication'];
    $u_parasiteC = $_POST['parasiteC'];
    $u_mcdate = date('Y-m-d', strtotime($_POST['mcdate']));


    $query = $conn->prepare("UPDATE clientinfo SET mobileNo = ?, othContact = ?, email = ?, clientAddress =  ?, suburb = ?, postcode = ? WHERE clientId = ?");
    $query->bind_param("iisssii", $u_mobile, $u_othContact, $u_email, $u_address, $u_suburb, $u_postcode, $u_id);
    $query->execute();

    $query2 = $conn->prepare("UPDATE petinfo SET petName = ?, petType = ?, breed = ?, sex = ?, color = ?, age = ?, petWeight = ?, microchip = ?, insurance = ?, medication = ?, parasiteControl = ?, mcDate = ? WHERE petKey = ? ");
    $query2->bind_param("sssssiisssssi", $u_petname, $u_pettype, $u_breed, $u_sex, $u_color, $u_age, $u_weight, $u_microchip, $u_insurance, $u_medication, $u_parasiteC, $u_mcdate, $u_id);
    $query2->execute();
    $test = true;
    if ($query2) {
        $_SESSION['status'] = "Client details updated";
        $_SESSION['status_code'] = "success";
        header("Location: rToday.php");
        exit();
    } else {
        $_SESSION['status'] = "Client details not updated!";
        $_SESSION['status_code'] = "error";
        header("Location: rToday.php");
        exit();
    }
}

//(4) Update client info (all clients page) #error pop-up done
if (isset($_POST['updateAclient'])) {
    $u_id = $_POST['cidd'];
    $u_mobile = $_POST['mobileUpdate'];
    $u_othContact = $_POST['otherContact'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_suburb = $_POST['suburb'];
    $u_postcode = $_POST['postcode'];

    $u_petname = $_POST['petname'];
    $u_pettype = $_POST['pettype'];
    $u_breed = $_POST['breed'];
    $u_sex = $_POST['sex'];
    $u_color = $_POST['color'];
    $u_age = $_POST['age'];
    $u_weight = $_POST['weight'];
    $u_microchip = $_POST['microchip'];
    $u_insurance = $_POST['insurance'];
    $u_medication = $_POST['medication'];
    $u_parasiteC = $_POST['parasiteC'];
    $u_mcdate = date('Y-m-d', strtotime($_POST['mcdate']));


    $query = $conn->prepare("UPDATE clientinfo SET mobileNo = ?, othContact = ?, email = ?, clientAddress =  ?, suburb = ?, postcode = ? WHERE clientId = ?");
    $query->bind_param("iisssii", $u_mobile, $u_othContact, $u_email, $u_address, $u_suburb, $u_postcode, $u_id);
    $query->execute();

    $query2 = $conn->prepare("UPDATE petinfo SET petName = ?, petType = ?, breed = ?, sex = ?, color = ?, age = ?, petWeight = ?, microchip = ?, insurance = ?, medication = ?, parasiteControl = ?, mcDate = ? WHERE petKey = ? ");
    $query2->bind_param("sssssiisssssi", $u_petname, $u_pettype, $u_breed, $u_sex, $u_color, $u_age, $u_weight, $u_microchip, $u_insurance, $u_medication, $u_parasiteC, $u_mcdate, $u_id);
    $query2->execute();
    if ($query2) {
        $_SESSION['status'] = "Client details updated";
        $_SESSION['status_code'] = "success";
        header("Location: rAllclients.php");
        exit();
    } else {
        $_SESSION['status'] = "Client details not updated!";
        $_SESSION['status_code'] = "error";
        header("Location: rAllclients.php");
        exit();
    }
}

//(5) Adding doctor deatails from reception #error pop-up done
if (isset($_POST['registerbtn'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $registered = "No";

    $email_query = $conn->prepare("SELECT * FROM doctor WHERE demail = ? ");
    $email_query->bind_param("s", $email);
    $email_query->execute();
    $result = $email_query->get_result()->fetch_assoc();
    if ($result > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: addDoctor.php');
        exit();
    } else {
        $query = $conn->prepare("INSERT INTO doctor (dFname, dLname, dEmail, registered)VALUES(?,?,?,?)");
        $query->bind_param("ssss", $firstname, $lastname, $email, $registered);
        $query->execute();

        if ($query) {
            $_SESSION['status'] = "Doctor Profile Added";
            $_SESSION['status_code'] = "success";
            header('Location: addDoctor.php');
            exit();
        } else {
            $_SESSION['status'] = "Doctor Profile Not Added";
            $_SESSION['status_code'] = "error";
            header('Location: addDoctor.php');
            exit();
        }
    }
}

//(6) Download CSV file error pop-up not working here
if (isset($_POST['downloadCSV'])) {
    $value = "Yes";
    $filename = "members-data_" . date('d-m-y') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    $f = fopen('php://output', 'w');
    $delimiter = ",";
    $fields = array('ID', 'TITLE', 'FIRST NAME', 'LAST NAME', 'MOBILE NO', 'EMAIL', 'CHECK-IN DATE');
    fputcsv($f, $fields, $delimiter);
    $query1 = $conn->prepare("SELECT clientId, title, firstName, surName, mobileNo, email, checkinDate  FROM clientinfo WHERE newsletter = ?");
    $query1->bind_param("s", $value);
    $query1->execute();
    $result = $query1->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($f, $row);
    }
    fclose($f);
}

//(7) Updating receptionist profile #error pop-up done
if (isset($_POST['updatereception'])) {
    $r_username = $_POST['rname'];
    $r_password = $_POST['rpassword'];
    $r_id = $_POST['rid'];

    $query = $conn->prepare("UPDATE reception SET rUsername = ?, rPassword = ? WHERE rId = ?");
    $query->bind_param("ssi", $r_username, $r_password, $r_id);
    $query->execute();
    if ($query) {
        $_SESSION['status'] = 'Your information has been updated. Log out and sign back in for changes to take effect.';
        $_SESSION['status_code'] = "success";
        $_SESSION['rNameU'] = $r_username;
        header("Location: rDashboard.php");
        exit();
    } else {
        $_SESSION['status'] = 'Something went wrong when updating your information. Try again later';
        $_SESSION['status_code'] = "error";
        header("Location: rDashboard.php");
        exit();
    }
}

//(8) Sending snippet email to client #error pop-up done
if (isset($_POST['submitEmail'])) {
    $_SESSION['status'] = 0;
    $mail = new PHPMailer();
    $upload_dir = dirname(__FILE__) . '/attachments' . DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    // Define maxsize for files i.e 20MB
    $maxsize = 20 * 1024 * 1024;
    // Checks if user sent an empty form
    if (!empty(array_filter($_FILES['files']['name']))) {
        // Loop through each file in files[] array
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {
            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // Set upload file path
            $filepath = $upload_dir . $file_name;
            // Check file type is allowed or not
            if (in_array(strtolower($file_ext), $allowed_types)) {
                // Verify file size - 2MB max
                if ($file_size > $maxsize) {
                    $_SESSION['status'] = 'Error: File size is larger than the allowed limit.';
                    $_SESSION['status_code'] = "error";
                    header("Location: rSendEmail.php");
                    exit();
                }
                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if (file_exists($filepath)) {
                    $filepath = $upload_dir . time() . $file_name;
                    if (move_uploaded_file($file_tmpname, $filepath)) {
                        echo "{$file_name} successfully uploaded <br />";
                    } else {
                        $_SESSION['status'] = 'Error uploading {$file_name} <br />';
                        $_SESSION['status_code'] = "error";
                        header("Location: rSendEmail.php");
                        exit();
                    }
                } else {
                    if (move_uploaded_file($file_tmpname, $filepath)) {
                        $mail->addAttachment(dirname(__FILE__) . "/attachments/" . $file_name);
                        //echo "{$file_name} successfully uploaded <br />";
                    } else {
                        echo "Error uploading {$file_name} <br />";
                    }
                }
            } else {
                // If file extension not valid
                $_SESSION['status'] = 'Error uploading {$file_name} {$file_ext} file type is not allowed)<br / >';
                $_SESSION['status_code'] = "error";
                header("Location: rSendEmail.php");
                exit();
            }
        }
    } else {
        // If no files selected
        echo "No files selected.";
    }
    //fetching template file
    $template = "./template.php";
    if (file_exists($template))
        $message = file_get_contents($template);
    else
        die("unable to locate file");

    $selectedCount = $_POST['selectedCount'];
    $selectedLinks = $_POST['selected'];

    //adding the selected links to the template file. Appends the links to the template file depending on the no of links slected.
    function addExtraLinks($count, $message, $sLinks)
    {
        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($message);
        for ($i = 0; $i < $count; $i++) {
            $links = "";
            $pieces = explode("\n", $sLinks);
            $links = substr($pieces[$i], 0, -1);
            $inside = $htmlDom->getElementById('test');

            $div = $htmlDom->createElement("div");
            $div->setAttribute("class", "justify-content: center;");
            $div->setAttribute("style", " height : 70px; display: flex; align-items: center; margin-left:35%; margin-right:35%; margin-top: 8px;");
            $div->setAttribute("id", $i);

            $link = $htmlDom->createElement("a");
            $link->setAttribute('href', $links);
            $link->setAttribute("class", "button");
            $link->setAttribute("style", "width : 150px; background-color: #b967c7; border: none; color: white; padding: 15px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;");
            $link->textContent = ("Article : " . $i + 1);

            $div->appendChild($link);

            $inside->appendChild($div);
        }
        return $htmlDom->saveHTML();
    }
    //composing the email 
    $msg = addExtraLinks($selectedCount, $message, $selectedLinks);
    $gusername = $gmailUsername;
    $gpassword = $gmailPassword;
    $cName = $_POST['sender_name'];
    $cEmail = $_POST['recipient'];
    $cSubject = $_POST['subject'];
    $cBody = $msg;


    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $gusername;
    $mail->Password = $gpassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Links');
    $mail->addAddress($cEmail, $cName);
    $mail->isHTML(true);
    $mail->Subject = $cSubject;

    $mail->Body = $cBody;

    try {
        $mail->send();
        $_SESSION['status'] = 1;
    } catch (Exception $e) {
        echo "error" . $mail->ErrorInfo;
    }

    if ($_SESSION['status'] == 1) {
        $_SESSION['status'] = 'Email sent successfully to : ' . $cName;
        $_SESSION['status_code'] = "success";
        $id = $_POST['cid'];
        $snippet = "Yes";
        $stmt = $conn->prepare("UPDATE clientinfo SET snippet = ? WHERE clientId = ?");
        $stmt->bind_param("si", $snippet, $id);
        $stmt->execute();
        header("Location: rSendsnippet.php");
        exit();
    } else {
        $_SESSION['status'] = 'Failed to send email. Try after some time.';
        $_SESSION['status_code'] = "error";
        header("Location: rSendsnippet.php");
        exit();
    }
}

//(9) Receptionist login verification #error pop-up done
if (isset($_POST['rLogin'])) {
    $rUsername = $_POST['username'];
    $rPassword = $_POST['password'];
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } else {
        $query = $conn->prepare("SELECT rUsername, rPassword FROM reception WHERE rUsername = ?");
        $query->bind_param("s", $rUsername);
        $query->execute();
        $result = $query->get_result();
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['statusD'] = 'Username is invalid';
            $_SESSION['status_codeD'] = "error";
            header('Location: receptionistLogin.php');
            exit();
        } else if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $qusername = "$row[rUsername]";
                $qpassword = "$row[rPassword]";
            }
            if (($rUsername == $qusername) && ($rPassword == $qpassword)) {
                $_SESSION['rName'] = $qusername;
                $_SESSION['status'] = 'WELCOME ' . $qusername . '.' . ' You have successfully logged in.';
                $_SESSION['status_code'] = "success";
                $_SESSION['loggedin'] = "success";
                header('Location: rDashboard.php');
                exit();
            } else if ($rPassword != $qpassword) {
                $_SESSION['statusD'] = 'Password is invalid';
                $_SESSION['status_codeD'] = "error";
                header('Location: receptionistLogin.php');
                exit();
            }
        }
    }
}

//(10) Delete doctor record #error pop-up done
if (isset($_POST['deletedoc'])) {
    $did = $_POST['did'];
    $query = $conn->prepare("DELETE FROM doctor WHERE docId = ?");
    $query->bind_param("i", $did);
    $query->execute();
    if ($query) {
        $_SESSION['status'] = "Doctor record deleted.";
        $_SESSION['status_code'] = "success";
        header("Location: addDoctor.php");
        exit();
    } else {
        $_SESSION['status'] = "Cannot delete Doctor Record.";
        $_SESSION['status_code'] = "error";
        header("Location: addDoctor.php");
        exit();
    }
}

//(11) Updating doctor profile #error pop-up done
if (isset($_POST['updatedoc'])) {
    $d_id = $_POST['docid'];
    $d_firstname = $_POST['firstname'];
    $d_lastname = $_POST['lastname'];
    $d_email = $_POST['email'];
    $d_username = $_POST['username'];
    $d_password = $_POST['password'];

    $query = $conn->prepare("UPDATE doctor SET dFname = ?, username = ?, dLname = ?, dEmail =  ?, dPassword = ? WHERE docId = ?");
    $query->bind_param("sssssi", $d_firstname, $d_username, $d_lastname, $d_email, $d_password, $d_id);
    $query->execute();
    if ($query) {
        $_SESSION['status'] = "Doctor details has been updated.";
        $_SESSION['status_codeD'] = "success";
        $_SESSION['docId'] = $d_id;
        header("Location: doc_edit.php");
        exit();
    } else {
        $_SESSION['status'] = "Oops, something went wrong. Try gaian later.";
        $_SESSION['status_codeD'] = "error";
        header("Location: doc_edit.php");
        exit();
    }
}

//(12) Resetting doctor credentials #error pop-up done
if (isset($_POST['reset'])) {
    $did = $_POST['did'];
    $password = "";
    $registered  = "No";
    $username = "";
    $query = $conn->prepare("UPDATE doctor SET username = ?, dPassword = ?, registered = ? WHERE docId = ? ");
    $query->bind_param("sssi", $username, $password, $registered, $did);
    $query->execute();
    if ($query) {
        $_SESSION['status'] = "Doctor credentials has been reset.";
        $_SESSION['status_code'] = "success";
        header("Location: addDoctor.php");
        exit();
    } else {
        $_SESSION['status'] = "Cannot reset doctor profile. Try again later.";
        $_SESSION['status_code'] = "error";
        header("Location: addDoctor.php");
        exit();
    }
}

//(13) Receptionist logout #error pop-up done
if (isset($_POST['logoutRec'])) {
    $_SESSION['statusD'] = "You have successfully logged out. See you soon";
    $_SESSION['status_codeD'] = "info";
    $_SESSION['msg'] = "";
    unset($_SESSION['loggedin']);
    header("Location: receptionistLogin.php");
    exit();
}
