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
            $age = $_POST["class"];
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
                    $sql = "INSERT INTO teacher (username, classage) VALUES ('" .$add. "', " .$age. ");";
                    mysqli_query($link, $sql);
                    header("location: pastiAdminAddTeacher.php");
                }
                else{
                    echo "Something went wrong. Please try again";
                }
            }    
        }
        else{
            $err = "That user does not exist";
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
    <div class="page-header">
        <h1><b>Add Teacher</b></h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($err)) ? 'has-error' : ''; ?>">
            <label>MyKad :</label>
            <input type="text" name="mykad" value="<?php echo $mykad; ?>">
            <span class="help-block"><?php echo $err; ?></span>
    <?php
        /*$query = "SELECT username FROM users WHERE usertype = 0;";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<input type='radio' name='choiceAdd' value='".$row['username']."'>".$row['username']."<br>\n";
        }

        mysqli_free_result($result);*/
    ?>
        </div>
        <div class="form-group">
            <p><select name="class">
                <option disabled selected value> --Select a class-- </option>
                <option value = 4>4</option>
                <option value = 5>5</option>
                <option value = 6>6</option>
            </select></p>
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