const hideIcon = document.querySelectorAll(".icon-cheveron-down");
const orderItemBody = document.querySelectorAll(".order__item-body");
const orderProducts = document.querySelectorAll(".order__item-products");

if (hideIcon) {
    for(let i = 0; i < hideIcon.length; i++) {
        hideIcon[i].addEventListener("click", () => {
            hideIcon[i].classList.toggle("active");

            if (orderItemBody[i].classList.contains("active")) {
                orderItemBody[i].style.height = `${orderItemBody.scrollHeight}px`;
                orderProducts[i].style.height = `${orderProducts.scrollHeight}px`;
                setTimeout(() => {
                    orderItemBody[i].style.height = "";
                    orderProducts[i].style.height = "";
                }, 320);
            } else {
                orderItemBody[i].style.height = `${orderItemBody.scrollHeight}px`;
                orderProducts[i].style.height = `${orderProducts.scrollHeight}px`;
                setTimeout(() => {
                    orderItemBody[i].style.height = "auto";
                    orderProducts[i].style.height = "auto";
                }, 0);
            }

            orderItemBody[i].classList.toggle("active");
            orderProducts[i].classList.toggle("active");
        });
    }
}


document.addEventListener('DOMContentLoaded', () => {
    const totalPriceElement = document.querySelectorAll('.order__item-price-total');

    function updateTotalPrice(quantityInput, priceProduct, priceProductCount) {
        const quantity = parseInt(quantityInput.value, 10);
        const unitPrice = parseFloat(priceProductCount.textContent);
        const totalPrice = quantity * unitPrice;
        priceProduct.textContent = totalPrice.toFixed(2);
        updateOverallTotalPrice();
    }

    function updateOverallTotalPrice() {
        let overallTotal = 0;
        document.querySelectorAll('.order__item-price-product').forEach(priceProduct => {
            overallTotal += parseFloat(priceProduct.textContent);
        });
        for(let i = 0; i < totalPriceElement.length; i++) {
            totalPriceElement[i].textContent = overallTotal.toFixed(2);
        }
    }

    document.querySelectorAll('.order__item-product').forEach(orderItem => {
        const addButton = orderItem.querySelector('.Reiji_product_amount--add');
        const subButton = orderItem.querySelector('.Reiji_product_amount--sub');
        const quantityInput = orderItem.querySelector('.quantity__current');
        const priceProduct = orderItem.querySelector('.order__item-price-product');
        const priceProductCount = orderItem.querySelector('.order__item-price-count');

        quantityInput.value = 1;

        addButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
            updateTotalPrice(quantityInput, priceProduct, priceProductCount);
        });

        subButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateTotalPrice(quantityInput, priceProduct, priceProductCount);
            } else if (currentValue === 1) {
                orderItem.remove(); // Удаляем товар из HTML
                updateOverallTotalPrice(); // Обновляем общую сумму
            }
        });

        updateTotalPrice(quantityInput, priceProduct, priceProductCount);
    });

    const deleteButtons = document.querySelectorAll('.order__item-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // отменяем стандартное действие кнопки
            const orderItem = event.target.closest('.order__item'); // находим элемент .order__item, содержащий кнопку
            orderItem.remove(); // удаляем элемент .order__item из HTML
            updateOverallTotalPrice(); // обновляем общую сумму
        });
    });
});