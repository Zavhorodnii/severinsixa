const popup = document.querySelector(".popup");
const popupOverley = document.querySelector(".popup__overley");
const popupBtn = document.querySelector(".popup__btn");
const page = document.querySelector('.page');

let scrollPosition;

function mobileHeight() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

const hideScroll = () => {
    mobileHeight();

    const scrollWidth = `${getScrollbarWidth()}px`;

    scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

    page.classList.add("scroll-hide");
    page.style.paddingRight = scrollWidth;
    page.scroll(0, scrollPosition);
};

const showScroll = () => {
    page.style.paddingRight = '';
    page.style.overflow = '';
    page.classList.remove("scroll-hide");
    window.scroll(0, scrollPosition);
};

// Get scrollbar width
const getScrollbarWidth = () => {
    const outer = document.createElement('div');

    outer.style.position = 'absolute';
    outer.style.top = '-9999px';
    outer.style.width = '50px';
    outer.style.height = '50px';
    outer.style.overflow = 'scroll';
    outer.style.visibility = 'hidden';

    document.body.appendChild(outer);
    const getScrollbarWidth = outer.offsetWidth - outer.clientWidth;
    document.body.removeChild(outer);

    return getScrollbarWidth;
};


function showPopup() {
    if (popup) {
        popup.classList.add('active');
        hideScroll();
    }
}

// showPopup();

function hidePopup() {
    if (popup) {
        popupOverley.addEventListener("click", () => {
            popup.classList.remove('active');
            showScroll();
        });

        popupBtn.addEventListener("click", () => {
            popup.classList.remove('active');
            showScroll();
        });
    }
}

hidePopup();