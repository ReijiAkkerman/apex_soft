<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <link rel="stylesheet" href="/src/css/Reiji/style.css">
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page page--cart">
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">Карточка товара</span>
                        </li>
                    </ul>
                </nav>
                <button id="for_theme">Тема</button>
                <button id="for_paragraph">Описание</button>
                <button id="for_list">Список</button>
                <h1 class="page__title" contenteditable="true" id="product_name">Название товара</h1>
                <h2 contenteditable="true" id="product_type">Тип товара</h2>
            </div>
        </div>
        <div class="cart">
            <div class="cart__container">
                <div class="cart__wrapper">
                    <div class="cart__content">
                        <div class="cart__content-picture" id="add_image">
                            <img src="/src/assets/img/cart.jpg" alt="" class="cart__content-image">
                        </div>
                        <div class="cart__content-body" id="product_description" contenteditable="true">
                            <h3>Введите текст</h3>
                        </div>
                        <form id="admin_form">
                            <input type="text" name="product_name">
                            <input type="text" name="product_type">
                            <input type="text" name="product_description">
                            <input type="file" name="image">
                            <button id="save-button">Сохранить</button>
                        </form>
                    </div>
                    <div class="cart__filter catalog__filter filter">
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
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    <script type="module" src="/src/js/Reiji/async/AdminForm.js"></script>
    <template class="Reiji_list">
        <ul>
            <li>текст</li>
        </ul>
    </template>
    <template class="Reiji_list_item">
        <li>текст</li>
    </template>
    <template class="Reiji_paragraph">
        <p>Введите описание</p>
    </template>
    <template class="Reiji_theme">
        <h3>Введите тему</h3>
    </template>
</body>

</html>