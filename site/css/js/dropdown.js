function dropdownClick($id)
{
    document.getElementById($id).classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

var open = false;
function menuClick() {

  var menu = document.getElementsByClassName("menu");
  var header = document.getElementById("header");

  if(!open){
    open = true;
    menu[0].className += " menu-open";
    header.style.position = "fixed";
  } else {
    open = false;
    menu[0].className = menu[0].className.replace(" menu-open", "");
    header.style.position = "absolute";
  }
}
