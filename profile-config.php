<?php include("includes/header.php")?>
<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
    header("Location: index.php");
} else {
    //code...
    echo "hola";
}
?>

<!-- HTML SCRIPT -->
<div class="float-button fb-right">
    <a href="logout.php">Logout</a>
</div>
<?php include("includes/footer.php")?>