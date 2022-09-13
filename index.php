<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="wrap-logo">
            <img src="img/ural.png" alt="">
        </div>
    <form method="POST" action="basket-in-form.php">
        <input type="submit" class="btn btn-primary" value="Корзина">
        </form>
    </header>

    <main>

        <?php

        use LDAP\Result;

        require("connect.php");


        $hashSession = $_COOKIE["session"];
        if (!$hashSession) {
        } else {



            $result = $connect->query("SELECT `role`, `name` FROM `account` AS a
                        INNER JOIN `session` AS s 
                        ON a.`id`=s.`account`
                        WHERE s.`hash`='$hashSession'");
            if (!$result) {
                $result = $connect->query("UPDATE `session` SET 'end' = current_timestap WHERE 'hash' = '$hashSession'");
                if (!$result) {
                    echo $connect->error;
                }
                setcookie("session", "", 0);
                header("Location: /index.php", TRUE, 301);
            }

            $user = $result->fetch_assoc();
            $isLogin = true;
        }

        ?>

        <div class="container">
            <?php
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db_name = 'db';
            $link = mysqli_connect($host, $user, $pass, $db_name);
            $sql = mysqli_query($link, 'SELECT * FROM `tru`');
            while ($result = mysqli_fetch_array($sql)) : ?>

                <div class="card" style="width: 18rem;">
                    <img src="img/<?= $result['img'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $result['name'] ?></h5>
                        <h5 class="card-title"><?= $result['info'] ?></h5>
                        <h5 class="card-title"><?= $result['country'] ?></h5>
                        <h5 class="card-title"><?= $result['price'] ?></h5>
                        <p class="card-text">
                            <?php
                            if ($isLogin == true) {
                            ?>
                                <a href="#" class="btn btn-primary">Купить</a><?php } ?>
                        <form action="basket.php" method="POST">
                            <input name="id" style="display: none;" value="<?= $result['id'] ?>">
                            <input type="submit" class="btn btn-primary" value="Добавить в корзину">
                        </form>
                    </div>
                </div>

            <?php endwhile ?>
        </div>


        <div class="fullPageMenu<?php if ($isLogin == true) echo " active"; ?>" id="nav">
            <div class="banner">
                <img src="https://vinyl-market.ru/images/shop_items/1234.jpg.webp" alt="image">
            </div>
            <div class="nav">
                <ul>

                    <li><a href="registration.php" data-text="Зарегистрироваться">Зарегистрироваться</a></li>

                    <li><a href="sign-in-form.php" data-text="Войти">Войти</a></li>
                    <li><a href="index.php" data-text="Главная">Главная</a></li>
                    <li><a href="#" data-text="Контакты">Контакты</a></li>
                    <li><a href="profile.php" data-text="Профиль">Профиль</a></li>
                    <li><a href="#" data-text="Каталог">Каталог</a></li>
                </ul>
            </div>
        </div>
        <span class="menuicon<?php if ($isLogin == true) echo " active"; ?>" id="toggle" onclick="menuToggle()"></span>




        <script src="assets/js/js.js"></script>
</body>

</html>