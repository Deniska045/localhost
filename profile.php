<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
<header>
        <div class="wrap-logo">
           <img src="img/ural.png" alt="">
        </div>
      
       
    </header>
    <main>

    <link rel="stylesheet" href="assets/css/style.css">
    <?php
    require_once("connect.php");

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
        }
        $isLogin = true;
        $user = $result->fetch_assoc();


    ?>
        <div class="fullPageMenu<?php if ($isLogin == true) echo " active"; ?>" id="nav">
            <div class="banner">
                <img src="https://vinyl-market.ru/images/shop_items/1234.jpg.webp" alt="image">
            </div>
            <div class="nav">
                <ul>
                    <li><a href="registration.php" data-text="Зарегистрироваться">Зарегистрироваться</a></li>
                    <li><a href="sign-in-form.php" data-text="Войти">Войти</a></li>
                    <li><a href="index.php" data-text="Главная">Главная</a></li>
                    <li><a href="profile.php" data-text="Профиль">Профиль</a></li>
                    <li><a href="#" data-text="Контакты">Контакты</a></li>
                    <li><a href="#" data-text="Каталог">Каталог</a></li>
                </ul>
            </div>
        </div>
        <span class="menuicon<?php if ($isLogin == true) echo " active"; ?>" id="toggle" onclick="menuToggle()"></span>

        <h3>Здравствуйте, <?php
                            echo $user["name"] . " [";
                            echo $user["role"] . "]" . '<br>';

                            $user = $_SESSION['user_id'];


                            $user = $connect->query('SELECT * FROM `my_db`');

                            if (!$user) {
                                echo $connect->error;
                                return;
                            }


                            if ($user->num_rows > 0) {
                                while ($info_user = $user->fetch_assoc()) {

                                    echo '<div class="fega">'; ?>
                    <div class="ref"> <?php
                                        echo '<h3>Пользователь</h3>';
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['surname'];
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['name'];
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['patronymic'];
                                        ?><img src="<?php echo $info_user['image']; ?>" /></div>
        <?php
                                }
                            }
                        }
        ?>

        <?php

        ?>
      <form action="logout.php" method="POST">
            <input class="logout" type="submit" value="Выйти">
        </form>
   

        </main>
        <script src="assets/js/js.js"></script>
</body>

</html>