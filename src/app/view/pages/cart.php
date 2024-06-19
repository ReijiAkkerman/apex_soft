<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <div class="preloader" style="z-index: -1; opacity:0;">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <main>
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="/main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">Корзина</span>
                        </li>
                    </ul>
                </nav>
                <h1 class="page__title">Корзина</h1>
            </div>
        </div>
        <section class="basket">
            <div class="basket__container">
                <div class="left__column">
                    <div class="basket__labels">
                        <ul class="basket__items">
                            <li class="basket__item basket__item--name item item-heading">Товар</li>
                            <li class="basket__item basket__item--price price">Цена</li>
                            <li class="basket__item basket__item--quantity quantity">Количество</li>
                            <li class="basket__item basket__item--subtotal  subtotal">Итого</li>
                            <li class="basket__item basket__item--subtotal  subtotal">Выбрать</li>
                        </ul>
                    </div>
                    <form class="basket__wrapper Reiji_cart_form">
                        <?php $cost = 0 ?>
                        <?php $products = 0 ?>
                        <?php foreach ($GLOBALS['products'] as $product) { ?>
                            <?php if ($product->amount) { ?>
                                <?php $products += $product->amount ?>
                                <div class="basket__product">
                                    <div class="basket__product-description item">
                                        <div class="basket__picture">
                                            <img src="/images/<?= $product->imageName ?>?id=<?php echo rand(0, 400000000) ?>"
                                                alt="Placholder Image 2" class="basket__image">
                                        </div>
                                        <div class="basket__details">
                                            <p class="basket__details-text"><?= $product->name ?></p>
                                            <p class="basket__details-article">Артикул - <?= $product->articul ?></p>
                                        </div>
                                    </div>
                                    <div class="basket__product-price">
                                        <p>Цена товара:</p>
                                        <?= $product->price ?>
                                    </div>
                                    <div class="basket__product-quantity">
                                        <p>Количество:</p>
                                        <input type="number" value="<?= $product->amount ?>" step="1" min=0
                                            class="quantity-field Reiji_product_amount Reiji_id-<?= $product->ID ?>">
                                    </div>
                                    <div class="basket__product-wrapper">
                                        <p>Итого:</p>
                                        <span class="basket__product-subtotal Reiji_product_price"><?php $cost += $product->price * $product->amount;
                                        echo $product->price * $product->amount ?></span>
                                    </div>
                                    <span class="basket__product-name">Выбрать товар</span>
                                    <label class="basket__product-checkbox">
                                        <input class="basket__product-input Reiji_id-<?= $product->ID ?>" type="checkbox">
                                        <span class="basket__product-box"></span>
                                    </label>
                                    <button
                                        class="basket__product-remove btn Reiji_delete_product Reiji_id-<?= $product->ID ?>">Удалить
                                        товар</button>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </form>
                </div>
                <aside class="right__column">
                    <div class="summary">
                        <div class="summary-total-items">
                            <span class="total-items-text">Количество:</span>
                            <span class="total-items"><?= $products ?></span>
                        </div>
                        <div class="summary-subtotal">
                            <div class="subtotal-title">Итоговая цена:</div>
                            <div class="subtotal-value final-value Reiji_total_price" id="basket-subtotal"><?= $cost ?>
                            </div>
                        </div>
                        <button class="summary-buy btn" id="buy">Заказать</button>
                    </div>
                </aside>
            </div>
        </section>
    </main>
    <section class="basket__section">
        <form class="basket__section-form Reiji_order_form">
            <svg class="basket__section-close" width="64" version="1.1" xmlns="http://www.w3.org/2000/svg" height="64"
                viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
                <g>
                    <path fill="#1D1D1B"
                        d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                    </path>
                </g>
            </svg>
            <label for="">
                <span>Введите свое имя</span>
                <p class="form__error-text" id="recipient_name" style="display:none;"></p>
                <input type="text" class="basket__section-input" name="recipient_name" placeholder="Как обращаться?"
                    pattern="^[a-zA-Z0-9а-яА-Я ]{3,100}$">
            </label>
            <label for="">
                <span>Введите свою электронную почту</span>
                <p class="form__error-text" id="recipient_email" style="display:none;"></p>
                <input type="text" class="basket__section-input" name="recipient_email" placeholder="Электронная почта"
                    pattern="^[a-z][a-z0-9\-._]{1,99}@[a-z]{2,20}\.[a-z]{2,10}$">
            </label>
            <label for="">
                <span>Введите свой номер телефона</span>
                <p class="form__error-text" id="recipient_phone" style="display:none;"></p>
                <input type="text" value="+7" class="basket__section-input" name="recipient_phone"
                    placeholder="+70000000000" pattern="^\+[0-9]{1,3}[0-9]{10}$">
            </label>
            <p class="basket__section-title">Ваш заказ</p>
            <div class="basket__section-items">
            </div>
            <input type="hidden" name="products" class="Reiji_cart_hidden_field">
            <button class="basket__section-button" id="createOrder">Оформить заказ</button>
        </form>
    </section>
    <?php include_once __DIR__ . '/components/footer.php' ?>
    <script type="module" src="/src/js/Reiji/async/Cart.js"></script>
    <script type="module" src="/src/js/Reiji/async/Order.js"></script>
</body>

</html>