<?php

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 0){
    header("location: pastiLogin.php");
    exit;
}   

require_once "../../configs/pastiConfig.php";
        



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Application</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page-header">
        <h1>Hi user <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <?php
        $username = $_SESSION["username"];
        $query = "SELECT * FROM student WHERE username = '" .$username. "';";
        $result = mysqli_query($link, $query);
        
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>MyKid</th>";
        echo "<th>Date of Birth</th>";
        echo "<th>Birth Certificate Number</th>";
        echo "<th>Address</th>";
        echo "<th>Allergy</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mykid"] . "</td>";
            echo "<td>" . $row["dob"] . "</td>";
            echo "<td>" . $row["bc"] . "</td>":
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["allergy"] . "</td>";
            echo "<td>" . $row["illness"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
            
            
        mysqli_free_result($result);
        mysqli_close($link);

    ?>
    <!--<p><input type="button" value="Add Parent or Guardian" onclick="location='pastiNewParent.php'" /></p>-->
    <p><input type="button" value="Add Student" onclick="location='pastiNewStudent.php'" /></p>
    <p><input type="button" value="Edit Student Information" onclick="location='pastiChooseEditStudent.php'" /></p>
    <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>