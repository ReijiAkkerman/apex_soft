const productCards = document.querySelectorAll(".product-card");
const dropdownButton = document.querySelector('.dropdown__button');
const dropdownList = document.querySelector('.dropdown__list');
const dropdownItems = document.querySelectorAll('.dropdown__item');

const addButtons = document.querySelectorAll('.product-card__add');
const quantityControls = document.querySelectorAll('.quantity__control');
const quantityCurrent = document.querySelectorAll('.quantity__current');
const cardQuantity = document.querySelectorAll('.product-card__quantity');

const basketCount = document.querySelector(".header__basket-count");

if (dropdownButton) {
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

            // Store the clicked item's dataset.filter value in a variable
            const selectedFilter = this.dataset.filter;

            // Check if the clicked item is "Показать все" and show all product cards accordingly
            if (selectedFilter === "Показать все") {
                productCards.forEach(function (card) {
                    card.style.display = 'block';
                });
            } else {
                productCards.forEach(function (card) {
                    // Use the selectedFilter variable instead of this.dataset.filter
                    if (selectedFilter === card.dataset.type) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    });
}

addButtons.forEach((addButton, index) => {
    addButton.addEventListener('click', () => {
        addButton.style.display = 'none'; // скрываем кнопку addButton
        cardQuantity[index].style.display = 'flex'; // показываем форму cardQuantity
    });
});

const quantityCurrentArray = Array.from(quantityCurrent);

addButtons.forEach((addButton) => {
    addButton.addEventListener('click', () => {
        addButton.style.display = 'none';
        cardQuantity.forEach((card, index) => {
            if (addButton.parentElement === card.parentElement) {
                card.style.display = 'flex';
                quantityCurrentArray[index].textContent = 1;
                basketCount.textContent = parseInt(basketCount.textContent) + 1;
            }
        });
    });
});

quantityControls.forEach((quantityControl) => {
    quantityControl.addEventListener('click', () => {
        const currentQuantity = parseInt(quantityControl.parentElement.querySelector('.quantity__current').textContent);
        const operation = quantityControl.dataset.quantity;

        let newQuantity;

        if (operation === 'plus') {
            newQuantity = currentQuantity + 1;
        } else if (operation === 'minus') {
            newQuantity = currentQuantity - 1;

            // проверяем, чтобы количество не было меньше 0
            if (newQuantity < 0) {
                newQuantity = 0;
            }
        }

        quantityControl.parentElement.querySelector('.quantity__current').textContent = newQuantity;

        // обновляем сумму всех значений из .quantity__current у которых открыта .product-card__quantity
        let totalQuantity = 0;
        quantityCurrentArray.forEach((quantity) => {
            if (quantity.parentElement.style.display === 'flex') {
                totalQuantity += parseInt(quantity.textContent);
            }
        });
        basketCount.textContent = totalQuantity;

        // проверяем, чтобы количество не было равно 0
        if (newQuantity === 0) {
            quantityControl.parentElement.parentElement.querySelector('.product-card__quantity').style.display = 'none';
            quantityControl.parentElement.parentElement.querySelector('.product-card__add').style.display = 'block';
        } else {
            quantityControl.parentElement.parentElement.querySelector('.product-card__quantity').style.display = 'flex';
            quantityControl.parentElement.parentElement.querySelector('.product-card__add').style.display = 'none';
        }
    });
});
// const adminPanel = document.querySelector(".panel__wrapper");
// const adminPanelForm = document.querySelector(".panel__wrapper-form");
// const buttonAdd = document.querySelector(".catalog__control-button");

// function showAdminPanel() {
//     adminPanel.style.display = "flex";
// }
// function closeAdminPanel() {
//     adminPanel.style.display = "none";
// }
// function stop(e) {
//     e.stopPropagation();
// }

// function closeAdminPanelEsc(event) {
//     if (event.key === "Escape") {
//         closeAdminPanel();
//     }
// }

// if(adminPanel)
//     document.addEventListener("DOMContentLoaded", () => {
//         buttonAdd.addEventListener("click", showAdminPanel);
//         adminPanelForm.addEventListener("click", stop);
//         adminPanel.addEventListener("click", closeAdminPanel)
//         productCards.forEach((productCard) => {
//             productCard.addEventListener("click", showAdminPanel);
//         })
//         document.addEventListener("keydown", closeAdminPanelEsc);
//     })

// const imageInput = document.querySelector(".panel__input-image");
// const imagePreview = document.querySelector(".panel__image-preview");

// if (imageInput) {
//     imageInput.addEventListener("change", function () {
//         const file = this.files[0];
//         if (file) {
//             const reader = new FileReader();
//             reader.addEventListener("load", function () {
//                 imagePreview.setAttribute("src", this.result);
//             });
//             reader.readAsDataURL(file);
//         }
//     });
// }