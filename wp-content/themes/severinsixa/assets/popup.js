const popupOverley = document.querySelectorAll(".popup__overley");
const popupBtn = document.querySelectorAll(".popup__btn");
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


function showPopup(id) {
    let popup = document.querySelector(id);

    if (popup) {
        popup.classList.add('active');
        hideScroll();
    }
}

// showPopup("#popup2");

function hidePopup() {
    if (popupOverley != 0) {
        popupOverley.forEach(function (item) {
            item.addEventListener("click", () => {
                item.closest('.popup').classList.remove('active');
                showScroll();
            });
        });

        popupBtn.forEach(function (item) {
            item.addEventListener("click", () => {
                item.closest('.popup').classList.remove('active');
                showScroll();
            });
        });
    }
}

hidePopup();