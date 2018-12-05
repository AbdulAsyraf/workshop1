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
        
        echo "<p>Children</p>";
        ?>
        <p><input type="button" value="Add Child" onclick="location='pastiNewStudent.php'" />
        <input type="button" value="Edit Child Information" onclick="location='pastiChooseEditStudent.php'" />
        <input type="button" value="Delete Student(Only for unapproved children)" onclick="location='pastiDeleteStudent.php'" /></p>
        <?php
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>MyKid</th>";
        echo "<th>Date of Birth</th>";
        echo "<th>Birth Certificate Number</th>";
        echo "<th>Age</th>";
        echo "<th>Address</th>";
        echo "<th>Allergy</th>";
        echo "<th>Illness</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mykid"] . "</td>";
            echo "<td>" . $row["dob"] . "</td>";
            echo "<td>" . $row["bc"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["allergy"] . "</td>";
            echo "<td>" . $row["illness"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table><br>";

        $query = "SELECT name1, mykad1, job1, phone1, name2, mykad2, job2, phone2, address FROM parentguardian WHERE username = '".$username."';";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
        <p>Parents/Guardians</p>
        <p><input type="button" value="Edit Parent or Guardian Information" onclick="location='pastiEditparent.php'"/></p>
        <table border='1'>
        <tr>
            <th>Name</th>
            <th>MyKad</th>
            <th>Occupation</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>
        <?php
        echo "<tr>
                <td>".$row["name1"]."</td>
                <td>".$row["mykad1"]."</td>
                <td>".$row["job1"]."</td>
                <td>".$row["phone1"]."</td>
                <td>".$row["address"]."</td>
            </tr>
            <tr>
                <td>".$row["name2"]."</td>
                <td>".$row["mykad2"]."</td>
                <td>".$row["job2"]."</td>
                <td>".$row["phone2"]."</td>
                <td>".$row["address"]."</td>
            </tr>
        </table><br>";

        $query = "SELECT name, relation, phone FROM emergency WHERE username = '".$username."';";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
        <p>Emergency Contact</p>
        <p><input type="button" value="Edit Emergency Contact Information" onclick="location ='pastiEditemergency.php'"/></p>
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>Relationship</th>
                <th>Phone Number</th>
            </tr>
        <?php
        echo "<tr>
                <td>".$row["name"]."</td>
                <td>".$row["relation"]."</td>
                <td>".$row["phone"]."</td>
            </tr>
        </table>";            
            
        mysqli_free_result($result);
        mysqli_close($link);

    ?>
    <!--<p><input type="button" value="Add Parent or Guardian" onclick="location='pastiNewParent.php'" /></p>
    <p><input type="button" value="Add Student" onclick="location='pastiNewStudent.php'" /></p>
    <p><input type="button" value="Edit Student Information" onclick="location='pastiChooseEditStudent.php'" /></p>
    <p><input type="button" value="Delete Student" onclick="location='pastiDeleteStudent.php'" /></p>
    <p><input type="button" value="Edit Parent or Guardian Information" onclick="location='pastiEditparent.php'"/></p>
    <p><input type="button" value="Edit Emergency Contact Information" onclick="location ='pastiEditemergency.php'"/></p>-->
    <p><input type="button" value="Sign Out" onclick="location:'pastiLogout.php'" class="btn btn-danger"></p>
</body>
</html>