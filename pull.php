<?php

    require_once "../../configs/pastiConfig.php";

    $sql = "SELECT username from users";
    $result = mysqli_query($link, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
    printf("%s (%s)\n", $row["username"]);

    mysqli_free_result($result);
    mysqli_close($link);



?>