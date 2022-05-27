const reviewsSwiper = new Swiper(".reviews-swiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    speed: 1000,
    pagination: {
        el: ".highlights__progressbar",
        type: "progressbar",
    },
    breakpoints: {
        1300: {
            slidesPerView: 3,
        },
        1070: {
            slidesPerView: 2.5,
        },
        900: {
            slidesPerView: 2.1,
        },
        300: {
            slidesPerView: 1.3,
        },
    },
});