function validateLogin() {
    var email = document.forms["login"]["email"].value; // Put values from the form into Javascrip vatriables
    var pass = document.forms["login"]["pass"].value;
    if (email == null || email == "") { // Make sure Email is not empty
        alert("Email required");
        return false;
    }
    if (pass == null || pass == "") { // Make sure Password is not empty
        alert("Password required");
        return false;
    }
    else{ 
        window.location.href= "./desktop"; // Send user to Admin Page
    }
}
      
    // validation was successful

function validateRegister() {
    var user = document.forms["register"]["user"].value; // Make sure all variables are not empty
    if (user == null || user == "") {
        alert("Please select a username");
        return false;
    }

    var email = document.forms["register"]["email"].value;
    if (email == null || email == "") {
        alert("Please put a valid email address");
        return false;
    }

    var pass = document.forms["register"]["password"].value;
    if (pass == null || pass == "" || pass.length<8) {
        alert("Please select a longer password");
        return false;
    }

    var check = document.forms["register"]["terms"];
    if (check.checked == false) {
        alert("Please check terms and conditions");
        return false;
    }

    window.location.href= "./desktop"; // Send user to Admin page
    return true;
}
