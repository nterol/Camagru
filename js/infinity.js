window.onscroll = function () {
    datScroll()
};
var page = 0;

function datScroll() {
    if (document.documentElement.scrollTop + window.innerHeight >= document.body.clientHeight - window.innerHeight * 0.1) {
        page += 1;
        var i = 6;
    }
    while (i <= page * 3) {
        if (document.getElementById("post" + i)) {
            document.getElementById("post" + i).removeAttribute('class');
            document.getElementById("post" + i).setAttribute('class', 'card');
            document.getElementById("post" + i).setAttribute('style', 'animation_name: card_anim;animation-duration: 2.5s');
        }
        i += 1;
    }
}

// function like() {

// }