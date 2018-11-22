<?php

    require_once "../../configs/pastiConfig.php";

    $sql1 = "SELECT allergy FROM student WHERE mykid = '121211045555';";
    $sql2 = "UPDATE student SET allergy = NULL WHERE mykid = '121211045555';";

    $result = mysqli_query($link, $sql1);

    $row = mysqli_fetch_assoc($result);

    echo $row["allergy"];

    mysqli_free_result($result);

    mysqli_query($link, $sql2);

    $result = mysqli_query($link, $sql1);

    $row = mysqli_fetch_assoc($result);

    echo $row["allergy"];

    mysqli_free_result($result);
    mysqli_close($link);

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