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
                <div class="order__status">
                    <p class="order__status-title">Сортировать по статусу</p>
                    <div class="order__status-items">
                        <div class="order__status-item">
                            <p class="order__status-name">Изменён</p>
                            <label class="basket__product-checkbox" data-sort="Изменён">
                                <input class="basket__product-input" type="checkbox">
                                <span class="basket__product-box"></span>
                            </label>
                        </div>
                        <div class="order__status-item">
                            <p class="order__status-name">Оформлен</p>
                            <label class="basket__product-checkbox" data-sort="Оформлен">
                                <input class="basket__product-input" type="checkbox">
                                <span class="basket__product-box"></span>
                            </label>
                        </div>
                        <div class="order__status-item">
                            <p class="order__status-name">Отменён</p>
                            <label class="basket__product-checkbox" data-sort="Отменён">
                                <input class="basket__product-input" type="checkbox">
                                <span class="basket__product-box"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <?php foreach ($GLOBALS['orders'] as $order) { ?>
                    <form action="" class="order__item" id="order_id-<?= $order->order_ID ?>"
                        data-status="<?= $order->order_status ?>">
                        <div class="order__item-panel">
                            <div class="order__item-control">
                                <span class="icon-cheveron-down"></span>
                                <p class="order__item-order">Заказ №<?= $order->order_ID ?></p>
                                <p class="order__item-date">от <?= $order->order_time ?></p>
                                <p class="order__item-status Reiji_order_status"><?= $order->order_status ?></p>
                                <?php if ($order->order_status != 'Отменён') { ?>
                                    <button
                                        class="btn order__item-button Reiji_cancel_order Reiji_order_id-<?= $order->order_ID ?>">Отменить
                                        заказ</button>
                                <?php } ?>
                            </div>
                            <div class="order__item-action">
                                <div class="order__item-action-block">
                                    <p class="order__item-user-text">Имя получателя:</p>
                                    <p class="order__item-user-name"><?= $order->recipient_name ?></p>
                                </div>
                                <div class="order__item-phone">
                                    <p class="order__item-phone-text">Телефон получателя:</p>
                                    <p class="order__item-phone-user"><?= $order->recipient_phone ?>
                                    </p>
                                </div>
                                <p class="order__item-action-price">Стоимость: <span
                                        class="order__item-price-total">300</span>
                                </p>
                            </div>
                        </div>
                        <div class="order__item-body">
                            <div class="order__item-products">
                                <?php foreach ($GLOBALS['products'][$order->order_ID] as $product) { ?>
                                    <div class="order__item-product">
                                        <div class="order__item-picture">
                                            <img src="/images/<?= $product->imageName ?>?id=<?php echo rand(0, 400000000) ?>" alt="" class="order__item-image">
                                        </div>
                                        <div class="order__item-description">
                                            <p class="order__item-name"><?= $product->name ?></p>
                                            <p class="order__item-articul">Артикул: <?= $product->articul ?></p>
                                        </div>
                                        <div class="order__item-block">
                                            <p class="order__item-block-price">Цена: <span
                                                    class="order__item-price-product">299</span>
                                            </p>
                                            <div class="order__item-block-count <?php if ($order->order_status == 'Отменён')
                                                echo 'remove' ?>">
                                                    <div
                                                        class="order__item-quantity Reiji_cart_buttons-multiple Reiji_cart_actions">
                                                    <?php if ($order->order_status != 'Отменён') { ?>
                                                        <div class="quantity__control Reiji_product_amount--sub Reiji_product_id-<?= $product->ID ?> Reiji_order_id-<?= $order->order_ID ?>"
                                                            data-quantity="minus">-</div>
                                                    <?php } ?>
                                                    <input class="quantity__current Reiji_order_id-<?= $order->order_ID ?> Reiji_product_id-<?= $product->ID ?> Reiji_product_amount<?php if ($order->order_status == 'Отменён')
                                                              echo '--inactive' ?>" type="text"
                                                            value="<?= $product->amount ?>" min="1" <?php if ($order->order_status == 'Отменён')
                                                                  echo 'readonly' ?>>
                                                    <?php if ($order->order_status != 'Отменён') { ?>
                                                        <div class="quantity__control Reiji_product_amount--add Reiji_product_id-<?= $product->ID ?> Reiji_order_id-<?= $order->order_ID ?>"
                                                            data-quantity="plus">+</div>
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <pre>x </pre>
                                                    <span class="order__item-price-count"><?= $product->price ?></span>
                                                </div>
                                            </div>
                                            <?php if ($order->order_status != 'Отменён') { ?>
                                                <button
                                                    class="order__item-remove Reiji_delete_product Reiji_product_id-<?= $product->ID ?> Reiji_order_id-<?= $order->order_ID ?> btn">Удалить
                                                    товар</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </section>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
    <script type="module" src="/src/js/Reiji/async/Order.js"></script>
</body>

</html>