const hideIcon = document.querySelector(".icon-cheveron-down");
const orderItemBody = document.querySelector(".order__item-body");
const orderProducts = document.querySelector(".order__item-products");

if (hideIcon) {
    hideIcon.addEventListener("click", () => {
        hideIcon.classList.toggle("active");

        if (orderItemBody.classList.contains("active")) {
            orderItemBody.style.height = `${orderItemBody.scrollHeight}px`;
            orderProducts.style.height = `${orderProducts.scrollHeight}px`;
            setTimeout(() => {
                orderItemBody.style.height = "";
                orderProducts.style.height = "";
            }, 320);
        } else {
            orderItemBody.style.height = `${orderItemBody.scrollHeight}px`;
            orderProducts.style.height = `${orderProducts.scrollHeight}px`;
            setTimeout(() => {
                orderItemBody.style.height = "auto";
                orderProducts.style.height = "auto";
            }, 0);
        }

        orderItemBody.classList.toggle("active");
        orderProducts.classList.toggle("active");
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const totalPriceElement = document.querySelector('.order__item-price-total');

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
        totalPriceElement.textContent = overallTotal.toFixed(2);
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