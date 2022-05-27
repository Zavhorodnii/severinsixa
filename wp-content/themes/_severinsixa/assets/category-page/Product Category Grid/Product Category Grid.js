var categoryNav = new Swiper('.category-nav__slider', {
    freeMode: true,
    pagination: {
        el: ".category-nav__progressbar",
        type: "progressbar",
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            spaceBetween: 15,
            slidesPerView: 1.2,
            speed: 700,
        },
        500: {
            spaceBetween: 15,
            slidesPerView: 1.8,
        },
        768: {
            slidesPerView: 2.3,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3.4,
            spaceBetween: 30,
            speed: 1700,
        },
        1366: {
            slidesPerView: 4.4,
            spaceBetween: 30,
        }
    }
});
