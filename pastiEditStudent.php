<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    if(isset($_POST["update"])){
        
        if(empty(trim($_POST["name"]))){
            $err_arr[0] = "Please enter student's name";
        }
        else{
            $name = trim($_POST["name"]);
        }
    
        if(empty(trim($_POST["dobinput"]))){
            $err_arr[1] = "Please enter student's date of birth";
        }
        else{
            $dobinput = trim($_POST["dobinput"]);
            $dob = date("Y-m-d", strtotime($dobinput));
        }
    
        if(empty(trim($_POST["mykid"]))){
            $err_arr[2] = "Please enter student's MyKid number";
        }
        else{
            $mykid = trim($_POST["mykid"]);
        }
    
        if(empty(trim($_POST["bc"]))){
            $err_arr[3] = "Please enter student's birth certificate number";
        }
        else{
            $bc = trim($_POST["bc"]);
        }
    
        if(empty(trim($_POST["address"]))){
            $err_arr[4] = "Please enter student's address";
        }
        else{
            $address = trim($_POST["address"]);
        }

        if(empty($err_arr)){

            $sql = "$UPDATE student SET name = ?, dob = ?, mykid = ?, bc = ?, address = ?, illness = ?, allergy = ? WHERE username = ?";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssssssss", $param[0], $param[1], $param[2], $param[3], $param[4], $param[5], $param[6], $param[7]);

                $param[0] = $name;
                $param[1] = $dob;
                $param[2] = $mykid;
                $param[3] = $bc;
                $param[4] = $address;
                $param[7] = $username;

                if(empty(trim($_POST["illness"]))){
                    $param[5] = NULL;
                }
                else{
                    $param[5] = trim($_POST["illness"]);
                }
    
                if(empty(trim($_POST["allergy"]))){
                    $param[6] = NULL;
                }
                else{
                    $param[6] = trim($_POST["allergy"]);
                }

                if(mysqli_stmt_execute($stmt)){
                    header("location: pastiUserMain.php");
                }
                else{
                    echo "Something went wrong. Please try again later";
                }
            }

        }
    }
    else if(isset($_POST["request"])){
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
</div>
</body></html>