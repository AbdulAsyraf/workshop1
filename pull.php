<?php

    require_once "../../configs/pastiConfig.php";

    echo "1";
    $sql = "SELECT username from users";
    echo "2";
    $result = mysqli_query($link, $sql);
    echo "3";
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
    printf("%s (%s)\n", $row["username"]);

    mysqli_free_result($result);
    mysqli_close($link);



?>