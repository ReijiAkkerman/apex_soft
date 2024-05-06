class AdminForm {
    static test(event) {
        event.preventDefault();
        let data = new FormData(document.querySelector('#admin_form'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../catalog/createProduct');
        xhr.send(data);
        xhr.responseType = 'text';
        xhr.onload = () => {
            alert(xhr.response);
        };
    }
}

export {AdminForm};



document.addEventListener('DOMContentLoaded', function() {
    let element = document.querySelector('#save-button');
    element.addEventListener('click', AdminForm.test);
});