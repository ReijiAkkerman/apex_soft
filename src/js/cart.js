let quantityFields = document.querySelectorAll('.quantity-field');
const totalItemsElement = document.querySelector('.total-items');
const basketSubtotalElement = document.querySelector('.basket-subtotal');

const buyFormCart = document.querySelector(".summary-buy");
const buyForm = document.querySelector(".basket__section");
const buyFormContent = document.querySelector(".basket__section-form");
const body = document.querySelector("body");
const basketFormClose = document.querySelector(".basket__section-close");

if (quantityFields && totalItemsElement) {

    const updateTotalItems = () => {
        const totalItems = Array.from(quantityFields)
            .reduce((accumulator, currentField) => {
                const currentQuantity = parseInt(currentField.value, 10);
                if(currentQuantity > 0)
                    accumulator = accumulator + currentQuantity;
                return accumulator;
            }, 0);
        totalItemsElement.textContent = totalItems;
    };

    const updateBasketSubtotal = () => {
        if (basketSubtotalElement) {
            const total = Array.from(quantityFields)
                .reduce((accumulator, currentField) => {
                    const currentProduct = currentField.closest('.basket__product');
                    if (currentProduct) {
                        const currentPriceElement = currentProduct.querySelector('.basket__product-price');
                        const currentPrice = parseFloat(currentPriceElement.textContent.replace(/\D/g, ''));
                        const currentQuantity = parseInt(currentField.value, 10);
                        const currentSubtotal = currentPrice * currentQuantity;
                        return accumulator + currentSubtotal;
                    }
                    return accumulator;
                }, 0);
            basketSubtotalElement.textContent = total.toFixed(2);
        }
    };

    updateTotalItems();
    updateBasketSubtotal();

    const removeButtons = document.querySelectorAll('.basket__product-remove');

    removeButtons.forEach(function (removeButton) {
        removeButton.addEventListener('click', function () {
            const product = this.closest('.basket__product');
            const quantityField = product.querySelector('.quantity-field');
            const currentQuantity = parseInt(quantityField.value, 10);

            // Удалить товар из корзины
            product.remove();

            // Обновить коллекцию quantityFields после удаления товара
            quantityFields = document.querySelectorAll('.quantity-field');

            // Пересчитать значения после удаления товара
            updateTotalItems();
            updateBasketSubtotal();
        });
    });

    quantityFields.forEach(function (quantityField) {
        quantityField.addEventListener('input', function () {
            const product = this.closest('.basket__product');
            const priceElement = product.querySelector('.basket__product-price');
            const subtotalElement = product.querySelector('.basket__product-subtotal');
            const detailsQuantityElement = product.querySelector('.basket__details-quantity');
            const price = parseFloat(priceElement.textContent.replace(/\D/g, ''));
            const quantity = parseInt(this.value, 10);
            let subtotal;
            if(quantity > 0)
                subtotal = price * quantity;
            else 
                subtotal = 0;
            subtotalElement.textContent = subtotal.toFixed(2);

            // Проверка наличия элемента перед его использованием
            if (detailsQuantityElement) {
                detailsQuantityElement.textContent = quantity;
            }

            // Пересчитать значения после изменения количества товара в корзине
            updateTotalItems();
            updateBasketSubtotal();
        });
    });

    // Обработчик открытия формы
    buyFormCart.addEventListener("click", (event) => {
        event.stopPropagation(); // Предотвращаем всплытие события
        buyForm.classList.add("active");
        body.classList.add("active");
    });

    // Функция закрытия формы
    const closeForm = () => {
        buyForm.classList.remove("active");
        body.classList.remove("active");
    };

    // Обработчик закрытия формы по кнопке
    basketFormClose.addEventListener("click", (event) => {
        event.stopPropagation(); // Предотвращаем всплытие события
        closeForm();
    });

    // Предотвращаем всплытие события при клике на форме
    buyFormContent.addEventListener("click", (event) => {
        event.stopPropagation();
    });

    // Закрываем форму при клике вне её области
    body.addEventListener("click", (event) => {
        if (buyForm.classList.contains("active")) {
            closeForm();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('.basket__section-items');

        // Функция для добавления товара в форму
        function addProductToForm(product) {
            const productItem = document.createElement('div');
            productItem.classList.add('basket__section-item');
            productItem.dataset.productId = product.id;

            productItem.innerHTML = `
                <div class="basket__section-picture">
                    <img src="${product.image}" alt="" class="basket__section-image">
                </div>
                <div class="basket__section-description">
                    <p class="basket__section-name">${product.name}</p>
                    <p class="basket__section-articul">Артикул - ${product.articul}</p>
                    <p class="basket__section-quantity">Количество: ${product.quantity} шт.</p>
                </div>
            `;

            form.appendChild(productItem);
        }

        // Функция для удаления товара из формы
        function removeProductFromForm(productId) {
            const productItem = form.querySelector(`.basket__section-item[data-product-id="${productId}"]`);
            if (productItem) {
                productItem.remove();
            }
        }

        // Обработчик изменения состояния чекбоксов
        document.querySelectorAll('.basket__product-input').forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                const productElement = event.target.closest('.basket__product');
                const product = {
                    id: productElement.querySelector('.quantity-field').classList[2].split('-')[1],
                    image: productElement.querySelector('.basket__image').src,
                    name: productElement.querySelector('.basket__details-text').textContent,
                    articul: productElement.querySelector('.basket__details-article').textContent.split(' - ')[1],
                    quantity: productElement.querySelector('.quantity-field').value
                };

                if (event.target.checked) {
                    addProductToForm(product);
                } else {
                    removeProductFromForm(product.id);
                }
            });
        });
    });
}

const basketPreloader = document.querySelector(".basket__section-button");

function preloader() {
    let preloader = document.querySelector(".preloader");

    preloader.style.zIndex = "20";
    preloader.style.opacity = "1";
}

function stopPreloader(e) {
    e.stopPropagation();
}

if (basketPreloader) {
    basketPreloader.addEventListener("click", stopPreloader);
    basketPreloader.addEventListener("click", preloader);
}

tippy('[name="recipient_name"]', {
    content: 'Буквы латиницы, кириллицы, цифры и пробел. От 3 до 100 символов.',
});


tippy('[name="recipient_email"]', {
    content: 'Начинается с буквы латинского алфавита, цифры, знак нижнего подчеркивания, точка и тире.',
});
