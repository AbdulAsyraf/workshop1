<?php

session_start();

$username = $_SESSION["username"];

require_once "../../configs/pastiConfig.php";

$fathername = $fathermykad = $fatherjob = "";
$fathername_err = $fathermykad_err = $fatherjob_err = "";
$mothername = $mothermykad = $motherjob = "";
$mothername_err = $mothermykad_err = $motherjob_err = "";
$name = $mykad = $job = $relation = "";
$name_err = $mykad_err = $job_err = $relation_err = "";

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

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your address";
    }
    else{
        $address = trim($_POST["address"]);
    }

    if(empty($name_err) && empty($relation_err) && empty($mykad_err) && empty($job_err) && empty($address_err)){
        $sql = "INSERT INTO adult (mykad, username, name, relation, occupation, address) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_mykad, $param_username, $param_name, $param_relation, $param_job, $param_address);

            $param_mykad = $mykad;
            $param_username = $username;
            $param_name = $name;
            $param_relation = $relation;
            $param_job = $job;
            $param_address = $address;

            if(mysqli_stmt_execute($stmt)){
                $sql2 = "UPDATE users SET filled = 'filled' WHERE username = ?";
                $stmt2 = mysqli_prepare($link, $sql2);
                mysqli_stmt_bind_param($stmt2, "s", $param_username);
                $param_username = $username;
                mysqli_stmt_execute($stmt2);
                
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