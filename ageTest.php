<?php

    if(isset($_POST["test"])){
        $dobinput = $_POST["dobinput"];
        $today = new Datetime(date("Y-m-d"));
        $bday = new Datetime(date("Y-m-d", strtotime($dobinput)));
        $diff = $today->diff($bday);
        printf('Your age is %d years old', $diff->Y);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Age Test</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Insert Age</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dobinput" class="form-control" value="<?php echo $dobinput; ?>">
            </div>
            <div class="form-group">
                <input type="submit" name="test" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body></html>