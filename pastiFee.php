<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fee</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        $now = date("n");
        echo "<table border='1'>
                    <tr>
                        <th>Name</th>
                        <th>MyKid</th>
                        <th>Father's/Guardian's Name</th>
                        <th>Phone Number</th>
                        <th>Mother's/Guardian's Name</th>
                        <th>Phone Number</th>";
        switch($now){
            case 12:
                echo "<th>December</th>";
            case 11:
                echo "<th>November</th>";
            case 10:
                echo "<th>October</th>";
            case 9:
                echo "<th>September</th>";
            case 8:
                echo "<th>August</th>";
            case 7: default:
                echo "<th>July</th>";
            case 6:
                echo "<th>June</th>";
            case 5:
                echo "<th>May</th>";
            case 4:
                echo "<th>April</th>";
            case 3:
                echo "<th>March</th>";
            case 2:
                echo "<th>February</th>";
            case 1:
                echo "<th>January</th>";
        }

    ?>
</body>
</html>