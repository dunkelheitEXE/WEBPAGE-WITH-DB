<?php include("includes/header.php")?>
<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} else {
    //code...
    $message="";
    if(isset($_POST['submit'])){
        $mysql = "UPDATE users SET profilephoto = :photo, userdesc = :userdesc WHERE id=:id";
        $req = $connection->prepare($mysql);
        $req->bindParam(':id', $_SESSION['userid']);
        $des=$_POST['userdesc'];
        $photofile = "img/".$_FILES['profilephoto']['name'];
        //SAVE IMAGE AND UPLOAD IT TO DB
        if(empty($_FILES['profilephoto']['name']) or empty($_FILES['profilephoto']['tmp_name'])){
            $message = "You kept your photo profile";
            $record=$connection->prepare("SELECT * FROM users WHERE id=:id");
            $record->bindParam(':id', $_SESSION['userid']);
            $record->execute();
            $res = $record->fetch(PDO::FETCH_ASSOC);
            $photofile = $res['profilephoto'];
        } else if(empty($_POST['userdesc'])) {
            $message = "Your profile photo has been updated";
            $record=$connection->prepare("SELECT * FROM users WHERE id=:id");
            $record->bindParam(':id', $_SESSION['userid']);
            $record->execute();
            $res = $record->fetch(PDO::FETCH_ASSOC);
            $des = $res['userdesc'];
        }
        $req->bindParam(':userdesc', $des);
        move_uploaded_file($_FILES['profilephoto']['tmp_name'], $photofile);
        $req->bindParam(':photo', $photofile);
        $req->execute();
    }
}
?>

<!-- HTML SCRIPT -->
<?php include("includes/toLogged.php"); ?>
<?php if(!empty($message)):?>
    <div class="target"><?=$message?></div>
<?php endif;?>
<form action="profile-config.php" method="post" class="form" enctype="multipart/form-data">
    <?php if(isset($_SESSION['profilephoto']) and $_SESSION['profilephoto'] != null): ?>
        <img src="<?= $_SESSION['profilephoto']?>" alt="photo mysql" class="profile-photo">
    <?php endif; ?>
    <?php if(!isset($_SESSION['profilephoto']) or $_SESSION['profilephoto'] == null): ?>
        <img src="img/profile.jpg" alt="photo" class="profile-photo">
    <?php endif;?>
    <input class="form-control" type="file" name="profilephoto" accept=".jpg,.png,.jpeg">
    <input type="text" name="userdesc" id="" class="form-control">
    <input type="submit" name="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>