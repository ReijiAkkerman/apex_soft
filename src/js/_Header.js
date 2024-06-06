import { headerForm, userCabinet, userCabinetMobile, userCabinetLoginSide, userCabinetRegSide, headerNav, burger, bodyPage, wrapperForm } from './header.js';

class Header {
    static openForm() {
        headerForm.classList.add("active");
        userCabinet.classList.add("active");
        bodyPage.classList.add("active");
        wrapperForm.classList.add("active");
    }

    static closeForm() {
        headerForm.classList.remove("active");
        userCabinet.classList.remove("active");
        bodyPage.classList.remove("active");
        wrapperForm.classList.remove("active");
    }


    static handleFormCloseClick() {
        Header.closeForm();
    }

    static handleEscKeyDown(event) {
        if (event.key === "Escape") {
            Header.closeForm();
        }
    }




    static openFormMobile() {
        headerForm.classList.add("active");
        userCabinetMobile.classList.add("active");
        bodyPage.classList.add("active");
        wrapperForm.classList.add("active");
    }

    static closeFormMobile() {
        headerForm.classList.remove("active");
        userCabinetMobile.classList.remove("active");
        bodyPage.classList.remove("active");
        wrapperForm.classList.remove("active");
    }

    static openFormSide() {
        userCabinetLoginSide.classList.add("active");
    }

    static openRegSide() {
        userCabinetLoginSide.classList.remove("active");
        userCabinetRegSide.classList.add("active");
    }

    static openAuthSide() {
        userCabinetLoginSide.classList.add("active");
        userCabinetRegSide.classList.remove("active");
    }

}

export { Header };