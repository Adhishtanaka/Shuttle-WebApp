 //validation part
 function validatesin() {

    if (document.sin.email.value == "") {
        alert("Type your Email");
        return false;
      }

      if (document.sin.password.value == "") {
        alert("Type your Password");
        return false;
      }

    return true;
  }

  function validateShuttles() {
    var ownerNIC = document.getElementById('ownerNIC').value;
    var ownerContact = document.getElementById('ownerContact').value;
    var ownerNICImage = document.getElementById('ownerNICImage').value;
    var driverContact = document.getElementById('driverContact').value;
    var driverEmail = document.getElementById('driverEmail').value;
    var driverPassword = document.getElementById('driverPassword').value;
    var driverNICImage = document.getElementById('driverNICImage').value;
    var vehicleLicenseImage = document.getElementById('vehicleLicenseImage').value;
    var routeNumbers = document.getElementById('routeNumbers').value;
    var destination = document.getElementById('destination').value;

    if (ownerNIC === "" || ownerContact === "" || ownerNICImage === "" || driverContact === "" || driverEmail === "" || driverPassword === "" || driverNICImage === "" || vehicleLicenseImage === "" || routeNumbers === "" || destination === "") {
        alert("Please fill in all fields");
        return false;
    }
    return true;
}


function validateAlert() {
  var ownerNIC = document.getElementById("ownerNIC").value;
  var ownerContact = document.getElementById("ownerContact").value;
  var odesc = document.getElementById("odesc").value;

  if (ownerNIC === "") {
      alert("Please fill in all fields");
      return false;
  }

  var contactPattern = /^\+[0-9]{10,15}$/;
  if (!contactPattern.test(ownerContact)) {
      alert("Invalid contact number. Please enter a valid contact number.");
      return false;
  }

  if (odesc.trim() === "") {
    alert("Please fill in all fields");
      return false;
  }

  return true;
}

