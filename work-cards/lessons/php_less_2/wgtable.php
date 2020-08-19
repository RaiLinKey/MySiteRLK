<table>
    <?php

        for($i=0;$i<10;$i++){
            
            echo "<tr>";
                for($j=0;$j<10;$j++){
                    if ($j%2 == 0){
                        $color="white";
                    } else {
                        $color = "grey";
                    }
                    echo "<td bgcolor=$color>$i-$j</td>";

                }
            echo "</tr>";
        }
    ?>
</table>