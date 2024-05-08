class AdminForm {
    static list_status = false;
    static ul_counter = 0;

    static sendData(event) {
        event.preventDefault();
        AdminForm.insertData();
        let data = new FormData(document.querySelector('#admin_form'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../product/createProduct');
        xhr.send(data);
        xhr.responseType = 'text';
        xhr.onload = () => {
            alert(xhr.response);
        };
    }

    static insertTheme() {
        AdminForm.list_status = false;
        let element_template = document.querySelector('.Reiji_theme');
        let element = element_template.content.cloneNode(true);
        let insertion_place = document.querySelector('#product_description');
        insertion_place.append(element);
    }

    static insertParagraph() {
        AdminForm.list_status = false;
        let element_template = document.querySelector('.Reiji_paragraph');
        let element = element_template.content.cloneNode(true);
        let insertion_place = document.querySelector('#product_description');
        insertion_place.append(element);
    }

    static insertList() {
        let element_template;
        if(AdminForm.list_status) {
            let list = document.querySelector('#list' + (AdminForm.ul_counter - 1));
            if(list === null) {
                AdminForm.ul_counter--;
                AdminForm.list_status = false;
                element_template = document.querySelector('.Reiji_list');
            }
            else 
                element_template = document.querySelector('.Reiji_list_item');
        }
        else 
            element_template = document.querySelector('.Reiji_list');
        let element = element_template.content.cloneNode(true);
        let ul = element.querySelector('ul');
        if(AdminForm.list_status == false)
            ul.id = 'list' + AdminForm.ul_counter;
        let insertion_place;
        if(AdminForm.list_status) {
            insertion_place = document.querySelector('#list' + (AdminForm.ul_counter - 1));
        }
        else {
            insertion_place = document.querySelector('#product_description');
            AdminForm.list_status = true;
            AdminForm.ul_counter++;
        }
        insertion_place.append(element);
    }

    static addImage() {
        let element = document.querySelector('[name="image"]');
        element.click();
    }

    static insertData() {
        let array = [
            'product_name',
            'product_type',
        ];
        let element;
        let input;
        for(let i = 0; i < array.length; i++) {
            let element = document.querySelector(`#${array[i]}`);
            let input = document.querySelector(`[name="${array[i]}"]`);
            input.value = element.textContent;
        }
        element = document.querySelector(`#product_description`);
        input = document.querySelector(`[name="product_description"]`);
        input.value = element.innerHTML;
    }
}

export {AdminForm};

document.addEventListener('DOMContentLoaded', function() {
    let element = document.querySelector('#save-button');
    if(element !== null)
        element.addEventListener('click', AdminForm.sendData);
    element = document.querySelector('#add_image');
    if(element !== null)
        element.addEventListener('click', AdminForm.addImage);
    element = document.querySelector('#for_list');
    if(element !== null)
        element.addEventListener('click', AdminForm.insertList);
    element = document.querySelector('#for_theme');
    if(element !== null)
        element.addEventListener('click', AdminForm.insertTheme);
    element = document.querySelector('#for_paragraph');
    if(element !== null)
        element.addEventListener('click', AdminForm.insertParagraph);
});