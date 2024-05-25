class Order {
    static createOrder(event) {
        event.preventDefault();
        let xhr = new XMLHttpRequest();
        let _form = document.querySelector('.Reiji_cart_form');
        let checkbox_array = _form.querySelectorAll('input[type="checkbox"]');
        let checked_inputs_array = (function(checkbox_array) {
            let checked_inputs_array = [];
            for(let i = 0; i < checkbox_array.length; i++) {
                if(checkbox_array[i].value == 'on')
                    checked_inputs_array.push(checkbox_array[i]);
            }
            return checked_inputs_array;
        })(checkbox_array);
        let productsIDs = (function(checked_inputs_array) {
            let productsIDs = [];
            for(let i = 0; i < checked_inputs_array.length; i++) {
                productsIDs[i] = (function (element) {
                    let classname;
                    for (let i = 0; i < element.classList.length; i++) {
                        if (/Reiji_id/.test(element.classList[i]))
                            classname = element.classList[i];
                    }
                    let id = classname.split('-')[1];
                    return id;
                })(checked_inputs_array[i]);
            }
            return productsIDs;
        })(checked_inputs_array);
        let products_amounts = (function(productsIDs, _form) {
            let products_amounts = [];
            for(let i = 0; i < productsIDs.length; i++) {
                let input = _form.querySelector(`input[type="number"].Reiji_id-${productsIDs[i]}`);
                products_amounts[i] = input.value;
            }
            return products_amounts;
        })(productsIDs, _form);
        let checked_products = (function(productsIDs, products_amounts) {
            let checked_products = '';
            for(let i = 0; i < productsIDs.length; i++) {
                checked_products = checked_products + productsIDs[i] + '=' + products_amounts[i] + ',';
            }
            checked_products = checked_products.slice(0, -1);
            return checked_products;
        })(productsIDs, products_amounts);
        let hidden_input = document.querySelector('.Reiji_cart_hidden_field');
        hidden_input.value = checked_products;
        let form = document.querySelector('.Reiji_order_form');
        let data = new FormData(form);
        xhr.open('POST', '/order/createOrder');
        xhr.send(data);
        xhr.responseType = 'text';
        xhr.onload = () => {
            alert(xhr.response);
        };
    }
}

export {Order};

if((window.location.pathname.split('/')[1]) == 'cart') {
    document.addEventListener('DOMContentLoaded', function () {
        let element = document.querySelector('#createOrder');
        element.addEventListener('click', Order.createOrder);
    });
}