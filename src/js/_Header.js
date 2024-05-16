import {headerForm, userCabinet, bodyPage, wrapperForm} from './header.js';

class Header {
    static openForm() {
        headerForm.classList.add("active")
        userCabinet.classList.add("active")
        bodyPage.classList.add("active")
        wrapperForm.classList.add("active")
    }

    static closeForm() {
        headerForm.classList.remove("active")
        userCabinet.classList.remove("active")
        bodyPage.classList.remove("active")
        wrapperForm.classList.remove("active")
    }
    
    
    static handleFormCloseClick() {
        Header.closeForm();
    }
    
    static handleEscKeyDown(event) {
        if (event.key === "Escape") {
            Header.closeForm();
        }
    }
}

export {Header};