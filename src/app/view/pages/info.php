<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once __DIR__ . '/components/head.php' ?>
    <title>Апекс - Софт</title>
</head>

<body>
    <?php require_once __DIR__ . '/components/header.php' ?>
    <main class="page page--info">
        <div class="page__header">
            <div class="page__container">
                <nav class="page__breadcrumbs breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="../main/view" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__current">Статьи</span>
                        </li>
                    </ul>
                </nav>
                <h1 class="page__title">Статьи</h1>
            </div>
        </div>
        <div class="page__container">
            <section class="article">
                <div class="article__wrapper">
                    <div class="article__wrapper-picture">
                        <img src="" alt="" class="article__wrapper-image">
                    </div>
                    <div class="article__wrapper-description">
                        <p class="article__wrapper-text"></p>
                    </div>
                </div>
            </section>

        </div>
    </main>
    <?php include_once __DIR__ . '/components/footer.php' ?>
</body>

</html>