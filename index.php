<?php include("includes/header.php");?>
<?php
require "db.php";
session_start();
if(isset($_SESSION['userid'])){
    header("Location: home.php");
}
?>
<h1 class="title">Welcome to Tecno Bauherr</h1>
<p class="subtitle">We are a tecnology commpany focus to develop our planet to a better way to the evolution</p>
<p class="paragraph"><a href="login.php"><span class="material-symbols-outlined">login</span> login</a> or <a href="signup.php">sign-up <span class="material-symbols-outlined">account_circle</span></a></p>
<div class="main-image"><img src="img/industry.jpg" alt=""></div>
<?php include("includes/footer.php");?>