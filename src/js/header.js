import { Header } from './_Header.js';
import { Auth } from './Reiji/async/Auth.js';

const headerForm = document.querySelector(".header__cabinet-button");
const userCabinet = document.querySelector(".header__cabinet-form");
const userCabinetMobile = document.querySelector(".header__cabinet-form--mobile");
const userCabinetLoginSide = document.querySelector(".form-header__cabinet--login");
const userCabinetRegSide = document.querySelector(".form-header__cabinet--registr");
const bodyPage = document.querySelector("body");
const wrapperForm = document.querySelector(".header__cabinet-wrapper");
const formCloseElements = document.querySelectorAll(".form__close");
const formLinkAuth = document.querySelector(".form-auth");
const formLinkReg = document.querySelector(".form-registr");



formCloseElements.forEach((formClose) => {
    formClose.addEventListener("click", Header.handleFormCloseClick);
});

if (!Auth.getCookie('id')) {

    if (window.screen.width <= 991) {
        headerForm.addEventListener("click", Header.openFormMobile);
        headerForm.addEventListener("click", closeBurgerMenu);
        headerForm.addEventListener("click", Header.openFormSide);
        formLinkReg.addEventListener("click", Header.openRegSide);
        formLinkAuth.addEventListener("click", Header.openAuthSide);
        userCabinetMobile.addEventListener("click", function (e) {
            e.stopPropagation();
        })
    } else {
        headerForm.addEventListener("click", Header.openForm);
        userCabinet.addEventListener("click", function (e) {
            e.stopPropagation();
        })

    }

}

wrapperForm.addEventListener("click", function (e) {
    closeBurgerMenuFull();
    e.stopPropagation();
})

document.addEventListener("keydown", Header.handleEscKeyDown);

const showMoreButtons = document.querySelectorAll(".description-list__button");

showMoreButtons.forEach(button => {
    const commonAncestor = button.closest('.description-list');
    const itemsContainers = commonAncestor.querySelectorAll('.description-list__items--more');
    const items = Array.from(itemsContainers).reduce((acc, container) => [...acc, ...container.querySelectorAll('.description-list__item')], []);
    const productsLength = items.length;
    let visibleItemsCount = 5;

    button.addEventListener("click", () => {
        visibleItemsCount += 2;
        const visibleItems = items.slice(0, visibleItemsCount);

        visibleItems.forEach(el => el.classList.add("is-visible"));

        if (visibleItems.length === productsLength) {
            button.style.display = "none";
        }
    });
});

const burger = document.querySelector(".burger");
const headerNav = document.querySelector(".header__nav--top");

burger.addEventListener("click", () => {
    burger.classList.add("active");
    headerNav.classList.add("active");
    bodyPage.classList.add("active");
    wrapperForm.classList.add("active");
})

wrapperForm.addEventListener("click", closeBurgerMenu);

function closeBurgerMenu(e) {
    burger.classList.remove("active");
    headerNav.classList.remove("active");
    bodyPage.classList.remove("active");
}

function closeBurgerMenuFull(e) {
    burger.classList.remove("active");
    headerNav.classList.remove("active");
    bodyPage.classList.remove("active");
    wrapperForm.classList.remove("active");
    (function (userCabinet, userCabinetMobile) {
        userCabinet.classList.remove("active");
        userCabinetMobile.classList.remove("active");
    })(userCabinet, userCabinetMobile);

}


tippy('[name="login"]', {
    content: 'Буквы латинского алфавита, цифры и знак нижнего подчеркивания. От 3 до 50 символов.',
});


tippy('[name="password"]', {
    content: 'Буквы латинского алфавита, цифры, точки и знак нижнего подчеркавния. От 5 до 50 символов.',
});

tippy('[name="name"]', {
    content: 'Буквы латиницы, кирилицы и цифры. От 3 до 100 символов.',
});

let switchCtn = document.querySelector("#switch-cnt");
let switchC1 = document.querySelector("#switch-c1");
let switchC2 = document.querySelector("#switch-c2");
let switchCircle = document.querySelectorAll(".switch__circle");
let switchBtn = document.querySelectorAll(".switch-btn");
let aContainer = document.querySelector(".form-header__cabinet--left");
let bContainer = document.querySelector(".form-header__cabinet--right");
let allButtons = document.querySelectorAll(".submit");

let getButtons = (e) => e.preventDefault()

let changeForm = (e) => {

    switchCtn.classList.add("is-gx");
    setTimeout(function () {
        switchCtn.classList.remove("is-gx");
    }, 1500)

    switchCtn.classList.toggle("is-txr");
    switchCircle[0].classList.toggle("is-txr");
    switchCircle[1].classList.toggle("is-txr");

    switchC1.classList.toggle("is-hidden");
    switchC2.classList.toggle("is-hidden");
    aContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-z200");
}

let mainF = (e) => {
    for (var i = 0; i < allButtons.length; i++)
        allButtons[i].addEventListener("click", getButtons);
    for (var i = 0; i < switchBtn.length; i++)
        switchBtn[i].addEventListener("click", changeForm)
}

window.addEventListener("load", mainF);

export { headerForm, userCabinet, userCabinetMobile, userCabinetLoginSide, userCabinetRegSide, headerNav, burger, bodyPage, wrapperForm };