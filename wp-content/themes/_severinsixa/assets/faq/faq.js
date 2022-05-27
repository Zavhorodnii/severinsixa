function initAccordion () {
    const questions = document.querySelectorAll(".faq__question");

    if (questions.length != 0) {
        questions.forEach(function (item) {
            item.addEventListener("click", function () {
                if(this.classList.contains("active")) {
                    this.classList.remove("active");
                    this.nextElementSibling.style.maxHeight = "";
                } else {
                    this.classList.add("active");
                    this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
                }
            });
        });
    }
}

initAccordion();