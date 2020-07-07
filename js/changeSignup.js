function changeLogin(){
    var value = document.getElementById("change").innerHTML
    if (value == "Sign Up"){
        document.getElementById("repwd").style.display = "block"
        document.getElementById("fullname").style.display = "block"
        document.getElementById("tel").style.display = "block"
        document.getElementById("email").style.display = "block"
        document.getElementById("change").textContent = "Log In"
        document.getElementById("state").textContent = "ACCOUNT SIGN UP"
        document.getElementById("btnLogIn").textContent = "SIGN UP"
    }
    else {
        document.getElementById("repwd").style.display = "none"
        document.getElementById("fullname").style.display = "none"
        document.getElementById("tel").style.display = "none"
        document.getElementById("email").style.display = "none"
        document.getElementById("change").textContent = "Sign Up"
        document.getElementById("state").textContent = "ACCOUNT LOGIN"
        document.getElementById("btnLogIn").textContent = "LOG IN"
    }
}