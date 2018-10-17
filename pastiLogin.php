<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["usertype"] === 0){
        header("location: pastiUserMain.php");
        exit;
    }
    elseif($_SESSION["usertype"] === 1){
        header("location: pastiTeacherMain.php");
        exit;
    }
    elseif($_SESSION["usertype"] === 2){
        header("location: pastiAdminMain.php");
        exit;
    }
}

require_once "../../configs/pastiConfig.php";

$username = $password = $usertype = "";
$username_err = $password_err = "";
$check_filled = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //check for empty username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    else{
        $username = trim(($_POST["username"]));
    }

    //check for empty password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //look for username+password combo in db
    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT username, password, usertype, filled FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                //1 means username exists, not 1 is wrong username
                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $usertype, $check_filled);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["usertype"] = $usertype;

                            if($usertype === 0){
                                if($check_filled !== "unfilled")
                                    header("location: pastiUserMain.php");
                                else
                                    header("location: pastiNewParent.php");
                            }
                            elseif($usertype === 1){
                                header("location: pastiTeacherMain.php");
                            }
                            elseif($usertype === 2){
                                header("location: pastiAdminMain.php");
                            }
                        }
                        else{
                            //in case of wrong password
                            $password_err = "The password you entered was not valid.";
                        }
                    }

                }
                else{
                    //in case of wrong username
                    $username_err = "No user found with that username.";
                }
            }
            else{
                //mysql server offline or other errors
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="cheat.css">
    <style>
        .wrapper{
            width: 600px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in the form to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" maxlength="12" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="button">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p><a href="pastiNewUser.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>