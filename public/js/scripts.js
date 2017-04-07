/**
 * scripts.js
 *
 * Computer Science 50
 * Problem Set
 *
 * Global JavaScript, if any.
 */

document.onload = function() {myMove()};
function myMove() {
  var elem = document.getElementsByClassName("product-top");   
  var pos = 50;
  var id = setInterval(frame, 5);
  function frame() {
    if (pos == 1) {
      clearInterval(id);
    } else {
      pos--; 
      elem.style.top = pos + '%';
      elem.style.opacity = 1 - (pos-1)/100;
    }
  }
}