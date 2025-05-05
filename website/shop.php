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
    .search-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        background: #e3e6f3;
        padding: 10px;
    }

    #category-filter {
        padding: 6px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
    }

    #search {
        padding: 6px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
    }

    #search-btn {
        outline: none;
        border: none;
        padding: 10px 30px;
        background-color: navy;
        color: white;
        border-radius: 1rem;
        cursor: pointer;
    }
    </style>

 
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Головна</a></li>
                <li><a class="active" href="shop.php">Магазин</a></li>
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

    <section id="page-header">
        <h2>Преміум Iгри</h2>

        <p>Заощаджуйте більше з купонами та знижками до 70%!</p>
    </section>

    <div class="search-container">
        <form id="search-form" method="post">
            <label for="search">Пошук:</label>
            <input type="text" id="search" name="search">
            <label for="category-filter">Категорія:</label>
            <select id="category-filter" name="cat">
                <option value="all">Всі</option>
                <option value="keyboard">Клавіатура</option>
                <option value="motherboard">Материнська плата</option>
                <option value="mouse">Мишка</option>
                <option value="cpu">Процесор</option>
                <option value="gpu">Графічний процесор</option>
                <option value="ram">Оперативна пам'ять</option>
            </select>
            <button type="submit" id="search-btn" name="search1">Пошук</button>
        </form>
    </div>

    <?php
    include("include/connect.php");
    if (isset($_POST['search1'])) {
        $search = $_POST['search'];
        $category = $_POST['cat'];
        $query = "";
        if (!empty($search))
            $query = "select* from `products` where ((pname like '%$search%') or (brand like '%$search%') or (description like '%$search%'))";
        else
            $query = "select * from `products`";

        if ($category != "all") {
            if (empty($search)) {
                $query = $query . "where category = '$category'";
            } else {
                $query = $query . "and category = '$category'";
            }
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $pname = $row['pname'];
            if (strlen($pname) > 35) {
                $pname = substr($pname, 0, 35) . '...';
            }
            $desc = $row['description'];
            $qty = $row['qtyavail'];
            $price = $row['price'];
            $cat = $row['category'];
            $img = $row['img'];
            $brand = $row['brand'];

           
                    $query2 = "SELECT pid, AVG(rating) AS average_rating FROM reviews where pid = $pid GROUP BY pid ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);
            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>₴$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }
    } else {
        include("include/connect.php");

        $select = "Select* from products where qtyavail > 0 order by rand()";
        $result = mysqli_query($con, $select);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $pname = $row['pname'];
            if (strlen($pname) > 35) {
                $pname = substr($pname, 0, 35) . '...';
            }
            $desc = $row['description'];
            $qty = $row['qtyavail'];
            $price = $row['price'];
            $cat = $row['category'];
            $img = $row['img'];
            $brand = $row['brand'];

            $query2 = "SELECT pid, AVG(rating) AS average_rating FROM reviews where pid = $pid GROUP BY pid ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);

            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>₴$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }

    }
    ?>


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
    function topage(pid) {
        window.location.href = `sproduct.php?pid=${pid}`;
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