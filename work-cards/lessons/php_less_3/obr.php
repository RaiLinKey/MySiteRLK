<?php
    $nm=$_REQUEST['nm'];
    $sx=$_REQUEST['sx'];

    if(!$nm and !$sx){
        echo "Заполнены не все поля"
    }
    echo "Привет, nm";
?>