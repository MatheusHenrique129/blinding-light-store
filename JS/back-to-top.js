window.onscroll = function () {
    scroll();
};

function scroll() {
    let btn = document.getElementById("btnTop");
    if (document.documentElement.scrollTop > 300) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
}

function backToTop() {
    document.documentElement.scrollTop = 0;
}
