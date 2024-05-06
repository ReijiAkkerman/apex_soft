const adminPanel = document.querySelector(".panel__wrapper");
const adminPanelForm = document.querySelector(".panel__wrapper-form");
const buttonAdd = document.querySelector(".catalog__control-button");
const productCards = document.querySelectorAll(".product-card");

function showAdminPanel() {
    adminPanel.style.display = "flex";
}
function closeAdminPanel() {
    adminPanel.style.display = "none";
}
function stop(e) {
    e.stopPropagation();
}

function closeAdminPanelEsc(event) {
    if (event.key === "Escape") {
        closeAdminPanel();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    buttonAdd.addEventListener("click", showAdminPanel);
    adminPanelForm.addEventListener("click", stop);
    adminPanel.addEventListener("click", closeAdminPanel)
    productCards.forEach((productCard) => {
        productCard.addEventListener("click", showAdminPanel);
    })
    document.addEventListener("keydown", closeAdminPanelEsc);
})

const imageInput = document.querySelector(".panel__input-image");
const imagePreview = document.querySelector(".panel__image-preview");

imageInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            imagePreview.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    }
});


const dropdownButton = document.querySelector('.dropdown__button');
const dropdownList = document.querySelector('.dropdown__list');
const dropdownItems = document.querySelectorAll('.dropdown__item');

dropdownButton.addEventListener('click', function () {
    dropdownList.classList.toggle('show');
});

dropdownItems.forEach(function (item) {
    item.addEventListener('click', function () {
        const currentActiveItem = document.querySelector('.dropdown__item.active');
        if (currentActiveItem) {
            currentActiveItem.classList.remove('active');
        }
        this.classList.add('active');
        dropdownButton.textContent = this.textContent;
        dropdownList.classList.remove('show');
    });
});

dropdownList.addEventListener('click', function (event) {
    const filter = event.target.dataset.filter;
    productCards.forEach(function (card) {
        if (filter === card.dataset.category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});