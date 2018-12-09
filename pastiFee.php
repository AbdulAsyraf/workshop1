<?php

    session_start();

    $usertype = $_SESSION["usertype"];
    require_once "../../configs/pastiConfig.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mykid = $_POST["who"];
        $month = $_POST["when"];
        //$status = $_POST["status"];
        $sql = "SELECT " .$month. " FROM fee WHERE mykid = '" .$mykid. "';";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result);
        $test = $row[0];
        echo $_POST["what"];

        if($usertype == 1){
            if($test != "N/A"){
                $query = "UPDATE fee SET " .$month. " = 'Yes' WHERE mykid = '" .$mykid. "';";
                mysqli_query($link, $query);
            }
        }
        elseif($usertype == 2){
            $what = $_POST["what"];
            $query = "UPDATE fee SET " .$month. " = '" .$what. "' WHERE mykid = '" .$mykid. "';";
            mysqli_query($link, $query);
        }
        //header("location: pastiFee.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fee</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        $now = date("n");
        $sql = "SELECT a.name, a.mykid AS mykid, b.name1, b.phone1, b.name2, b.phone2, c.* FROM student a, parentguardian b, fee c WHERE a.username = b.username AND a.mykid = c.mykid;";
        $result = mysqli_query($link, $sql);
        while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $mykid = $rows["mykid"];
            switch($now){
                case 11:
                    if($rows["november"] == "N/A"){
                        $sql = "UPDATE fee SET november = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 10:
                    if($rows["october"] == "N/A"){
                        $sql = "UPDATE fee SET october = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 9:
                    if($rows["september"] == "N/A"){
                        $sql = "UPDATE fee SET september = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 8:
                    if($rows["august"] == "N/A"){
                        $sql = "UPDATE fee SET august = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 7:
                    if($rows["july"] == "N/A"){
                        $sql = "UPDATE fee SET july = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 6:
                    if($rows["june"] == "N/A"){
                        $sql = "UPDATE fee SET june = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 5:
                    if($rows["may"] == "N/A"){
                        $sql = "UPDATE fee SET may = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 4:
                    if($rows["april"] == "N/A"){
                        $sql = "UPDATE fee SET april = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 3:
                    if($rows["march"] == "N/A"){
                        $sql = "UPDATE fee SET march = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 2:
                    if($rows["february"] == "N/A"){
                        $sql = "UPDATE fee SET february = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
                case 1:
                    if($rows["january"] == "N/A"){
                        $sql = "UPDATE fee SET january = 'No' WHERE mykid = '" .$mykid. "';";
                        mysqli_query($link, $sql);
                        break;
                    }
            }
        }
        $sql = "SELECT a.name, a.mykid AS mykid, b.name1, b.phone1, b.name2, b.phone2, c.* FROM student a, parentguardian b, fee c WHERE a.username = b.username AND a.mykid = c.mykid;";
        $result = mysqli_query($link, $sql);
        
        echo "<table border='1'>
                    <tr>
                        <th>Name</th>
                        <th>MyKid</th>
                        <th>Father's/Guardian's Name</th>
                        <th>Phone Number</th>
                        <th>Mother's/Guardian's Name</th>
                        <th>Phone Number</th>";

        echo "  <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
            </tr>";
        
        
        
        while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr>
                    <td>" . $rows["name"] . "</td>
                    <td>" . $rows["mykid"] . "</td>
                    <td>" . $rows["name1"] . "</td>
                    <td>" . $rows["phone1"] . "</td>
                    <td>" . $rows["name2"] . "</td>
                    <td>" . $rows["phone2"] . "</td>";
            
            echo "<td>" . $rows["january"] . "</td>";
            echo "<td>" . $rows["february"] . "</td>";
            echo "<td>" . $rows["march"] . "</td>";
            echo "<td>" . $rows["april"] . "</td>";
            echo "<td>" . $rows["may"] . "</td>";
            echo "<td>" . $rows["june"] . "</td>";
            echo "<td>" . $rows["july"] . "</td>";
            echo "<td>" . $rows["august"] . "</td>";
            echo "<td>" . $rows["september"] . "</td>";
            echo "<td>" . $rows["october"] . "</td>";
            echo "<td>" . $rows["november"] . "</td>";
            
            /*switch($now){
                case 11: default:
                    echo "<td>" . $rows["november"] . "</td>";
                case 10:
                    echo "<td>" . $rows["october"] . "</td>";
                case 9:
                    echo "<td>" . $rows["september"] . "</td>";
                case 8:
                    echo "<td>" . $rows["august"] . "</td>";
                case 7:
                    echo "<td>" . $rows["july"] . "</td>";
                case 6:
                    echo "<td>" . $rows["june"] . "</td>";
                case 5:
                    echo "<td>" . $rows["may"] . "</td>";
                case 4:
                    echo "<td>" . $rows["april"] . "</td>";
                case 3:
                    echo "<td>" . $rows["march"] . "</td>";
                case 2:
                    echo "<td>" . $rows["february"] . "</td>";
                case 1:
                    echo "<td>" . $rows["january"] . "</td>";
                    break;
            }*/
            echo "</tr>";
        }
        echo "</table>";

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <p><select name="who">
                <option disabled selected value> --Select a student-- </option>
                <?php
                    $sql = "SELECT a.name, b.mykid FROM student a, fee b WHERE a.mykid = b.mykid;";
                    $result = mysqli_query($link, $sql);
                    while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        echo "<option value='".$rows["mykid"]."'>".$rows["name"]."\t".$rows["mykid"]."</option>";
                    }
                ?>
            </select></p>
        </div>

        <div class="form-group">
            <p><select name="when">
                <option disabled selected value> --Select a month-- </option>
                <?php
                    $now = date("n");
                    switch($now){
                        case 11: default:
                            echo "<option value='november'>November</option>";
                        case 10:
                            echo "<option value='october'>October</option>";
                        case 9:
                            echo "<option value='september'>September</option>";
                        case 8:
                            echo "<option value='august'>August</option>";
                        case 7:
                            echo "<option value='july'>July</option>";
                        case 6:
                            echo "<option value='june'>June</option>";
                        case 5:
                            echo "<option value='may'>May</option>";
                        case 4:
                            echo "<option value='april'>April</option>";
                        case 3:
                            echo "<option value='march'>March</option>";
                        case 2:
                            echo "<option value='february'>February</option>";
                        case 1:
                            echo "<option value='january'>January</option>";
                            break;                            
                    }
                ?>
            </select></p>
        </div>
        
        <div class="form-group">
            <!--p><select name="status"-->
                <!--<option value="No">No</option>
                <option value="Yes">Yes</option>-->
            <?php
            
                if($usertype == 1)
                    echo "<p><input type='submit' value='Confirm Payment' class='btn btn-primary'></p>";
                elseif($usertype == 2){
                    echo "<p><select name = 'what'>
                            <option value='N/A'>N/A</option>
                            <option value='No'>No</option>
                            <option value='Yes'>Yes</option>
                        </select></p>
                        <p><input type = 'submit' value = 'Ok' class = 'btn btn-primary'></p>";
                }
            
            ?>
            <!--/select></p-->
        </div>

        <!--<div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>-->
    </form>
        <input type="button" value="Back" onclick="location='pastiLogin.php'">
</body>
</html>