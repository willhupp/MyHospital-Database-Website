function validate() {
    var firstname = document.forms["RegForm"]["firstname"].value;
    var lastname = document.forms["RegForm"]["lastname"].value;
    var email = document.forms["RegForm"]["email"].value;
    var username = document.forms["RegForm"]["username"].value;
    var password = document.forms["RegForm"]["password"].value;
    var name_pattern = /^[a-zA-Z][a-zA-Z\s]+$/;
    var digit_pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    var email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    // name error checking
    //if (firstname == "")
    //{
    //    document.getElementById("fname_err").innerHTML = "First name cannnot be blank";
    //    return false;
    //}
    
    
    if (name_pattern.test(firstname) == false) {
        document.getElementById("fname_err").innerHTML = "First name is a required field and can only be alphabetic characters";
        return false;
    }
    // reset
    document.getElementById("fname_err").innerHTML = "";
    if (name_pattern.test(lastname) == false) {
        document.getElementById("lname_err").innerHTML = "Last name is a required field and can only be alphabetic characters";
        return false;
    }
    document.getElementById("lname_err").innerHTML = "";
    if (email_pattern.test(email) == false) {
        document.getElementById("em_err").innerHTML = "Invalid email address";
        return false;
    }
    document.getElementById("em_err").innerHTML = "";
    if (name_pattern.test(username) == false) {
        document.getElementById("uname_err").innerHTML = "User is a required field and can only be alphabetic characters";
        return false;
    }
    document.getElementById("uname_err").innerHTML = "";
    if (password == "") {
        document.getElementById("pw_err").innerHTML = "Passwowrd is a required field";
        return false;
    }
    document.getElementById("pw_err").innerHTML = "";
    // validation complete
    return true;
}