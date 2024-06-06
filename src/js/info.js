document.addEventListener("DOMContentLoaded", () => {
    const articleTitles = document.querySelectorAll(".article__wrapper-title");
    const articleButtons = document.querySelectorAll(".article__wrapper-button");
    const articleDescriptions = document.querySelectorAll(".article__wrapper-description");

    function pxToVw(px) {
        const vw = window.innerHeight / 100;
        return px / vw;
    }

    function toggleDescription(description) {
        if (description.classList.contains('active')) {
            const maxHeightVw = pxToVw(description.scrollHeight);
            description.style.maxHeight = `${maxHeightVw}vw`;
            // Force reflow
            description.offsetHeight;
            description.classList.remove('active');
            description.style.maxHeight = 0;
        } else {
            const maxHeightVw = pxToVw(description.scrollHeight);
            description.style.maxHeight = `${maxHeightVw}vw`;
            description.classList.add('active');
            description.style.maxHeight = `${maxHeightVw}vw`;
        }
    }

    articleTitles.forEach((title, index) => {
        title.addEventListener("click", () => {
            toggleDescription(articleDescriptions[index]);
        });
    });

    articleButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            toggleDescription(articleDescriptions[index]);
        });
    });
});
