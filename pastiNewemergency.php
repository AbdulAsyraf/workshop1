<?php

    session_start();

    $username = $_SESSION["username"];

    require_once "../../configs/pastiConfig.php";

    $err_arr = [];

    $name = $phone = $relation = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emergency Contact</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Fill up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($err_arr[0])) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                <span class="help-block"><?php echo $err_arr[0];?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_arr[1)) ? 'has-error' : ''; ?>">
                <label>Relationship</label>
                <input type="text" name="relation" class="form-control" value="<?php echo $relation;?>">
                <span class="help-block"><?php echo $err_arr[1];?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_arr[2])) ? 'has-error' : ''; ?>">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone;?>">
                <span class="help-block"><?php echo $err_arr[2];?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>