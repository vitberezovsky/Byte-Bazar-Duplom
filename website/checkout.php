<?php
session_start();

if (isset($_POST['sub'])) {
    include("include/connect.php");

    $aid = $_SESSION['aid'];
    $add = $_POST['houseadd'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $acc = $_POST['acc'];
    $query = "";

    if (empty($acc)) {
        $query = "insert into `orders` (dateod, datedel, aid, address, city, country, account, total) values(CURDATE(), NULL, '$aid', '$add', '$city', '$country', NULL, 0)";
    } else {
        if (preg_match('/\D/', $acc) || strlen($acc) != 16) {
            echo "<script> alert('невірний номер рахунку'); setTimeout(function(){ window.location.href = 'checkout.php'; }, 100); </script>";
            exit();
        }

        $query = "insert into `orders` (dateod, datedel, aid, address, city, country, account, total) values(CURDATE(), NULL, '$aid', '$add', '$city', '$country', '$acc', 0)";
    }
    $result = mysqli_query($con, $query);

    $oid = mysqli_insert_id($con);

    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

    $result = mysqli_query($con, $query);
    global $tott;
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
        $tott = $price * $cqty;

        $query = "insert into `order-details` (oid, pid, qty) values ($oid, $pid, $cqty)";

        mysqli_query($con, $query);

        $query = "update products set qtyavail = qtyavail - $cqty where pid = $pid";

        mysqli_query($con, $query);
    }

    $query = "delete from cart where aid = $aid";

    mysqli_query($con, $query);

    $query = "update orders set total = $tott where oid = $oid";

    mysqli_query($con, $query);


    header("Location: profile.php");
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

    <style>
        #account-field {
            display: block;
        }

        .hidden {
            display: none;
        }
        .input11 {
  display: block;
  width: 80%;
  margin: 40px auto;
  padding: 10px 5px;
  border: none;
  border-bottom: 0.01rem dimgray solid;
  outline: none;
}

.table12 {
  margin: 0;
  padding: 0;
  width: 100%;
  overflow: auto;
}

.table12 tr{
    width: 100%;
  overflow: auto;

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

    <div class="container">
        <div class="titlecheck">
            <h2>Форма замовлення товару</h2>
        </div>
        <div class="d-flex">
            <form method="post" id="form1">

                <h3 style="color: darkred; margin: auto"></h3>
                <input class="input11" type="text" name="houseadd" placeholder="Адреса" required>
                <input class="input11" type="text" name="city" placeholder="Місто" required>
                <input class="input11" type="text" name="country" placeholder="Країна/Область" required>
                <input class="input11" id="account-field" type="text" name="acc" placeholder="Номер рахунку">
                <div>
                    <input class="input2" type="radio" id="ac1" name="dbt" value="cod" onchange="showInputBox()"> Готівка
                    після доставки
                </div>
                <div>
                    <input class="input2" type="radio" id="ac2" name="dbt" value="bank" checked
                        onchange="showInputBox()"> Paypal/Visa/MasterCard <span>
                        <img src="img/pay/pay.png" alt="">
                    </span>
                </div>
                <button name="sub" type="submit" class="btn112">Оформити замовлення</button>
            </form>
            <div class="Yorder">
                <table class="table12">
                    <tr class='tr1'>
                        <th class='th1' colspan='2'>Ваше замовлення</th>
                    </tr>

                    <?php
                    include("include/connect.php");

                    $aid = $_SESSION['aid'];

                    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                    $result = mysqli_query($con, $query);

                    global $tot;

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
                        $tot = $tot + $a;

                        echo "
            
            <tr class='tr1'>
              <td class='td1'>$pname x $cqty(Qty)</td>
              <td class='td1'>$a</td>
            </tr>

              ";
                    }
                    echo "
            <tr class='tr1'>
            <td class='td1'>Підсумок</td>
            <td class='td1'>₴$tot.00</td>
          </tr>
          <tr class='tr1'>
            <td class='td1'>Доставка</td>
            <td class='td1'>Безкоштовна доставка</td>
          </tr>";
                    ?>


                </table><br>
            </div><!-- Yorder -->
        </div>
    </div>

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
    function showInputBox() {
        var select = document.querySelector('#ac1');
        var inputBox = document.getElementById("account-field");
        if (!select.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
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