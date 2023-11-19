<?php include("includes/header.php");?>
<?php
session_start();
require "db.php";
$name ="";
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
    <?php
    if(isset($_SESSION['userid'])):
        $produc = $connection->prepare("SELECT * FROM objects");
        $produc->execute();
        while($produc_result = $produc->fetch()):?>
            <div class="element-target">
                <div class="element-image">
                    <img src="<?= $produc_result['obimage']?>" alt="img">
                </div>
                <div class="element-button">
                    <?php if($produc_result['byuser'] != $name):?>
                    <a href="#" class="element-btn view">view</a>
                    <a href="#" class="element-btn buy">buy</a>
                    <?php else: ?>
                        <a href="#">UPDATE</a>
                    <?php endif;?>
                </div>
                <div class="element-title"><?=$produc_result['obname']?></div>
                <div class="element-text"><?= $produc_result['obdesc']?></div>
            </div>
        <?php 
        endwhile;
    endif;
        ?>
</div>
<?php include("includes/footer.php");?>