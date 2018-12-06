<?php
    
    require_once "../../configs/pastiConfig.php";
    
    $arr_fee = array(0, 0, 0);//[yes, no, total]
    $sql = "SELECT january, february, march, april, may, june, july, august, september, october, november FROM fee;";
    $result = mysqli_query($link, $sql);
    //$rows = mysqli_fetch_array($result, MYSQLI_NUM);
    //echo count($rows);*/
    $arr_rows = [];
    //$arr_rows[] = $rows;
    while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $arr_rows[] = $rows;
    }
    echo sizeof($arr_rows);
    
    /*for ($x = 0; $x < 11; $x++){
        if($arr_rows[$i] == "Yes"){
            $arr_fee[0]++;
        }
        elseif($arr_rows[$i] == "No"){
            $arr_fee[1]++;
        }
        $arr_fee[2]++;
    }

    $rowLength = count($rows);
    for( $i = 0; $i < $rowLength, $i++){
        if($rows[$i] == "Yes"){
            $arr_fee[0]++;
        }
        elseif($rows[$i] == "No"){
            $arr_fee[1]++;
        }
        $arr_fee[2]++;
    }*/
    //echo $arr_rows[0][2];

    /*echo "Hi";
    echo $arr_fee[0];
    echo "Hi";
    echo $arr_fee[1];
    echo "Hi";
    echo $arr_fee[2];*/
?>