
function validateSignUp() {
   
    var password = document.getElementById('pwd').value;
    var confirm_pasword = document.getElementById('repwd').value;

    var valid = true;
    
    if (password != confirm_pasword) {
        valid = false;
        document.getElementById('repwd').innerHTML = "Both passwords must be same.";
    }
    return valid;
}
