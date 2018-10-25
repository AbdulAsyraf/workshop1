<?php

session_start();

$username = $_SESSION["username"];

require_once "../../configs/pastiConfig.php";

$name = $mykad = $job = $relation = $email = $phone = "";
$name_err = $mykad_err = $job_err = $relation_err = $email_err = $phone_err = "";
$check_filled = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!isset($_POST["relation"])){
        $relation_err = "Please select your relation with the child";
    }
    else{
        $relation = $_POST["relation"];
    }
    
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name";
    }
    else{
        $name = trim(($_POST["name"]));
    }

    if(empty(trim($_POST["mykad"]))){
        $mykad_err = "Please enter your mykad number";
    }
    else{
        $mykad = trim(($_POST["mykad"]));
    }

    if(empty(trim($_POST["job"]))){
        $job_err = "Please enter your occupation";
    }
    else{
        $job = trim($_POST["job"]);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address";
    }
    else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number";
    }
    else{
        $phone = trim($_POST["phone"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your address";
    }
    else{
        $address = trim($_POST["address"]);
    }

    if(empty($name_err) && empty($relation_err) && empty($mykad_err) && empty($job_err) && empty($email_err) && empty($address_err) && empty($phone_err)){
        $sql = "INSERT INTO adult (mykad, username, name, relationship, occupation, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_mykad, $param_username, $param_name, $param_relation, $param_job, $param_email, $param_phone, $param_address);

            $param_mykad = $mykad;
            $param_username = $username;
            $param_name = $name;
            $param_relation = $relation;
            $param_job = $job;
            $param_email = $email;
            $param_phone = $phone
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
                
                header("location: pastiUserMain.php");
            }
            else{
                echo "Something went wrong. Please try again later";
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
    <title>Adult Info</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <h2>Fill up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="form-radio <?php echo (!empty($relation_err)) ? 'has-error' : ''; ?>">
            <input type="radio" name= "relation" value="Guardian"> Guardian<br>
            <input type="radio" name= "relation" value="Father" > Father<br>
            <input type="radio" name= "relation" value="Mother" > Mother<br>
            <span class="help-block"><?php echo $relation_err; ?></span>
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mykad_err)) ? 'has-error' : ''; ?>">
            <label>MyKad Number</label>
            <input type="text" name="mykad" class="form-control" maxlength="12" value="<?php echo $mykad; ?>">
            <span class="help-block"><?php echo $mykad_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Phone Number</label>
            <input type="tel" name="phone" minlength="9" maxlength="11" class="form-control" value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($job_err)) ? 'has-error' : ''; ?>">
            <label>Occupation</label>
            <input type="text" name="job" class="form-control" value="<?php echo $job; ?>">
            <span class="help-block"><?php echo $job_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block"><?php echo $address_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>