function rememberMe() {
    var rememberme = document.forms["loginForm"]["idreme"].checked;
    var email = document.forms["loginForm"]["idemail"].value;
    var pass = document.forms["loginForm"]["idpass"].value;
    console.log("Form data: " + rememberme + ", " + email + ", " + pass);

    if(!rememberme) {
        setCookies("cemail", "", 0);
        setCookies("cpass", "", 0);
        setCookies("crem", false, 0);
        document.forms["loginForm"]["idemail"].value = "";
        document.forms["loginForm"]["idpass"].value = "";
        document.forms["loginForm"]["idreme"].checked = false;
        alert("Credentials removed.");
    } else {
        if(email == "" && pass == "") {
            document.forms["loginForm"]["idreme"].checked = false;
            return false;
        } else {
            setCookies("cemail", email, 30);
            setCookies("cpass", pass, 30);
            setCookies("crem", rememberme, 30);
            alert("Credentials stored success.");
        }
    }
}

function setCookies(cookiename, cookiedata, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 *60 *1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookiename + "= " + cookiedata + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for(var i = 0; i < ca.length; i++){
        var c = ca[i];
        while(c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if(c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loadCookies() {
    var email = getCookie("cemail");
    var password = getCookie("cpass");
    var rememberme = getCookie("crem");
    document.forms["loginForm"]["idemail"].value = email;
    document.forms["loginForm"]["idpass"].value = password;
    if(rememberme) {
        document.forms["loginForm"]["idreme"].checked = true;
    } else {
        document.forms["loginForm"]["idreme"].checked = false;
    }
}