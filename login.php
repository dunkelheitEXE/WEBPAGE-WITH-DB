<?php include("includes/header.php")?>
<?php
session_start();
if(isset($_SESSION['userid'])){
    header("Location: home.php");
}
require "db.php";

if(!empty($_POST['username']) && !empty($_POST['userpass'])) {
    $sql = 'SELECT * FROM users where username=:username';
    $rec=$connection->prepare($sql);
    $rec->bindParam(':username', $_POST['username']);
    $rec->execute();
    
    $message="";
    $results = $rec->fetch(PDO::FETCH_ASSOC);
    //echo $results;

    try {
        //code...
        if(count($results) > 0 && password_verify($_POST['userpass'], $results['userpass'])) {
            $_SESSION['userid'] = $results['id'];
            header("Location: home.php");
        } else {
            $message = "Not authorized access. These credentials are not available";
        }
    } catch (\Throwable $th) {
        $message = "Not authorized access. These credentials are not available";
    }
    
}
if(!empty($message)) {
    echo"<div class='target tg-danger'>$message</div>";
}
?>
<form action="login.php" class="form" method="POST">
    <div class="title">Login</div>
    <input type="text" name="username" class="form-control" placeholder="User">
    <input type="password" name="userpass" class="form-control" placeholder="Password">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>