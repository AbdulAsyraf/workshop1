<?php

print_r($_POST);

session_start();

$username = $_SESSION["username"];

require_once "../../configs/pastiConfig.php";

$name1 = $mykad1 = $job1 = $phone1 = "";
$name2 = $mykad2 = $job2 = $phone2 = "";
$name1_err = $mykad1_err = $job1_err = $phone1_err = "";
$name2_err = $mykad2_err = $job2_err = $phone2_err = "";
$check_filled = "";
$err_arr = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    //Parent or guardian 1
    if(empty(trim($_POST["name1"]))){
        //$name1_err = "This field is required";
        $err_arr[0] = "This field is required";
    }
    else{
        $name1 = trim($_POST["name1"]);
    }

    if(empty(trim($_POST["mykad1"]))){
        //$mykad1_err = "This field is required";
        $err_arr[1] = "This field is required";
    }
    else{
        $mykad1 = trim($_POST["mykad1"]);
    }

    if(empty(trim($_POST["job1"]))){
        //$job1_err = "This field is required";
        $err_arr[2] = "This field is required";
    }
    else{
        $job1 = trim($_POST["job1"]);
    }

    if(empty(trim($_POST["phone1"]))){
        //$phone1_err = "This field is required";
        $err_arr[3] = "This field is required";
    }
    else{
        $phone1 = trim($_POST["phone1"]);
    }


    //parent or guardian 2
    if(empty(trim($_POST["name2"]))){
        //$name2_err = "This field is required";
        $err_arr[4] = "This field is required";
    }
    else{
        $name2 = trim($_POST["name2"]);
    }

    if(empty(trim($_POST["mykad2"]))){
        //$mykad2_err = "This field is required";
        $err_arr[5] = "This field is required";
    }
    else{
        $mykad2 = trim($_POST["mykad2"]);
    }

    if(empty(trim($_POST["job2"]))){
        //$job2_err = "This field is required";
        $err_arr[6] = "This field is required";
    }
    else{
        $job2 = trim($_POST["job2"]);
    }

    if(empty(trim($_POST["phone2"]))){
        //$phone2_err = "This field is required";
        $err_arr[7] = "This field is required";
    }
    else{
        $phone2 = trim($_POST["phone2"]);
    }

    if(empty($_POST["address"])){
        //$phone2_err = "This field is required";
        $err_arr[8] = "This field is required";
    }
    else{
        $address = strip_tags($_POST["address"]);
        //$address = $_POST["address"];
    }

    if(empty($err_arr)){
        $sql = "insert into parentguardian (username, name1, mykad1, job1, phone1, name2, mykad2, job2, phone2, address) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_username, $param_name1, $param_mykad1, $param_job1, $param_phone1, $param_name2, $param_mykad2, $param_job2, $param_phone2, $param_address);

            $param_username = $username;
            $param_name1 = $name1;
            $param_mykad1 = $mykad1;
            $param_job1 = $job1;
            $param_phone1 = $phone1;
            $param_name2 = $name2;
            $param_mykad2 = $mykad2;
            $param_job2 = $job2;
            $param_phone2 = $phone2;
            $param_address = $address;

            if(mysqli_stmt_execute($stmt)){

                $sql2 = "SELECT filled from users where username = ?";
                $stmt2 = mysqli_prepare($link, $sql2);
                mysqli_stmt_bind_param($stmt2, "s", $param_username);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_store_result($stmt2);
                mysqli_stmt_bind_result($stmt2, $check_filled);

                if($check_filled == "unfilled"){
                    $sql3 = "UPDATE users SET filled = 'filled' WHERE username = ?";
                    $stmt3 = mysqli_prepare($link, $sql3);
                    mysqli_stmt_bind_param($stmt3, "s", $param_username);
                    mysqli_stmt_execute($stmt3);
                }

                //header("location: pastiUserMain.php");
            }
            else{
                echo ("Error Description: ".mysqli_error($link));
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parents or Guardians Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <h2>Fill up</h2>
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <h3>Father or First Guardian</h3>
        <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name = "name1" class="form-control" value="<?php echo $name1; ?>">
            <span class="help-block"><?php echo $err_arr[0]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[1])) ? 'has-error' : ''; ?>">
            <label>MyKad Number</label>
            <input type="text" name = "mykad1" minlength="12" maxlength="12" class="form-control" value="<?php echo $mykad1; ?>">
            <span class="help-block"><?php echo $err_arr[1]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
            <label>Occupation</label>
            <input type="text" name = "job1" class="form-control" value="<?php echo $job1; ?>">
            <span class="help-block"><?php echo $err_arr[2]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[3])) ? 'has-error' : ''; ?>">
            <label>Phone Number</label>
            <input type="tel" name = "phone1" minlength="9" maxlength="11" class="form-control" value="<?php echo $phone1; ?>">
            <span class="help-block"><?php echo $err_arr[3]; ?></span>
        </div>

        <h3>Mother or Second Guardian</h3>
        <div class="form-group <?php echo (!empty($err_arr[4])) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name = "name2" class="form-control" value="<?php echo $name2; ?>">
            <span class="help-block"><?php echo $err_arr[4]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[5])) ? 'has-error' : ''; ?>">
            <label>MyKad Number</label>
            <input type="text" name = "mykad2" minlength="12" maxlength="12" class="form-control" value="<?php echo $mykad2; ?>">
            <span class="help-block"><?php echo $err_arr[5]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[6])) ? 'has-error' : ''; ?>">
            <label>Occupation</label>
            <input type="text" name = "job2" class="form-control" value="<?php echo $job2; ?>">
            <span class="help-block"><?php echo $err_arr[6]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[7])) ? 'has-error' : ''; ?>">
            <label>Phone Number</label>
            <input type="tel" name = "phone2" minlength="9" maxlength="11" class="form-control" value="<?php echo $phone2; ?>">
            <span class="help-block"><?php echo $err_arr[7]; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_arr[8])) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <textarea name="address" rows="5" cols="40"><?php echo $address;?></textarea>
            <span class="help-block"><?php echo $err_arr[8]; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
</body>