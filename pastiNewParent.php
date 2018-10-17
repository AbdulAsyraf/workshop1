<?php

require_once "../../configs/pastiConfig.php";

$fathername = $fathermykad = $fatherjob = "";
$fathername_err = $fathermykad_err = $fatherjob_err = "";
$mothername = $mothermykad = $motherjob = "";
$mothername_err = $mothermykad_err = $motherjob_err = "";



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
        <div class="form-group" >
            <input type="radio" name= "relation" value="Guardian" checked>Guardian<br>
            <input type="radio" name= "relation" value="Father" >Father<br>
            <input type="radio" name= "relation" value="Mother" >Mother<br>
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="fathername" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($mykad_err)) ? 'has-error' : ''; ?>">
            <label>MyKad Number</label>
            <input type="text" name="fathermykad" class="form-control" maxlength="12" value="<?php echo $mykad; ?>">
            <span class="help-block"><?php echo $mykad_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($job_err)) ? 'has-error' : ''; ?>">
            <label>Occupation</label>
            <input type="text" name="fatherjob" class="form-control" value="<?php echo $job; ?>">
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