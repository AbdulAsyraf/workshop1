<?php

    require_once "../../configs/pastiConfig.php";

    echo "1";
    $sql = "SELECT username from users";
    echo "2";
    $result = mysqli_query($link, $sql);
    echo "3";
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    echo "4";
    /*echo. $row["username"]);
    echo "5";
    mysqli_free_result($result);
    mysqli_close($link);*/



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Stuff</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .wrapper{
            width: 600px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <p>This is a test page</p>
</body>
</html>