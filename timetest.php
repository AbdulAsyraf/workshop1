<?php

    require_once "../../configs/pastiConfig.php";

    $sql = "SELECT name, MONTH(applicationdate) as month, YEAR(applicationdate) as year FROM students;";
    $result = mysqli_query($link, $sql);

    echo "<table border='0'>
            <tr>
                <th>Name</th>
                <th>Month</th>
                <th>Year</th>
            </tr>";
    while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>";
            echo "<td>" . $rows["name"] . "</td>";
            echo "<td>" . $rows["month"] . "</td>";
            echo "<td>" . $rows["year"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

?>