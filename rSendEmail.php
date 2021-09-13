<?php
if(isset($_POST['sendEmail'])){
    if(!empty($_POST['check_list'])) {
        $checked_count = count($_POST['check_list']);
        
        echo "You have selected following ".$checked_count." option(s): <br/>";
        foreach($_POST['check_list'] as $selected) {
            echo "<p>".$selected ."</p>";
            }
            echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";
        }
        else{
            echo "<b>Please Select Atleast One Option.</b>";
        }
        $id = $_POST['cid'];
        echo $id;
    }

?>