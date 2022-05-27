var swiper2 = new Swiper(".highlights__inner", {

    speed: 1700,
    freeMode: true,
    pagination: {
        el: ".highlights__progressbar",
        type: "progressbar",
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            spaceBetween: 10,
            slidesPerView: 1.2,
        },
        500: {
            spaceBetween: 15,
            slidesPerView: 1.8,
        },
        769: {
            slidesPerView: 2.3,
            spaceBetween: 15,
        },
        1025: {
            slidesPerView: 3,
            spaceBetween: 30,
        }
    }
});