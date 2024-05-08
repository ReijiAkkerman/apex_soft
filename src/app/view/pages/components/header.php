<header class="header">
    <div class="header__top">
        <div class="container header__container header__container--top">
            <a href="/" class="logo header__logo" aria-label="Логотип Апекс Софт"><img src="/src/assets/img/logo.png"
                    alt="Логотип компании «Апекс-софт»"></a>
            <nav class="nav header__nav header__nav--top ">
                <ul class="nav__list nav__list--top">
                    <li class="nav__item nav__item--top"><a
                            href="https://yandex.ru/maps/org/apeks_soft/1023193342/?indoorLevel=1&ll=34.344219%2C53.243368&z=17.05"
                            class="nav__link icon-adress">Россия, г. Брянск, переулок Осоавиахима, 3А , офис 603</a>
                    </li>
                    <li class="nav__item nav__item--top"><a href="tel:+74832320117" class="nav__link icon-phone">+7
                            (4832) 320-117</a>
                    </li>
                    <li class="nav__item nav__item--top"><a href="mailto:info@1capexsoft.ru"
                            class="nav__link icon-mail">info@1capexsoft.ru</a>
                    </li>
                </ul>
            </nav>
            <div class="header__basket" id="cart-button" <?php if(!isset($this->name)) echo 'style="display:none;"' ?>>
                <a href="../cart/view" class="header__basket-icon icon-basket">
                    <span>0</span>
                </a>
            </div>
            <div class="header__cabinet Reiji_nav_for_exit-button">
                <button class="header__cabinet-button icon-user btn Reiji_showAuthForm-button">
                    <p id="username"><?php
                    if (isset($this->name))
                        echo $this->name;
                    else
                        echo 'Войти';
                    ?></p>
                </button>
            </div>
            <div class="header__logout icon-log-out" id="exit-button" <?php if(!isset($this->name)) echo 'style="display:none;"' ?>></div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container header__container header__container--bottom">
            <nav class="nav header__nav header__nav--bottom">
                <ul class="nav__list nav__list--bottom">
                    <li class="nav__item nav__item--bottom">
                        <a href="" class="nav__link nav__link--bottom">Решения</a>
                        <ul class="nav__list-description description">
                            <li class="description-list">
                                <p class="description-list__title">Базовая</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1C: Бухгалтерия 8. Базовая
                                            Версия</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Зарплата и Управление
                                            Персоналом 8. Базовая версия</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Управление торговлей 8.
                                            Базовая версия</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Розница 8. Базовая версия.</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Управление нашей фирмой 8.
                                            Базовая версия</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">ПРОФ</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Бухгалтерия 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Зарплата и Управление
                                            Персоналом 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Управление торговлей 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Розница 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Управление нашей фирмой 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Комплексная автоматизация
                                            8</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">БЮДЖЕТ</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Зарплата и кадры
                                            государственного учреждения 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Бухгалтерия государственного
                                            учреждения 8</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Бухгалтерия государственного
                                            учреждения 8. Базовая версия</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav__item nav__item--bottom">
                        <a href="/catalog/view" class="nav__link nav__link--bottom">Каталог</a>
                        <ul class="nav__list-description description">
                            <li class="description-list">
                                <p class="description-list__title">Программы</p>
                                <ul class="description-list__items description-list__items--more">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С : Бухгалтерия 8 ПРОФ</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Розница 8 ПРОФ </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С : Бухгалтерия 8. Комплект на 5
                                            пользователей </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Управление нашей фирмой 8 </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Зарплата и Управление Персоналом
                                            8. Базовая версия </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Управление торговлей 8. Базовая
                                            версия </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Розница 8. Базовая версия </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Управление нашей фирмой 8.
                                            Базовая версия </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Бухгалтерия 8. Базовая версия
                                        </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Зарплата и Управление Персоналом
                                            8 ПРОФ </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Комплексная автоматизация 8 </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> 1С :Управление торговлей 8 ПРОФ </a>
                                    </li>
                                </ul>
                                <div class="description-list__button">
                                    Показать больше
                                </div>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">Услуги</p>
                                <ul class="description-list__items description-list__items--more">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Консультации 1С</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Установка 1С</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Настройка 1С </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Обслуживание 1С </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Информационно-технологическое
                                            сопровождение (ИТС) </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Аутсорсинг программирования 1С</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Торговое оборудование</a>
                                    </li>
                                </ul>
                                <div class="description-list__button">
                                    Показать больше
                                </div>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">Сервисы</p>
                                <ul class="description-list__items description-list__items--more">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Веб сервис</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Обновление программ </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Контрагент </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:ДиректБанк </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С-ЭДО </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Подпись </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Сверка </a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">1С:Фреш</a>
                                    </li>
                                </ul>
                                <div class="description-list__button">
                                    Показать больше
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav__item nav__item--dropdown">
                        <a href="" class="nav__link nav__link--bottom">Контакты</a>
                    </li>
                    <li class="nav__item nav__item--bottom">
                        <a href="" class="nav__link nav__link--bottom">Информация</a>
                        <ul class="nav__list-description description description--info">
                            <li class="description-list">
                                <p class="description-list__title">Статьи</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">
                                            1С:Бухгалтерия: как настроить новые коды в платежных поручениях на выплату
                                            зарплаты с 1 июня 2020</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Как компании организовать удаленную
                                            работу: рекомендации и лайфхаки от фирмы «1С»</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Обязательная маркировка обуви: как не
                                            нарушать закон после 1 марта 2020 года</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">Новости</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> Депутаты предложили изменить условия
                                            выплаты детских пособий</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Минфин и ФНС уточнили срок
                                            представления бухгалтерской отчетности за 2019 год</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> Какие автомобили считаются
                                            дорогостоящими в 2020 году</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link"> В какие сроки надо уплатить
                                            имущественные налоги в 2019 году</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="description-list">
                                <p class="description-list__title">Разработки на 1С</p>
                                <ul class="description-list__items">
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Перенос данных с помощью обработки
                                            "Загрузка данных из табличного документа"</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Выгрузка из документа "Реализация
                                            товаров и услуг" формы УПД в формате xml для загрузки в Диадок</a>
                                    </li>
                                    <li class="description-list__item">
                                        <a href="#" class="description-list__link">Перенос данных из ДАЛИОН: ТРЕНД в
                                            1С:Управление торговлей, редакция 11</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="header__cabinet-wrapper Reiji_forms">
    <div class="header__cabinet-form form-header">
        <div class="form-header__cabinet form-header__cabinet--left">
            <form class="form form--left Reiji_login">
                <svg class="form__close" width="64" version="1.1" xmlns="http://www.w3.org/2000/svg" height="64"
                    viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                    <g>
                        <path fill="#1D1D1B"
                            d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z" />
                    </g>
                </svg>
                <h2 class="form__title title">Войдите на сайт Апекс Софт</h2>
                <span class="form__span">Используйте свою учетную <br> запись</span>
                <p class="form__error-text _login"></p>
                <input class="form__input" type="text" name="login" pattern="[A-Za-z0-9_]{8,50}" placeholder="Login">
                <p class="form__error-text _password"></p>
                <input class="form__input" type="password" name="password" pattern="[A-Za-z0-9_.]{5,50}"
                    placeholder="Password">
                <a class="form__link">Забыли пароль?</a>
                <button class="form__button button submit" id="login_button">ВОЙТИ</button>
            </form>
        </div>
        <div class="form-header__cabinet form-header__cabinet--right">
            <form class="form form--right Reiji_registration">
                <svg class="form__close" width="64" version="1.1" xmlns="http://www.w3.org/2000/svg" height="64"
                    viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                    <g>
                        <path fill="#1D1D1B"
                            d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z" />
                    </g>
                </svg>
                <h2 class="form__title title">Создайте аккаунт</h2>
                <span class="form__span">Используйте свою учетную запись <br> электронной почты для регистрации</span>
                <p class="form__error-text _login"></p>
                <input class="form__input " type="text" name="login" pattern="^[A-Za-z0-9_]{8,50}$" placeholder="Login">
                <p class="form__error-text _name"></p>
                <input class="form__input" type="text" name="name" pattern="^[A-Za-z0-9А-Яа-я]{3,100}$"
                    placeholder="Name">
                <p class="form__error-text _password"></p>
                <input class="form__input" type="password" name="password" pattern="^[A-Za-z0-9_.]{5,50}$"
                    placeholder="Password">
                <button class="form__button button submit" id="registration_button">ЗАРЕГИСТРИРОВАТЬСЯ</button>
            </form>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container is-hidden" id="switch-c1">
                <h2 class="switch__title title">Добро пожаловать!</h2>
                <p class="switch__description">Чтобы оставаться на связи с нами, пожалуйста, войдите, используя
                    свои личные данные.</p>
                <button class="switch__button button switch-btn">ВОЙТИ</button>
            </div>
            <div class="switch__container" id="switch-c2">
                <h2 class="switch__title title">Привет, друг !</h2>
                <p class="switch__description">Введите свои личные данные и начните путешествие вместе с нами
                </p>
                <button class="switch__button button switch-btn">ЗАРЕГИСТРИРОВАТЬСЯ</button>
            </div>
        </div>
    </div>
</div>
<script type="module" src="/src/js/Reiji/async/Auth.js"></script>
<template class="ReijiTemplate_exit-button">
    <div class="header__logout icon-log-out Reiji_exit-button"></div>
</template>