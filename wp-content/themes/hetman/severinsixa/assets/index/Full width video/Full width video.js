function toggleVideo() {
    const video = document.querySelector(".video-block__player");
    const button = document.querySelector(".video-block__control");

    if (video != null) {
        button.addEventListener("click", function () {
            if (this.classList.contains("play")) {
                this.classList.remove("play");
                video.pause();
            } else {
                video.play();
                this.classList.add("play");
            }
        });

        video.addEventListener("click", function () {
            if (button.classList.contains("play")) {
                button.classList.remove("play");
                video.pause();
            } else {
                button.classList.add("play");
                video.play();
            }
        });
    }
}

toggleVideo();