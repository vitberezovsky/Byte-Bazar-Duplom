<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ByteBazaar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css" />

    <style>
    .paragraph {
        line-height: 1.5;
    }
    </style>


</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Головна</a></li>
                <li><a href="shop.php">Магазин</a></li>
                <li><a class="active" href="about.php">Про нас</a></li>
                <li><a href="contact.php">Контакти</a></li>

                <?php

                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>Вхід</a></li>
            <li><a href='signup.php'>Реєстрація</a></li>
            ";
                } else {
                    echo "   <li><a href='profile.php'>Профіль</a></li>
          ";
                }
                ?>
                <li><a href="admin.php">Адміністратор</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>#ГраДоПереможногоКінця</h2>

        <p>Надання ігрових периферійних пристроїв преміум-класу</p>
    </section>

    <section id="about-head" class="section-p1">
        <img src="img/about/x2.jpg" alt="" />
        <div>
            <h2>Щодо нас?</h2>
            <p class="paragraph">
            ByteBazaar - це інтернет-магазин, який пропонує широкий асортимент високоякісної комп'ютерної техніки.
                Заснований
                у
                2010 року, ми прагнемо надати нашим клієнтам найкращий досвід покупок, з
                зручний веб-сайт і відмінну підтримку клієнтів. Купуйте у нас найновіші комп'ютерні компоненти,
                периферійні пристрої та аксесуари від провідних світових брендів.            </p>
            <br /><br />
            <marquee bgcolor="#ccc" loop="-1" scrollamount="5">Гра до переможного кінця</marquee>
        </div>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="" />
            <h6>Безкоштовна доставка</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="" />
            <h6>Онлайн замовлення</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="" />
            <h6>Заощаджуйте гроші</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="" />
            <h6>Акції</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="" />
            <h6>Щасливий продаж</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="" />
            <h6>Підтримка 24/7</h6>
        </div>
    </section>


    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" />
            <h4>Контакти</h4>
            <p>
                <strong>Адреса: </strong> вул. Леся Курбаса, 13, м. Тернопіль.

            </p>
            <p>
                <strong>Телефон: </strong> +380970556060
            </p>
            <p>
                <strong>Робочий час: </strong> 9:00-17:00
            </p>
        </div>

        <div class="col">
            <h4>Мій обліковий запис</h4>
            <a href="cart.php">Переглянути кошик</a>
            <a href="wishlist.php">Мій список бажань</a>
        </div>
        <div class="col install">
            <p>Платіжні системи</p>
            <img src="img/pay/pay.png" />
        </div>
        <div class="copyright">
            <p>2025. byteBazaar. Vitaly Berezovsky </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>