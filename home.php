<?php include("includes/header.php");?>
<?php
session_start();
require "db.php";
if(isset($_SESSION['userid'])){
    $stmt = $connection->prepare('SELECT id, username FROM users WHERE id=:id');
    $stmt -> bindParam(':id', $_SESSION['userid']);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $user=null;
    if(count($results) >0) {
        $user = $results;
    }

    if(!empty($user)) {
        $name = $user['username'];
        $but_logout = '<div class="float-button"><a href="logout.php"><span class="material-symbols-outlined">logout</span></a></div>';
        echo $but_logout;
    }
} else {
    header("Location: index.php");
}
?>

<div class="target-user">
    <img src="img\profile.jpg" alt="image" class="profile-photo">
    <div class="user-data">
        <p>User: <?php echo $name; ?></p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam placeat inventore quaerat tempora sunt deserunt veritatis at impedit laboriosam, itaque commodi provident molestias iste a amet eos est sequi ad.</p>
        <input type="button" value="Hola" class="button-selection">
    </div>
</div>
<p class="subtitle">We are a tecnology commpany focus to develop our planet to a better way to the evolution</p>
<div class="main-image"><img src="img/industry.jpg" alt=""></div>
<?php include("includes/footer.php");?>