<?php

require("connect.php");

$login = $_POST["Login"];
$password = $_POST["Password"];


$result = $connect->query("SELECT `id`, `role`, `name`, `surname`, `patronymic` 
                           FROM `account` WHERE `login`='$login' AND `password`='$password'");

if(!$result){
    echo $connect->error;
    return;
}

if($result ->num_rows == 0) {
    echo "Нет данных";
    return;
}


$account = $result->fetch_assoc();
if (!$account) {
    echo $connect->error;
    return;
}


$id = $account["id"];
$hash = sha1(date(DATE_ATOM));
$result = $connect->query("INSERT INTO `session` (`hash`, `account`, `start`, `end`) VALUES ('$hash', '$id', current_timestamp, current_timestamp + interval 30 day)");
if (!$result || $connect->errno != 0) {
    echo $connect->error;
    return;
}



setcookie("session", $hash, time()+3600);

header("Location: /index.php",TRUE,301);

?>
