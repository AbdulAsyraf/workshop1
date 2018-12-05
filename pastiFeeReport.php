<?php
    
    require_once "../../configs/pastiConfig.php";
    
    $arr_fee = array(0, 0, 0);//[yes, no, total]
    $sql = "SELECT january, february, march, april, may, june, juluy, august, september, october, november FROM fee;";
    $result = mysqli_query($link, $sql);

    while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        for( $i = 0; $i < sizeof($rows), $i++){
            if($rows[$i] == "Yes")
                $arr_fee[0]++;
            elseif($rows[$i] == "No")
                $arr_fee[1]++;
            $arr_fee[2]++;
        }
    }

    echo $arr_fee;
?>