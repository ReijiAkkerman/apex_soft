import {Header} from './_Header.js';
import {Auth} from './Reiji/async/Auth.js';

const headerForm = document.querySelector(".header__cabinet-button");
const userCabinet = document.querySelector(".header__cabinet-form");
const bodyPage = document.querySelector("body");
const wrapperForm = document.querySelector(".header__cabinet-wrapper");
const formCloseElements = document.querySelectorAll(".form__close");

formCloseElements.forEach((formClose) => {
    formClose.addEventListener("click", Header.handleFormCloseClick);
});
if(!Auth.getCookie('id'))
    headerForm.addEventListener("click", Header.openForm);

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

export {headerForm, userCabinet, bodyPage, wrapperForm};