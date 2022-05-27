var swiper3 = new Swiper(".category__slider", {
    slidesPerView: 4.5,
    spaceBetween: 30,
    speed: 1700,
    freeMode: true,
    pagination: {
        el: ".category__progressbar",
        type: "progressbar",
    },
    breakpoints: {
        320: {
            spaceBetween: 10,
            slidesPerView: 1.2,
        },
        425: {
            spaceBetween: 15,
            slidesPerView: 1.4,
        },
        625: {
            spaceBetween: 15,
            slidesPerView: 2,
        },
        768: {
            spaceBetween: 15,
            slidesPerView: 2.2,
        },
        1024: {
            spaceBetween: 20,
            slidesPerView: 3.2,
        },
        1366: {
            slidesPerView: 4.5,
            spaceBetween: 20,
        },
        1440: {
            slidesPerView: 4.5,
            spaceBetween: 30,
        },
    }
});