var done = 0;
var head1 = document.getElementById("head1");
var head2 = document.getElementById("head2");
var head3 = document.getElementById("head3");
var div1 = document.getElementById("divbleft1");
var div2 = document.getElementById("divbleft2");
var divmain = document.getElementById("divbtm2");
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    console.log(scrolled);

    if (Math.ceil(scrolled) >= 700 && done !=1) {
            divmain.classList.toggle('divmainanim');
            head1.classList.toggle('head1anim');
            head2.classList.toggle('head2anim');
            head3.classList.toggle('head3anim');
            div1.classList.toggle('divbleftanim1');
            div2.classList.toggle('divbleftanim2');
        done=1;
    }
});