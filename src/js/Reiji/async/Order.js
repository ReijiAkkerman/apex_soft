import {Auth} from './Auth.js';

class Order {
    static createOrder(event) {
        event.preventDefault();
        let xhr = new XMLHttpRequest();
        let _form = document.querySelector('.Reiji_cart_form');
        let checkbox_array = _form.querySelectorAll('input[type="checkbox"]');
        let checked_inputs_array = (function(checkbox_array) {
            let checked_inputs_array = [];
            for(let i = 0; i < checkbox_array.length; i++) {
                if(checkbox_array[i].checked === true)
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
        xhr.redirect = false;
        xhr.onload = () => {
            alert(xhr.response);
            if(xhr.response !== null && xhr.response.hasOwnProperty('error_message')) {
                if(xhr.response['error_message']) {
                    if(xhr.response['error_message'].includes('|')) {
                        let temp_array = xhr.response['error_message'].split('|');
                        let element = document.querySelector('#' + temp_array[0]);
                        element.textContent = temp_array[1];
                        element.style.display = 'block';
                    }
                    else {
                        alert(xhr.response['error_message']);
                    }
                }
                else {
                    Auth.viewParseError(xhr.response);
                }
            }
            else {
                xhr.redirect = true;
            }
        };
        xhr.onloadend = () => {
            if(xhr.redirect === true)
                window.location.href = '/order/view';
        };
    }

    cancelOrder(event) {
        event.preventDefault();
        let order_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_order_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/order/cancelOrder/${order_id}`);
        xhr.send();
        xhr.responseType = 'json';
        xhr.onload = () => {
            let element = document.querySelector(`#order_id-${order_id}`);
            let order_status = element.querySelector('.Reiji_order_status');
            element.dataset['status'] = 'Отменён';
            order_status.textContent = 'Отменён';
        };
    }

    deleteProductFromOrder(event) {
        event.preventDefault();
        let product_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_product_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let order_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_order_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/order/deleteProductFromOrder/${order_id}/${product_id}`);
        xhr.send();
        xhr.responseType = 'json';
        xhr.onload = () => {
            let element = document.querySelector(`#order_id-${order_id}`);
            let order_status = element.querySelector('.Reiji_order_status');
            element.dataset['status'] = 'Изменён';
            order_status.textContent = 'Изменён';
            if((xhr.response === null) || (!xhr.response)) {
                let element = document.querySelector(`#order_id-${order_id}`);
                element.remove();
            }
        };
    }

    changeProductAmount__add() {
        let input = this.previousElementSibling;
        let product_amount = input.value;
        let product_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_product_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let order_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_order_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/order/changeProductAmount/${order_id}/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            let element = document.querySelector(`#order_id-${order_id}`);
            let order_status = element.querySelector('.Reiji_order_status');
            element.dataset['status'] = 'Изменён';
            order_status.textContent = 'Изменён';
        };
    }

    changeProductAmount__sub() {
        let input = this.nextElementSibling;
        let product_amount = input.value;
        let product_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_product_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let order_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_order_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/order/changeProductAmount/${order_id}/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            let element = document.querySelector(`#order_id-${order_id}`);
            let order_status = element.querySelector('.Reiji_order_status');
            element.dataset['status'] = 'Изменён';
            order_status.textContent = 'Изменён';
        };
    }

    changeProductAmount__input() {
        let product_amount = this.value;
        let product_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_product_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let order_id = (function (element) {
            let classname;
            for (let i = 0; i < element.classList.length; i++) {
                if (/Reiji_order_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/order/changeProductAmount/${order_id}/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            let element = document.querySelector(`#order_id-${order_id}`);
            let order_status = element.querySelector('.Reiji_order_status');
            element.dataset['status'] = 'Изменён';
            order_status.textContent = 'Изменён';
        };
    }

    static unsetErrorName() {
        let name = document.querySelector('#recipient_name');
        name.textContent = '';
        name.style.display = 'none';
    }

    static unsetErrorEmail() {
        let email = document.querySelector('#recipient_email');
        email.textContent = '';
        email.style.display = 'none';
    }

    static unsetErrorPhone() {
        let phone = document.querySelector('#recipient_phone');
        phone.textContent = '';
        phone.style.display = 'none';
    }
}

export {Order};

var order = new Order();

if((window.location.pathname.split('/')[1]) == 'cart') {
    document.addEventListener('DOMContentLoaded', function () {
        let element = document.querySelector('#createOrder');
        element.addEventListener('click', Order.createOrder);
        element = document.querySelector('input[name="recipient_name"]');
        element.addEventListener('input', Order.unsetErrorName);
        element = document.querySelector('input[name="recipient_email"]');
        element.addEventListener('input', Order.unsetErrorEmail);
        element = document.querySelector('input[name="recipient_phone"]');
        element.addEventListener('input', Order.unsetErrorPhone);
    });
}

if((window.location.pathname.split('/')[1]) == 'order') {
    document.addEventListener('DOMContentLoaded', function () {
        let elements = document.querySelectorAll('.Reiji_cancel_order');
        for(let i = 0; i < elements.length; i++) 
            elements[i].addEventListener('click', order.cancelOrder);
        elements = document.querySelectorAll('.Reiji_delete_product');
        for(let i = 0; i < elements.length; i++) 
            elements[i].addEventListener('click', order.deleteProductFromOrder);
        elements = document.querySelectorAll('.Reiji_product_amount--add');
        for(let i = 0; i < elements.length; i++)
            elements[i].addEventListener('click', order.changeProductAmount__add);
        elements = document.querySelectorAll('.Reiji_product_amount--sub');
        for(let i = 0; i < elements.length; i++)
            elements[i].addEventListener('click', order.changeProductAmount__sub);
        elements = document.querySelectorAll('.Reiji_product_amount');
        for(let i = 0; i < elements.length; i++)
            elements[i].addEventListener('input', order.changeProductAmount__input);
    });
}