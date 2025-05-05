<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassowrd = $_POST['confirmPassword'];
    $cnic = $_POST['cnic'];
    $dob = $_POST['dob'];
    $contact = $_POST['phone'];
    $gen = $_POST['gender'];
    $email = $_POST['email'];

    $query = "select * from accounts where username = '$username' or cnic='$cnic' or phone='$contact' or email='$email'";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row['aid'])) {
        echo "<script> alert('Облікові дані вже існують'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($password != $confirmpassowrd) {
        echo "<script> alert('Паролі не співпадають'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($password < 8) {
        echo "<script> alert('Паролі занадто короткі'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (strtotime($dob) > time()) {
        echo "<script> alert('неправильна дата'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($gen == "S") {
        echo "<script> alert('оберіть стать'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (preg_match('/\D/', $cnic) || strlen($cnic) != 13) {
        echo "<script> alert('недійсна картка'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (preg_match('/\D/', $contact) || strlen($contact) != 11) {
        echo "<script> alert('невірний номер'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }

    $query = "insert into `accounts` (afname, alname, phone, email,cnic, dob, username, gender,password) values ('$firstname', '$lastname', '$contact','$email', '$cnic', '$dob', '$username', '$gen','$password')";

    $result = mysqli_query($con, $query);



    if ($result) {
        echo "<script> alert('Successfully entered account'); setTimeout(function(){ window.location.href = 'login.php'; }, 100); </script>"; // exit();
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
        <a href="#"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Головна</a></li>
                <li><a href="shop.php">Магазин</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="contact.php">Контакти</a></li>
                <li><a href="login.php">Вхід</a></li>
                <li><a class="active" href="signup.php">Реєстрація</a></li>
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


    <form method="post" id="form">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="fn" name="firstName" type="text" placeholder="Ім'я *" required="required">
        <input class="input1" id="ln" name="lastName" type="text" placeholder="Прізвище *" required="required">
        <input class="input1" id="user" name="username" type="text" placeholder="Юзернейм *" required="required">
        <input class="input1" id="email" name="email" type="text" placeholder="Електронна пошта *" required="required">
        <input class="input1" id="pass" name="password" type="password" placeholder="Пароль *" required="required">
        <input class="input1" id="cpass" name="confirmPassword" type="password" placeholder="Підтвердіть пароль *"
            required="required">
        <input class="input1" id="cnic" name="cnic" type="number" placeholder="Картка *" required="required">
        <input class="input1" id="dob" name="dob" type="date" placeholder="Дата народження " required="required">
        <input class="input1" id="contact" name="phone" type="number" placeholder="Контакти *" required="required">
        <select class="select1" id="gen" name="gender" required="required">
            <option value="S">Оберіть стать</option>
            <option value="M">Чоловік</option>
            <option value="F">Жінка</option>
        </select>
        <button name="submit" type="submit" class="btn">Надіслати</button>

    </form>

    <div class="sign">
        <a href="login.php" class="signn">Вже маєте обліковий запис?</a>
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
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>