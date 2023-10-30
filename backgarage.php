<?php include("includes/header.php");?>
<?php 
require "db.php";
$message = "";
if(!empty($_POST['modname']) && !empty($_POST['modpassword']) && !empty($_POST['modkey'])) {
    $message = "<div class='target tg-success'>Available connection</div>";
    $mysql = "";
} else {
    $message = "<div class='target tg-danger'>Not Available connection</div>";
}

echo $message;
?>
<form action="backgarage.php" class="form" method="POST">
    <div class="title">MOD REGISTER</div>
    <input type="text" name="modname" class="form-control" placeholder="User">
    <input type="password" name="modpassword" class="form-control" placeholder="Password">
    <input type="text" name="modkey" class="form-control" placeholder="Master key">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php");?>