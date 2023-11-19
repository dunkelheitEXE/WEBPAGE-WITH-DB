<?php include("includes/header.php");?>
<?php
session_start();
require "db.php";

if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
}
$message="";
if(!empty($_POST['obname']) && !empty($_POST['obdesc'])){
    $getuser = $connection->prepare("SELECT username FROM users WHERE id=:id");
    $getuser->bindParam(':id', $_SESSION['userid']);
    $getuser->execute();
    $gotten = $getuser->fetch(PDO::FETCH_ASSOC);
    $req = $connection->prepare("INSERT INTO objects(obname, obdesc, obimage, obcreated, byuser) VALUES(:obname, :obdesc, :obimage, NOW(), :byuser)");
    $req->bindParam(':obname', $_POST['obname']);
    $req->bindParam(':obdesc', $_POST['obdesc']);
    $req->bindParam(':byuser', $gotten['username']);
    $obimage = 'img/'.$_FILES['obimage']['name'];
    move_uploaded_file($_FILES['obimage']['tmp_name'], $obimage);
    $req->bindParam(':obimage', $obimage);
    if($req->execute()){
        $message = "SUCCESS";
    } else {
        $message = "ERROR";
    }
}

?>
<?php if(!empty($message)):?>
    <div class="target"><?=$message?></div>
<?php endif;?>
<form action="uploadOb.php" method="post" class="form" enctype="multipart/form-data">
    <input type="text" name="obname" id="" class="form-control" placeholder="Product name">
    <input type="text" name="obdesc" id="" class="form-control" placeholder="Description">
    <input type="file" name="obimage" accept=".jpg,.png,.jpeg" class="form-control">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php");?>