<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page page--catalog">
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="/main/view" class="breadcrumbs__link">Главная</a>
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
                        <div class="filter__wrapper">
                            <div class="filter__item" data-category="Показать все">
                                <p class="filter__item-name">Показать все</p>
                            </div>
                            <div class="filter__item" data-category="Программы">
                                <p class="filter__item-name">Программы</p>
                            </div>
                            <div class="filter__item" data-category="Услуги">
                                <p class="filter__item-name">Услуги</p>
                            </div>
                            <div class="filter__item" data-category="Сервисы">
                                <p class="filter__item-name">Сервисы</p>
                            </div>
                        </div>
                        <div class="filter__item-price">
                            <p class="filter__item-name">Фильтровать по цене</p>
                            <form action="" class="filter__item-form">
                                <input class="filter__item-price-min" type="text" min="1000" max="999999"
                                    placeholder="1000">
                                <input class="filter__item-price-max" type="text" min="1000" max="999999"
                                    placeholder="999999">
                            </form>
                            <div class="filter__item-slider"></div>
                            <button class="filter__item-button btn">Показать</button>
                        </div>
                    </div>
                    <div class="catalog__content">
                        <div class="catalog__control">
                            <div class="catalog__control-item Reiji_place_for_add_button">
                                <p>Сортировать по категориям</p>
                                <div class="dropdown">
                                    <button class="dropdown__button">Выберите пункт</button>
                                    <ul class="dropdown__list">
                                        <li class="dropdown__item" data-category="Показать все">Показать все</li>
                                        <li class="dropdown__item" data-category="Программы">Программы</li>
                                        <li class="dropdown__item" data-category="Услуги">Услуги</li>
                                        <li class="dropdown__item" data-category="Сервисы">Сервисы</li>
                                    </ul>
                                </div>
                            </div>
                            <?php if ($this->admin) { ?>
                                <div class="catalog__control-item" id="add_button">
                                    <a href="/product/view?default_action=create"
                                        class="catalog__control-button btn">Добавить</a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="catalog__products">
                            <?php foreach ($GLOBALS['products'] as $product) { ?>
                                <article class="product-card Reiji_product Reiji_id-<?= $product->ID ?>"
                                    data-type="<?= $product->type ?>" data-price="<?= $product->price ?>">
                                    <?php if ($this->admin) { ?>
                                        <div class="product-card__checkmark Reiji_id-<?= $product->ID ?> Reiji_delete-button"
                                            id="delete-button">
                                            <svg class="product-card__icon" width="64" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" height="64" viewBox="0 0 64 64"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                                                <g>
                                                    <path fill="#013784"
                                                        d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>
                                    <?php } ?>
                                    <div class="product-card__body Reiji_cart_buttons-single__IP">
                                        <a class="product-card__picture"
                                            href="/product/view?default_action=update&id=<?= $product->ID ?>">
                                            <img src="/images/<?= $product->imageName ?>" alt=""
                                                class="product-card__image">
                                        </a>
                                        <a class="product-card__name"
                                            href="/product/view/?default_action=update&id=<?= $product->ID ?>">
                                            <h3><?= $product->name ?></h3>
                                        </a>
                                        <p class="product-card__price" data-price="<?= $product->price ?>">
                                            <?= $product->price ?></p>
                                        <p class="product-card__article Reiji_cart_buttons-multiple__IP">
                                            <?= $product->articul ?></p>
                                        <?php
                                        if (isset($this->login)) {
                                            ?>
                                            <div class="product-card__quantity Reiji_cart_buttons-multiple Reiji_cart_actions" <?php
                                            if ($product->amount)
                                                echo 'style="display:flex;"';
                                            else
                                                echo 'style="display:none;"';
                                            ?>>
                                                <div class="quantity__control Reiji_product_amount--sub" data-quantity="minus">-
                                                </div>
                                                <input
                                                    class="quantity__current Reiji_product_amount Reiji_id-<?= $product->ID ?>"
                                                    type="text" value="<?= $product->amount ?>"></input>
                                                <div class="quantity__control Reiji_product_amount--add" data-quantity="plus">+
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    if (isset($this->login)) {
                                        ?>
                                        <button
                                            class="product-card__add btn Reiji_product_amount-add Reiji_cart_buttons-single Reiji_cart_actions" <?php
                                            if ($product->amount)
                                                echo 'style="display:none;"';
                                            else
                                                echo 'style="display:block;"';
                                            ?>>Добавить</button>
                                    <?php } ?>
                                </article>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
    <script type="module" src="/src/js/Reiji/async/AdminForm.js"></script>
    <script type="module" src="/src/js/Reiji/async/Cart.js"></script>
    <template class="Reiji_add_button">
        <div class="catalog__control-item" id="add_button">
            <button class="catalog__control-button btn">
                <a href="/product/view">Добавить</a>
            </button>
        </div>
    </template>
    <template class="Reiji_cart_buttons multiple">
        <div class="product-card__quantity Reiji_cart_buttons-multiple Reiji_cart_actions" style="display:none;">
            <div class="quantity__control Reiji_product_amount--sub" data-quantity="minus">-</div>
            <input class="quantity__current Reiji_product_amount" type="text"></input>
            <div class="quantity__control Reiji_product_amount--add" data-quantity="plus">+</div>
        </div>
    </template>
    <template class="Reiji_cart_buttons single">
        <button class="product-card__add btn Reiji_product_amount-add Reiji_cart_buttons-single Reiji_cart_actions"
            style="display:none;">Добавить</button>
    </template>
</body>

</html>