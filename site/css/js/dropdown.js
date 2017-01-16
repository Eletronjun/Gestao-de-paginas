var open = false;
var menu = document.getElementsByClassName("menu");


function dropdownClick($id)
{
    var name = "itemDD_" + $id;
    if(!document.getElementById($id).classList.contains("selected_drop")) {
      document.getElementById(name).classList.toggle("show");
      document.getElementById($id).className += " selected_drop";
    } else {
      document.getElementById(name).classList.remove("show");
      var selected = document.getElementsByClassName("selected_drop");
      selected[0].className = selected[0].className.replace(" selected_drop", "");
    }
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
        var selected = document.getElementsByClassName("selected_drop");
        selected[0].className = selected[0].className.replace(" selected_drop", "");
    }
}

function menuClick() {

  if(!open){
    open = true;
    menu[0].className += " menu-open";
  } else {
    open = false;
    menu[0].className = menu[0].className.replace(" menu-open", "");
  }
}
