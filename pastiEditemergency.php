<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    if(isset($_POST["update"])){

        if(empty(trim($_POST["name"]))){
            $err_arr[0] = "This field is required";
        }
        else{
            $newname = trim($_POST["name"]);
            if($newname != $name){
                $sql = "UPDATE emergency SET name = '".$newname."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }

        if(empty(trim($_POST["relation"]))){
            $err_arr[1] = "This field is required";
        }
        else{
            $newrelation = trim($_POST["relation"]);
            if($newrelation != $relation){
                $sql = "UPDATE emergency SET relation = '".$newrelation."' WHERE username = '".$username"';";
                mysqli_query($link, $sql);
            }
        }

        if(empty(trim($_POST["phone"]))){
            $err_arr[2] = "This field is required";
        }
        else{
            $newphone = trim($_POST["phone"]);
            if($newphone != $phone){
                $sql = "UPDATE emergency SET phone = '".$newphone."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }

        if(empty($err_arr)){
            unset($_POST["update"]);
            header("location: pastiUserMain.php");
        }
        else{
            echo "Something went wrong. Please try again";
        }
    }
    else{
        $username = $_SESSION["username"];
        $query = "SELECT name, relation, phone FROM emergency WHERE username = '".$username."';";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $relation = $row["relation"];
        $phone = $row["phone"];
    }

    mysqli_stmt_close($link);
    mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emergency Contact</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Fill up</h2>
        <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $err_arr[0]; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_arr[1])) ? 'has-error' : ''; ?>">
                <label>Relationship</label>
                <input type="text" name="relation" class="form-control" value="<?php echo $relation; ?>">
                <span class="help-block"><?php echo $err_arr[1]; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
                <label>Phone Number</label>
                <input type="tel" name="phone" minlength="9" maxlength="11" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $err_arr[2]; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>