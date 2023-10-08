let menu_button = document.getElementById("menu-button");//Comentario en español
let menu_dropdown = document.getElementById("menu-dropdown");
let statement = false;
menu_button.addEventListener("click", () => {
    if (statement == false) {
        //console.log("Visibble");
        menu_dropdown.classList.add("visible");
        statement = true;
    } else {
        //console.log("Not visibble");        
        menu_dropdown.classList.remove("visible");
        statement = false;
    }
});