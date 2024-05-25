<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page page--order">
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">История заказов</span>
                        </li>
                    </ul>
                </nav>
                <h1 class="page__title">История заказов</h1>
            </div>
        </div>
        <section class="order">
            <div class="order__container">
                <form action="" class="order__item">
                    <div class="order__item-panel">
                        <div class="order__item-control">
                            <span class="icon-cheveron-down"></span>
                            <p class="order__item-order">Заказ Г-11379069</p>
                            <p class="order__item-date">от 21.05.2024</p>
                            <p class="order__item-status">Оформлен</p>
                            <button class="btn order__item-button">Удалить заказ</button>

                        </div>
                        <div class="order__item-action">
                            <div class="order__item-action-block">
                                <p class="order__item-user-text">Имя получателя:</p>
                                <p class="order__item-user-name">Bebebab123</p>
                            </div>
                            <div class="order__item-phone">
                                <p class="order__item-phone-text">Телефон получателя:</p>
                                <p class="order__item-phone-user">+7 930 824-45-80
                                </p>
                            </div>
                            <p class="order__item-action-price">Стоимость: <span
                                    class="order__item-price-total">300</span>
                            </p>
                        </div>
                    </div>
                    <div class="order__item-body">
                        <div class="order__item-products">
                            <div class="order__item-product">
                                <div class="order__item-picture">
                                    <img src="/images/0.png" alt="" class="order__item-image">
                                </div>
                                <div class="order__item-description">
                                    <p class="order__item-name">Карта памяти Smartbuy microSDHC 16 ГБ
                                        [SB16GBSDCL10-01]
                                    </p>
                                    <p class="order__item-articul">Артикул: 1325186</p>
                                </div>
                                <div class="order__item-block">
                                    <p class="order__item-block-price">Цена: <span
                                            class="order__item-price-product">299</span>
                                    </p>
                                    <div class="order__item-block-count">
                                        <div
                                            class="order__item-quantity Reiji_cart_buttons-multiple Reiji_cart_actions">
                                            <div class="quantity__control Reiji_product_amount--sub"
                                                data-quantity="minus">-</div>
                                            <input class="quantity__current Reiji_product_amount" type="text">
                                            <div class="quantity__control Reiji_product_amount--add"
                                                data-quantity="plus">+</div>
                                        </div>
                                        x
                                        <span class="order__item-price-count">299</span>
                                    </div>
                                    <button class="order__item-remove btn">Удалить товар</button>
                                </div>
                            </div>
                            <div class="order__item-product">
                                <div class="order__item-picture">
                                    <img src="/images/0.png" alt="" class="order__item-image">
                                </div>
                                <div class="order__item-description">
                                    <p class="order__item-name">Карта памяти Smartbuy microSDHC 16 ГБ
                                        [SB16GBSDCL10-01]
                                    </p>
                                    <p class="order__item-articul">Артикул: 1325186</p>
                                </div>
                                <div class="order__item-block">
                                    <p class="order__item-block-price">Цена: <span
                                            class="order__item-price-product">299</span>
                                    </p>
                                    <div class="order__item-block-count">
                                        <div
                                            class="order__item-quantity Reiji_cart_buttons-multiple Reiji_cart_actions">
                                            <div class="quantity__control Reiji_product_amount--sub"
                                                data-quantity="minus">-</div>
                                            <input class="quantity__current Reiji_product_amount" type="text">
                                            <div class="quantity__control Reiji_product_amount--add"
                                                data-quantity="plus">+</div>
                                        </div>
                                        x
                                        <span class="order__item-price-count">299</span>
                                    </div>
                                    <button class="order__item-remove btn">Удалить товар</button>
                                </div>
                            </div>
                            <div class="order__item-product">
                                <div class="order__item-picture">
                                    <img src="/images/0.png" alt="" class="order__item-image">
                                </div>
                                <div class="order__item-description">
                                    <p class="order__item-name">Карта памяти Smartbuy microSDHC 16 ГБ
                                        [SB16GBSDCL10-01]
                                    </p>
                                    <p class="order__item-articul">Артикул: 1325186</p>
                                </div>
                                <div class="order__item-block">
                                    <p class="order__item-block-price">Цена: <span
                                            class="order__item-price-product">299</span>
                                    </p>
                                    <div class="order__item-block-count">
                                        <div
                                            class="order__item-quantity Reiji_cart_buttons-multiple Reiji_cart_actions">
                                            <div class="quantity__control Reiji_product_amount--sub"
                                                data-quantity="minus">-</div>
                                            <input class="quantity__current Reiji_product_amount" type="text">
                                            <div class="quantity__control Reiji_product_amount--add"
                                                data-quantity="plus">+</div>
                                        </div>
                                        x
                                        <span class="order__item-price-count">299</span>
                                    </div>
                                    <button class="order__item-remove btn">Удалить товар</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
</body>

</html>