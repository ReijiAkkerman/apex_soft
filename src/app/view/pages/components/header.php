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
                <div class="header__nav-mobile"></div>
            </nav>
            <div class="header__basket" id="cart-button" <?php if (!isset($this->name))
                echo 'style="display:none;"' ?>>
                    <a href="../cart/view" class="header__basket-icon icon-basket">
                    <?php if (isset($product_amount_mark)) { ?>
                        <span class="header__basket-count Reiji_products_number">0</span>
                    <?php } ?>
                </a>
            </div>
            <div class="header__cabinet Reiji_nav_for_exit-button" data-da="header__nav-mobile,1,991">
                <button class="header__cabinet-button icon-user btn Reiji_showAuthForm-button">
                    <p id="username"><?php
                    if (isset($this->name))
                        echo $this->name;
                    else
                        echo 'Войти';
                    ?></p>
                </button>
            </div>
            <div class="header__logout icon-log-out" id="exit-button" data-da="header__nav-mobile,2,991" <?php if (!isset($this->name))
                echo 'style="display:none;"' ?>></div>
                <button class=" btn-reset burger" aria-label="Открыть меню"><span class="burger__line"></span></button>
            </div>
        </div>
        <div class="header__bottom" data-ta="header__nav-mobile,0,500">
            <div class="container header__container header__container--bottom">
                <nav class="nav header__nav header__nav--bottom">
                    <ul class="nav__list nav__list--bottom">
                        <li class="nav__item nav__item--bottom">
                            <a href="/catalog/view" class="nav__link">Каталог</a>
                        </li>
                        <li class="nav__item nav__item--bottom" id="order_story" <?php if (!(isset($this->ID) && $this->ID))
                echo 'style="display:none;"' ?>>
                            <a href="/order/view" class="nav__link">История заказов</a>
                        </li>
                        <li class="nav__item nav__item--bottom">
                            <a href="/contacts/view" class="nav__link">Контакты</a>
                        </li>
                        <li class="nav__item nav__item--bottom">
                            <a href="/info/view" class="nav__link">Информация</a>
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
                    <h2 class="form__title title">Войдите на сайт</h2>
                    <span class="form__span">Используйте свою учетную <br> запись</span>
                    <p class="form__error-text _login"></p>
                    <input class="form__input" type="text" name="login" pattern="[A-Za-z0-9_]{3,50}" placeholder="Логин">
                    <p class="form__error-text _password"></p>
                    <input class="form__input" type="password" name="password" pattern="[A-Za-z0-9_.]{5,50}"
                        placeholder="Пароль">
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
                    <input class="form__input " type="text" name="login" pattern="^[A-Za-z0-9_]{3,50}$" placeholder="Логин">
                    <p class="form__error-text _name"></p>
                    <input class="form__input" type="text" name="name" pattern="^[A-Za-z0-9А-Яа-я]{3,100}$"
                        placeholder="Имя пользователя">
                    <p class="form__error-text _password"></p>
                    <input class="form__input" type="password" name="password" pattern="^[A-Za-z0-9_.]{5,50}$"
                        placeholder="Пароль">
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
        <div class="header__cabiner-form header__cabinet-form--mobile form-header form-header--mobile">
            <div class="form-header__cabinet form-header__cabinet--login">
                <form class="form form--left Reiji_login">
                    <h2 class="switch__title title">Привет, друг !</h2>
                    <p class="switch__description">Введите свои личные данные и начните путешествие вместе с нами
                    </p>
                    <h2 class="form__title title">Войдите на сайт</h2>
                    <span class="form__span">Используйте свою учетную <br> запись</span>
                    <p class="form__error-text _login"></p>
                    <input class="form__input" type="text" name="login" pattern="[A-Za-z0-9_]{8,50}" placeholder="Логин">
                    <p class="form__error-text _password"></p>
                    <input class="form__input" type="password" name="password" pattern="[A-Za-z0-9_.]{5,50}"
                        placeholder="Пароль">
                    <button class="form__button button submit" id="login_button">ВОЙТИ</button>
                    <p class="form__p">Первый раз? <span class="form-registr">Зарегистрируйтесь сейчас!</span></p>
                </form>
            </div>
            <div class="form-header__cabinet form-header__cabinet--registr">
                <form class="form form--right Reiji_registration">
                    <h2 class="switch__title title">Добро пожаловать!</h2>
                    <p class="switch__description">Чтобы оставаться на связи с нами, пожалуйста, войдите, используя
                        свои личные данные.</p>
                    <h2 class="form__title title">Создайте аккаунт</h2>
                    <span class="form__span">Используйте свою учетную запись <br> электронной почты для регистрации</span>
                    <p class="form__error-text _login"></p>
                    <input class="form__input" type="text" name="login" pattern="^[A-Za-z0-9_]{8,50}$" placeholder="Логин">
                    <p class="form__error-text _name"></p>
                    <input class="form__input" type="text" pattern="^[A-Za-z0-9А-Яа-я]{3,100}$"
                        placeholder="Имя пользователя">
                    <p class="form__error-text _password"></p>
                    <input class="form__input" type="password" name="password" pattern="^[A-Za-z0-9_.]{5,50}$"
                        placeholder="Пароль">
                    <button class="form__button button submit" id="registration_button">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                    <p class="form-auth">Уже есть аккаунт?</p>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="/src/js/Reiji/async/Auth.js"></script>
    <template class="ReijiTemplate_exit-button">
        <div class="header__logout icon-log-out Reiji_exit-button"></div>
    </template>