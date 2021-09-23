<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'simple_html_dom.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
if(isset($_POST['submitEmail']))
    {
        $cName = $_POST['sender_name'];
        $cEmail = $_POST['recipient'];
        $cSubject = $_POST['subject'];
        $cAttachment = $_FILES['attachments']['name'];
        $cBody = $_POST['body'];
        $_SESSION['id']= $_POST['cid']; 
    }
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    
    $_SESSION['status'] = 0;
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Quick Search..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Quick Search..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php
            if(isset($_POST['sendEmail']))
            {
                $cid = $_POST['cid'];
            }
            ?>
                <h1 class="h3 mb-0 text-gray-800">CLIENT ID : <?php   echo $_SESSION['id'] ?> </h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                        style="font-size:1.2vw;">
                                        CLIENT NAME</div>
                                    <?php
                                        $space = " ";
                                        $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                                        $query = $conn->prepare("SELECT title, firstName, surName, addComments FROM clientinfo WHERE clientId = ?");
                                        $query->bind_param("s",$cid);
                                        $query->execute();
                                        $stmt1 = $query->get_result()->fetch_row();
                                        ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stmt1[0], $space,$stmt1[1], $space, $stmt1[2]?></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if(isset($_POST['sendEmail']))
            {
                $cid = $_POST['cid'];
                $space = " ";
                $selectedCount = count($_POST['check_list']);
            }
                $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
                $query = $conn->prepare("SELECT email FROM clientinfo WHERE clientId = ?");
                $query->bind_param("s",$cid);
                $query->execute();
                $stmt = $query->get_result()->fetch_row();
            ?>

            <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-md-12 mb-12">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                            style="font-size:1.2vw;">PREVIEW EMAIL</div>
                                        <div class="row">
                                            <div class="col-md-8 mx-auto bg-white border p-5">
                                                <?php if ($_SESSION['status'] == 1) { ?>
                                                <div class='alert alert-success'>Email sent successfully.</div>
                                                <?php } ?>
                                                <form action="rsendingEmail.php" method="POST" >
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <label for="sender_name" class="form-label">Sender Name</label>
                                                            <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="John Doe" value="<?php echo $stmt1[0], $space,$stmt1[1], $space, $stmt1[2] ;?>"required>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label for="subject" class="form-label">Subject</label>
                                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="How are you?" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="attachments" class="form-label">Attachments (Multiple)</label>
                                                        <input type="file" class="form-control" multiple id="attachments" name="attachments[]" placeholder="name@example.com">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient" class="form-label">Recipient Emails</label>
                                                        <input type="text" class="form-control" id="recipient" name="recipient" value="<?php echo $stmt[0] ;?>" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php
                                                        $arraySel = array();
                                                        if(isset($_POST['sendEmail'])){
                                                            if(!empty($_POST['check_list'])) {
                                                            $checked_count = count($_POST['check_list']);
                                                                foreach($_POST['check_list'] as $selected) {
                                                                    array_push($arraySel, $selected);
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <label for="body" class="form-label">Body</label>
                                                        <textarea class="form-control" id="body" name="body"  placeholder="Hi, How are you?" rows="10" required><?php foreach($arraySel as $sel) {echo $sel ."\n";} ?></textarea></n>
                                                    </div>
                                                    <div style =" text-align :center">
                                                        <button class="btn btn-primary me-2" name="submitEmail" type="submit">Send Email</button>
                                                        <button class="btn btn-danger" type="reset">Reset Form</button>
                                                    </div>
                                                    <input type = "hidden" name = "cid" value = "<?php echo $cid?>">
                                                    <input type = "hidden" name = "selectedCount" value = "<?php echo $selectedCount?>">
                                                    <input type = "hidden" name = "selected" value = "<?php foreach ($arraySel as $arr) {echo $arr ."\n";}?>">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 align-items-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800  justify-content-center">
                            <buttontype="button" class=" btn btn-warning" onclick="location.href='rFetch_links.php'" ;>
                                GO BACK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>