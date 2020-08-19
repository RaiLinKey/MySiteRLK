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
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    td {
        padding: 3px;
        border-left: 1px solid black;
        border-right: 1px solid black;
        margin: 0;
    }
</style>
<div class='wrapper'>
    <table align='center'>
        <tr>
            <td>Фамилия</td>
            <td>Имя</td>
            <td>Отчество</td>
            <td>Должность</td>
            <td>ЗП</td>
        </tr>
        <?php
            $link = mysqli_connect("localhost", "root","Tumb3228ler");
            mysqli_select_db($link,"frm");
            mysqli_query($link, "SET NAMES 'utf8'"); 
            mysqli_query($link, "SET CHARACTER SET 'utf8'");
            mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'");

            $sotr = mysqli_query($link, "select * from sotr");
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
</div>