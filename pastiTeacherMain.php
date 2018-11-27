<?php

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 1){
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
        <h1>Hi teacher <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <?php

        $query = "SELECT a.mykid, a.name, a.dob, a.bc,  a.address, a.illness, a.allergy, a.age, b.name1, b.mykad1, b.job1, b.phone1, b.name2, b.mykad2, b.job2, b.phone2, b.address FROM student a, parentguardian b WHERE status = 'Processing' AND a.username = b.username;";
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
        echo "</tr>";

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row["a.name"] . "</td>";
            echo "<td>" . $row["a.mykid"] . "</td>";
            echo "<td>" . $row["a.dob"] . "</td>";
            echo "<td>" . $row["a.bc"] . "</td>";
            echo "<td>" . $row["a.address"] . "</td>";
            echo "<td>" . $row["a.allergy"] . "</td>";
            echo "<td>" . $row["a.illness"] . "</td>";
            echo "<td>" . $row["a.age"] . "</td>";
            echo "<td>" . $row["b.name1"] . "</td>";
            echo "<td>" . $row["b.mykad1"] . "</td>";
            echo "<td>" . $row["b.job1"] . "</td>";
            echo "<td>" . $row["b.phone1"] . "</td>";
            echo "<td>" . $row["b.name2"] . "</td>";
            echo "<td>" . $row["b.mykad2"] . "</td>";
            echo "<td>" . $row["b.job2"] . "</td>";
            echo "<td>" . $row["b.phone2"] . "</td>";
            echo "<td>" . $row["b.address"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";

    if(isset($_POST["approval"])){
        $pick = $_POST["choice"];
        $sql = "UPDATE student SET status = 'Approved' WHERE mykid = '".$pick."';";
        if(mysqli_query($link, $sql)){
            header("location: pastiTeacherMain.php");
        }
        else{
            echo "Something went wrong. Please try again";
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
        $query = "SELECT mykid, name FROM student WHERE status = 'Processing';";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<input type='radio' name='choice' value='".$row['mykid']."'>".$row['name']."<br>\n";
        }

        mysqli_free_result($result);
        mysqli_close($link);
    ?>
        <p><input type="submit" name="approval" value="Approve Student"></p>
    </form>
        <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>