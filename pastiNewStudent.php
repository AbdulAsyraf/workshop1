<?php

session_start();

$username = $_SESSION["username"];

require_once "../../configs/pastiConfig.php";

$name = $dob = $mykid = $bc = $address = $illness = $allergy = "";
$name_err = $dob_err = $mykid_err = $bc_err = $address_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter student's name";
    }
    else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["dobinput"]))){
        $dob_err = "Please enter student's date of birth";
    }
    else{
        $dobinput = trim($_POST["dobinput"]);
        $dob = date("Y-m-d", strtotime($dobinput));
    }

    if(empty(trim($_POST["mykid"]))){
        $mykid_err = "Please enter student's MyKid number";
    }
    else{
        $mykid = trim($_POST["mykid"]);
    }

    if(empty(trim($_POST["bc"]))){
        $bc_err = "Please enter student's birth certificate number";
    }
    else{
        $bc = trim($_POST["bc"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter student's address";
    }
    else{
        $address = trim($_POST["address"]);
    }

    if(empty($name_err) && empty($dob_err) && empty($mykid_err) && empty($bc_err) && empty($address_err)){

        $sql = "INSERT INTO student (mykid, username, name, dob, bc, address, illness, allergy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_mykid, $param_username, $param_name, $param_dob, $param_bc, $param_address, $param_illness, $param_allergy);

            $param_mykid = $mykid;
            $param_username = $username;
            $param_name = $name;
            $param_dob = $dob;
            $param_bc = $bc;
            $param_address = $address;

            if(empty(trim($_POST["illness"]))){
                $param_illness = NULL;
            }
            else{
                $param_illness = trim($_POST["illness"]);
            }

            if(empty(trim($_POST["allergy"]))){
                $param_allergy = NULL;
            }
            else{
                $param_allergy = trim($_POST["allergy"]);
            }

            if(mysqli_stmt_execute($stmt)){
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
    <title>New Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <h2>Fill up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
            <label>Date of Birth</label>
            <input type="date" name="dobinput" class="form-control" value="<?php echo $dobinput; ?>">
            <span class="help-block"><?php echo $dob_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mykid_err)) ? 'has-error' : ''; ?>">
            <label>MyKid</label>
            <input type="text" name="mykid" class="form-control" maxlength="12" value="<?php echo $mykid; ?>">
            <span class="help-block"><?php echo $mykid_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($bc_err)) ? 'has-error' : ''; ?>">
            <label>Birth Certificate Number</label>
            <input type="text" name="bc" class="form-control" value="<?php echo $bc; ?>">
            <span class="help-block"><?php echo $bc_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block"><?php echo $address_err; ?></span>
        </div>
        <div class="form-group">
            <label>Illness (if any)</label>
            <input type="text" name="illness" class="form-control" value="<?php echo $illness; ?>">
        </div>
        <div class="form-group">
            <label>Allergies (if any)</label>
            <input type="text" name="allergy" class="form-control" value="<?php echo $allergy; ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
</div>
</body></html>