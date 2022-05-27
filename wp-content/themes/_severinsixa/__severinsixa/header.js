function menu() {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.header__bottom');
    const overley = document.querySelector('.overley');
    let scrollHide = calcScroll();

    function closeMenu() {
        overley.classList.remove('active');
        nav.classList.remove('active');
        burger.classList.remove('active');
        document.body.style.overflow = "";
        document.body.style.marginRight = '';
    }

    if (burger) {
        burger.addEventListener('click', function () {
            this.classList.toggle('active');
            nav.classList.toggle('active');
            overley.classList.toggle('active');
            if (!nav.classList.contains('active')) {
                document.body.style.overflow = "";
                document.body.style.marginRight = '';
            } else {
                document.body.style.overflow = "hidden";
                document.body.style.marginRight = `${scrollHide}px`;
            }
        });
    }

    if (overley) {
        overley.addEventListener('click', function () {
            closeMenu();
        });
    }

    function calcScroll() {
        let div = document.createElement('div');

        div.style.width = '50px';
        div.style.height = '50px';
        div.style.overflowY = 'scroll';
        div.style.visibility = 'hidden';

        document.body.appendChild(div);
        let scrollWidth = div.offsetWidth - div.clientWidth;
        div.remove();

        return scrollWidth;
    }

}

menu();

function hideHighlightBar() {
    const highlightBar = document.querySelector('.highlight-bar');
    const highlightBarBtn = document.querySelector('.highlight-bar__btn');

    
    if (highlightBar) {
        const value = JSON.parse(localStorage.getItem("hideHighlightBar"));

        if (value != "yes") {
            highlightBarBtn.addEventListener('click', function () {
                highlightBar.classList.add("hide");
                localStorage.setItem("hideHighlightBar", JSON.stringify("yes"));
            });
        } else {
            highlightBar.classList.add("disabled");
        }
    }
}

hideHighlightBar();