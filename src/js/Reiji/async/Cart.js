import {Auth} from './Auth.js';

class Cart {
    setProductAmount(event) {
        // event.stopPropagation();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let product_amount = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/${currentPagename}/setProductAmount/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            if((window.location.pathname.split('/')[1]) == 'cart')
                Cart.summarizePrice();
            Cart.summarizeProducts();
        };
    }

    setProductAmount_add(event) {
        // event.stopPropagation();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let parentElement = this.parentElement;
        let input = parentElement.querySelector('.Reiji_product_amount');
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(input);
        input.value = 1;
        let product_amount = input.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/${currentPagename}/setProductAmount/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = function(parentElement) {
            let $ = parentElement.querySelector('.Reiji_product_amount');
            let _add = parentElement.querySelector('.Reiji_product_amount-add');
            let __add = parentElement.querySelector('.Reiji_product_amount--add');
            let __sub = parentElement.querySelector('.Reiji_product_amount--sub');
            let addsubParent = __add.parentElement;
            _add.removeEventListener('click', cart.setProductAmount_add);
            _add.style.display = 'none';
            addsubParent.style.display = 'flex';
            __add.addEventListener('click', cart.setProductAmount__add);
            __sub.addEventListener('click', cart.setProductAmount__sub);
            $.addEventListener('input', cart.setProductAmount);
            Cart.summarizeProducts();
        }(parentElement);
    }

    setProductAmount__add(event) {
        // event.stopPropagation();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let input = (function(element) {
            let target = element.previousElementSibling;
            return target;
        })(this);
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(input);
        input.value++;
        let product_amount = input.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/${currentPagename}/setProductAmount/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            Cart.summarizeProducts();
        };
    }

    setProductAmount__sub(event) {
        // event.stopPropagation();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let parentElement = this.parentElement.parentElement.parentElement;
        let input = parentElement.querySelector('.Reiji_product_amount');
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(input);
        input.value--;
        let product_amount = input.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/${currentPagename}/setProductAmount/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = function(parentElement, input) {
            if(input.value == 0) {
                let $ = parentElement.querySelector('.Reiji_product_amount');
                let _add = parentElement.querySelector('.Reiji_product_amount-add');
                let __add = parentElement.querySelector('.Reiji_product_amount--add');
                let __sub = parentElement.querySelector('.Reiji_product_amount--sub');
                let addsubParent = __add.parentElement;
                _add.style.display = 'block';
                _add.addEventListener('click', cart.setProductAmount_add);
                __add.removeEventListener('click', cart.setProductAmount__add);
                __sub.removeEventListener('click', cart.setProductAmount__sub);
                $.removeEventListener('input', cart.setProductAmount);
                addsubParent.style.display = 'none';
            }
            Cart.summarizeProducts();
        }(parentElement, input);
    }

    deleteProduct() {
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/cart/deleteProduct/${product_id}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = function() {
            Cart.summarizePrice();
            Cart.summarizeProducts();
        };
    }

    static summarizeProducts() {
        if(Auth.getCookie('id')) {
            let elements = document.querySelectorAll('.Reiji_product_amount');
            let sum = 0;
            for(let i = 0; i < elements.length; i++) {
                sum = (+sum) + (+elements[i].value);
            }
            let element = document.querySelector('.Reiji_products_number');
            element.textContent = sum;
        }
    }

    static summarizePrice() {
        let elements = document.querySelectorAll('.Reiji_product_price');
        let cost = 0;
        for(let i = 0; i < elements.length; i++) {
            cost += (+elements[i].textContent);
        }
        let element = document.querySelector('.Reiji_total_price');
        element.textContent = cost;
    }

    static hideCartButtons() {
        let elements = document.querySelectorAll('.Reiji_cart_actions');
        for(let i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }

    static showCartButtons() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/catalog/getProductsNumbers');
        xhr.send();
        xhr.responseType = 'json';
        xhr.onload = function() {
            // alert(xhr.responseText);
            let products = document.querySelectorAll('article.Reiji_product');
            let counter = 0;
            for(let i = 0; i < products.length; i++) {
                let product_id = (function(element) {
                    let classname;
                    for(let i = 0; i < element.classList.length; i++) {
                        if(/Reiji_id/.test(element.classList[i]))
                            classname = element.classList[i];
                    }
                    let id = classname.split('-')[1];
                    return id;
                })(products[i]);
                let multiple_buttons = products[i].querySelector('.Reiji_cart_buttons-multiple');
                if(multiple_buttons === null) {
                    let buttons_template = document.querySelector('template.Reiji_cart_buttons.multiple');
                    let _buttons = buttons_template.content.cloneNode(true);
                    let buttons_insertion_place = products[i].querySelector('.Reiji_cart_buttons-multiple__IP');
                    _buttons.querySelector('.Reiji_product_amount').classList.add(`Reiji_id-${product_id}`);
                    buttons_insertion_place.after(_buttons);
                }
                let single_button = products[i].querySelector('.Reiji_cart_buttons-single');
                if(single_button === null) {
                    let button_template = document.querySelector('template.Reiji_cart_buttons.single');
                    let _button = button_template.content.cloneNode(true);
                    let button_insertion_place = products[i].querySelector('.Reiji_cart_buttons-single__IP');
                    button_insertion_place.after(_button);
                }
                if(xhr.response.length && (typeof xhr.response[counter] !== 'undefined')) {
                    if(product_id == xhr.response[counter]['ID']) {
                        if(xhr.response[counter]['amount'] > 0) {
                            let buttons = products[i].querySelector('.Reiji_cart_buttons-multiple');
                            buttons.style.display = 'flex';
                            let $ = buttons.querySelector('.Reiji_product_amount');
                            let __add = buttons.querySelector('.Reiji_product_amount--add');
                            let __sub = buttons.querySelector('.Reiji_product_amount--sub');
                            $.addEventListener('input', cart.setProductAmount);
                            __add.addEventListener('click', cart.setProductAmount__add);
                            __sub.addEventListener('click', cart.setProductAmount__sub);
                            $.value = xhr.response[counter]['amount'];
                        }
                        else {
                            let $ = products[i].querySelector('.Reiji_product_amount');
                            $.value = 0;
                            let button = products[i].querySelector('.Reiji_cart_buttons-single');
                            button.style.display = 'block';
                            button.addEventListener('click', cart.setProductAmount_add);
                        }
                        counter++
                    }
                    else {
                        let $ = products[i].querySelector('.Reiji_product_amount');
                        $.value = 0;
                        let button = products[i].querySelector('.Reiji_cart_buttons-single');
                        button.style.display = 'block';
                        button.addEventListener('click', cart.setProductAmount_add);
                    }
                }
                else {
                    let $ = products[i].querySelector('.Reiji_product_amount');
                    $.value = 0;
                    let button = products[i].querySelector('.Reiji_cart_buttons-single');
                    button.style.display = 'block';
                    button.addEventListener('click', cart.setProductAmount_add);
                }
            }
            Cart.summarizeProducts();
        };
    }

    static buy() {
        // alert('Заявка принята!');
    }
}

export {Cart};

let cart = new Cart;

if((window.location.pathname.split('/')[1]) == 'catalog') {
    document.addEventListener('DOMContentLoaded', function() {
        let elements = document.querySelectorAll('.Reiji_product_amount');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('input', cart.setProductAmount);
        }
        elements = document.querySelectorAll('.Reiji_product_amount-add');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('click', cart.setProductAmount_add);
        }
        elements = document.querySelectorAll('.Reiji_product_amount--add');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('click', cart.setProductAmount__add);
        }
        elements = document.querySelectorAll('.Reiji_product_amount--sub');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('click', cart.setProductAmount__sub);
        }
        Cart.summarizeProducts();
    });
}

if((window.location.pathname.split('/')[1]) == 'cart') {
    document.addEventListener('DOMContentLoaded', function() {
        let elements = document.querySelectorAll('.Reiji_product_amount');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('input', cart.setProductAmount);
        }
        elements = document.querySelectorAll('.Reiji_delete_product');
        for(let i = 0; i < elements.length; i++) {
            if(elements[i] !== null)
                elements[i].addEventListener('click', cart.deleteProduct);
        }
        let element = document.querySelector('#buy');
        element.addEventListener('click', Cart.buy);
        Cart.summarizePrice();
        Cart.summarizeProducts();
    });
}