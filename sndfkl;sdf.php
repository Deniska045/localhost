<!--       
            <form enctype="multipart/form-data" class="info" action="info.php" method="POST">
                <input type="text" placeholder="Имя" name="name" size="30"><br />
                <label for="last_name"></label><br />
                <input type="text" placeholder="Информация" name="info" size="30"><br />
                <label for="text"></label><br />
                <input type="text" placeholder="Страна" name="country" size="30"><br />
                <label for="facebook"></label><br />
                <input name="price" placeholder="Цена" type="number" value="" size="30">
                <label for="facebook"></label><br />
                <input class="foto" name="image" type="file" />
                <label for="facebook"></label><br />
                <input class="cnopa" type="submit" value="Добавить">

            </form>

        </h3>
  

    <?php
    // }

    $result = $connect->query("SELECT `name`, `info`,`country`,`price`, `image` FROM `info`");
    if (!$result) {
        echo $connect->error;
        return;
    }
    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <td>Имя</td>
                <td>Информация</td>
                <td>Страна</td>
                <td>Цена</td>
                <td>Фото</td>
            </tr>
            <?php
            while ($data = $result->fetch_assoc()) {
            ?><tr>


                    <td><?php echo $data['name']; ?> </td>
                    <td><?php echo $data['info']; ?> </td>
                    <td><?php echo $data['country']; ?> </td>
                    <td><?php echo $data['price']; ?> </td>
                    <td><img class="ft" src="img/<?php echo $data['image']; ?>" /></td>
                <?php
            }
            if ($isLogin == true) {
                ?><button></button><?php
                                }
                                    ?>
                </tr><?php
                    }
                        ?>
</main> -->