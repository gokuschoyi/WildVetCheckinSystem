<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            maxDate: today
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });
</script>
<form method = "POST" >
<p>Select Date: <input type="text" name  = "date" placeholder="Select Date" class="datepicker form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center"></p>
<button class="btn btn primary" name = "btn">click me</button>
</form>
<?php
if(isset($_POST['btn'])){
    $mcDate =  date('Y-m-d', strtotime($_POST['date']));
    echo $mcDate;
}
$fname = "gokul";
$tname = "gokul";
if($fname == $tname){
    echo "true test";
}
$loop_expiry = time()+5;
$t=time();
echo($t . "<br>");
echo($loop_expiry . "<br>");
/* echo(date("Y-m-d",$t)); */
/* while($loop_expiry>time()){
    echo $loop_expiry."  ".time();
} */
?>
</body>
</html>