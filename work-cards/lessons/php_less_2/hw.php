<?php
    $day = 16;
    $month = 2;
    $year = 2004;

    if ($year % 4 == 0){
        echo("Вы родились в високосный год ");
    } else {
        echo("Вы родились в невисокосный год ");
    }
    $anim_year = $year % 12;
    switch ($anim_year){
        case 0:
            echo("обезьяны.<br>");
            break;
        case 1:
            echo("петуха.<br>");
            break;
        case 2:
            echo("собаки.<br>");
            break;
        case 3:
            echo("свиньи.<br>");
            break;
        case 4:
            echo("крысы.<br>");
            break;
        case 5:
            echo("быка.<br>");
            break;
        case 6:
            echo("тигра.<br>");
            break;
        case 7:
            echo("кролика.<br>");
            break;
        case 8:
            echo("дракона.<br>");
            break;
        case 9:
            echo("змеи.<br>");
            break;
        case 10:
            echo("лошади.<br>");
            break;
        case 11:
            echo("овцы.<br>");
            break;
        default:
            echo("Что-то пошло не так.<br>");
    }
    echo("По знаку зодиака Вы: ");
    if(($day >= 21 && $month == 1) || ($day <= 19 && $month == 2)){
        echo("водолей.");
    }
    if(($day >= 20 && $month == 2) || ($day <= 20 && $month == 3)){
        echo("рыбы.");
    }
    if(($day >= 21 && $month == 3) || ($day <= 20 && $month == 4)){
        echo("овен.");
    }
    if(($day >= 21 && $month == 4) || ($day <= 21 && $month == 5)){
        echo("телец.");
    }
    if(($day >= 22 && $month == 5) || ($day <= 21 && $month == 6)){
        echo("близнецы.");
    }
    if(($day >= 22 && $month == 6) || ($day <= 23 && $month == 7)){
        echo("рак.");
    }
    if(($day >= 24 && $month == 7) || ($day <= 23 && $month == 8)){
        echo("лев.");
    }
    if(($day >= 24 && $month == 8) || ($day <= 23 && $month == 29)){
        echo("водолей.");
    }
    if(($day >= 24 && $month == 9) || ($day <= 23 && $month == 10)){
        echo("водолей.");
    }
    if(($day >= 24 && $month == 10) || ($day <= 22 && $month == 11)){
        echo("водолей.");
    }
    if(($day >= 23 && $month == 11) || ($day <= 21 && $month == 12)){
        echo("водолей.");
    }
    if(($day >= 22 && $month == 12) || ($day <= 20 && $month == 1)){
        echo("водолей.");
    }
    
?>