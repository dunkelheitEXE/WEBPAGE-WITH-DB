<?php include("includes/header.php")?>
<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} else {
    //code...
    $message="";
    $getting = $connection->prepare("SELECT * FROM users WHERE id=:id");
    $getting->bindParam(':id', $_SESSION['userid']);
    $getting->execute();
    $results = $getting->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['submit'])){
        if(!empty($_POST['userdesc']) and !$_FILES['profilephoto']['tmp_name']) {
            $req = $connection->prepare("UPDATE users SET userdesc=:descc WHERE id=:id");
            $req->bindParam(':descc', $_POST['userdesc']);
            $req->bindParam(':id', $_SESSION['userid']);
            if($req->execute()) {
                $message = "USER DESCRIPTION UPDATED SUCCESSFULLY!";
            }
        } else if(empty($_POST['userdesc']) and $_FILES['profilephoto']['tmp_name']){
            $req = $connection->prepare("UPDATE users SET profilephoto=:p WHERE id=:id");
            $route = "img/".$_FILES['profilephoto']['name'];
            move_uploaded_file($_FILES['profilephoto']['tmp_name'], $route);
            $req->bindParam(':p', $route);
            $req->bindParam(':id', $_SESSION['userid']);
            if($req->execute()) {
                $message = "USER PHOTO UPDATED SUCCESSFULLY!";
            }
        } else if(empty($_POST['userdesc']) and !$_FILES['profilephoto']['tmp_name'] and !empty($_POST['usernickname'])){
            $req = $connection->prepare("UPDATE users SET usernickname=:nick WHERE id=:id");
            $req->bindParam(':nick', $_POST['usernickname']);
            $req->bindParam(':id', $_SESSION['userid']);
            if($req->execute()) {
                $message = "NICKNAME UPDATED SUCCESSFULLY!";
            }
        } else {
            $req = $connection->prepare("UPDATE users SET userdesc=:descc, profilephoto=:p, usernickname=:n WHERE id=:id");
            $req->bindParam(':descc', $_POST['userdesc']);
            $route = "img/".$_FILES['profilephoto']['name'];
            move_uploaded_file($_FILES['profilephoto']['tmp_name'], $route);
            $req->bindParam(':p', $route);
            $req->bindParam(':n', $_POST['usernickname']);
            $req->bindParam(':id', $_SESSION['userid']);
            if($req->execute()) {
                $message = "USER ASPECTS UPDATED SUCCESSFULLY!";
            }
        }
    }
}
?>

<!-- HTML SCRIPT -->
<?php include("includes/toLogged.php"); ?>
<?php if(!empty($message)):?>
    <div class="target"><?=$message?></div>
<?php endif;?>
<form action="profile-config.php" method="post" class="form" enctype="multipart/form-data">
    <?php if(isset($_SESSION['profilephoto']) or $_SESSION['profilephoto'] != null): ?>
        <img src="<?= $_SESSION['profilephoto']?>" alt="photo mysql" class="profile-photo">
    <?php endif; ?>
    <?php if(!isset($_SESSION['profilephoto']) or $_SESSION['profilephoto'] == null): ?>
        <img src="resources/profile.jpg" alt="photo" class="profile-photo">
    <?php endif;?>
    <input type="text" name="usernickname" class="form-control" value="<?= $results['usernickname']?>" placeholder="Nickname">
    <input class="form-control" type="file" name="profilephoto" accept=".jpg,.png,.jpeg">
    <input type="text" name="userdesc" id="" class="form-control" placeholder="profile description">
    <input type="submit" name="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>