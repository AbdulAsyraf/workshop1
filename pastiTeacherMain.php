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

        $query = "SELECT * FROM student WHERE status = 'Processing';";
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
            echo "</tr>";
        }
        
        echo "</table>";
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
        <p><input type="submit" value="Approve Student"></p>
    </form>
        <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>