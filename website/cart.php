<?php
session_start();

if ($_SESSION['aid'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $aid = $_SESSION['aid'];
    $pid = $_GET['re'];
    $query = "DELETE FROM CART WHERE aid = $aid and pid = $pid";

    $result = mysqli_query($con, $query);
    header("Location: cart.php");
    exit();
}

if (isset($_POST['check'])) {
    include("include/connect.php");

    $aid = $_SESSION['aid'];

    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

    $result = mysqli_query($con, $query);

    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result2);

    if (empty($row2['pid'])) {
        header("Location: shop.php");
        exit();
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['pid'];
        $pname = $row['pname'];
        $desc = $row['description'];
        $qty = $row['qtyavail'];
        $price = $row['price'];
        $cat = $row['category'];
        $img = $row['img'];
        $brand = $row['brand'];
        $cqty = $row['cqty'];
        $a = $price * $cqty;

        $newqty = $_POST["$pid-qt"];

        $query = "UPDATE CART SET cqty = $newqty where aid = $aid and pid = $pid";

        mysqli_query($con, $query);


    }
    header("Location: checkout.php");
    exit();
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

<body onload="totala()">
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
                <li><a href="admin.php">Адміністратор</a></li>
                <li id="lg-bag">
                    <a class="active" href="cart.php"><i class="far fa-shopping-bag"></i></a>
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


    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Видалити</td>
                    <td>Зображення</td>
                    <td>Товар</td>
                    <td>Вартість</td>
                    <td>Кількість</td>
                    <td>Підсумок</td>
                </tr>
            </thead>
            <tbody>

                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                $result = mysqli_query($con, $query);


                while ($row = mysqli_fetch_assoc($result)) {
                    $pid = $row['pid'];
                    $pname = $row['pname'];
                    $desc = $row['description'];
                    $qty = $row['qtyavail'];
                    $price = $row['price'];
                    $cat = $row['category'];
                    $img = $row['img'];
                    $brand = $row['brand'];
                    $cqty = $row['cqty'];
                    $a = $price * $cqty;
                    echo "

            <tr>
              <td>
                <a href='cart.php?re=$pid'><i class='far fa-times-circle'></i></a>
              </td>
              <td><img src='product_images/$img' alt='' /></td>
              <td>$pname</td>
              <td class='pr'>₴$price</td>
              <td><input type='number' class = 'aqt' value='$cqty' min = '1' max = '$qty' onchange='subprice()' /></td>
              <td class = 'atd'>₴$a</td>
            </tr>
            ";
                }
                ?>

            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">

        </div>
        <div id="subtotal">
            <h3>Всього в кошику</h3>
            <table>
                <tr>
                    <td>Підсумок кошика</td>
                    <td id='tot1' onload="totala()">₴</td>
                </tr>
                <tr>
                    <td>Доставка</td>
                    <td>Безкоштовно</td>
                </tr>
                <tr>
                    <td><strong>Всього</strong></td>
                    <td id='tot' onload="totala()"><strong>₴</strong></td>
                </tr>
            </table>

            <form method="post">
                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                $result = mysqli_query($con, $query);


                while ($row = mysqli_fetch_assoc($result)) {
                    $pid = $row['pid'];
                    $pname = $row['pname'];
                    $desc = $row['description'];
                    $qty = $row['qtyavail'];
                    $price = $row['price'];
                    $cat = $row['category'];
                    $img = $row['img'];
                    $brand = $row['brand'];
                    $cqty = $row['cqty'];
                    $a = $price * $cqty;
                    echo "

              <input style='display: none;' name='$pid-p' class='inp' type = 'number' value = '$pid'/>
              <input style='display: none;' name='$pid-qt' class='inq' type = 'number' value = '$cqty'/>
              ";
                }
                ?>
                <button class="normal" name="check">Перейдіть до оформлення замовлення</button>
            </form>
            </a>
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
function subprice() {
    var qty = document.getElementsByClassName("aqt");
    var sub = document.getElementsByClassName("atd");
    var pri = document.getElementsByClassName("pr");
    var upd = document.getElementsByClassName("inq");

    for (var i = 0; i < qty.length; i++) {
        var quantity = parseInt(qty[i].value);
        var price = parseFloat(pri[i].innerText.replace('₴', ''));
        sub[i].innerHTML = `₴${quantity * price}`;
        upd[i].value = parseInt(qty[i].value);
    }

    totala();
}

function totala() {
    var pri = document.getElementsByClassName("atd");
    let yes = 0;
    for (var i = 0; i < pri.length; i++) {
        yes = yes + parseFloat(pri[i].innerText.replace('₴', ''));
    }


    document.getElementById('tot').innerHTML = '₴' + yes;
    document.getElementById('tot1').innerHTML = '₴' + yes;
}
</script>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>