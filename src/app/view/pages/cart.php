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
                        </ul>
                    </div>
                    <?php $cost = 0 ?>
                    <?php $products = 0 ?>
                    <?php foreach($GLOBALS['products'] as $product) { ?>
                    <?php $products += $product->amount ?>
                    <div class="basket__product">
                        <div class="basket__product-description item">
                            <div class="basket__picture">
                                <img src="/images/<?= $product->imageName ?>" alt="Placholder Image 2" class="basket__image">
                            </div>
                            <div class="basket__details">
                                <p class="basket__details-text"><?= $product->name ?></p>
                                <p class="basket__details-article">Артикул - <?= $product->articul ?></p>
                            </div>
                        </div>
                        <div class="basket__product-price"><?= $product->price ?></div>
                        <form class="basket__product-quantity">
                            <input type="number" value="<?= $product->amount ?>" step="1" class="quantity-field Reiji_product_amount Reiji_id-<?= $product->ID ?>">
                        </form>
                        <div class="basket__product-wrapper">
                            <span class="basket__product-subtotal Reiji_product_price"><?php $cost += $product->price * $product->amount; echo $product->price * $product->amount ?></span>
                            <button class="basket__product-remove btn Reiji_delete_product Reiji_id-<?= $product->ID ?>">Удалить товар</button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <aside class="right__column">
                    <div class="summary">
                        <div class="summary-total-items">
                            <span class="total-items"><?= $products ?></span>
                            <span class="total-items-text">товара в вашей корзине</span>
                        </div>
                        <div class="summary-subtotal">
                            <div class="subtotal-title">Итоговая цена</div>
                            <div class="subtotal-value final-value Reiji_total_price" id="basket-subtotal"><?= $cost ?></div>
                        </div>
                        <button class="summary-buy" id="buy">Купить</button>
                    </div>
                </aside>
            </div>
        </section>
    </main>
    <footer></footer>
    <script type="module" src="/src/js/Reiji/async/Cart.js"></script>
</body>

</html>