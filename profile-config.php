<?php include("includes/header.php")?>
<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} else {
    //code...
    $currentSession = $connection->prepare("SELECT profilephoto FROM users WHERE id=:id");
    $currentSession->bindParam(':id', $_SESSION['userid']);
    $currentSession->execute();
    $results = $currentSession->fetch(PDO::FETCH_ASSOC);

    $profilephoto = $results['profilephoto'];//STABLISH NEW PROFILE PHOTO
    if(isset($_POST['submit'])){
        $mysql = "UPDATE users SET profilephoto = :photo WHERE id=:id";
        $req = $connection->prepare($mysql);
        $req->bindParam(':id', $_SESSION['userid']);

        //SAVE IMAGE AND UPLOAD IT TO DB
        $photofile = "img/".$_FILES['profilephoto']['name'];
        move_uploaded_file($_FILES['profilephoto']['tmp_name'], $photofile);
        $req->bindParam(':photo', $photofile);

        $req->execute();
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