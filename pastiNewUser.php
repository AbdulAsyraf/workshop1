<?php

require_once "../../configs/pastiConfig.php";

$username = $password = "";
$username_err = $password_err = "";

//get data from form after submission
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"])))
        $username_err = "Please enter a username.";
    else{
        //sql statement prep to check for existing username
        $sql = "SELECT username FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to prepped statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //assigning value to to parameters
            $param_username = trim($_POST["username"]);

            //execute sql statement (if valid)
            if(mysqli_stmt_execute($stmt)){

                //store result to manipulate
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                    $username_err = "An account with this username already exists.";
                else
                    $username = trim($_POST["username"]);
            }
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    //password stuff
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must be at least 6 characters.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //confirm the password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }

    //check for errors before modifying database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: pastiLogin.php");
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
    <title>New Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{width: 350px; padding: 20px; }
    </style>
<body>
<div class="wrapper">
    <h2>Register</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>IC Number</label>
            <input type="text" name="username" class="form-control" maxlength="12" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="pastiLogin.php">Login here</a>.</p>
    </form>
</div>
</body></html>

