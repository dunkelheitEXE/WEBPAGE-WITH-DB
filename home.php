<?php include("includes/header.php");?>
<?php
session_start();
require "db.php";
if(isset($_SESSION['userid'])){
    $stmt = $connection->prepare('SELECT * FROM users WHERE id=:id');
    $stmt -> bindParam(':id', $_SESSION['userid']);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $user=null;
    if(count($results) >0) {
        $user = $results;
    }
    if(!empty($user)) {
        $name = $user['username'];
        $desc = $user['userdesc'];
    }

} else {
    header("Location: index.php");
}

include("includes/toLogged.php");
?>
<div class="target-user">
    <?php if(isset($_SESSION['profilephoto']) and $_SESSION['profilephoto'] != null): ?>
        <img src="<?= $_SESSION['profilephoto']?>" alt="photo mysql" class="profile-photo">
    <?php endif; ?>
    <?php if(!isset($_SESSION['profilephoto']) or $_SESSION['profilephoto'] == null): ?>
        <img src="resources/profile.jpg" alt="photo" class="profile-photo">
    <?php endif;?>
    <div class="user-data">
        <p>User: <?php echo $name; ?></p>
        <p><?php echo $desc; ?></p>
        <div class="button-selection">
            <a href="profile-config.php">CONFIGURE</a>
        </div>
    </div>
</div>
<p class="subtitle">We are a tecnology commpany focus to develop our planet to a better way to the evolution</p>
<div class="main-image"><img src="resources/industry.jpg" alt=""></div>

<div class="container">
    
</div>
<?php include("includes/footer.php");?>