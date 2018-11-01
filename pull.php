<?php

    require_once "../../configs/pastiConfig.php";

    $sql = "SELECT username from users";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC){
        printf("%s (%s)\n", $row["username"]);
    }




?>