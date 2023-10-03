function popupMenu() {
    var navPages = document.getElementById("nav-pages");
    var a1Animation = document.getElementById("a1-animation");
    var a2Animation = document.getElementById("a2-animation");
    var a3Animation = document.getElementById("a3-animation");
    var logo = document.getElementById("logo");
    var menu = document.getElementById("menu-button");
    var arrow = document.getElementById("arrow");
    var s2 = document.getElementById("s2");
    var ft = document.getElementById("ft");


    navPages.classList.toggle('nav-pages-animation');
    a1Animation.classList.toggle('a1-animation');
    a2Animation.classList.toggle('a2-animation');
    a3Animation.classList.toggle('a3-animation');
    logo.classList.toggle('logo-invisible');
    menu.classList.toggle('menu-button-fixed');
    arrow.classList.toggle('arrow-ani');
    s2.classList.toggle('s2Display');
    ft.classList.toggle('ftDisplay');
}

function msgin(){
    var div=document.getElementById("poped");
    div.classList.toggle('poped');
}

function msgout(){
    var div=document.getElementById("poped");
    div.className="poped-display";
}