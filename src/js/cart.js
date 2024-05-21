

const quantityFields = document.querySelectorAll('.quantity-field');
const totalItemsElement = document.querySelector('.total-items');

if (quantityFields && totalItemsElement) {
    
    totalItemsElement.textContent = quantityFields.length;
    const removeButtons = document.querySelectorAll('.basket__product-remove');

    removeButtons.forEach(function (removeButton) {
        removeButton.addEventListener('click', function () {
            const product = this.closest('.basket__product');
            const quantityField = product.querySelector('.quantity-field');
            const currentQuantity = parseInt(quantityField.value, 10);

            // Удалить товар из корзины
            product.remove();

            // Обновить коллекцию quantityFields после удаления товара
            const quantityFields = document.querySelectorAll('.quantity-field');

            // Пересчитать значение .total-items
            const totalItems = Array.from(quantityFields)
                .reduce((accumulator, currentField) => {
                    const currentQuantity = parseInt(currentField.value, 10);
                    return accumulator + currentQuantity;
                }, 0);
            totalItemsElement.textContent = totalItems;

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
        });
    });

    quantityFields.forEach(function (quantityField) {
        quantityField.addEventListener('input', function () {
            const product = this.closest('.basket__product');
            const priceElement = product.querySelector('.basket__product-price');
            const subtotalElement = product.querySelector('.basket__product-subtotal');
            const detailsQuantityElement = product.querySelector('.basket__details-quantity');
            const price = parseFloat(priceElement.textContent.replace(/\D/g, ''));
            const quantity = this.value;
            const subtotal = price * quantity;
            subtotalElement.textContent = subtotal.toFixed(2);
            detailsQuantityElement.textContent = quantity;

            // Пересчитать значение .total-items после изменения количества товара в корзине
            const totalItems = Array.from(quantityFields)
                .reduce((accumulator, currentField) => {
                    const currentQuantity = parseInt(currentField.value, 10);
                    return accumulator + currentQuantity;
                }, 0);
            totalItemsElement.textContent = totalItems;

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
        });
    });
}