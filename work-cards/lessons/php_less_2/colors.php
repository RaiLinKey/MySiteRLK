<table>
    <?php
        $n = 10;

        for($i=0;$i<10;$i++){
            echo "<tr>";
                for($j=0;$j<10;$j++){
                    if($i==$j){
                        $color = "#FF0000";
                    }
                    if($i+$j==$n-1){
                        $color = "#00FF00";
                    }
                    if (($i>$j) && ($i+$j>$n-1)){
                        $color = "#00FFFF";
                    }
                    if (($i<$j) && ($i+$j<$n-1)){
                        $color = "#555";
                    }
                    if (($i>$j) && ($i+$j<$n-1)){
                        $color = "#0000FF";
                    }
                    if (($i<$j) && ($i+$j>$n-1)){
                        $color = "#20AAAA";
                    }
                    echo "<td bgcolor=$color>$i-$j</td>";
                }
            echo "</tr>";
        }
    ?>
</table>