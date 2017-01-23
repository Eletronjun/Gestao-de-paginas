var index = 0;
var show = 0;
var timerId = 0;

window.showBanner();

function showBanner() {
  var list = document.getElementsByClassName("publication");

  if(window.innerWidth < 801) {

    if(index == list.length) {
     index = 0;
    } else if(index == 0) {
      show = list.length - 1;
    } else if (show == list.length) {
      show = 0;
    }

    list[show].className = list[show].className.replace(" show", "");
    list[index++].className += " show";
    show++;

    window.clearInterval(timerId);
    timerId = window.setInterval(showBanner, 6000);
  }
}
