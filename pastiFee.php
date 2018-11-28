<?php

    session_start();

    require_once "../../configs/pastiConfig.php";

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
        $sql = "SELECT a.name, a.mykid AS mykid, b.name1, b.phone1, b.name2, b.phone2, c.* FROM student a, parentguardian b, fee c WHERE a.username = b.username AND a.mykid = c.mykid;";
        $result = mysqli_query($link, $sql);
        echo "<table border='1'>
                    <tr>
                        <th>Name</th>
                        <th>MyKid</th>
                        <th>Father's/Guardian's Name</th>
                        <th>Phone Number</th>
                        <th>Mother's/Guardian's Name</th>
                        <th>Phone Number</th>";
        switch($now){
            case 11: default:
                echo "<th>November</th>";
            case 10:
                echo "<th>October</th>";
            case 9:
                echo "<th>September</th>";
            case 8:
                echo "<th>August</th>";
            case 7:
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
                break;
        }
        echo "</tr>";
        
        while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>
                    <td>" . $rows["name"] . "</td>
                    <td>" . $rows["mykid"] . "</td>
                    <td>" . $rows["name1"] . "</td>
                    <td>" . $rows["phone1"] . "</td>
                    <td>" . $rows["name2"] . "</td>
                    <td>" . $rows["phone2"] . "</td>";
            
            switch($now){
                case 11: default:
                    echo "<td>" . $rows["november"] . "</td>";
                case 10:
                    echo "<td>" . $rows["october"] . "</td>";
                case 9:
                    echo "<td>" . $rows["september"] . "</td>";
                case 8:
                    echo "<td>" . $rows["august"] . "</td>";
                case 7:
                    echo "<td>" . $rows["july"] . "</td>";
                case 6:
                    echo "<td>" . $rows["june"] . "</td>";
                case 5:
                    echo "<td>" . $rows["may"] . "</td>";
                case 4:
                    echo "<td>" . $rows["april"] . "</td>";
                case 3:
                    echo "<td>" . $rows["march"] . "</td>";
                case 2:
                    echo "<td>" . $rows["february"] . "</td>";
                case 1:
                    echo "<td>" . $rows["january"] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

    ?>
</body>
</html>