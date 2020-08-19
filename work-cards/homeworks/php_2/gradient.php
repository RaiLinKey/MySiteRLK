<table>
    <?php
        $r = 255;
        $g = 255;
        $n = 10;

        // $r_k = $r / $n;
        // $g_k = $g / $n;

        for($i=0;$i<$n;$i++){
            
            echo "<tr>";
                for($j=0;$j<$n;$j++){
                    if ($j % 2 == 0){
                    echo "<td bgcolor=rgb(0,$g,0)>$i-$j</td>";
                    
                    }
                    $g = $g - 10;
                }
            echo "</tr>";
            $r = $r - 10;
        }
    ?>
</table>