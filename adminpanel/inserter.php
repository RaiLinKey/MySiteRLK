
<?php
//функция транлитерации
function translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ' ' => '_'
    );
    return strtr($string, $converter);
}

//вспомагательная функция
function myscandir($dir)
{
	$list = scandir($dir);
	unset($list[0],$list[1]);
	return array_values($list);
}

// функция очищения папки
function clear_dir($dir)
{
	$list = myscandir($dir);
	
	foreach ($list as $file)
	{
		if (is_dir($dir.$file))
		{
			clear_dir($dir.$file.'/');
			rmdir($dir.$file);
		}
		else
		{
			unlink($dir.$file);
		}
	}
}

$link = mysqli_connect("localhost","root","SOMEPASSWORD");
mysqli_select_db($link,"site_db");
mysqli_query($link, "SET NAMES 'utf8'"); 
mysqli_query($link, "SET CHARACTER SET 'utf8'");
mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'");

//добавление категории в БД
if(isset($_POST['input-new-work-type']) and $_POST['input-new-work-type']!=''){
    
    $namecheck = 0;
   
    if(mysqli_fetch_array(mysqli_query($link, "SELECT `big_cat_name` FROM `id13007167_site_db`.`big_cat` WHERE `big_cat_name` = '{$_POST['input-new-work-type']}'")) != ''){
        $namecheck = 1;
    }
    if($namecheck == 1){
        echo json_encode('repeat');
    }
    else
    {
        echo json_encode('noRepeat');
        $big_cat_url = translit($_POST['input-new-work-type']);
        mkdir("../work-cards/{$big_cat_url}",0777,true);
        mysqli_query($link, "INSERT INTO `id13007167_site_db`.`big_cat` (`big_cat_name`,`big_cat_url`) VALUES ('{$_POST['input-new-work-type']}','{$big_cat_url}/');");
    }
}

//добавление подкатегории в БД
if(isset($_POST['input-new-work']) and $_POST['input-new-work']!=''){
    if(isset($_POST['select-work-type'])){

        $namecheck = 0;
        if(mysqli_fetch_array(mysqli_query($link, "SELECT `cat_name` FROM `id13007167_site_db`.`cat` WHERE `cat_name` = '{$_POST['input-new-work']}'")) != ''){
            $namecheck = 1;
        }
        if($namecheck == 1){
            echo json_encode('repeat');
        }
        else
        {
            echo json_encode('noRepeat');
            $id_of_big_cat = mysqli_query($link, "SELECT `id_big_cat`,`big_cat_url` FROM big_cat");
            while($result = mysqli_fetch_array($id_of_big_cat)){
                if ($result['id_big_cat']==$_POST['select-work-type']){
                    $big_cat_url = $result['big_cat_url'];
                }
            }

            $cat_url = translit($_POST['input-new-work']);
            mkdir("../work-cards/{$big_cat_url}{$cat_url}",0777,true);

            mysqli_query($link, "INSERT INTO `id13007167_site_db`.`cat` (`cat_name`,`cat_url`,`id_of_big_cat`) VALUES ('{$_POST['input-new-work']}','{$cat_url}/','{$_POST['select-work-type']}');");
        }
    }
}

//добавление карточки на сайт
if(isset($_POST['input-new-work-card']) and $_POST['input-new-work-card']!=''){
    echo "Название пришло";

    $namecheck = 0;
    if(mysqli_fetch_array(mysqli_query($link, "SELECT `name` FROM `id13007167_site_db`.`work_cards` WHERE `name` = '{$_POST['input-new-work']}'")) != ''){
        $namecheck = 1;
    }
    if($namecheck == 1){
        echo json_encode('repeat');
    }
    else
    {
        if(isset($_POST['select-work']) and $_POST['select-work']!=''){
            echo "Тип пришёл";
            if(isset($_FILES['input-img-work-card']) and $_FILES['input-img-work-card']!=''){
                echo "Картинка пришла";
                    if(isset($_FILES['input-file-work-card']) and $_FILES['input-file-work-card']!='' and $_FILES['input-file-work-card']['type'] == 'application/x-zip-compressed'){
                        echo "Файл пришёл";
                        $_FILES['input-file-work-card']['name'] = translit($_FILES['input-file-work-card']['name']);
                        $filename = $_FILES['input-file-work-card']['name'];

                        echo("$filename");

                        $id_of_cat = mysqli_query($link,"SELECT `id_cat`,`cat_url`,`id_of_big_cat` FROM cat");
                        while($result = mysqli_fetch_array($id_of_cat)){
                            if ($result['id_cat']==$_POST['select-work']){
                                $cat_url = $result['cat_url'];
                                
                                $id_of_big_cat = mysqli_query($link, "SELECT `id_big_cat`,`big_cat_url` FROM big_cat");

                                while($result2 = mysqli_fetch_array($id_of_big_cat)){
                                    if ($result2['id_big_cat']==$result['id_of_big_cat']){
                                        $big_cat_url = $result2['big_cat_url'];
                                    }
                                }
                            }
                        }

                        $uploaddir = "../work-cards/{$big_cat_url}{$cat_url}";
                        $uploadfile = $uploaddir . basename($_FILES['input-file-work-card']['name']);
                        move_uploaded_file($_FILES['input-file-work-card']['tmp_name'], $uploadfile);

                        $zip = new ZipArchive;
                        $res = $zip->open("../work-cards/{$big_cat_url}{$cat_url}{$_FILES['input-file-work-card']['name']}");
                        if ($res === TRUE) {
                            $zip->extractTo("../work-cards/{$big_cat_url}{$cat_url}");
                            $zip->close();
                                echo 'ok';
                        } else {
                            echo 'failed';
                        }
                        $check = scandir("../work-cards/{$big_cat_url}{$cat_url}");
                        $f = 0;
                        for ($i = 0; $i < count($check); $i++){
                            if (($check[$i] == 'index.php') or ($check[$i] == 'index.htm') or ($check[$i] == 'index.html')){
                                $f = 1;
                            }
                        }
                        if ($f == 0){
                            echo('Не является сайтом!');
                            clear_dir("../work-cards/{$big_cat_url}{$cat_url}");
                        }
                        else
                        {
                            echo('Это сайт');
                            $findname = scandir("../work-cards/{$big_cat_url}{$cat_url}");
                            for ($i = 0; $i < count($findname); $i++){
                                if ($findname[$i] == 'index.php') $workname = $findname[$i];
                                if ($findname[$i] == 'index.htm') $workname = $findname[$i];
                                if ($findname[$i] == 'index.html') $workname = $findname[$i];
                            }
                            $_FILES['input-img-work-card']['name'] = translit($_FILES['input-img-work-card']['name']);
                        
                            $img_filename = $_FILES['input-img-work-card']['name'];

                            mkdir("../img/cards/{$cat_url}",0777,true);
                            $uploaddir_img = "../img/cards/{$cat_url}";
                            $uploadfile_img = $uploaddir_img . basename($_FILES['input-img-work-card']['name']);
                            move_uploaded_file($_FILES['input-img-work-card']['tmp_name'], $uploadfile_img);

                            echo("Даже тут всёё ок<br>");
                            echo("{$_POST['input-new-work-card']}<br>
                            img/cards/{$cat_url}{$img_filename}<br>
                            work-cards/{$big_cat_url}{$cat_url}{$filename}<br>
                            {$_POST['select-work']}");
                            
                            mysqli_query($link, 
                            "INSERT INTO `id13007167_site_db`.`work_cards`
                            (`name`,`img_url`,`href_url`,`id_of_cat`)
                            VALUES
                            ('{$_POST['input-new-work-card']}','img/cards/{$cat_url}{$img_filename}','work-cards/{$big_cat_url}{$cat_url}{$workname}','{$_POST['select-work']}');");
                        }
                }
            }
        }
    }
}
?>
<!-- Ключевое слово для Ajax -->
confirme