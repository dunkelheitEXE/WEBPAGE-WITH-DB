<div class="float-element fb-right">
    <div class="float-button"><a href="logout.php">Logout</a></div>
    <div class="float-button"><a href="#" id="profile-btn"><span class="material-symbols-outlined">account_circle</span></a></div>
</div>
<div class="profile-menu" id="profile-menu">
    <a href="uploadOb.php">UPLOAD</a>
    <a href="#">comming soon</a>
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
