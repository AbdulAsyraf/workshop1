<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    $name = $phone = $relation = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["name"]))){
            $err_arr[0] = "This field is required";
        }
        else{
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["relation"]))){
            $err_arr[1] = "This field is required";
        }
        else{
            $relation = trim($_POST["relation"]);
        }

        if(empty(trim($_POST["phone"]))){
            $err_arr[2] = "This field is required";
        }
        else{
            $phone = trim($_POST["phone"]);
        }

        if(empty($err_arr)){
            $sql = "INSERT INTO emergency (username, name, relation, phone) values (?, ?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql)){

                mysqli_stmt_bind_param($stmt, "ssss", $username, $param_name, $param_relation, $param_phone);

                $param_name = $name;
                $param_relation = $relation;
                $param_phone = $phone;

                if(mysqli_stmt_execute($stmt)){
                    $sql = "UPDATE users set emergency = 'Yes' WHERE username = '".$username."';";
                    mysqli_query($link, $sql);

                    header("location: pastiLogin.php");
                }
                else{
                    echo "Something went wrong. Please try again later";
                }
            }
        }

        mysqli_stmt_close($link);
        mysqli_close($link);
    }

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $err_arr[0]; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_arr[1)) ? 'has-error' : ''; ?>">
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