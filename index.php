<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaiLinKeyWEB</title>
    <link rel="stylesheet" href="css/style.css">
    <script
        src="https://kit.fontawesome.com/9ab3692c85.js"
        crossorigin="anonymous"
    ></script>
</head>

<body>
    
    <header>
        <nav>
            <input type="checkbox" id='checkbox-menu'>
            <label for="checkbox-menu">
                <span class="toggle"><i class="fas fa-bars"></i></span>
                <ul class="menu touch">
                    <li><a href="#" class="logo">RaiLinKeyWEB</a></li>
                    <li><a href="header-links/future.php">Грядущие обновления</a></li>
                    <li><a href="#">Галерея</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Настройки</a></li>
                </ul>
            </label>
            <div class="mobile-logo"><a href="#">RaiLinKeyWEB</a></div>
        </nav>
    </header>

    <main>
        <section class="intro wrapper">
            <div class="intro-text">
                <h1>Блог-портфолио<br> веб-программиста</h1>
                <hr>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus deleniti eius corrupti nam ut 
                    facere consequatur debitis saepe nihil! In vero sequi repudiandae laboriosam placeat, praesentium temporibus 
                    maxime ea, magnam, eos architecto eaque labore eum! Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Voluptatum doloremque fuga qui nulla eum molestias.</p>
                <p>
                    Сайт разработан с целью упростить публикацию достижений в сфере веб-программирования. Он даёт возможность размещать сайты, 
                    в которых не требуется база данных. В ближайшем будующем будут добавлены новые фишки и будет улчешна работа сайта. В можете посетить админпанель, 
                    дописав в поисковую строку adminpanel/adminpanel.php
                </p>
            </div>
            <div class="intro-img">
                <img src="img/png/logos.png" alt="">
            </div>
        </section>
        <section class="skills">
            <div class="skills-line wrapper">
                <div class="skill">
                    <img src="img/svg/skill-design.svg" alt="">
                    <h2>3 года опыта в графическом дизайне</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ad nisi cum velit similique reiciendis distinctio tempora aspernatur consectetur harum?</p>
                </div>
                <div class="skill">
                    <img src="img/svg/skill-univer.svg" alt="">
                    <h2>Образование из одного из ведущих российских ВУЗов</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ad nisi cum velit similique reiciendis distinctio tempora aspernatur consectetur harum?</p>
                </div>
                <div class="skill">
                    <img src="img/svg/skill-progs.svg" alt="">
                    <h2>4 года опыта программирования</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ad nisi cum velit similique reiciendis distinctio tempora aspernatur consectetur harum?</p>
                </div>
            </div>
        </section>
        <section class="works wrapper" id="wrk">
            <div class="work-type">
            <?php
                $link = mysqli_connect("localhost","root","SOMEPASSWORD","site_db");
                mysqli_query($link, "SET NAMES 'utf8'"); 
                mysqli_query($link, "SET CHARACTER SET 'utf8'");
                mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'");

                $big_categories = mysqli_query($link, "select `id_big_cat`,`big_cat_name` from big_cat");
                while($result1 = mysqli_fetch_array($big_categories)){
                    echo ("<h2>{$result1['big_cat_name']}</h2>");
                    echo ("<hr>");
                    echo ("<div class='work'>");
                    $categories = mysqli_query($link, "select `id_cat`,`cat_name`,`id_of_big_cat` from cat");
                    while($result2 = mysqli_fetch_array($categories)){
                        if($result2['id_of_big_cat']==$result1['id_big_cat']){
                            echo ("<h3  id='pl'>{$result2['cat_name']}</h3>");
                            echo ("<div class='work-card-line'>");
                            $work_cards = mysqli_query($link, "select `id_work_cards`,`name`,`img_url`,`href_url`,`id_of_cat` from work_cards");
                            while($result3 = mysqli_fetch_array($work_cards)){
                                if($result3['id_of_cat']==$result2['id_cat']){
                                    echo ("<div class='work-card' onclick=\"document.location='{$result3['href_url']}'\">");
                                    echo("<div class='card-info'>");
                                    echo("<p>{$result3['name']}</p>");
                                    echo("</div>");
                                    echo("<img src='{$result3['img_url']}' alt=''>");
                                    echo("</div>");
                                }
                            }
                            echo("</div>");
                        }
                    }
                    echo("</div>");
                }
            ?>
            </div>
            <div class="search">
                <form action="">
                    <input type="text" placeholder="Поиск работы">
                    <input type="submit" value="Найти работу">
                </form>
            </div>
        </section>
        <section class="contacts">
            <div class="contact wrapper">
                <h2>Связаться со мной</h2>
                <div class="cont-blocks">
                    <div class="socials">
                        <a href="https://vk.com/railinkey" target='_blank'><img src="img/svg/vk.svg" alt=""></a>
                        <a href="https://instagram.com/railinkey" target='_blank'><img src="img/svg/instagram.svg" alt=""></a>
                        <a href="" target='_blank'><img src="img/svg/telegram.svg" alt=""></a>
                    </div>
                    <div class="e-mail">
                        <p>А также Вы можете написать мне на почту:</p>
                        <p class='mail'><a href="mailto:reytteam@gmail.com"> reytteam@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="wrapper">
            <div class="footer-block">
                <div class="footer-logo">
                    <h3>RaiLinKeyWEB</h3>
                    <h3>Это только начало</h3>
                </div>
                <div class="footer-search">
                    <input type="text" placeholder="Подписывайтесь на новости" />
                </div>
            </div>
            <hr />
            <div class="footer-links">
                <div class="footer-links-logo">
                    <h4>RaiLinKeyWEB</h4>
                </div>
                <div class="footer-link">
                    <p>Категория</p>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                </div>
                <div class="footer-link">
                    <p>Категория</p>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                </div>
                <div class="footer-link">
                    <p>Категория</p>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                </div>
                <div class="footer-link">
                    <p>Категория</p>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                    <a href="#">Ссылка</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>