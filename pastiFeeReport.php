<?php
    require_once "../../configs/pastiConfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page-header">
        <h1><b>Report for PASTI</b></h1>
    </div>

    <?php
    
    $fee_warning_threshold = 3;

    $arr_fee = array(0, 0, 0);//[yes, no, total]
    $sql = "SELECT * FROM fee;";
    $result = mysqli_query($link, $sql);
    //$rows = mysqli_fetch_array($result, MYSQLI_NUM);
    //echo count($rows);*/
    $arr_rows = [];
    //$arr_rows[] = $rows;
    while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $arr_rows[] = $rows;
    }
    
    for ($student = 0; $student < sizeof($arr_rows); $student++){
        for($month = 1; $month < 12; $month++){
            if($arr_rows[$student][$month] == "Yes"){
                $arr_fee[0]++;
            }
            elseif($arr_rows[$student][$month] == "No"){
                $arr_fee[1]++;
            }
            $arr_fee[2]++;
        }
    }    
    ?>

        <table border="1">
            <tr>
                <th>Student</th>
                <th>Father/Guardian</th>
                <th>Phone Number</th>
                <th>Mother/Guardian</th>
                <th>Phone Number</th>
                <th>Months Unpaid</th>
                <th>Amount Due</th>
            </tr>

    <?php
    for ($student = 0; $student < sizeof($arr_rows); $student++){
        $no_counter = 0;
        for($month = 1; $month < 12; $month++){
            if($arr_rows[$student][$month] == "Yes"){
                $arr_fee[0]++;
            }
            elseif($arr_rows[$student][$month] == "No"){
                $arr_fee[1]++;
                $no_counter++;
            }
            $arr_fee[2]++;
        }
        if($no_counter > $fee_warning_threshold){
            $mykid = $arr_rows[$student][0];
            $sql = "SELECT a.name, c.name1, c.phone1, c.name2, c.phone2 FROM student a, fee b, parentguardian c, users d WHERE b.mykid = a.mykid AND a.username = d.username AND d.username = c.username AND b.mykid = '" .$mykid. "';";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            echo "<tr>";
            for($i = 0; $i < 5; $i++){
                echo "<td>" .$row[$i]. "</td>";
            }
            $amt_due = $no_counter * 110;
            echo "<td>" .$no_counter. "</td>";
            echo "<td>RM " .$amt_due. "</td></tr>";
        }
    }

    $sqlnum4 = "SELECT mykid FROM student WHERE status = 'Approved' AND age = 4;";
    $result_num4 = mysqli_query($link, $sqlnum4);
    $num_stud4 = mysqli_num_rows($result_num4);

    $sqlnum5 = "SELECT mykid FROM student WHERE status = 'Approved' AND age = 5;";
    $result_num5 = mysqli_query($link, $sqlnum5);
    $num_stud5 = mysqli_num_rows($result_num5);

    $sqlnum6 = "SELECT mykid FROM student WHERE status = 'Approved' AND age = 6;";
    $result_num6 = mysqli_query($link, $sqlnum6);
    $num_stud6 = mysqli_num_rows($result_num6);

    //echo $arr_rows[0][2];
    $percentage = ($arr_fee[1]/$arr_fee[2])*100;
    if($percentage > 30)
        echo "Too much unpaid fees! Action is required";
    echo "<br>Paid fees: \tRM";
    echo $arr_fee[0]*110;
    echo "<br>Unpaid fees: \tRM";
    echo $arr_fee[1]*100;
    echo "<br>Number of 4 year old students: \t";
    echo $num_stud4;
    echo "<br>Number of 5 year old students: \t";
    echo $num_stud5;
    echo "<br>Number of 6 year old students: \t";
    echo $num_stud6;
    //echo "<br>Total: \t";
    //echo $arr_fee[2];
    //echo "<br>Percentage of unpaid fees: \t";
    //echo $percentage;
?>

<p><input type="button" value="Back" onclick="location='pastiLogin.php'"></p>

</body></html>