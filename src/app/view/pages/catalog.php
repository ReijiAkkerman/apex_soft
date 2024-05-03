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
                <h1 class="page__title">Каталог</h1>
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
                                <div class="product-card__checkmark">
                                    <svg class="product-card__icon" width="64" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" height="64" viewBox="0 0 64 64"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                                        <g>
                                            <path fill="#1D1D1B"
                                                d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="product-card__body">
                                    <div class="product-card__picture">
                                        <img src="/src/assets/img/image.jpg" alt="" class="product-card__image">
                                    </div>
                                    <h3 class="product-card__name"> 1С : Бухгалтерия 8 ПРОФ </h3>
                                </div>
                            </article>
                            <article class="product-card">
                                <div class="product-card__checkmark">
                                    <svg class="product-card__icon" width="64" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" height="64" viewBox="0 0 64 64"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                                        <g>
                                            <path fill="#1D1D1B"
                                                d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="product-card__body">
                                    <div class="product-card__picture">
                                        <img src="/src/assets/img/image.jpg" alt="" class="product-card__image">
                                    </div>
                                    <h3 class="product-card__name"> 1С : Бухгалтерия 8 ПРОФ </h3>
                                </div>
                            </article>
                            <article class="product-card">
                                <div class="product-card__checkmark">
                                    <svg class="product-card__icon" width="64" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" height="64" viewBox="0 0 64 64"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                                        <g>
                                            <path fill="#1D1D1B"
                                                d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
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
    <section class="panel__wrapper">
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
        <div class="panel__wrapper">
        </div>
    </section>
    <footer></footer>
</body>

</html>