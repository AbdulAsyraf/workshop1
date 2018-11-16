<?php

    require_once "../../configs/pastiConfig.php";

    $sql = "SELECT a.username, a.name1, b.usertype from parentguardian a, users b where a.username = b.username;";
    $result = mysqli_query($link, $sql);
    
    echo "<table border='1' width='800'>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Usertype</th>
            </tr>";

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>";
        echo "<td width='20%'>" . $row["username"] . "</td>";
        echo "<td width='60%'>" . $row["name1"] . "</td>";
        if ($row["usertype"] == 0){
            echo "<td width='20%'>Normal User</td>";
        }
        else if ($row["usertype"] == 1){
            echo "<td width='20%'>Teacher</td>";
        }
        else if ($row["usertype"] == 2){
            echo "<td width='20%'>Administrator</td>";
        }
        //echo "<td width='20%'>" . $row["usertype"] . "</td>";
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