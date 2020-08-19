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
    form{
        grid-area: post-8;
    }
    .debug{
        grid-area: post-9;
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

            // $rqst0 = "select * from sotr";
            // $rqst1 = "select * from sotr ORDER BY zp DESC LIMIT 2";
            // $rqst2 = "select * from sotr WHERE zp>30000";
            // $rqst3 = "select * from sotr WHERE name='Иван' OR name='Дмитрий'";
            

            if(isset($_POST['v'])){
                $rqst3 = "select * from sotr WHERE name='Иван' OR name='Дмитрий'";
                $v=$_POST['v'];
                switch($v){
                    case 0:
                        $sotr = mysqli_query($link, "select * from sotr");
                    break;

                    case 1:
                        $name = $_POST['name'];
                        $sotr = mysqli_query($link, "select * from sotr WHERE name='$name'");
                    break;

                    case 2:
                        if($_POST['min']){
                            $min = $_POST['min'];
                            $min--;
                        }
                        else {
                            $min = 0;
                        }

                        if($_POST['max']){
                            $max = $_POST['max'];
                            $max++;
                        }
                        else {
                            $max_requst = mysqli_query($link, "SELECT * FROM sotr ORDER BY zp DESC LIMIT 1");
                            $max_f = mysqli_fetch_array($max_requst);
                            $max = (int)$max_f['zp'];
                            $max++;
                        }

                        $rqst2 = "select * from sotr WHERE zp > {$min} and zp < {$max}";
                        $sotr = mysqli_query($link, "$rqst2");
                    break;

                    case 3:
                        $sotr = mysqli_query($link, "$rqst3");
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

    <form action="obr_db_3.php" method="post">
        <input type="radio" name="v" value="0" checked> Вывести всё <br>

        <input type="radio" name="v" value="1"> Имя
        <input type="text" name="name"><br>

        <input type="radio" name="v" value="2">
        Зарплата от<input type="text" name="min"> 
        до <input type="text" name="max">

        <input type="submit" value="Выполнить запрос">
    </form>

    <!-- <div class="debug">

    </div> -->
</div>
