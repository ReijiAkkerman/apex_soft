document.addEventListener("DOMContentLoaded", () => {
    const articleTitles = document.querySelectorAll(".article__wrapper-title");
    const articleButtons = document.querySelectorAll(".article__wrapper-button");
    const articleDescriptions = document.querySelectorAll(".article__wrapper-description");

    function toggleDescription(description) {
        if (description.classList.contains('active')) {
            description.style.maxHeight = `${description.scrollHeight}px`;
            // Force reflow
            description.offsetHeight;
            description.classList.remove('active');
            description.style.maxHeight = 0;
        } else {
            description.style.maxHeight = `${description.scrollHeight}px`;
            description.classList.add('active');
            description.style.maxHeight = `${description.scrollHeight}px`;
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
