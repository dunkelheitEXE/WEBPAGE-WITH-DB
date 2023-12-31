<?php include("includes/header.php")?>
<?php

try {
    //code...
require "db.php";

$message = "";
if(!empty($_POST['username']) && !empty($_POST['userpass'])) {
    // MYSQL COMMAND TO EXECUTE
    $state_verifying = true;
    $verification = $connection->prepare("SELECT * FROM users");
    $verification->execute();
    while ($verfying=$verification->fetch()) {
        if($verfying['username'] == $_POST['username']) {
            $state_verifying = false;
            break;
        }
    }
    if($state_verifying == false) {
        $message = "<div class='target tg-danger'>ERROR, THIS USER HAVE ALREADY BEEN CREATED</div>";
    } else {
        $sql = "INSERT INTO users(username, userpass) VALUES(:username, :userpass)";

        //VERIFY IF PASSWORD IS CONFIRMED
        $p1 = $_POST['userpass'];
        $p2 = $_POST['confirmation'];
        if($p1 == $p2) {
            //PREPARE AND EXECUTE MYSQL PROMPT
            $stmt = $connection -> prepare($sql);
            $stmt->bindParam(':username', $_POST['username']);
            $password = password_hash($_POST['userpass'], PASSWORD_BCRYPT);
            $stmt->bindParam(':userpass', $password);

            if($stmt->execute()) {
                $message="<div class='target tg-success'>USER CREATED SUCCESSFULY</div>";
            } else {
                $message="<div class='target tg-danger'>ERROR, PLEASE CHECK YOUR CONNECTION</div>";
            }
        } else {
            $message = "<div class='target tg-danger'>YOUR PASSWORD CONFIRMATION IS NOT CORRECT</div>";
        }
    }

    
}

if(!empty($message)) {
    echo"$message";
} else {
    echo "";
}

} catch (\Throwable $th) {
    //throw $th;
    echo $th;
}

?>
<form action="signup.php" class="form" method="POST">
    <h1 class="title"><span class="material-symbols-outlined">account_circle</span> Sign-up</h1>
    <input type="email" class="form-control" name="username" placeholder="User">
    <input type="password" class="form-control" name="userpass" placeholder="Password">
    <input type="password" class="form-control" name="confirmation" placeholder="Confirm Password">
    <input type="submit" value="Submit" class="form-control form-button">
</form>
<?php include("includes/footer.php")?>