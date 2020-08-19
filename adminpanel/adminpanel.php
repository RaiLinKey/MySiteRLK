<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка RaiLinKeyWEB</title>
    <link rel="stylesheet" href="style.css">
    <script src='../scripts/jq.js'></script>
    <script src='main.js'></script>
</head>

<?php
    $link = mysqli_connect("localhost","root","SOMEPASSWORD");
    mysqli_select_db($link,"site_db");
    mysqli_query($link, "SET NAMES 'utf8'"); 
    mysqli_query($link, "SET CHARACTER SET 'utf8'");
    mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'");
?>

<body>
    <header>
        <nav>
            <input type="checkbox" id='checkbox-menu'>
            <label for="checkbox-menu">
                <span class="toggle"><i class="fas fa-bars"></i></span>
                <ul class="menu touch">
                    <li><a href="../index.php" class="logo">RaiLinKeyWEB</a></li>
                    <li><a href="#">Хостинг</a></li>
                    <li><a href="#">Настройки</a></li>
                </ul>
            </label>
            <div class="mobile-logo"><a href="#">RaiLinKeyWEB</a></div>
        </nav>
    </header>
    <main>
        <section class="adding wrapper">
            <h2>Изменение раздела «Работы»</h2>
            <hr>
            <div class="inside-wrapper">
                <h3>Добавление группы «Тип работы»</h3>
                <div>
                <form action="inserter.php" name="new-work-type" method="POST" class="forms" id='f1'>
                    <p>
                        <label for="add-new-work-type" class="spaces">Введите название группы работ: </label>
                        <input type="text" maxlength="24" name="input-new-work-type" id="add-new-work-type" class="spaces">
                        <span id="bigCatRepeat" class="ErrNote" style="display: none;">Такое название уже есть</span>
                    </p>
                    <!-- <input type="button" onclick="submitBigCat();"> -->
                    <input type="submit" name="send-new-work-type" value="Сохранить">
                </form>
                </div>
                <h3>Добавление группы «Работы»</h3>
                <form action="inserter.php" name="new-work" method="POST" class="forms" id='f2'>
                    <p>
                        <label for="add-new-work" class="spaces">Введите название типа работы: </label>
                        <input type="text" maxlength="24" name="input-new-work" id="add-new-work" class="spaces">
                        <span id="CatRepeat" class="ErrNote" style="display: none;">Такое название уже есть</span>
                    </p>
                    <p>
                        <label for="sel-work-type" class="spaces">Из какой она группы: </label>
                        <select name="select-work-type" id="sel-work-type" class="spaces">
                            <?php
                                $bc_db = mysqli_query($link, "SELECT `id_big_cat`,`big_cat_name` FROM big_cat");
                                while($result = mysqli_fetch_array($bc_db)){
                                    echo("<option value='{$result['id_big_cat']}'>{$result['big_cat_name']}</option>");
                                }
                            ?>
                        </select>
                    </p>
                    <!-- <input type="button" onclick="submitCat();"> -->
                    <input type="submit" name="send-new-work" value="Сохранить">
                </form>
                <h3>Добавление карточек</h3>
                <form action="inserter.php" enctype="multipart/form-data" name="new-work-card" method="POST" class="forms" id='f3'>
                <!-- <form name="new-work-card" method="POST" class="forms" id='f3'> -->
                    <p>
                        <label for="add-new-work-card" class="spaces">Введите название работы: </label>
                        <input type="text" maxlength="24" name="input-new-work-card" id="add-new-work-card" class="spaces">
                        <span id="workRepeat" class="ErrNote" style="display: none;">Такое название уже есть</span>
                    </p>
                    <p>
                        <label for="sel-work" class="spaces">Какого она типа: </label>
                        <select name="select-work" id="sel-work" class="spaces">
                        <?php
                                $c_db = mysqli_query($link, "SELECT `id_cat`,`cat_name` FROM cat");
                                while($result = mysqli_fetch_array($c_db)){
                                    echo("<option value='{$result['id_cat']}'>{$result['cat_name']}</option>");
                                }
                            ?>
                        </select>
                    </p>
                    <p id='imgAdd'>
                        <label for="img-work-card" class="spaces">Добавить превью: </label>
                        <input type="file" name="input-img-work-card" id="img-work-card" class="spaces" accept=".jpg, .jpeg, .png">
                        <span id="imgErrNote" class="ErrNote" style="display: none;">Недопустимый тип файла</span>
                        <div class="fileInfo">Допустимые типы файла: jpg, jpeg, png.</div>
                    </p>
                    <p id='zipAdd'>
                        <label for="file-work-card" class="spaces">Добавить файл работы: </label>
                        <input type="file" name="input-file-work-card" id="file-work-card" class="spaces" accept=".zip">
                        <span id="zipErrNote" class="ErrNote" style="display: none;">Недопустимый тип файла</span>
                        <div class="fileInfo">
                            Допустимые типы файла: zip.<br>
                            В архиве должен находится index файл с одним из расширений: php, htm, html.<br>
                            При не соблюдении этих правил, Ваш сайт не будет загружен.
                        </div>
                    </p>
                    <!-- <input type="button" onclick="submitWork();"> -->
                    <input type="submit" name="send-new-work-card" value="Сохранить" id="submit">
                </form>
            </div>
        </section>
        <section class="sendConfirme">
            <div class="divConfirme">Данные отправлены, обновите страницу</div>
        </section>
    </main>
    <footer>
        <p class="wrapper">2020 &copy;RaiLinKeyWEB</p>
    </footer>
</body>
</html>