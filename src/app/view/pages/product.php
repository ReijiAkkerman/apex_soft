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
                <nav class="page__breadcrumbs breadcrumbs Reiji_place_for_buttons">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">Карточка товара</span>
                        </li>
                    </ul>
                </nav>
                <?php if ($this->admin && !isset($product->error_message)) { ?>
                    <div class="admin__buttons">
                        <button class="Reiji_admin-button admin__button btn" id="for_theme">Тема</button>
                        <button class="Reiji_admin-button admin__button btn" id="for_paragraph">Описание</button>
                        <button class="Reiji_admin-button admin__button btn" id="for_list">Список</button>
                    </div>
                <?php } ?>
                <h1 class="page__title cart__name" <?php if ($this->admin && !isset($product->error_message))
                    echo 'contenteditable="true"' ?> id="product_name"><?php
                if (isset($product))
                    if (isset($product->error_message))
                        echo $product->error_message;
                    else
                        echo $product->name;
                else
                    echo 'Название товара';
                ?></h1>
                <?php if (!isset($product->error_message)) { ?>
                    <h2 <?php if ($this->admin)
                        echo 'contenteditable="true"' ?> class="cart__category" id="product_type"><?php
                    if (isset($product))
                        if (isset($product->error_message))
                            ;
                        else
                            echo $product->type;
                    else
                        echo 'Тип товара';
                    ?></h2>
                <?php } ?>

            </div>
        </div>
        <div class="cart">
            <div class="cart__container">
                <div class="cart__wrapper">
                    <div class="cart__content">
                        <?php if (!isset($product->error_message)) { ?>
                            <div class="cart__content-picture" id="add_image">
                                <img src="/images/<?php
                                if (isset($product->imageName))
                                    echo $product->imageName;
                                else
                                    echo '0.png';
                                ?>" alt="" class="cart__content-image" id="image">
                            </div>
                        <?php } ?>
                        <?php if (!isset($product->error_message)) { ?>
                            <div class="cart__content-body" id="product_description" <?php if ($this->admin)
                                echo 'contenteditable="true"' ?>>
                                    <?php
                            if (isset($product))
                                if (isset($product->error_message))
                                    ;
                                else
                                    echo $product->description;
                            else {
                                ?>
                                    <h3>Введите текст</h3>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="card__content-inner">
                            <h4 id="product_price" contenteditable="true"></h4>
                            <p id="product_article" contenteditable="true"></p>
                        </div>
                        <?php if ($this->admin && !isset($product->error_message)) { ?>
                            <form id="admin_form" class="card__content-form" enctype="multipart/form-data">
                                <input type="text" name="product_name">
                                <input type="text" name="product_type">
                                <input type="text" name="product_description">
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" name="image">
                                <button class="action_<?php
                                if (isset($product->default_action))
                                    echo $product->default_action;
                                else
                                    echo 'create';
                                ?> Reiji_id-<?php if (isset($product->ID))
                                     echo $product->ID ?>" id="save-button">Сохранить</button>
                                <?php if (isset($product)) { ?>
                                    <button class="Reiji_id-<?= $product->ID ?> Reiji_delete-button"
                                        id="delete-button">Удалить</button>
                                <?php } ?>
                            </form>
                        <?php } ?>

                    </div>
                    <div class="cart__filter catalog__filter filter">
                        <div class="filter__item" data-filter="Коммерческие решения 1C">
                            <p class="filter__item-name">Коммерческие решения 1C</p>
                        </div>
                        <div class="filter__item" data-filter="Антивирусное программное обеспечение">
                            <p class="filter__item-name">Антивирусное программное обеспечение</p>
                        </div>
                        <div class="filter__item" data-filter="Отраслевые решения 1С">
                            <p class="filter__item-name">Отраслевые решения 1С</p>
                        </div>
                        <div class="filter__item" data-filter="Программы 1С для бюджетных учреждений">
                            <p class="filter__item-name">Программы 1С для бюджетных учреждений</p>
                        </div>
                        <div class="filter__item" data-filter="Торговое оборудование">
                            <p class="filter__item-name">Торговое оборудование</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    <script type="module" src="/src/js/Reiji/async/AdminForm.js"></script>
    <template class="Reiji_list">
        <ul class="some_class">
            <li>текст</li>
        </ul>
    </template>
    <template class="Reiji_list_item">
        <li class="some_class">текст</li>
    </template>
    <template class="Reiji_paragraph">
        <p class="some_class">Введите описание</p>
    </template>
    <template class="Reiji_theme">
        <h3 class="some_class">Введите тему</h3>
    </template>
    <template class="Reiji_admin-buttons">
        <button class="Reiji_admin-button" id="for_theme">Тема</button>
        <button class="Reiji_admin-button" id="for_paragraph">Описание</button>
        <button class="Reiji_admin-button" id="for_list">Список</button>
    </template>
    <template class="Reiji_admin-form">
        <form id="admin_form">
            <input type="text" name="product_name">
            <input type="text" name="product_type">
            <input type="text" name="product_description">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="image">
            <button id="save-button">Сохранить</button>
            <?php if (isset($product)) { ?>
                <button class="Reiji_id-<?= $product->ID ?> Reiji_delete-button" id="delete-button">Удалить</button>
            <?php } ?>
        </form>
    </template>
</body>

</html>