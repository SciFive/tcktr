function validateLogin(form)
  {
    // validation fails if the input is blank
    if(form.email.value == "") {
      alert("Error: Input is empty!");
      form.email.focus();
      return false;
    }
      
      window.location.href= "http://www.tcktr.tk/tcktr/admin/admin.html";
    // validation was successful
    return true;
  }

function validateRegister() {
        var x = document.forms["register"]["user"].value;
        if (x == null || x == "") {
            alert("Please select a longer username");
            return false;
        }
        var y = document.forms["register"]["password"].value;
        var y2 = document.forms["register"]["pass2"].value;
        if (y == null || y == "" || y.length<8) {
            alert("Please select a longer password");
            return false;
        }
        if (y!=y2) {
            alert("Passwords must match");
            return false;
        }
        alert("success");
         window.location.href= "http://www.tcktr.tk/tcktr/admin/admin.html";
        return true;
    }