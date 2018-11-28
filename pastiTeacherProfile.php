<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["name"]))){
            $err_arr[0] = "This field is required";
        }
        else{
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["mykad"]))){
            $err_arr[1] = "This field is required";
        }
        else{
            $mykad = trim($_POST["mykad"]);
        }

        if(empty(trim($_POST["address"]))){
            $err_arr[2] = "This field is required";
        }
        else{
            $address = trim($_POST["address"]);
        }

        if(empty(trim($_POST["phone"]))){
            $err_arr[3] = "This field is required";
        }
        else{
            $phone = trim($_POST["phone"]);
        }

        if(empty($err_arr)){
            $sql = "INSERT INTO teacher (username, name, mykad, address, phone) values (?, ?, ?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sssss", $username, $param_name, $param_mykad, $param_address, $param_phone);

                $param_name = $name;
                $param_mykad = $mykad;
                $param_address = $address;
                $param_phone = $phone;

                if(mysqli_stmt_execute($stmt)){
                    $sql2 = "UPDATE users SET filled = 'filled' WHERE username = '".$username."';";
                    mysqli_query($link, $sql2);

                    header("location: pastiTeacherMain.php");
                }
                else{
                    echo "Something went wrong. Please try again later";
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Fill up</h2>
    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
    <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
        <label>Name</label>
        <input type="text" name = "name" class="form-control" value="<?php echo $name; ?>">
        <span class="help-block"><?php echo $err_arr[0]; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($err_arr[1])) ? 'has-error' : ''; ?>">
        <label>MyKad</label>
        <input type="text" name = "mykad" maxlength="12" class="form-control" value="<?php echo $mykad; ?>">
        <span class="help-block"><?php echo $err_arr[1]; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
        <label>Address</label>
        <input type="text" name = "address" class="form-control" value="<?php echo $address; ?>">
        <span class="help-block"><?php echo $err_arr[2]; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($err_arr[3])) ? 'has-error' : ''; ?>">
        <label>Phone Number</label>
        <input type="tel" name = "phone" minlength="9" maxlength="11" class="form-control" value="<?php echo $phone; ?>">
        <span class="help-block"><?php echo $err_arr[3]; ?></span>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" clase="btn btn-default" value="Reset">
</body>
</html>