<?php include("includes/header.php")?>
<?php
require "db.php";

$message = "";
if(!empty($_POST['username']) && !empty($_POST['userpass'])) {
    $sql = "INSERT INTO users(username, userpass) VALUES(:username, :userpass)";
    $stmt = $connection -> prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $password = password_hash($_POST['userpass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':userpass', $password);

    if($stmt->execute()) {
        $message="User created successfuly";
    } else {
        $message="Connection error";
    }
    echo $message;
}

?>
<form action="signup.php" class="form" method="POST">
    <h1 class="title"><span class="material-symbols-outlined">account_circle</span> Sign-up</h1>
    <input type="text" class="form-control" name="username" placeholder="User">
    <input type="password" class="form-control" name="userpass" placeholder="Password">
    <input type="password" class="form-control" placeholder="Confirm Password">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>