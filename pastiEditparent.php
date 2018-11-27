<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    if(isset($_POST["update"])){
        if(empty(trim($_POST["name1"]))){
            //$name1_err = "This field is required";
            $err_arr[0] = "This field is required";
        }
        else{
            $newname1 = trim($_POST["name1"]);
            if($newname1 != $name1){
                $sql = "UPDATE parentguardian SET name1 = '".$newname1."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["mykad1"]))){
            //$mykad1_err = "This field is required";
            $err_arr[1] = "This field is required";
        }
        else{
            $newmykad1 = trim($_POST["mykad1"]);
            if($newmykad1 != $mykad1){
                $sql = "UPDATE parentguardian SET mykad1 = '".$newmykad1."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["job1"]))){
            //$job1_err = "This field is required";
            $err_arr[2] = "This field is required";
        }
        else{
            $newjob1 = trim($_POST["job1"]);
            if($newjob1 != $job1){
                $sql = "UPDATE parentguardian SET job1 = '".$newjob1."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["phone1"]))){
            //$phone1_err = "This field is required";
            $err_arr[3] = "This field is required";
        }
        else{
            $newphone1 = trim($_POST["phone1"]);
            if($newphone1 != $phone1){
                $sql = "UPDATE parentguardian SET phone1 = '".$newphone1."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
    
        //parent or guardian 2
        if(empty(trim($_POST["name2"]))){
            //$name2_err = "This field is required";
            $err_arr[4] = "This field is required";
        }
        else{
            $newname2 = trim($_POST["name2"]);
            if($newname2 != $name2){
                $sql = "UPDATE parentguardian SET name2 = '".$newname2."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["mykad2"]))){
            //$mykad2_err = "This field is required";
            $err_arr[5] = "This field is required";
        }
        else{
            $newmykad2 = trim($_POST["mykad2"]);
            if($newmykad2 != $mykad2){
                $sql = "UPDATE parentguardian SET mykad2 = '".$newmykad2."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["job2"]))){
            //$job2_err = "This field is required";
            $err_arr[6] = "This field is required";
        }
        else{
            $newjob2 = trim($_POST["job2"]);
            if($newjob2 != $job2){
                $sql = "UPDATE parentguardian SET job2 = '".$newjob2."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["phone2"]))){
            //$phone2_err = "This field is required";
            $err_arr[7] = "This field is required";
        }
        else{
            $newphone2 = trim($_POST["phone2"]);
            if($newphone2 != $phone2){
                $sql = "UPDATE parentguardian SET phone2 = '".$newphone2."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty($_POST["address"])){
            //$phone2_err = "This field is required";
            $err_arr[8] = "This field is required";
        }
        else{
            $newaddress = strip_tags($_POST["address"]);
            if($newaddress != $address){
                $sql = "UPDATE parentguardian SET address = '".$newaddress."' WHERE username = '".$username."';";
                mysqli_query($link, $sql);
            }
            //$address = $_POST["address"];
        }

        unset($_POST["update"]);
    }
    else {
        $username = $_SESSION["username"];
        $query = "SELECT name1, mykad1, job1, phone1, name2, mykad2, job2, phone2, address FROM parentguardian WHERE username = '".$username."';";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $name1 = $row["name1"];
        $mykad1 = $row["mykad1"];
        $job1 = $row["job1"];
        $phone1 = $row["phone1"];
        $name2 = $row["name2"];
        $mykad2 = $row["mykad2"];
        $job2 = $row["job2"];
        $phone2 = $row["phone2"];
        $address = $row["address"];
    }

    mysqli_free_result($result);
    mysqli_close($link);

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

        <!--
        <div class="form-group <?php echo (!empty($err_arr[8])) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <textarea name="address" rows="5" cols="40"><?php echo $address;?></textarea>
            <span class="help-block"><?php echo $err_arr[8]; ?></span>
        </div>
        -->

        <div class="form-group <?php echo (!empty($err_arr[8])) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class = "help-block"><?php echo $err_arr[8]; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" name="update" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
        <input type="button" value="Cancel" onclick="location='pastiUserMain.php'">

</div>
</body></html>