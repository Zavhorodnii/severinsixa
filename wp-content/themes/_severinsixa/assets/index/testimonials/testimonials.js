var testimonialsSlider = new Swiper(".testimonials__slider", {
    slidesPerView: 3,
    spaceBetween: 30,
    speed: 700,
    loop: true,
    navigation: {
        nextEl: ".testimonials-button-next",
        prevEl: ".testimonials-button-prev",
    },
    breakpoints: {
        320: {
            spaceBetween: 10,
            slidesPerView: 1.7,
        },
        768: {
            spaceBetween: 10,
            slidesPerView: 3.2,
        },
        1024: {
            slidesPerView: 3,
        }
    }
});