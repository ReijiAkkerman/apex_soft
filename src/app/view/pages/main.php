<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page page--main">
        <section class="hero">
            <div class="hero__swiper swiper">
                <button class="hero__swiper-prev btn"></button>
                <button class="hero__swiper-next btn"></button>
                <div class="hero__swiper-pagination swiper-pagination"> </div>
                <div class="hero__swiper-wrapper swiper-wrapper">
                    <div class="hero__slide swiper-slide" data-slide="">
                        <div class="hero__swiper-slide">
                            <div class="hero__container">
                                <h1 class="hero__swiper-title">1С:Веб сервис</h1>
                                <p class="hero__swiper-descr">
                                    Работайте в 1С через веб сервис.
                                    Автоматическое обновление,
                                    изменение конфигурации под
                                    ваши запросы, консультация.
                                </p>
                                <button class="hero__swiper-button btn">Перейти в каталог</button>
                            </div>
                        </div>
                    </div>
                    <div class="hero__slide swiper-slide" data-slide="">
                        <div class="hero__swiper-slide">
                            <div class="hero__container">
                                <h1 class="hero__swiper-title">1С:Фреш - работайте в программе 1С из любой точки мира
                                </h1>
                                <p class="hero__swiper-descr">
                                    Ведите бухгалтерский и налоговый учет, сдавайте отчетность, контролируйте бизнес
                                    через Интернет!
                                </p>
                                <button class="hero__swiper-button btn">Перейти в каталог</button>
                            </div>
                        </div>
                    </div>
                    <div class="hero__slide swiper-slide" data-slide="">
                        <div class="hero__swiper-slide">
                            <div class="hero__container">
                                <h1 class="hero__swiper-title">Продажа программных продуктов компании «1С»</h1>
                                <p class="hero__swiper-descr">
                                    Свыше 200 программ «1С» для эффективной работы вашего бизнеса, внедрение и
                                    сопровождение программных продуктов
                                </p>
                                <button class="hero__swiper-button btn">Перейти в каталог</button>
                            </div>
                        </div>
                    </div>
                    <div class="hero__slide swiper-slide" data-slide="">
                        <div class="hero__swiper-slide">
                            <div class="hero__container">
                                <h1 class="hero__swiper-title">Официальный партнер 1С франчайзинг</h1>
                                <p class="hero__swiper-descr">
                                    Автоматизация вашего бизнеса на базе программных продуктов компании 1С. Широкий
                                    спектр услуг по сопровождению программных продуктов компании 1С
                                </p>
                                <button class="hero__swiper-button btn">Перейти в каталог</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer__wrapper">
            <div class="footer__container">
                <a href="/" class="logo footer__logo" aria-label="Логотип Апекс Софт"><img src="/src/assets/img/logo.png"
                        alt="Логотип компании «Апекс-софт»"></a>
                <div class="footer__wrapper-menu">
                    <a href="/catalog/view" class="footer__wrapper-name">
                        Каталог
                    </a>
                    <ul class="footer__wrapper-items">
                        <li class="footer__wrapper-item"><a href="#" class="footer__wrapper-link">Программы</a></li>
                        <li class="footer__wrapper-item"><a href="#" class="footer__wrapper-link">Услуги</a></li>
                        <li class="footer__wrapper-item"><a href="#" class="footer__wrapper-link">Сервисы</a></li>
                    </ul>
                </div>
                <div class="footer__wrapper-menu">
                    <ul class="footer__wrapper-items">
                        <li class="footer__wrapper-item"><a href="#" class="footer__wrapper-link">Контакты</a></li>
                        <li class="footer__wrapper-item"><a href="#" class="footer__wrapper-link">История заказов</a>
                        </li>
                    </ul>
                </div>
                <div class="footer__wrapper-menu">
                    <a href="/contacts/view" class="footer__wrapper-name">
                        Контакты
                    </a>
                    <ul class="footer__wrapper-items">
                        <li class="footer__wrapper-item"><a
                                href="https://yandex.ru/maps/org/apeks_soft/1023193342/?indoorLevel=1&ll=34.344219%2C53.243368&z=17.05"
                                class="footer__wrapper-link icon-adress">Россия, г. Брянск, переулок Осоавиахима, 3А ,
                                офис 603</a></li>
                        <li class="footer__wrapper-item"><a href="+74832320117"
                                class="footer__wrapper-link icon-phone">+74832320117"</a></li>
                        <li class="footer__wrapper-item"><a href="mailto:info@1capexsoft.ru"" class="
                                footer__wrapper-link icon-mail">Сервисы</a></li>
                    </ul>
                </div>
                <div class="footer__wrapper-menu">
                    <div class="footer__wrapper-name">
                        Стоимость услуг
                    </div>
                    <div class="footer__wrapper-price">
                        <p>Ознакомьтесь со стоимостью услуг</p>
                        <button class="footer__wrapper-button btn">Скачать прайс лист</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>