
<?php
require ("connect.php");
$hashSession = $_COOKIE ["session"];
$result = $connect->query("UPDATE `session` SET `end` =current_timestamp WHERE `hash` = '$hashSession'" );
if(!$result){
    echo $connect->error;
    return;
}
setcookie("session", "", 0);
header("Location: /index.php",TRUE,301);

?>
