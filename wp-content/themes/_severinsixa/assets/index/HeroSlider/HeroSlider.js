var introSwiper = new Swiper(".intro", {
    loop: true,
    speed: 2000,
    autoplay: {
        delay: 10000,
    },
    // allowTouchMove: false,
    navigation: {
        nextEl: ".intro-button-next",
        prevEl: ".intro-button-prev",
    },
});