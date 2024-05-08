import {AuthPopup} from './AuthPopup.js';
import {AdminForm} from './AdminForm.js';

class Auth {
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
                    Auth.viewParseError(xhr.response);
                }
            }
            else {
                if(xhr.response.hasOwnProperty('name')) {
                    if(xhr.response['name']) {
                        let element = document.querySelector('#username');
                        element.textContent = xhr.response['name'];
                        AuthPopup.showExitButton();
                        AuthPopup.showCartButton();
                        let admin = Auth.getCookie('is_admin');
                        if(admin) 
                            AdminForm.showAdminFunctions();
                    }
                    else {
                        Auth.viewParseError(xhr.response);
                    }
                }
                else {
                    Auth.viewParseError(xhr.response);
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
                    Auth.viewParseError(xhr.response);
                }
            }
            else {
                if(xhr.response.hasOwnProperty('name')) {
                    if(xhr.response['name']) {
                        let element = document.querySelector('#username');
                        element.textContent = xhr.response['name'];
                        AuthPopup.showExitButton();
                        AuthPopup.showCartButton();
                        let admin = Auth.getCookie('is_admin');
                        if(admin) 
                            AdminForm.showAdminFunctions();
                    }
                    else {
                        Auth.viewParseError(xhr.response);
                    }
                }
                else {
                    Auth.viewParseError(xhr.response);
                }
            }
        };
    }

    static exit() {
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `../${currentPagename}/exit`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            let username = document.querySelector('#username');
            username.textContent = 'Войти';
            AuthPopup.hideExitButton();
            AuthPopup.hideCartButton();
        };
    }

    applyFormerFieldStyle() {
        this.classList.remove('form__error-field');
    }

    static viewParseError(data) {
        let got_data = JSON.stringify(data);
        alert(`Произошла ошибка во время обработки полученных данных!\n${got_data}`);
    }

    static getCookie(name) {
        let cookieArray = [];
        let temp_array = document.cookie.split('; ');
        for(let i = 0; i < temp_array.length; i++) {
            let temp_data = temp_array[i].split('=');
            cookieArray[temp_data[0]] = temp_data[1]; 
        }
        if(typeof cookieArray[name] === 'undefined')
            return false;
        else 
            return cookieArray[name];
    }
}

export {Auth};

let auth = new Auth();

document.addEventListener('DOMContentLoaded', function() {
    let element = document.querySelector('#registration_button');
    element.addEventListener('click', auth.registrate);
    element = document.querySelector('#login_button');
    element.addEventListener('click', auth.login);
    let elements;
    let elements_array = [
        'login',
        'name',
        'password'
    ];
    for(let i = 0; i < elements_array.length; i++) {
        elements = document.querySelectorAll(`.Reiji_forms input[name="${elements_array[i]}"]`);
        for(let j = 0; j < elements.length; j++) {
            elements[j].addEventListener('input', auth.applyFormerFieldStyle);
        }
    }
    element = document.querySelector('#exit-button');
    if(typeof element != 'null') 
        element.addEventListener('click', Auth.exit);
});