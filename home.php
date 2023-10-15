<?php include("includes/header.php");?>
<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} 
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
        echo"<h1 class='title'>Welcome $name</h1>";
    }
}


?>
<p class="subtitle">We are a tecnology commpany focus to develop our planet to a better way to the evolution</p>
<div class="main-image"><img src="img/industry.jpg" alt=""></div>
<?php include("includes/footer.php");?>