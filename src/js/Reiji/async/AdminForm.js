import {Auth} from './Auth.js';

class AdminForm {
    static list_status = false;
    static ul_counter = 0;

    static saveProductData(event) {
        event.preventDefault();
        AdminForm.insertData();
        let data = new FormData(document.querySelector('#admin_form'));
        let element = document.querySelector('#save-button');
        let action = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/action_/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let action = classname.split('_')[1];
            return action;
        })(element);
        let id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(element);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/product/${action}Product/${id}`);
        xhr.send(data);
        xhr.responseType = 'text';
        xhr.onload = () => {
            alert(xhr.response);
            // window.location.href = '/catalog/view';
        };
    }

    deleteProduct(event) {
        event.preventDefault();
        let id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(this);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/product/deleteProduct/${id}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            window.location.href = '/catalog/view';
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
        if(element !== null)
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

    static showAdminFunctions() {
        let product_name = document.querySelector('#product_name');
        let product_type = document.querySelector('#product_type');
        let product_description = document.querySelector('#product_description');
        let image = document.querySelector('#add_image');
        let form_template = document.querySelector('.Reiji_admin-form');
        let buttons_template = document.querySelector('.Reiji_admin-buttons');
        let form = form_template.content.cloneNode(true);
        let buttons = buttons_template.content.cloneNode(true);
        let place_for_form = document.querySelector('#product_description');
        let place_for_buttons = document.querySelector('.Reiji_place_for_buttons');

        product_name.setAttribute('contenteditable', 'true');
        product_type.setAttribute('contenteditable', 'true');
        product_description.setAttribute('contenteditable', 'true');
        place_for_form.after(form);
        place_for_buttons.after(buttons);
        image.addEventListener('click', AdminForm.addImage);

        let send_button = document.querySelector('#save-button');
        let list = document.querySelector('#for_list');
        let paragraph = document.querySelector('#for_paragraph');
        let theme = document.querySelector('#for_theme');

        send_button.addEventListener('click', AdminForm.saveProductData);
        list.addEventListener('click', AdminForm.insertList);
        paragraph.addEventListener('click', AdminForm.insertParagraph);
        theme.addEventListener('click', AdminForm.insertTheme);
    }

    static hideAdminFunctions() {
        let product_name = document.querySelector('#product_name');
        let product_type = document.querySelector('#product_type');
        let product_description = document.querySelector('#product_description');
        let image = document.querySelector('#add_image');
        let form = document.querySelector('#admin_form');
        let buttons = document.querySelectorAll('.Reiji_admin-button');

        product_name.removeAttribute('contenteditable');
        product_type.removeAttribute('contenteditable');
        product_description.removeAttribute('contenteditable');
        image.removeEventListener('click', AdminForm.addImage);
        form.remove();
        for(let i = 0; i < buttons.length; i++) {
            buttons[i].remove();
        }
    }

    static hideAddButton() {
        let element = document.querySelector('#add_button');
        element.remove();
    }

    static showAddButton() {
        let element_template = document.querySelector('.Reiji_add_button');
        let element = element_template.content.cloneNode(true);
        let insertion_place = document.querySelector('.Reiji_place_for_add_button');
        insertion_place.after(element);
    }

    addId() {
        this.id = 'delete-button';
    }

    deleteId() {
        this.id = '';
    }
}

export {AdminForm};

var admin = new AdminForm();

if((window.location.pathname.split('/')[1]) == 'product') {
    document.addEventListener('DOMContentLoaded', function() {
        let element = document.querySelector('#save-button');
        if(element !== null)
            element.addEventListener('click', AdminForm.saveProductData);
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
        element = document.querySelector('#exit-button');
        if(element !== null)
            element.addEventListener('click', AdminForm.hideAdminFunctions);
        element = document.querySelector('.Reiji_delete-button');
        if(element !== null)
            element.addEventListener('click', admin.deleteProduct);
    });
}

if((window.location.pathname.split('/')[1]) == 'catalog') {
    let elements = document.querySelectorAll('.Reiji_delete-button');
    for(let i = 0; i < elements.length; i++) {
        if(elements !== null) {
            elements[i].addEventListener('click', admin.deleteProduct);
            elements[i].addEventListener('mouseover', admin.addId);
            elements[i].addEventListener('mouseout', admin.deleteId);
        }
    }
}