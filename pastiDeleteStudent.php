<?php

    session_start();

    require_once "../../configs/pastiConfig.php"

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //$target = $_POST['choice'];
        echo hi;
        //$sql = "DELETE FROM student WHERE mykid = '".$target."';";
        //mysqli_query($link, $sql);
        //mysqli_close($link);
        //header("location: pastiUserMain.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page=header">
        <h1>Please choose which student to delete</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
        <input type="submit" value="Submit (THIS IS IRREVERSIBLE)">
    </form>
    <div class="form-group">
        
        <input type="button" value="Cancel" onclick="location='pastiUserMain.php'">
    </div>
</body>
</html>