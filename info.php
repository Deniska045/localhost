<?

$name = $_POST["name"];
$info = $_POST["info"];
$country  = $_POST["country"];
$price = $_POST["price"];
$image = $_FILES["image"];
require_once('connect.php');
$imageName = $image['name'];
$uploadFile = "img/" . basename($imageName);
 if (!move_uploaded_file ( $image ['tmp_name'], $uploadFile)){
     $imageName = null;
 }
 $result = $connect->query("INSERT INTO `info`(`name`, `info`, `country`, `price` ,`image`)
                VALUES ('$name', '$info','$country',$price,'$imageName')");
if (!$result) {
    echo $connect->error;
    return;
}
header("Location: /index.php", TRUE, 301);
