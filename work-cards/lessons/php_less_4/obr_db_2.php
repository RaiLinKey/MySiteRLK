<style>
    * {
        padding: 0;
        margin: 0;
        font-family: "Roboto Condensed", sans-serif;
    }
    
    .wrapper{
        width: 100%;
        height: 100%;
        display: grid;
        grid-template: [start] "post-1 post-2 post-3" 1fr [row2] 
                    [row2] "post-4 post-5 post-6"  1fr [row3]
                    [row3] "post-7 post-8 post-9" 1fr [row-end] / 1fr 1fr 1fr;
    }
    table {
        grid-area: post-5;
        vertical-align: middle;
        border: 1px solid black;
    }
    td {
        padding: 3px;
        border-left: 1px solid black;
        border-right: 1px solid black;
        margin: 0;
    }
    .links{
        grid-area: post-8;
        color: black;
    }
</style>
<div class='wrapper'>
    <table align='center'>
        <tr>
            <td style="border-bottom: 1px solid black;">Фамилия</td>
            <td style="border-bottom: 1px solid black;">Имя</td>
            <td style="border-bottom: 1px solid black;">Отчество</td>
            <td style="border-bottom: 1px solid black;">Должность</td>
            <td style="border-bottom: 1px solid black;">ЗП</td>
        </tr>
        <?php
            $link = mysqli_connect("localhost", "root","Tumb3228ler");
            mysqli_select_db($link,"frm");
            mysqli_query($link, "SET NAMES 'utf8'"); 
            mysqli_query($link, "SET CHARACTER SET 'utf8'");
            mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'");

            if(isset($_GET['v'])){
                $v=$_GET['v'];
                switch($v){
                    case 1:
                        $sotr = mysqli_query($link, "select * from sotr ORDER BY zp DESC LIMIT 2");
                    break;
                    case 2:
                        $sotr = mysqli_query($link, "select * from sotr WHERE zp>30000");
                    break;
                    case 3:
                        $sotr = mysqli_query($link, "select * from sotr WHERE name='Иван' OR name='Дмитрий'");
                    break;
                }
            }
            else {
                $sotr = mysqli_query($link, "select * from sotr");
            }
            
            // $result = mysqli_fetch_array($sotr);
            while($result = mysqli_fetch_array($sotr)){
                echo ("<tr>
                        <td>{$result['fam']}</td>
                        <td>{$result['name']}</td>
                        <td>{$result['lname']}</td>
                        <td>{$result['dol']}</td>
                        <td>{$result['zp']}</td>
                    </tr>");
            }
            // printf("Сотрудник: %s %s %s %s %s<br>",$result['fam'],$result['name'],$result['lname'],$result['dol'],$result['zp']);
        ?>
    </table>
    <ul class='links'>
        <li><a href="obr_db_2.php">Отобразить всё</a></li>
        <li><a href="obr_db_2.php?v=1">ТОП-2 по ЗП</a></li>
        <li><a href="obr_db_2.php?v=2">ЗП больше 30 тыс.</a></li>
        <li><a href="obr_db_2.php?v=3">Вывод если имя Иван или Дмитрий</a></li>
    </ul>
</div>
