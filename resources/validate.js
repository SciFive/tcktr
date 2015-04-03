function validateLogin() {
        var email = document.forms["login"]["email"].value;
        var pass = document.forms["login"]["pass"].value;
        if (email == null || email == "") {
            alert("Email required");
            return false;
        }
        if (pass == null || pass == "") {
            alert("Password required");
            return false;
        }
        else{ 
            window.location.href= "http://www.tcktr.tk/tcktr/admin/admin.html";
        }
    }
      
    // validation was successful

function validateRegister() {
        var user = document.forms["register"]["user"].value;
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

        window.location.href= "http://www.tcktr.tk/tcktr/admin/admin.html";
        return true;
    }
