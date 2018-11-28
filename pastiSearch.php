<?php

    session_start();

    require_once "../../configs/pastiConfig.php";

    if(isset($_POST["search"])){
        if(!empty(trim($_POST["term"]))){
            $term = trim($_POST["term"]);
            $query = "SELECT a.mykid, a.name, a.dob, a.bc,  a.address, a.illness, a.allergy, a.age, b.name1, b.mykad1, b.job1, b.phone1, b.name2, b.mykad2, b.job2, b.phone2, b.address AS address2 FROM student a, parentguardian b WHERE CONCAT(a.mykid, a.name, a.dob, a.bc, a.address, a.illness, a.allergy, a.age) LIKE '%$term%' ORDER BY a.name ASC;";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) >0){
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
                    echo "</tr>";
                }
            }
            else{
                echo "No match found";
            }
            
            echo "</table>";
        }

        mysqli_free_result($result);
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_POST['PHP_SELF']); ?>" method="post">
    <div class="form-group">
        <label>Search</label>
        <input type="text" name="term" class="form-control" value = "<?php echo $term; ?>">
    </div>

    <div class="form-group">
        <input type="submit" name="search" class="btn btn-primary" value="Search">
    </form>
        <p><input type="button" value="Back" onclick="location='pastiLogin.php'"></p>
</body></html>