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

</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Головна</a></li>
                <li><a href="shop.php">Магазин</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a class="active" href="contact.php">Контакти</a></li>

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

        <p>Забезпечення преміального ігрового досвіду</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>ЗВ'ЯЗАТИСЯ З НАМИ</span>
            <h2>Завітайте до одного з наших агентств або зв'яжіться з нами вже сьогодні</h2>
            <h3>Головний офіс</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>вул. Леся Курбаса, 13, м. Тернопіль.</p>
                </li>
                <li>
                    <i class="fal fa-envelope"></i>
                    <p>bytebzr@gmail.com</p>
                </li>
                <li>
                    <i class="fal fa-phone-alt"></i>
                    <p>+380970556060</p>
                </li>
                <li>
                    <i class="fal fa-clock"></i>
                    <p>З понеділка по п'ятницю: 9:00-17:00</p>

                </li>
            </div>
        </div>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1293.6397778955934!2d25.642460706399923!3d49.5736154441572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47303162a63761ab%3A0xe42c067aa6eb73cb!2sTekhnichnyy%20Koledzh%20Tntu%20Im.%20I.%20Pulyuya!5e0!3m2!1sen!2sua!4v1740473792003!5m2!1sen!2sua"
                width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <div class="people">
            <div>
                <img src="img/people/a.jpeg" alt="" />
                <p>
                    <span>Vitaly Berezovsky</span> Founder and CEO <br />
                    Phone: +03120100830 <br />
                    Email:VitalyB@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/b.jpeg" alt="" />
                <p>
                    <span>Nazariy Holodiuk</span> Executive Marketing Manager <br />
                    Phone: +03000101230 <br />
                    Email:NazariyH@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/c.jpeg" alt="" />
                <p>
                    <span>Volodymyr Obud</span> Customer Service Officer <br />
                    Phone: +03400190835 <br />
                    Email:VolodymyrO@gmail.com
                </p>
            </div>
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