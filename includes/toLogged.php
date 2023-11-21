<?php require "db.php";
$link = "resources/profile.jpg";
if(isset($_SESSION['userid'])) {
    $account = $connection->prepare("SELECT profilephoto FROM users WHERE id = :id");
    $account->bindParam(':id', $_SESSION['userid']);
    $account->execute();
    $r = $account->fetch(PDO::FETCH_ASSOC);
    if(count($r) > 0) {
        $link = $r['profilephoto'];
    }
}
?>
<div class="float-element fb-right">
    <div class="float-button"><a href="logout.php">Logout</a></div>
    <div class="float-button"><a href="#" id="profile-btn"><img src="<?=$link ?>" alt="" style="width: 24px; border-radius:50%;"></a></div>
</div>
<div class="profile-menu" id="profile-menu">
    <a href="uploadOb.php">UPLOAD</a>
    <a href="ware.php">YOUT PRODUCTS</a>
</div>

<script>
    let p_menu = document.getElementById('profile-menu');
    let p_btn_menu = document.getElementById('profile-btn');
    let p_m_state = false;
    p_btn_menu.addEventListener("click", () => {
        if(p_m_state == false){
            //console.log("PROFILE");
            p_menu.classList.add('profile-v');
            p_m_state = true;
        } else {
            //console.log("NO PROFILE");
            p_menu.classList.remove('profile-v');
            p_m_state = false;
        }
    });
</script>
