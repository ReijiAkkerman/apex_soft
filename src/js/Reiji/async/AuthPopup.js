class AuthPopup {
    static showExitButton() {
        let exit_button = document.querySelector('#exit-button');
        exit_button.style.display = 'block';
    }

    static hideExitButton() {
        let exit_button = document.querySelector('#exit-button');
        exit_button.style.display = 'none';
    }

    static showCartButton() {
        let cart_button = document.querySelector('#cart-button');
        cart_button.style.display = 'block';
    }

    static hideCartButton() {
        let cart_button = document.querySelector('#cart-button');
        cart_button.style.display = 'none';
    }

    static hideAuthForm() {
        let form = document.querySelector('.Reiji_forms');
        form.style.display = 'none';
    }
}

export {AuthPopup};