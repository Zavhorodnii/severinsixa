var categoryIntroSlider = new Swiper(".category-intro__slider", {
    loop: true,
    speed: 2000,
    autoplay: {
        delay: 10000,
    },
    // allowTouchMove: false,
    navigation: {
        nextEl: ".category-intro__next",
        prevEl: ".category-intro__prev",
    },
});