var currentPosition = 0; // Current position set 
showPosition(currentPosition); // Show the current position

function showPosition(n) {
  var x = document.getElementsByClassName("passForm");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
}

function nextPrev(n) {
  // This function will figure out which position to show
  var x = document.getElementsByClassName("passForm");
  // Exit the function if any field in the current position is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current position:
  x[currentPosition].style.display = "none";
  // Increase or decrease the current position by 1:
  currentPosition = currentPosition + n;
  // if you have reached the end of the form...
  if (currentPosition >= x.length) {
    // ... the form gets submitted:
    document.getElementById("dForm").submit();
    return false;
  }
  // Otherwise, show the correct position:
  showPosition(currentPosition);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("passForm");
  y = x[currentPosition].getElementsByTagName("input");
  // A loop that checks every input field in the current Position:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentPosition].className += " finish";
  }
  return valid; // return the valid status
}
