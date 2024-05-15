const headerForm = document.querySelector(".header__cabinet-button");
const userCabinet = document.querySelector(".header__cabinet-form");
const bodyPage = document.querySelector("body");
const wrapperForm = document.querySelector(".header__cabinet-wrapper");
const formCloseElements = document.querySelectorAll(".form__close");

function openForm() {
    headerForm.classList.add("active")
    userCabinet.classList.add("active")
    bodyPage.classList.add("active")
    wrapperForm.classList.add("active")
}

function closeForm() {
    headerForm.classList.remove("active")
    userCabinet.classList.remove("active")
    bodyPage.classList.remove("active")
    wrapperForm.classList.remove("active")
}

function handleFormCloseClick() {
    closeForm();
}

function handleEscKeyDown(event) {
    if (event.key === "Escape") {
        closeForm();
    }
}

formCloseElements.forEach((formClose) => {
    formClose.addEventListener("click", handleFormCloseClick);
});

headerForm.addEventListener("click", openForm);
document.addEventListener("keydown", handleEscKeyDown);


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
