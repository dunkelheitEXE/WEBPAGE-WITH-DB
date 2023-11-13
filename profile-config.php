<?php include("includes/header.php")?>
<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} else {
    //code...
    if(isset($_POST['submit'])){
        
    }
}
?>

<!-- HTML SCRIPT -->
<?php include("includes/toLogged.php"); ?>

<form action="profile-config.php" method="post" class="form" enctype="multipart/form-data">
    <img src="img/profile.jpg" alt="photo" class="profile-photo">
    <input class="form-control" type="file" name="profilephoto" accept=".jpg,.png,.jpeg">
    <input type="submit" name="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>