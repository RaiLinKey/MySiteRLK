<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            text-align: center;

        }
    </style>
</head>
<body>
    <h1>Регистрационная форма</h1>
    <form action="obr.php" method=GET>
        <p>
            <label>Ваше имя: <input type="text" name="nm"></label>
        </p>
        <p>
            <label>Ваше пол: <br>
                Мужчина<input type="radio" value="m" name="sx" checked>
                Женщина<input type="radio" value="w" name="sx">
            </label>
        </p>
        <input type="submit" value="Зарегистрироваться">
        
    </form>
</body>
</html>