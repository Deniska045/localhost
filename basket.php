<?php
require_once("connect.php");

$id = $_POST["id"];

$hashSession = $_COOKIE["session"];
if (!$hashSession) {
} else {



    $result = $connect->query("SELECT `id` FROM `account` AS a
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
    $id_user = $user["id"];
    print_r($user);
    $result = $connect->query("INSERT INTO `basket` (`id_product`, `id_user`) VALUES ('$id', '$id_user')");
    if (!$result || $connect->errno != 0) {
        echo $connect->error;
        return;
    }
}



if ($basket->num_rows > 0) {
    while ($info_basket = $basket->fetch_assoc()) {

        echo '<td class="fega">'; ?>
        <td class="ref"> <?php
                            echo '<h3>Товар</h3>';
                            ?></td>
        <td class="ref"> <?php
                            echo $info_basket['name'];
                            ?></td>
        <td class="ref"> <?php
                            echo $info_basket['info'];
                            ?></td>
        <td class="ref"> <?php
                            echo $info_basket['price'];
                            ?><img src="img/<?php echo $info_basket['img']; ?>" /></div>
    <?php


    }
}
header("Location: /index.php",TRUE,301);
    ?>