<?php
    $city['Россия']="Москва";
    $city['Франция']="Париж";
    $city['Германия']="Берлин";

    arsort($city);

    foreach($city as $str=>$ct){
        $conv_str = substr($str, 0, -2);
        echo("Столица {$conv_str}и это $ct <br>");
    }
?>