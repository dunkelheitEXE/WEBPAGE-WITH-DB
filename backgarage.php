<?php include("includes/header.php");?>
<?php 
require "db.php";
$message = "";
if(!empty($_POST['modname']) && !empty($_POST['modpassword']) && !empty('modkey')) {
    $message = "Available connection";
}

echo $message;
?>
<form action="" class="form" method="POST">
    <div class="title">MOD REGISTER</div>
    <input type="text" name="modname" class="form-control" placeholder="User">
    <input type="password" name="modpassword" class="form-control" placeholder="Password">
    <input type="text" name="modkey" class="form-control" placeholder="Master key">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php");?>