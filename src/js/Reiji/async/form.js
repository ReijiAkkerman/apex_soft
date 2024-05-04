class Form {
    static DOM_element;

    registrate(event) {
        event.preventDefault();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let data = new FormData(document.querySelector('.Reiji_registration'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `../${currentPagename}/registrate`);
        xhr.send(data);
        xhr.responseType = 'json';
        xhr.onload = () => {
            // alert(xhr.response);
            if(xhr.response.hasOwnProperty('error_message')) {
                if(xhr.response['error_message']) {
                    let result = xhr.response['error_message'].indexOf('|');
                    if(result < 0) 
                        alert(xhr.response['error_message']);
                    else {
                        let str_array = xhr.response['error_message'].split('|');
                        let field = str_array[0];
                        let message = str_array[1];
                        let error_text = document.querySelector(`.Reiji_registration p._${field}`);
                        let error_field = document.querySelector(`.Reiji_registration input[name="${field}"]`);
                        error_text.textContent = message;
                        error_field.classList.add('form__error-field');
                    }
                }
                else {
                    Form.viewParseError(xhr.response);
                }
            }
            else {
                if(xhr.response.hasOwnProperty('name')) {
                    if(xhr.response['name']) {
                        let element = document.querySelector('#username');
                        element.textContent = xhr.response['name'];
                    }
                    else {
                        Form.viewParseError(xhr.response);
                    }
                }
                else {
                    Form.viewParseError(xhr.response);
                }
            }
        };
    }

    login(event) {
        event.preventDefault();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let data = new FormData(document.querySelector('.Reiji_login'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `../${currentPagename}/login`);
        xhr.send(data);
        xhr.responseType = 'json';
        xhr.onload = () => {
            // alert(xhr.response);
            if(xhr.response.hasOwnProperty('error_message')) {
                if(xhr.response['error_message']) {
                    let result = xhr.response['error_message'].indexOf('|');
                    if(result < 0) 
                        alert(xhr.response['error_message']);
                    else {
                        let result = xhr.response['error_message'].indexOf('&');
                        if(result < 0) {
                            let str_array = xhr.response['error_message'].split('|');
                            let field = str_array[0];
                            let message = str_array[1];
                            let error_text = document.querySelector(`.Reiji_login p._${field}`);
                            let error_field = document.querySelector(`.Reiji_login input[name="${field}"]`);
                            error_text.textContent = message;
                            error_field.classList.add('form__error-field');
                        }
                        else {
                            let str_array = xhr.response['error_message'].split('|');
                            let labels_array = str_array[0].split('&');
                            let message = str_array[1];
                            let error_text = document.querySelector('.Reiji_login p._login');
                            let error_field;
                            error_text.textContent = message;
                            for(let i = 0; i < labels_array.length; i++) {
                                error_field = document.querySelector(`.Reiji_login input[name="${labels_array[i]}"]`);
                                error_field.classList.add('form__error-field');
                            }
                        }
                    }
                }
                else {
                    Form.viewParseError(xhr.response);
                }
            }
            else {
                if(xhr.response.hasOwnProperty('name')) {
                    if(xhr.response['name']) {
                        let element = document.querySelector('#username');
                        element.textContent = xhr.response['name'];
                    }
                    else {
                        Form.viewParseError(xhr.response);
                    }
                }
                else {
                    Form.viewParseError(xhr.response);
                }
            }
        };
    }

    applyFormerFieldStyle() {
        this.classList.remove('form__error-field');
    }

    static viewParseError(data) {
        let got_data = JSON.stringify(data);
        alert(`Произошла ошибка во время обработки полученных данных!\n${got_data}`);
    }
}

let form = new Form();

document.addEventListener('DOMContentLoaded', function() {
    let element = document.querySelector('#registration_button');
    element.addEventListener('click', form.registrate);
    element = document.querySelector('#login_button');
    element.addEventListener('click', form.login);
    let elements;
    let elements_array = [
        'login',
        'name',
        'password'
    ];
    for(let i = 0; i < elements_array.length; i++) {
        elements = document.querySelectorAll(`header ~ div:first-of-type input[name="${elements_array[i]}"]`);
        for(let j = 0; j < elements.length; j++) {
            elements[j].addEventListener('input', form.applyFormerFieldStyle);
        }
    }
});