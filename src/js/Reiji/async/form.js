class Form {
    registrate(event) {
        event.preventDefault();
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let data = new FormData(document.querySelector('header ~ div:first-of-type .registration'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `../${currentPagename}/registrate`);
        xhr.send(data);
        xhr.responseType = 'json';
        xhr.onload = () => {
            // alert(xhr.response);
            if(xhr.response.hasOwnProperty('error_message')) {

            }
            else {
                
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
        let data = new FormData(document.querySelector('header ~ div:first-of-type .login'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `../${currentPagename}/login`);
        xhr.send(data);
        xhr.responseType = 'json';
        xhr.onload = () => {
            // alert(xhr.response);
            if(xhr.response.hasOwnProperty('error_message')) {

            }
            else {

            }
        };
    }
}

let form = new Form();

document.addEventListener('DOMContentLoaded', function() {
    let element = document.querySelector('#registration_button');
    element.addEventListener('click', form.registrate);
    element = document.querySelector('#login_button');
    element.addEventListener('click', form.login);
});