<?php

    session_start();

    require_once "../../configs/pastiConfig.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page=header">
        <h1>Please choose which student to edit</h1>
    </div>
    <form action="pastiEditStudent.php" method="POST">
        <?php
            $username = $_SESSION["username"];
            $query = "SELECT name, mykid FROM student WHERE username = '" .$username."'";
            $result = mysqli_query($link, $query);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<input type='radio' name='choice' value='".$row['mykid']."'>".$row['name']."<br>\n";
            }

            mysqli_free_result($result);
            mysqli_close($link);
        ?>
        <input type="submit" name="request" value="Submit">
    </form>
    <div class="form-group">
        
        <input type="button" value="Cancel" onclick="location='pastiUserMain.php'">
    </div>
</body>
</html>