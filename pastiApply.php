<?php

require_once "pastiConfig.php";

//variable initialisation
$name = $dob = $mykid = $bc = $address = "";
$name_err = $dob_err = $mykid_err = $bc_err = $address_err = "";
$fathername = $fathermykad = $fatherjob = "";
$fathername_err = $fathermykad_err = $fatherjob_err = "";
$mothername = $mothermykad = $motherjob = "";
$mothername_err = $mothermykad_err = $motherjob_err = "";

//get form data
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter student's name.";
    }else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["dobinput"]))){
        $dob_err = "Please enter student's date of birth.";
    }else{
        $dobinput = trim($_POST["dobinput"]);
        $dob = date("Y-m-d", strtotime($dobinput));
    }

    if(empty(trim($_POST["mykid"]))){
        $mykid_err = "Please enter student's MyKid number.";
    }else{
        $mykid = trim($_POST["mykid"]);
    }

    if(empty(trim($_POST["bc"]))){
        $bc_err = "Please enter student's birth certificate number.";
    }else{
        $bc = trim($_POST["bc"]);
    }

    if(empty(trim($_POST["fathername"]))){
        $fathername_err = "Please enter student's father's name.";
    }else{
        $fathername = trim($_POST["fathername"]);
    }

    if(empty(trim($_POST["fathermykad"]))){
        $fathermykad_err = "Please enter student's father's MyKad number.";
    }else{
        $fathermykad = trim($_POST["fathermykad"]);
    }

    if(empty(trim($_POST["fatherjob"]))){
        $fatherjob_err = "Please enter student's father's occupation.";
    }else{
        $fatherjob = trim($_POST["fatherjob"]);
    }

    if(empty(trim($_POST["mothername"]))){
        $mothername_err = "Please enter student's mother's name.";
    }else{
        $mothername = trim($_POST["mothername"]);
    }

    if(empty(trim($_POST["mothermykad"]))){
        $mothermykad_err = "Please enter student's mother's MyKad number.";
    }else{
        $mothermykad = trim($_POST["mothermykad"]);
    }

    if(empty(trim($_POST["motherjob"]))){
        $motherjob_err = "Please enter student's mother's occupation.";
    }else{
        $motherjob = trim($_POST["motherjob"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter student's address.";
    }else{
        $address = trim($_POST["address"]);
    }


    if(empty($name_err) && empty($dob_err) && empty($mykid_err) && empty($bc_err) && empty($fathername_err) && empty($fathermykad_err) && empty($fatherjob_err) && empty($mothername_err) && empty($mothermykadd_err) && empty($motherjob_err) && empty($address_err)){

        $sql = "INSERT INTO student (name, mykid, dob, bc, fathername, fathermykad, fatherjob, mothername, mothermykad, motherjob, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_name, $param_mykid, $param_dob, $param_bc, $param_fathername, $param_fathermykad, $param_fatherjob, $param_mothername, $param_mothermykad, $param_motherjob, $param_address);

            $param_name = $name;
            $param_dob = $dob;
            $param_mykid = $mykid;
            $param_bc = $bc;
            $param_fathername = $fathername;
            $param_fathermykad = $fathermykad;
            $param_fatherjob = $fatherjob;
            $param_mothername = $mothername;
            $param_mothermykad = $mothermykad;
            $param_motherjob = $motherjob;
            $param_address = $address;


            if(mysqli_stmt_execute($stmt)){
                header("location: pastiUserMain.php");
            }
            else{
                echo "Something went wrong. Please try again later.";
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
    <title>New Application</title></head>
    <style type="text/css"></style>
<body>
<div class="wrapper">
    <h2>Fill up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mykid_err)) ? 'has-error' : ''; ?>">
            <label>MyKid Number</label>
            <input type="text" name="mykid" class="form-control" maxlength= "12" value="<?php echo $mykid; ?>">
            <span class="help-block"><?php echo $mykid_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
            <label>Date of Birth</label>
            <input type="date" name="dobinput" class="form-control" value="<?php echo $dobinput; ?>">
            <span class="help-block"><?php echo $dob_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($bc_err)) ? 'has-error' : ''; ?>">
            <label>Birth Certificate Number</label>
            <input type="text" name="bc" class="form-control" value="<?php echo $bc; ?>">
            <span class="help-block"><?php echo $bc_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($fathername_err)) ? 'has-error' : ''; ?>">
            <label>Father's Name</label>
            <input type="text" name="fathername" class="form-control" value="<?php echo $fathername; ?>">
            <span class="help-block"><?php echo $fathername_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($fathermykad_err)) ? 'has-error' : ''; ?>">
            <label>Father's MyKad Number</label>
            <input type="text" name="fathermykad" class="form-control" maxlength="12" value="<?php echo $fathermykad; ?>">
            <span class="help-block"><?php echo $fathermykad_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($fatherjob_err)) ? 'has-error' : ''; ?>">
            <label>Father's Occupation</label>
            <input type="text" name="fatherjob" class="form-control" value="<?php echo $fatherjob; ?>">
            <span class="help-block"><?php echo $fatherjob_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mothername_err)) ? 'has-error' : ''; ?>">
            <label>Mother's Name</label>
            <input type="text" name="mothername" class="form-control" value="<?php echo $mothername; ?>">
            <span class="help-block"><?php echo $mothername_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mothermykad_err)) ? 'has-error' : ''; ?>">
            <label>Mother's MyKad Number</label>
            <input type="text" name="mothermykad" class="form-control" maxlength="12" value="<?php echo $mothermykad; ?>">
            <span class="help-block"><?php echo $mothermykad_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($motherjob_err)) ? 'has-error' : ''; ?>">
            <label>Mother's Occupation</label>
            <input type="text" name="motherjob" class="form-control" value="<?php echo $motherjob; ?>">
            <span class="help-block"><?php echo $motherjob_err; ?></span>
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
</div>
</body></html>
