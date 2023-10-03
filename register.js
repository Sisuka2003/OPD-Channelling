function drOrNoCheck(that) {
    var div3 = document.getElementById("div03");
    if (that.value == "dr") {
        div3.className = "div-set-03";
    } else {
        div3.className = "div-set-03-hide";
    }
}