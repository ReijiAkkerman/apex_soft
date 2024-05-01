<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page">
        <div class="page__header">
            <div class="page__container">
                <h1 class="page__title">Каталог</h1>
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">Каталог</span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <section class="catalog">
            <div class="catalog__container">
                <div class="catalog__body">
                    <div class="catalog__filter filter">
                        <div class="filter__item">
                            <p class="filter__item-name">Программы</p>
                        </div>
                        <div class="filter__item">
                            <p class="filter__item-name">Услуги</p>
                        </div>
                        <div class="filter__item">
                            <p class="filter__item-name">Сервисы</p>
                        </div>
                    </div>
                    <div class="catalog__content">
                        <div class="catalog__control">
                            <div class="catalog__control-item">
                                <p>Сортировать по категориям</p>
                                <select data-menu>
                                    <option selected>Программы</option>
                                    <option>Услуги</option>
                                    <option>Сервисы</option>
                                </select>
                            </div>
                            <div class="catalog__control-item">
                                <p>Сортировать по:</p>
                                <select data-menu>
                                    <option selected>Названию</option>
                                    <option>Дате</option>
                                </select>
                            </div>
                            <div class="catalog__control-item">
                                    <button class="catalog__control-button">Добавить</button>
                            </div>
                        </div>
                        <div class="catalog__products">
                            <article class="product-card">
                                <div class="product-card__body">
                                    <div class="product-card__picture">
                                        <img src="/src/assets/img/image.jpg" alt="" class="product-card__image">
                                    </div>
                                    <h3 class="product-card__name"> 1С : Бухгалтерия 8 ПРОФ </h3>
                                </div>
                            </article>
                            <article class="product-card">
                                <div class="product-card__body">
                                    <div class="product-card__picture">
                                        <img src="/src/assets/img/image.jpg" alt="" class="product-card__image">
                                    </div>
                                    <h3 class="product-card__name"> 1С : Бухгалтерия 8 ПРОФ </h3>
                                </div>
                            </article>
                            <article class="product-card">
                                <div class="product-card__body">
                                    <div class="product-card__picture">
                                        <img src="/src/assets/img/image.jpg" alt="" class="product-card__image">
                                    </div>
                                    <h3 class="product-card__name"> 1С : Бухгалтерия 8 ПРОФ </h3>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="panel">
        <div class="panel__wrapper">
            <form action="" class="panel__wrapper-form">
                <p>Название продукта</p>
                <input type="text" name="title" class="panel__name">
                <p>Выберите фотографию</p>
                <input type="file" name="image" class="panel__input-image">
                <img src="" alt="Предпросмотр фотографии" class="panel__image-preview">
                <p>Название описание</p>
                <input type="text">
                <p>Описание</p>
                <textarea name="" id="" cols="30" rows="10" class="panel__description"></textarea>
                <div class="panel__buttons">
                    <button class="panel__button btn">Сохранить</button>
                </div>
            </form>
        </div>
    </section>
    <footer></footer>
</body>

</html>