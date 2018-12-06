<?php
    
    require_once "../../configs/pastiConfig.php";
    
    $arr_fee = array(0, 0, 0);//[yes, no, total]
    $sql = "SELECT january, february, march, april, may, june, july, august, september, october, november FROM fee;";
    $result = mysqli_query($link, $sql);

    while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $rowLength = count($rows);
        for( $i = 0; $i < $rowLength, $i++){
            if($rows[$i] == "Yes"){
                $arr_fee[0]++;
            }
            elseif($rows[$i] == "No"){
                $arr_fee[1]++;
            }
            $arr_fee[2]++;
        }
    }

    echo "Hi";
    echo $arr_fee[0];
    echo "Hi";
    echo $arr_fee[1];
    echo "Hi";
    echo $arr_fee[2];
?>