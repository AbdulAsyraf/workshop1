<?php

    session_start();

    require_once "../../configs/pastiConfig.php";

    if(isset($_POST["search"])){
        if(!empty(trim($_POST["term"]))){
            $term = trim($_POST["term"]);
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_POST['PHP_SELF']); ?>" method="post">
    <div class="form-group">
        <label>Search</label>
        <input type="text" name="term" class="form-control" value = "<?php echo $term; ?>">
    </div>

    <div class="form-group">
        <input type="submit" name="search" class="btn btn-primary" value="Search">
</body></html>