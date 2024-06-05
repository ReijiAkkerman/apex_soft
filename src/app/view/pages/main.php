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
                                <a class="hero__swiper-button btn" href="/catalog/view" style="text-decoration:none;">Перейти в каталог</a>
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
                                <a class="hero__swiper-button btn" href="/catalog/view" style="text-decoration:none;">Перейти в каталог</a>
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
                                <a class="hero__swiper-button btn" href="/catalog/view" style="text-decoration:none;">Перейти в каталог</a>
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
                                <a class="hero__swiper-button btn" href="/catalog/view">Перейти в каталог</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
</body>

</html>