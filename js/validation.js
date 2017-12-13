var g_signup =0;
var g_login =1;
show_hide_signup();
show_hide_login();
function validatelogin(){
        var username1 = document.getElementById("username1").value;
        var password1 = document.getElementById("password1").value;
        if(username1 == null || username1 == ""){
            alert("Enter your username ! ");
            return false;
        }
        else if(password1 == null || password1  == ""){
            alert("Enter your password ! ");
            return false;
        }
        else return true;
    }
function checkUsername_pass() {
    var Msg = document.getElementById('feedback_user');
    var Msg4 = document.getElementById('feedback_user1');
    var Msg2= document.getElementById('feedback_pass');
    var Msg3= document.getElementById('feedback_email');
    var Firstname = document.getElementById('firstname');
    var Lastname = document.getElementById('lastname');
    var Nickname = document.getElementById('nickname');
    var Password = document.getElementById('password');
    var pass =1 ;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z\-])+\.)+([a-zA-Z]{2,4})$/;
    var email = document.getElementById('email');
    if (Firstname.value.length < 5 && Firstname.value != "") {
        Msg.textContent = 'Firstname must be 5 characters or more';
        pass = 0 ;
    } else {
        Msg.textContent = '';
        pass =1 ;
    }
    if (Lastname.value.length < 5 && Lastname.value != "") {
        Msg4.textContent = 'Lastname must be 5 characters or more';
        pass = 0 ;
    } else {
        Msg4.textContent = '';
        pass =1 ;
    }
    if (Password.value.length < 5 && Password.value !="") {
        Msg2.textContent = 'Password must be 5 characters or more';
        pass =0 ;
    } else {
        Msg2.textContent = '';
        pass =1 ;
    }
    if (!filter.test(email.value) && email.value != "") {
        Msg3.textContent = 'invalid email !';
        pass =0;
    }
    else {
        Msg3.textContent ='';
        pass = 1 ;
    }
    if (!pass){
        return false ;
    }
    else {
        return true ;
    }
}
function show_hide_signup(){
    if(g_signup == 0){
    document.getElementById('signup').style.display="none";
        g_signup =1 ;}
    else {
        document.getElementById('signup').style.display="block";
        g_signup=0;
    }
}
function show_hide_login(){
    if(g_login == 0){
        document.getElementById('login').style.display="none";
        g_login =1 ;}
    else {
        document.getElementById('login').style.display="block";
        g_login=0;
    }
}