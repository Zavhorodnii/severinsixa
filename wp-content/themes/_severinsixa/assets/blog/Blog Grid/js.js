function blogFilter() {
    const filterBox = document.querySelectorAll('.articles__item');
    const filterTop = document.querySelector('.blog-filter-top');
    const filterBtn = document.querySelectorAll('.blog-filter-top__btn');

    if (filterTop) {
        filterTop.addEventListener('click', (event) => {

            let filterClass = event.target.getAttribute("data-filter");

            filterBtn.forEach(item => {
                item.classList.remove('active');
            });

            event.target.classList.add('active');

            filterBox.forEach(elem => {
                elem.classList.remove('hide');
                if (!elem.classList.contains(filterClass) && filterClass !== 'all') {
                    elem.classList.add('hide');
                }
            });

        });
    }
}

blogFilter();