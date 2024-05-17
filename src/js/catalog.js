

const productCards = document.querySelectorAll(".product-card");
const dropdownButton = document.querySelector('.dropdown__button');
const dropdownList = document.querySelector('.dropdown__list');
const dropdownItems = document.querySelectorAll('.dropdown__item');

const filterItems = document.querySelectorAll('.filter__item');

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

            const selectedCategory = this.dataset.category;

            if (selectedCategory === "Показать все") {
                productCards.forEach(function (card) {
                    card.style.display = 'flex';
                });
            } else {
                productCards.forEach(function (card) {
                    if (selectedCategory === card.dataset.type) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    });

    document.addEventListener('click', function (event) {
        if (!dropdownButton.contains(event.target) && !dropdownList.contains(event.target)) {
            dropdownList.classList.remove('show');
        }
    });
}

addButtons.forEach((addButton, index) => {
    addButton.addEventListener('click', () => {
        addButton.style.display = 'none'; // скрываем кнопку addButton
        cardQuantity[index].style.display = 'flex'; // показываем форму cardQuantity
    });
});

const quantityCurrentArray = Array.from(quantityCurrent);

addButtons.forEach((addButton, index) => {
    addButton.addEventListener('click', () => {
        addButton.style.display = 'none';
        cardQuantity[index].style.display = 'flex';
        quantityCurrent[index].value = 1;
        basketCount.textContent = parseInt(basketCount.textContent) + 1;
    });
});

quantityControls.forEach((quantityControl) => {
    quantityControl.addEventListener('click', () => {
        const currentQuantity = parseInt(quantityControl.parentElement.querySelector('.quantity__current').value);
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

        quantityControl.parentElement.querySelector('.quantity__current').value = newQuantity;

        // обновляем сумму всех значений из .quantity__current у которых открыта .product-card__quantity
        let totalQuantity = 0;
        productCards.forEach((productCard) => {
            const productCardQuantity = productCard.querySelector('.product-card__quantity');
            if (productCardQuantity.style.display === 'flex') {
                const quantityCurrent = productCardQuantity.querySelector('.quantity__current');
                totalQuantity += parseInt(quantityCurrent.value);
            }
        });
        basketCount.textContent = totalQuantity;

        // проверяем, чтобы количество не было равно 0
        const productCard = quantityControl.closest('.product-card');
        const productCardQuantity = productCard.querySelector('.product-card__quantity');
        const productCardAdd = productCard.querySelector('.product-card__add');
        if (newQuantity === 0) {
            productCardQuantity.style.display = 'none';
            productCardAdd.style.display = 'flex';
        } else {
            productCardQuantity.style.display = 'flex';
            productCardAdd.style.display = 'none';
        }
    });
});


const rangeSlider = document.querySelector(".filter__item-slider");
const filterButton = document.querySelector(".filter__item-button");
if (rangeSlider) {
    noUiSlider.create(rangeSlider, {
        start: [500, 999999],
        connect: true,
        tooltips: [true, true],
        step: 1,
        range: {
            min: [500],
            max: [999999],
        },
    });

    const inputMin = document.querySelector(".filter__item-price-min");
    const inputMax = document.querySelector(".filter__item-price-max");
    const inputs = [inputMin, inputMax];

    rangeSlider.noUiSlider.on("update", function (values, handle) {
        inputs[handle].value = Math.round(values[handle]);
    });

    const setRangeSlider = (i, value) => {
        let arr = [null, null];
        arr[i] = value;
        rangeSlider.noUiSlider.set(arr);
    };

    inputs.forEach((el, index) => {
        el.addEventListener("change", (e) => {
            setRangeSlider(index, e.currentTarget.value);
        });
    });

    // Filter products by price on button click
    filterButton.addEventListener("click", () => {
        const minPrice = parseInt(inputMin.value);
        const maxPrice = parseInt(inputMax.value);

        productCards.forEach((card) => {
            const cardPrice = parseInt(card.querySelector(".product-card__price").dataset.price);

            if (cardPrice >= minPrice && cardPrice <= maxPrice) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });
}