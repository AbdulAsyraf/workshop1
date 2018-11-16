<?php

    require_once "../../configs/pastiConfig.php";

    $sql = "SELECT a.username, a.name1, b.usertype from parentguardian a, users b where a.username = b.username;";
    $result = mysqli_query($link, $sql);
    
    echo "<table border='1' width='400'>
            <tr>
                <th>Username</th>
                <th>Name</th>
            </tr>";

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>";
        echo "<td width='20%'>" . $row["username"] . "</td>";
        echo "<td width='60%'>" . $row["name1"] . "</td>";
        echo "<td width='20%'>" . $row["usertype"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
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