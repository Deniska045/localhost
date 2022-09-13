<?php 
require_once("connect.php");
$hashSession = $_COOKIE["session"];
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

    $result = $connect->query("SELECT b.`id_product`, t.`name`, t.`price`, t.`info` FROM `basket` b
                                INNER JOIN `tru` t ON b.`id_product` = t.`id`
                                WHERE `id_user` = '$id_user'");
        if(!$result){
            echo $connect->error;
            return;
        }

        ?> <td><?php
        if ($result->num_rows > 0) {?></td> 
           <td><?php while ($product = $result->fetch_assoc()) {?> </td>
               <td><?php echo $product['id_product'];?></td>
                 <td><?php echo $product['id_user'];?></td>  
                 <td><?php echo $product['name'];?></td>  
                 <td><?php echo $product['info'];?></td>  
                 <td><?php echo $product['price'];?></td>  
            <?php    
            }
        }
?>