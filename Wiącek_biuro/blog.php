<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIACUS TRAVEL | Biuro Podróży</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?php
        include("connect.php");
        session_start();
        @$log_id = $_SESSION['login_id'];
        if(!isset($log_id)) header("Location: login.php");
        $result = mysqli_query($conn, "SELECT * FROM `konta` WHERE `ID` = $log_id");
        while($tab = mysqli_fetch_row($result)){
            $user = $tab[1];
            $user_mail = $tab[3];
            $user_date = $tab[4];
        }
    ?>
    <style>
        main h1{
            text-align: center;
        }
        main hr{
            margin: 15px 0 15px 0;
        }
        main form input[type=submit], input[type=reset]{
            height: 30px;
            margin: 0px 20px 0px 0px;
            min-width: 20%;
        }
        #kalkulator section{
            width:100%;
            align-items: center;
        }
        #kalkulator section h4{
            margin: 10px;
            font-size: 15px;
        }
        #kalkulator section input{
            padding: 5px;
            margin: 10px 0 0 0;
            height: 30px;
            width: 6em;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.html"><img src="logo.png" alt="logo"></a>
        <nav>
            <form method="POST" action="login.php">
                <input type="submit" name="oferty" value="OFERTY">
                <input type="submit" name="promocje" value="PROMOCJE">
                <input type="submit" name="galeria" value="GALERIA">
                <input type="submit" name="blog" value="BLOG">
                <input type="submit" name="kontakt" value="KONTAKT">
            </form>
        </nav>
    </header>
    <div id="kalkulator">
        <section>
            <?php
                echo "<h4>Login: ".$user."<br>E-mail: ".$user_mail."<br>Data utworzenia konta: ".$user_date."</h4>";
                if(@isset($_POST['logout'])){
                    unset($_SESSION['login_id']);
                    header("Location: login.php");
                }
            ?>
            <form method="POST" action="">
                <input type="submit" value="Wyloguj" name="logout">
            </form>
        </section>
    </div>
    <main>
        <h1>Witaj na blogu!</h1>
        <h3>Dodaj wpis na bloga!</h3>
        <form method="POST" action="">
            <label for="temat">Temat: </label>
            <input type="text" name="temat" placeholder="Temat wpisu" required><br><br>
            <label for="opis">Wyraź swoją opinię:</label><br>
            <textarea cols="50" rows="7" required placeholder="Podziel się z Nami Twoimi doznaniami!" name="opis"></textarea><br><br>
            <input type="submit" value="Dodaj wpis!" name="add_opinion">
            <input type="reset" value="Resetuj!">
        </form>
        <?php
            if(@isset($_POST['add_opinion'])){
                $temat = $_POST['temat'];
                $opis = $_POST['opis'];
                $time = time();
                $result = mysqli_query($conn, "SELECT * FROM `wpisy_blog` WHERE temat='$temat' AND wpis='$opis'");
                if(mysqli_fetch_row($result)==0){
                    mysqli_query($conn, "INSERT INTO `wpisy_blog`(`konta_id`, `temat`, `wpis`, `data_wpisu`) VALUES ($log_id, '$temat', '$opis', FROM_UNIXTIME($time))");
                    echo "<p><br>Udało dodać się wpis :D</p>";
                }
            }
        ?>
        <hr>
        <h1>Wpisy na blogu</h1>
        <?php
            if(@isset($_POST['usun_wpis'])){
                $id_wpis = $_POST['wpis_numer'];
                mysqli_query($conn, "DELETE FROM `wpisy_blog` WHERE `ID` = $id_wpis");
                mysqli_query($conn, "DELETE FROM `wpisy_komentarze` WHERE `id_wpis` = $id_wpis");
            }
            
            $result = mysqli_query($conn, "SELECT wpisy_blog.temat, wpisy_blog.wpis, wpisy_blog.data_wpisu, konta.login, konta.mail, konta.utworzenie_konta, wpisy_blog.ID FROM `wpisy_blog` INNER JOIN konta ON wpisy_blog.konta_id = konta.ID order by wpisy_blog.data_wpisu DESC, wpisy_blog.ID DESC");
            while($tab = mysqli_fetch_array($result)){
                $ile = mysqli_query($conn, "SELECT COUNT(*) FROM `wpisy_komentarze` WHERE `id_wpis` = $tab[6]");
                $tab_ile = mysqli_fetch_array($ile);
                echo "<div class='wpis'><h2>".$tab[0]."</h2><h4>Data dodania: <span class='ul'>".$tab[2]."</span></h4><h3>Autor: <span style='color:blue;'>".$tab[3]."</span><br>Kontakt: <span class='ul'>".$tab[4]."</span><br>Użytkownik jest z nami od: <span class='ul'>".$tab[5]."</span></h3><p>".$tab[1]."</p><div class='menu'><a href='blog_wpis.php?id=".$tab[6]."'>Dodaj komentarz</a>";
                if($tab[3]==$user){
                    echo "<form action='' method='POST'><input type='number' value='".$tab[6]."' style='display:none;' name='wpis_numer'><input type='submit' value='Usuń wpis' name='usun_wpis'></form></div><h4>Liczba komentarzy pod postem: <span class='ul'>".$tab_ile[0]."</span></h4></div><hr>";
                }else{
                    echo "</div><h4>Liczba komentarzy pod postem: <span class='ul'>".$tab_ile[0]."</span></h4></div><hr>";
                }
            }
        ?>
    </main>
    <?php
        mysqli_close($conn);
    ?>
    <footer>
        <p>Stroną wykonał: Kamil Wiącek<sup>&copy;</sup></p>
        <span><a href="http://www.facebook.pl" target="_blank">Î</a></span>
        <span><a href="http://www.instagram.com" target="_blank">Ú</a></span>
        <span><a href="http://www.youtube.com" target="_blank">Ö</a></span>
    </footer>
</body>
</html>