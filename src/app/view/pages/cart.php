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
                    <?php foreach($GLOBALS['products'] as $product) { ?>
                    <div class="basket__product">
                        <div class="basket__product-description item">
                            <div class="basket__picture">
                                <img src="../src/assets/img/cart.jpg" alt="Placholder Image 2" class="basket__image">
                            </div>
                            <div class="basket__details">
                                <p class="basket__details-text"><span class="basket__details-quantity"></span> x 1С :
                                    Бухгалтерия 8 ПРОФ</p>
                                <p class="basket__details-article">Артикул - 232321939</p>
                            </div>
                        </div>
                        <div class="basket__product-price">2600</div>
                        <form class="basket__product-quantity">
                            <input type="number" value="" min="1" step="1" class="quantity-field">
                        </form>
                        <div class="basket__product-wrapper">
                            <span class="basket__product-subtotal">2600</span>
                            <button class="basket__product-remove btn">Удалить товар</button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <aside class="right__column">
                    <div class="summary">
                        <div class="summary-total-items"><span class="total-items"></span> <span
                                class="total-items-text">товара в вашей корзине</span></div>
                        <div class="summary-subtotal">
                            <div class="subtotal-title">Итоговая цена</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"></div>
                        </div>
                        <button class="summary-buy">Купить</button>
                    </div>
                </aside>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>