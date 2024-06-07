document.addEventListener('DOMContentLoaded', () => {
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
            addButton.style.display = 'none';
            cardQuantity[index].style.display = 'flex';
        });
    });

    const quantityCurrentArray = Array.from(quantityCurrent);

    addButtons.forEach((addButton, index) => {
        addButton.addEventListener('click', () => {
            addButton.style.display = 'none';
            cardQuantity[index].style.display = 'flex';
            quantityCurrent[index].value = 1;
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

    filterItems.forEach(filterItem => {
        filterItem.addEventListener('click', () => {
            const filterValue = filterItem.dataset.category;

            if (filterValue === "Показать все") {
                productCards.forEach(card => {
                    card.style.display = 'flex';
                });
            } else {
                productCards.forEach(card => {
                    if (card.dataset.type === filterValue) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    });
});