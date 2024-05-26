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
                            <a href="/main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="/catalog/view" class="breadcrumbs__link">Каталог</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current"><?php
                            if (isset($product->name))
                                echo $product->name;
                            else
                                echo 'Новый товар';
                            ?></span>
                        </li>
                    </ul>
                </nav>
                <?php if ($this->admin) { ?>
                    <div class="admin__buttons">
                        <button class="Reiji_admin-button admin__button btn" id="for_theme">Тема</button>
                        <button class="Reiji_admin-button admin__button btn" id="for_paragraph">Описание</button>
                        <button class="Reiji_admin-button admin__button btn" id="for_list">Список</button>
                    </div>
                <?php } ?>
                <p id="error_product_name" style="display:none;"></p>
                <h1 class="page__title cart__name" <?php if ($this->admin)
                    echo 'contenteditable="true"' ?>
                        id="product_name"><?php
                if (isset($product))
                    echo $product->name;
                else
                    echo 'Название товара';
                ?></h1>
                <p id="error_product_type" style="display:none;"></p>
                <h2 <?php if ($this->admin)
                    echo 'contenteditable="true"' ?> class="cart__category" id="product_type"><?php
                if (isset($product))
                    echo $product->type;
                else
                    echo 'Тип товара';
                ?></h2>
            </div>
        </div>
        <div class="cart">
            <div class="cart__container">
                <div class="cart__wrapper">
                    <div class="cart__content">
                        <div class="cart__content-picture">
                            <p id="error_image"></p>
                            <div class="cart__content-images" id="add_image">
                                <img src="/images/<?php
                                if (isset($product->imageName))
                                    echo $product->imageName;
                                else
                                    echo '0.png';
                                ?>?id=<?php echo rand(0, 400000000) ?>" alt="" class="cart__content-image" id="image">
                            </div>
                            <div class="cart__content-price">
                                <p id="error_product_price" style="display:none;"></p>
                                <h4 class="cart__content-price-title Reiji_place_for_price">Цена:</h4>
                                <h4 class="cart__content-price-value" id="product_price" <?php if ($this->admin)
                                    echo 'contenteditable="true"' ?>><?php
                                if (isset($product->price))
                                    echo $product->price;
                                else
                                    echo '0';
                                ?></h4>
                            </div>
                            <div class="cart__content-articul">
                                <p id="error_product_articul" style="display:none;"></p>
                                <p class="Reiji_place_for_articul">Артикул:</p>
                                <p id="product_articul" <?php if ($this->admin)
                                    echo 'contenteditable="true"' ?>><?php
                                if (isset($product->articul))
                                    echo $product->articul;
                                else
                                    echo '0000000000';
                                ?></p>
                            </div>
                        </div>
                        <div class="cart__content-body" id="product_description" <?php if ($this->admin)
                            echo 'contenteditable="true"' ?>><?php
                        if (isset($product))
                            echo $product->description;
                        else
                            echo '<h3>Введите текст</h3>' ?>
                            </div>

                        <?php if ($this->admin) { ?>
                            <form id="admin_form" class="card__content-form" enctype="multipart/form-data">
                                <input type="text" name="product_name">
                                <input type="text" name="product_type">
                                <input type="text" name="product_description">
                                <input type="text" name="product_articul">
                                <input type="text" name="product_price">
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" name="image">
                                <button class="btn action_<?php
                                if (isset($product->default_action))
                                    echo $product->default_action;
                                else
                                    echo 'create';
                                ?> Reiji_id-<?php if (isset($product->ID))
                                     echo $product->ID ?> " id="save-button">Сохранить</button>
                                <?php if (isset($product)) { ?>
                                    <button class="btn Reiji_id-<?= $product->ID ?> Reiji_delete-button btn"
                                        id="delete-button">Удалить</button>
                                <?php } ?>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
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
            <input type="text" name="product_articul">
            <input type="text" name="product_price">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="image">
            <button id="save-button" class="btn">Сохранить</button>
            <?php if (isset($product)) { ?>
                <button class="Reiji_id-<?= $product->ID ?> Reiji_delete-button btn" id="delete-button">Удалить</button>
            <?php } ?>
        </form>
    </template>
</body>

</html>