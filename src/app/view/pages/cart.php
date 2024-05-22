<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main>
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
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
                            <li class="basket__item basket__item--subtotal  subtotal">Итоговая цена</li>
                            <li class="basket__item basket__item--subtotal  subtotal">Выбрать</li>
                        </ul>
                    </div>
                    <form action="" class="basket__wrapper">
                        <?php $cost = 0 ?>
                        <?php $products = 0 ?>
                        <?php foreach ($GLOBALS['products'] as $product) { ?>
                            <?php if ($product->amount) { ?>
                                <?php $products += $product->amount ?>
                                <div class="basket__product">
                                    <div class="basket__product-description item">
                                        <div class="basket__picture">
                                            <img src="/images/<?= $product->imageName ?>" alt="Placholder Image 2"
                                                class="basket__image">
                                        </div>
                                        <div class="basket__details">
                                            <p class="basket__details-text"><?= $product->name ?></p>
                                            <p class="basket__details-article">Артикул - <?= $product->articul ?></p>
                                        </div>
                                    </div>
                                    <div class="basket__product-price"><?= $product->price ?></div>
                                    <div class="basket__product-quantity">
                                        <input type="number" value="<?= $product->amount ?>" step="1"
                                            class="quantity-field Reiji_product_amount Reiji_id-<?= $product->ID ?>">
                                    </div>
                                    <div class="basket__product-wrapper">
                                        <span class="basket__product-subtotal Reiji_product_price"><?php $cost += $product->price * $product->amount;
                                        echo $product->price * $product->amount ?></span>
                                    </div>
                                    <label class="basket__product-checkbox">
                                        <input class="basket__product-input" type="checkbox">
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
                            <span class="total-items"><?= $products ?></span>
                            <span class="total-items-text">товара в вашей корзине</span>
                        </div>
                        <div class="summary-subtotal">
                            <div class="subtotal-title">Итоговая цена</div>
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
        <form class="basket__section-form">
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
                <input type="text" class="basket__section-input" name="fullname" placeholder="Как обращаться?">
            </label>
            <label for="">
                <span>Введите свою электронную почту</span>
                <input type="text" class="basket__section-input" name="email" placeholder="Электронная почта">
            </label>
            <label for="">
                <span>Введите свой номер телефона</span>
                <input type="text" class="basket__section-input" name="phone_number" placeholder="Номер телефона">
            </label>
            <div class="basket__section-items">
                <!-- <div class="basket__section-item">
                    <div class="basket__section-picture">
                        <img src="/images/1.jpeg" alt="" class="basket__section-image">
                    </div>
                    <div class="basket__section-description">
                        <p class="basket__section-name">1C битрикс</p>
                        <p class="basket__section-articul">Артикул - 12312312312</p>
                    </div>
                </div>
                <div class="basket__section-item">
                    <div class="basket__section-picture">
                        <img src="/images/0.png" alt="" class="basket__section-image">
                    </div>
                    <div class="basket__section-description">
                        <p class="basket__section-name">
                            Название товара-09988123</p>
                        <p class="basket__section-articul">Артикул - 0000000000</p>
                    </div>
                </div> -->
            </div>
            <a href="/order/view" class="basket__section-button">Оформить заказ</a>
        </form>
    </section>
    <?php include_once __DIR__ . '/components/footer.php' ?>
    <script type="module" src="/src/js/Reiji/async/Cart.js"></script>
</body>

</html>