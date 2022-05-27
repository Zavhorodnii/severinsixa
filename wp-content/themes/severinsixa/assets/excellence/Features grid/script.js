if (window.innerWidth < 580) {
    const practicFancSwiper = new Swiper(".practic-fanc-swiper", {
        slidesPerView: 1.7,
        spaceBetween: 15,
        pagination: {
            el: ".highlights__progressbar",
            type: "progressbar",
        },
    });

}