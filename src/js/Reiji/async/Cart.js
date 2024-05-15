class Cart {
    static setProductAmount() {
        let currentPagename = (function() {
            let path = window.location.pathname;
            let pagenames_array = path.split('/');
            let pagename = pagenames_array[1];
            return pagename;
        })();
        let input = document.querySelector('.Reiji_product_amount');
        let product_id = (function(element) {
            let classname;
            for(let i = 0; i < element.classList.length; i++) {
                if(/Reiji_id/.test(element.classList[i]))
                    classname = element.classList[i];
            }
            let id = classname.split('-')[1];
            return id;
        })(input);
        let product_amount = input.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/${currentPagename}/setProductAmount/${product_id}/${product_amount}`);
        xhr.send();
        xhr.responseType = 'text';
        xhr.onload = () => {
            alert(xhr.response);
        };
    }

    static deleteProduct() {
        
    }
}

if((window.location.pathname.split('/')[1]) == 'catalog') {
    document.addEventListener('DOMContentLoaded', function() {
        element = document.querySelector('.Reiji_increment_product');
        if(element !== null) 
            element = document.addEventListener('click', Cart.setProductAmount);
        element = document.querySelector('.Reiji_decrement_product');
        if(element !== null) 
            element = document.addEventListener('click', Cart.setProductAmount);
    });
}
