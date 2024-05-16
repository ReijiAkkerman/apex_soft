

const quantityFields = document.querySelectorAll('.quantity-field');
const totalItemsElement = document.querySelector('.total-items');

if (quantityFields && totalItemsElement) {
    
    quantityFields.forEach(function (quantityField) {
        quantityField.value = 1;
    });

    const productElements = document.querySelectorAll('.basket__product');

    productElements.forEach(function (product) {
        const detailsQuantityElement = product.querySelector('.basket__details-quantity');

        detailsQuantityElement.textContent = 1;
    });

    
    totalItemsElement.textContent = quantityFields.length;
    const removeButtons = document.querySelectorAll('.basket__product-remove');

    removeButtons.forEach(function (removeButton) {
        removeButton.addEventListener('click', function () {
            const product = this.closest('.basket__product');
            product.remove();
            const totalItems = document.querySelectorAll('.basket__product').length;
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

            document.querySelector('#basket-subtotal').textContent = total.toFixed(2);
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
            const totalItems = document.querySelectorAll('.basket__product').length;
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
            document.querySelector('#basket-subtotal').textContent = total.toFixed(2);
        });
    });

}