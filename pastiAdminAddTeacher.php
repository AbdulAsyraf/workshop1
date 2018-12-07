<?php

    session_start();

    require_once "../../configs/pastiConfig.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 2){
        header("location: pastiLogin.php");
        exit;
    }

    $username = $_SESSION["username"];

    if(isset($_POST["add"])){
        if(!empty($_POST["mykad"])){
            $search = $_POST["mykad"];

            $param_search = $search;

            $sql = "SELECT username FROM users WHERE username = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $param_search);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $add = $_POST["mykad"];
                $sql = "UPDATE users SET usertype = 1 WHERE username = '".$add."';";
                if(mysqli_query($link, $sql)){
                    unset($_POST["add"]);
                    header("location: pastiAdminAddTeacher.php");
                }
                else{
                    echo "Something went wrong. Please try again";
                }
            }    
        }
        else{
            echo "That user does not exist.";
        }
    }
    elseif(isset($_POST["remove"])){
        $remove = $_POST["choiceRemove"];
        $sql = "UPDATE users SET usertype = 0 WHERE username = '".$remove."';";
        if(mysqli_query($link, $sql)){
            unset($_POST["remove"]);
            header("location: pastiAdminAddTeacher.php");
        }
        else{
            echo "Something went wrong. Please try again";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Teacher</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>MyKad :</label>
        <p><input type="text" name="mykad" value="<?php echo $mykad; ?>"></p>
    <?php
        /*$query = "SELECT username FROM users WHERE usertype = 0;";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<input type='radio' name='choiceAdd' value='".$row['username']."'>".$row['username']."<br>\n";
        }

        mysqli_free_result($result);*/
    ?>
        <p><input type="submit" name="add" value="Add teacher"></p>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
        $query2 = "SELECT username FROM users WHERE usertype = 1;";
        $result2 = mysqli_query($link, $query2);
        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
            echo "<input type='radio' name='choiceRemove' value='".$row2['username']."'>".$row2['username']."<br>\n";
        }

        mysqli_free_result($result2);
        mysqli_close($link);
    ?>
        <p><input type="submit" name="remove" value="Remove teacher"></p>
    </form>
        <p><input type="button" value="Back" onclick="location='pastiAdminMain.php'">
</body></html>