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
                    <!-- <li class="nav__item nav__item--top"><a href="#" class="nav__link icon-calendar-alt-fill">
                            <p class="nav__link-text">Время работы <span><time datetime="10:00">10:00</time>-<time
                                        datetime="17:00">17:00</time></span> </p>
                        </a></li> -->
                    <!-- <li class="nav__item nav__item--top"><a href="#" class="nav__link icon-user">Войти</a></li> -->
                </ul>
            </nav>
            <div class="header__cabinet">
                <button class="header__cabinet-button icon-user btn">
                    <p id="username"><?php
                    if (isset($this->name))
                        echo $this->name;
                    else
                        echo 'Войти';
                    ?></p>
                </button>
            </div>
        </div>
    </div>
    <div class="header__fixed">
        <div class="container header__container header__container--fixed">
            <nav class="nav header__nav header__nav--fixed">
                <ul class="nav__list nav__list--fixed">
                    <li class="nav__item nav__item--fixed">
                        <a href="" class="nav__link nav__link--fixed">Решения</a>
                        <ul class="nav__list-description description description--first">
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
                    <li class="nav__item nav__item--fixed">
                        <a href="" class="nav__link nav__link--fixed">Каталог</a>
                        <ul class="nav__list-description description"></ul>
                    </li>
                    <li class="nav__item nav__item--fixed">
                        <a href="" class="nav__link nav__link--fixed">Контакы</a>
                    </li>
                    <li class="nav__item nav__item--fixed">
                        <a href="" class="nav__link nav__link--fixed">Информация</a>
                        <ul class="nav__list-description description"></ul>

                    </li>
                    <!-- <li class="nav__item nav__item--fixed">ООО «Апекс-софт» <br> официальный представитель 1C <br> в Брянске</li> -->
                </ul>
            </nav>
            <!-- <div class="header__right">
            </div> -->
        </div>
    </div>
</header>
<div class="header__cabinet-form form-header">
    <div class="form-header__cabinet form-header__cabinet--left">
        <form class="form form--left registration">
            <h2 class="form__title title">Создайте аккаунт</h2>
            <span class="form__span">Используйте свою учетную запись <br> электронной почты для регистрации</span>
            <p class="form__error-text _login"></p>
            <input class="form__input " type="text" name="login" pattern="^[A-Za-z0-9_]{8,50}$" placeholder="Login">
            <p class="form__error-text _name"></p>
            <input class="form__input" type="text" name="name" pattern="^[A-Za-z0-9А-Яа-я]{3,100}$" placeholder="Name">
            <p class="form__error-text _password"></p>
            <input class="form__input" type="password" name="password" pattern="^[A-Za-z0-9_.]{5,50}$"
                placeholder="Password">
            <button class="form__button button submit" id="registration_button">ЗАРЕГИСТРИРОВАТЬСЯ</button>
        </form>
    </div>
    <div class="form-header__cabinet form-header__cabinet--right">
        <form class="form form--right login">
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
    <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
            <h2 class="switch__title title">Добро пожаловать!</h2>
            <p class="switch__description description">Чтобы оставаться на связи с нами, пожалуйста, войдите, используя
                свои личные данные.</p>
            <button class="switch__button button switch-btn">ВОЙТИ</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
            <h2 class="switch__title title">Привет, друг !</h2>
            <p class="switch__description description">Введите свои личные данные и начните путешествие вместе с нами
            </p>
            <button class="switch__button button switch-btn">ЗАРЕГИСТРИРОВАТЬСЯ</button>
        </div>
    </div>
</div>
<script src="/src/js/Reiji/async/form.js"></script>