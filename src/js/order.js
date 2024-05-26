const hideIcons = document.querySelectorAll(".icon-cheveron-down");
const orderItemBodies = document.querySelectorAll(".order__item-body");
const orderProducts = document.querySelectorAll(".order__item-products");

hideIcons.forEach((hideIcon, index) => {
    const orderItemBody = orderItemBodies[index];
    const orderProduct = orderProducts[index];

    if (hideIcon) {
        hideIcon.addEventListener("click", () => {
            hideIcon.classList.toggle("active");

            if (orderItemBody.classList.contains("active")) {
                orderItemBody.style.height = `${orderItemBody.scrollHeight}px`;
                orderProduct.style.height = `${orderProduct.scrollHeight}px`;
                setTimeout(() => {
                    orderItemBody.style.height = "";
                    orderProduct.style.height = "";
                }, 320);
            } else {
                orderItemBody.style.height = `${orderItemBody.scrollHeight}px`;
                orderProduct.style.height = `${orderProduct.scrollHeight}px`;
                setTimeout(() => {
                    orderItemBody.style.height = "auto";
                    orderProduct.style.height = "auto";
                }, 0);
            }

            orderItemBody.classList.toggle("active");
            orderProduct.classList.toggle("active");
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    function updateTotalPrice(quantityInput, priceProduct, priceProductCount) {
        const quantity = parseInt(quantityInput.value, 10);
        const unitPrice = parseFloat(priceProductCount.textContent);
        const totalPrice = quantity * unitPrice;
        priceProduct.textContent = totalPrice.toFixed(2);
        const orderItem = quantityInput.closest('.order__item');
        updateOverallTotalPrice(orderItem);
    }

    function updateOverallTotalPrice(orderItem) {
        let overallTotal = 0;
        orderItem.querySelectorAll('.order__item-price-product').forEach(priceProduct => {
            overallTotal += parseFloat(priceProduct.textContent);
        });
        const totalPriceElement = orderItem.querySelector('.order__item-price-total');
        if (totalPriceElement) {
            totalPriceElement.textContent = overallTotal.toFixed(2);
        }
    }

    document.querySelectorAll('.order__item').forEach(orderItem => {
        orderItem.querySelectorAll('.order__item-product').forEach(product => {
            const addButton = product.querySelector('.Reiji_product_amount--add');
            const subButton = product.querySelector('.Reiji_product_amount--sub');
            const quantityInput = product.querySelector('.quantity__current');
            const priceProduct = product.querySelector('.order__item-price-product');
            const priceProductCount = product.querySelector('.order__item-price-count');

            // quantityInput.value = 1;

            if (quantityInput.value <= 1) {
                if (subButton !== null) {
                    subButton.classList.add('disabled');
                }
            }

            if (addButton !== null) {
                addButton.addEventListener('click', () => {
                    let currentValue = parseInt(quantityInput.value, 10);
                    quantityInput.value = currentValue + 1;
                    if (quantityInput.value > 1) {
                        subButton.classList.remove('disabled');
                    }
                    updateTotalPrice(quantityInput, priceProduct, priceProductCount);
                });
            }

            if (subButton !== null) {
                subButton.addEventListener('click', () => {
                    let currentValue = parseInt(quantityInput.value, 10);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        updateTotalPrice(quantityInput, priceProduct, priceProductCount);
                    }
                    if (currentValue === 2) {
                        subButton.classList.add('disabled');
                    }
                });
            }

            updateTotalPrice(quantityInput, priceProduct, priceProductCount);

            const removeButton = product.querySelector('.order__item-remove');
            if (removeButton) {
                removeButton.addEventListener('click', (event) => {
                    event.preventDefault();
                    product.remove();
                    updateOverallTotalPrice(orderItem);
                });
            }
        });

        const deleteButton = orderItem.querySelector('.order__item-button');
        if (deleteButton) {
            deleteButton.addEventListener('click', (event) => {
                event.preventDefault();
                deleteButton.remove();

                orderItem.querySelectorAll('.quantity__control').forEach(control => {
                    control.style.display = 'none';
                });
                orderItem.querySelectorAll('.quantity__current').forEach(current => {
                    current.setAttribute("readonly", "")
                });

                orderItem.querySelectorAll('.order__item-block-count').forEach(quantity => {
                    quantity.classList.add('remove');
                });

                orderItem.querySelectorAll('.order__item-remove').forEach(removeButton => {
                    removeButton.classList.add('disabled');
                    removeButton.style.display = 'none';
                });
            });
        }
    });
});