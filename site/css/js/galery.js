var index = 1;
showPhoto(index);

function nextPhoto(n) {
  showPhoto(index += n);
}

function currentPhoto(n) {
  showPhoto(index = n);
}

function showPhoto(n) {
  var i;
  var photos = document.getElementsByClassName("photo");
  var dots = document.getElementsByClassName("dot");

  if (n > photos.length) {
    index = 1;
  }
  if (n < 1) {
    index = photos.length;
  }

  for(i = 0; i < photos.length; i++) {
    photos[i].style.display = "none";
  }

  for(i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  photos[index-1].style.display = "block";
  dots[index-1].className += " active";
}
