<?php

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 2){
    header("location: pastiLogin.php");
    exit;
}

require_once "../../configs/pastiConfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="page-header">
        <h1><b>Remove Student<b></h1>
    </div>
    <?php

        $query = "SELECT a.mykid, a.name, a.dob, a.bc,  a.address, a.illness, a.allergy, a.age, a.status, b.name1, b.mykad1, b.job1, b.phone1, b.name2, b.mykad2, b.job2, b.phone2, b.address AS address2 FROM student a, parentguardian b WHERE a.username = b.username;";
        $result = mysqli_query($link, $query);

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>MyKid</th>";
        echo "<th>Date of Birth</th>";
        echo "<th>Birth Certificate Number</th>";
        echo "<th>Address</th>";
        echo "<th>Allergy</th>";
        echo "<th>Illness</th>";
        echo "<th>Age</th>";
        echo "<th>Father's or Guardian's Name</th>";
        echo "<th>MyKad Number</th>";
        echo "<th>Occupation</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Mother's or Guardian's Name</th>";
        echo "<th>MyKad Number</th>";
        echo "<th>Occupation</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Address</th>";
        echo "<th>Status</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mykid"] . "</td>";
            echo "<td>" . $row["dob"] . "</td>";
            echo "<td>" . $row["bc"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["allergy"] . "</td>";
            echo "<td>" . $row["illness"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["name1"] . "</td>";
            echo "<td>" . $row["mykad1"] . "</td>";
            echo "<td>" . $row["job1"] . "</td>";
            echo "<td>" . $row["phone1"] . "</td>";
            echo "<td>" . $row["name2"] . "</td>";
            echo "<td>" . $row["mykad2"] . "</td>";
            echo "<td>" . $row["job2"] . "</td>";
            echo "<td>" . $row["phone2"] . "</td>";
            echo "<td>" . $row["address2"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";

    if(isset($_POST["delete"])){
        $pick = $_POST["choice"];
        $sql = "DELETE FROM student WHERE mykid = '".$pick."';";
        if(mysqli_query($link, $sql)){
            unset($_POST["delete"]);
            header("location: pastiAdminRemove.php");
        }
        else{
            echo "Something went wrong. Please try again";
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
        $query = "SELECT mykid, name FROM student;";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<input type='radio' name='choice' value='".$row['mykid']."'>".$row['name']."<br>\n";
        }

        mysqli_free_result($result);
        mysqli_close($link);
    ?>
        <p><input type="submit" name="delete" value="Remove Student"></p>
    </form>
        <p><input type="button" value="Back" onclick="location='pastiAdminMain.php'">
        <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>