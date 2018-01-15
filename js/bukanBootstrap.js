$('#diary').bind('input propertychange', function(){
    $.ajax({
        method:"POST",
        url:"updateDatabase.php",
        data: {content: $("#diary").val()}
    });
    // .done(function(msg){
    //     alert("Pesan : "+msg);
    // });
    
});

var btnLogIn =  document.getElementById("showLogInForm"); 
    
btnLogIn.onclick = function(){
    var logIn = document.getElementById("logInForm");
    var signUp = document.getElementById("signUpForm");
    var errornya = document.getElementById('pError');
   

    if(logIn.style.display === "none"){
        logIn.style.display = "block";
        signUp.style.display = "none";
        btnLogIn.innerHTML = "Sign Up";
        errornya.innerHTML = '';

    }else{
        logIn.style.display = "none";
        signUp.style.display = "block";
        btnLogIn.innerHTML = "Log In";
        errornya.innerHTML = '';
    };
};


