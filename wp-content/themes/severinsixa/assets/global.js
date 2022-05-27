document.addEventListener('DOMContentLoaded', function () {

    const castomSelect = document.querySelectorAll('.castom-select');
    castomSelect.forEach(function (item) {
        const choices = new Choices(item);
    });


    function selectFanc() {
        const select = document.querySelectorAll('select');
        const selectParent = document.querySelectorAll('.select-block-wrap');

        if (select) {
            select.forEach(item => {
                item.addEventListener('blur', () => {
                    item.parentElement.classList.remove('active');
                });
            });

            select.forEach(item => {
                item.addEventListener('change', () => {
                    item.classList.add('active');
                });
            });

            select.forEach(item => {
                item.addEventListener('click', () => {
                    if (item.parentElement.classList.contains('active')) {
                        item.parentElement.classList.remove('active');
                    } else {
                        item.parentElement.classList.add('active');
                    }
                });
            });

            window.addEventListener('scroll', function () {
                selectParent.forEach(item => {
                    item.classList.remove('active');
                });
            });
        }
    }

    selectFanc();


    const anchors = document.querySelectorAll('a.scroll-to');

    for (let anchor of anchors) {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const blockID = anchor.getAttribute('href');

            document.querySelector(blockID).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    }

});