<?php
session_start();
include("include/connect.php");

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == "admin1") {

    $query = "select * from accounts where username='$username' and password='$password'";
    $result = mysqli_query($con, $query);


    if (mysqli_num_rows($result) > 0) {
      echo "<script> window.open('inventory.php', '_blank') </script>";


    } else {
      echo "<script> alert('Неправильні дані') </script>";
    }

  } else {
    echo "<script> alert('Неправильні дані') </script>";
  }
}

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
                <li><a class="active" href="admin.php">Адміністратор</a></li>
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


    <form method="post" id="form">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="user" name="username" type="text" placeholder="Ім'я користувача *">
        <input class="input1" id="pass" name="password" type="password" placeholder="Пароль *">
        <button type="submit" class="btn" name="submit">Вхід</button>

    </form>


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