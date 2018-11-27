<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    //$mykidInit = $_POST["choice"];

    if(isset($_POST["update"])){
        
        $mykidInit = $_SESSION["mykid"];

        if(empty(trim($_POST["name"]))){
            $err_arr[0] = "Please enter student's name";
        }
        else{
            $name2 = trim($_POST["name"]);
            if ($name2 != $name){
                $sql = "UPDATE student SET name = '".$name2."' WHERE mykid = '".$mykidInit."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["dobinput"]))){
            $err_arr[1] = "Please enter student's date of birth";
        }
        else{
            $dobinput = trim($_POST["dobinput"]);
            $dob2 = date("Y-m-d", strtotime($dobinput));
            
            $today = new Datetime(date("Y-m-d"));
            $bday = new Datetime($dob2);
            $diff = $today->diff($bday);
            $age = $diff->format('%y');
            $sql = "UPDATE student SET dob = '".$dob2."', age = ".$age." WHERE mykid = '".$mykidInit."';";
            mysqli_query($link, $sql);
        }

        
    
        if(empty(trim($_POST["mykid"]))){
            $err_arr[2] = "Please enter student's MyKid number";
        }
        else{
            $mykid2 = trim($_POST["mykid"]);
            if($mykid2 != $mykid){
                $sql = "UPDATE student SET mykid = '".$mykid2."' WHERE mykid = '".$mykidInit."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["bc"]))){
            $err_arr[3] = "Please enter student's birth certificate number";
        }
        else{
            $bc2 = trim($_POST["bc"]);
            if($bc2 != $bc){
                $sql = "UPDATE student SET bc = '".$bc2."' WHERE mykid = '".$mykidInit."';";
                mysqli_query($link, $sql);
            }
        }
    
        if(empty(trim($_POST["address"]))){
            $err_arr[4] = "Please enter student's address";
        }
        else{
            $address2 = trim($_POST["address"]);
            if($address2 != $address){
                $sql = "UPDATE student SET address = '".$address2."' WHERE mykid = '".$mykidInit."';";
                mysqli_query($link, $sql);
            }
        }

        if(empty(trim($_POST["illness"]))){
            $illness = NULL;
            $sql = "UPDATE student SET illness = NULL WHERE mykid = '".$mykidInit."';";
            mysqli_query($link, $sql);
        }
        else{
            $illness = trim($_POST["illness"]);
            $sql = "UPDATE student SET illness = '".$illness."' WHERE mykid = '".$mykidInit."';";
            mysqli_query($link, $sql);
        }

        if(empty(trim($_POST["allergy"]))){
            $allergy = NULL;
            $sql = "UPDATE student SET allergy = NULL WHERE mykid = '".$mykidInit."';";
            mysqli_query($link, $sql);
        }
        else{
            $allergy = trim($_POST["allergy"]);
            $sql = "UPDATE student SET allergy = '".$allergy."' WHERE mykid = '".$mykidInit."';";
            mysqli_query($link, $sql);
        }

        if(empty($err_arr)){
            unset($_SESSION["mykid"]);
            header("location: pastiUserMain.php");
        }
        else{
            echo "Something went wrong. Please try again";
        }
    }
    else if(isset($_POST["request"])){
        $_SESSION["mykid"] = $mykid = $mykidInit = $_POST["choice"];
        $query = "SELECT name, dob, bc, address, illness, allergy FROM student WHERE mykid = '".$mykidInit."'";
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


        unset($_POST["request"]);

    }

    mysqli_stmt_close($stmt);
    mysqli_free_result($result);
    mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Informtion Editing</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <h2>Fill up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
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
        <div class="form-group <?php echo (!empty($err_arr[3])) ? 'has-error' : ''; ?>">
            <label>Birth Certificate Number</label>
            <input type="text" name="bc" class="form-control" value="<?php echo $bc; ?>">
            <span class="help-block"><?php echo $err_arr[3]; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($err_arr[4])) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block"><?php echo $err_arr[4]; ?></span>
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
            <input type="submit" name="update" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
        <input type="button" value="Cancel" onclick="location='pastiUserMain.php'">
</div>
</body></html>