function change(){
    var image =document.getElementById("image");
    var pswd =document.getElementById("password");
    
    password=true;
    image.addEventListener('click', function(){
        if(password){
            pswd.setAttribute('type','text');
            image.src="images/private.png";
        }else{
            pswd.setAttribute('type','password');
            image.src="images/look.png";
        }
        password=!password;
    });
}


function changeTwo(){
       var image =document.getElementById("btnEye");
    var pswd =document.getElementById("password2");
    
    password=true;
    image.addEventListener('click', function(){
        if(password){
            pswd.setAttribute('type','text');
            image.src="images/private.png";
        }else{
            pswd.setAttribute('type','password');
            image.src="images/look.png";
        }
        password=!password;
    }); 
}

function popupMenu2() {
    var navPages = document.getElementById("nav-pages");
    var boxOut = document.getElementById("profile-outer-div");
    var ft = document.getElementById("ft");
    navPages.classList.toggle('nav-pages-animation');
    boxOut.classList.toggle('profile-outer-div-blur');
    ft.classList.toggle('profile-outer-div-blur');
}

function popoutMenu(){
    var navPages = document.getElementById("nav-pages");
    var boxOut = document.getElementById("profile-outer-div");
    var ft = document.getElementById("ft");
    navPages.className=('nav-pages');
    boxOut.classList.toggle('profile-outer-div-blur');
    ft.classList.toggle('profile-outer-div-blur');
}
