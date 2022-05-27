if (window.innerWidth < 580) {
    const bestsellerList = new Swiper(".bestseller__list", {
        slidesPerView: 1.25,
        spaceBetween: 30,
        freeMode: true,
        observer: true,
        observeParents: true,
        pagination: {
            el: ".bestseller__progressbar",
            type: "progressbar",
        },
        breakpoints: {
            520: {
                slidesPerView: 1.9,
                spaceBetween: 30,
            },
            465: {
                slidesPerView: 1.6,
                spaceBetween: 30,
            },
            425: {
                slidesPerView: 1.4,
                spaceBetween: 30,
            },
            300: {
                slidesPerView: 1.25,
                spaceBetween: 30,
            },
        },
    });
}