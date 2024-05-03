const adminPanel = document.querySelector(".panel__wrapper");
const adminPanelForm = document.querySelector(".panel__wrapper-form");
const buttonAdd = document.querySelector(".catalog__control-button");
const productCards = document.querySelectorAll(".product-card");

function showAdminPanel() {
    adminPanel.style.display = "flex";
}
function closeAdminPanel() {
    adminPanel.style.display = "none";
}
function stop(e) {
    e.stopPropagation();
}

function closeAdminPanelEsc(event) {
    if (event.key === "Escape") {
        closeAdminPanel();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    buttonAdd.addEventListener("click", showAdminPanel);
    adminPanelForm.addEventListener("click", stop);
    adminPanel.addEventListener("click", closeAdminPanel)
    productCards.forEach((productCard) => {
        productCard.addEventListener("click", showAdminPanel);
    })
    document.addEventListener("keydown", closeAdminPanelEsc);
})

const imageInput = document.querySelector(".panel__input-image");
const imagePreview = document.querySelector(".panel__image-preview");

imageInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            imagePreview.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    }
});


$('select[data-menu]').each(function () {

    let select = $(this),
        options = select.find('option'),
        menu = $('<div />').addClass('catalog__control-select'),
        button = $('<div />').addClass('catalog__control-button'),
        list = $('<ul />'),
        arrow = $('<em />').prependTo(button);

    options.each(function (i) {
        let option = $(this);
        list.append($('<li />').text(option.text()));
    });

    menu.css('--t', select.find(':selected').index() * -41 + 'px');

    select.wrap(menu);

    button.append(list).insertAfter(select);

    list.clone().insertAfter(button);

});

$(document).on('click', '.catalog__control-select', function (e) {

    let menu = $(this);

    if (!menu.hasClass('open')) {
        menu.addClass('open');
    }

});

$(document).on('click', '.catalog__control-select > ul > li', function (e) {

    let li = $(this),
        menu = li.parent().parent(),
        select = menu.children('select'),
        selected = select.find('option:selected'),
        index = li.index();

    menu.css('--t', index * -41 + 'px');
    selected.attr('selected', false);
    select.find('option').eq(index).attr('selected', true);

    menu.addClass(index > selected.index() ? 'tilt-down' : 'tilt-up');

    setTimeout(() => {
        menu.removeClass('open tilt-up tilt-down');
    }, 500);

});

$(document).click(e => {
    e.stopPropagation();
    if ($('.catalog__control-select').has(e.target).length === 0) {
        $('.catalog__control-select').removeClass('open');
    }
})


