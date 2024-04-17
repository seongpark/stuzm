var mc = 0;

function fadeIn(element, duration) {
    var opacity = 0;
    var interval = 5; // Shortened interval for faster animation
    var increment = interval / duration;

    element.style.display = "block";
    element.style.opacity = opacity;

    function fade() {
        opacity += increment;
        element.style.opacity = opacity;

        if (opacity >= 1) {
            clearInterval(fadeInterval);
        }
    }

    var fadeInterval = setInterval(fade, interval);
}

function fadeOut(element, duration) {
    var opacity = 1;
    var interval = 2; // Shortened interval for faster animation
    var decrement = interval / duration;

    function fade() {
        opacity -= decrement;
        element.style.opacity = opacity;

        if (opacity <= 0) {
            clearInterval(fadeInterval);
            element.style.display = "none";
        }
    }

    var fadeInterval = setInterval(fade, interval);
}

function modal(p) {
    var modal = document.getElementById('modal' + p);
    var modalChild = document.getElementById('modal_child' + p);

    if (mc === 0) {
        mc++;
        fadeIn(modal, 100); // Shortened duration for faster fade-in
        fadeIn(modalChild, 100); // Shortened duration for faster fade-in
        document.body.style.overflow = "hidden";
        document.body.style.touchAction = "none";
    } else {
        fadeOut(modalChild, 100); // Shortened duration for faster fade-out
        fadeOut(modal, 100); // Shortened duration for faster fade-out
        document.body.style.overflow = "visible";
        document.body.style.touchAction = "auto";
        mc = 0;
    }
}
