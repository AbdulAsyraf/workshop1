<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mykid = $_POST["choice"];
        $query = "SELECT name, dob, bc, address, illness, allergy FROM student WHERE mykid = '".$mykid."'";
        $result = mysqli_query($link, $query);
        
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $dob =$row["dob"];
        $bc = $row["bc"];
        $address = $row["address"];
        if($row["illness"] == NULL)
            $illness = NULL;
        else
            $illness = $row["illness"];

        if($row["allergy"] == NULL)
            $allergy = NULL;
        else
            $allergy =$row["allergy"];

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
        <div class="form-group <?php echo (!empty($nerr_arr[0])) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $err_arr[0]; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($err_arr[1])) ? 'has-error' : ''; ?>">
            <label>Date of Birth</label>
            <input type="date" name="dobinput" class="form-control" value="<?php echo $dob; ?>">
            <span class="help-block"><?php echo $err_arr[1]; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
            <label>MyKid</label>
            <input type="text" name="mykid" class="form-control" maxlength="12" value="<?php echo $mykid; ?>">
            <span class="help-block"><?php echo $err_arr[2]; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
            <label>Birth Certificate Number</label>
            <input type="text" name="bc" class="form-control" value="<?php echo $bc; ?>">
            <span class="help-block"><?php echo $err_arr[2]; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($err_arr[3])) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block"><?php echo $err_arr[3]; ?></span>
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