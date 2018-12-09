<?php

    session_start();

    require_once "../../configs/pastiConfig.php";

    $username = $_SESSION["username"];
    $sql = "SELECT * FROM teacher WHERE username = '".$username."';";
    $result = mysqli_query($link, $sql);

    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>MyKad</th>
                <th>Address</th>
                <th>Phone Number</th>
            </tr>";
    
    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>
                <td>" . $rows["name"] . "</td>
                <td>" . $rows["mykad"] . "</td>
                <td>" . $rows["address"] . "</td>
                <td>" . $rows["phone"] . "</td>
            </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
    mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page-header">
        <h1><b>View Profile<b></h1>
    </div>
    <?php

        echo "<table border='1'>
        <tr>
            <th>Name</th>
            <th>MyKad</th>
            <th>Address</th>
            <th>Phone Number</th>
        </tr>";

        while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>
            <td>" . $rows["name"] . "</td>
            <td>" . $rows["mykad"] . "</td>
            <td>" . $rows["address"] . "</td>
            <td>" . $rows["phone"] . "</td>
        </tr>";
        }
        echo "</table>";

        mysqli_free_result($result);
        mysqli_close($link);

    ?>
    
    <p><input type="button" value="Back" onclick="location='pastiTeacherMain.php'"></p>
</body></html>