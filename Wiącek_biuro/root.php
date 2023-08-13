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
        if($log_id!=20) header("Location: index.html");
        $result = mysqli_query($conn, "SELECT * FROM `konta` WHERE `ID` = $log_id");
        while($tab = mysqli_fetch_row($result)){
            $user = $tab[1];
            $user_mail = $tab[3];
            $user_date = $tab[4];
        }

        function obr($png){
            if($png == 0) return "none.png";
            else return "checked.png";
        }
    ?>
    <style>
        #kalkulator section{
        text-align:center;
        }
        .tab_oferty{
            width:100%;
        }
        #rezerwacje{
            width:100%;
        }
    </style>
</head>
<body>
    <header>
        <a href="root.php"><img src="logo.png" alt="logo"></a>
        <nav>
            <form method="POST" action="login.php">
                <input type="submit" name="oferty" value="OFERTY">
                <input type="submit" name="blog" value="BLOG">
                <input type="submit" name="kontakt" value="KONTAKT">
            </form>
        </nav>
    </header>
    <div id="kalkulator">
        <section>
            <?php
                echo "<h4>Zalogowano jako administrator</h4>";
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
    <div class="main">
        <h1>Dodaj ofertę do biura:</h1>
        <form action="" method="POST" id="root_oferta">
            <section>
                <label for="kierunek">Kierunek wycieczki: </label>
                <select name="kierunek" required>
                    <option disabled selected hidden>Kraj wycieczki</option>
                    <option>Polska</option>
                    <option>Wlochy</option>
                    <option>Gruzja</option>
                    <option>Szkocja</option>
                </select>
            </section>
            <section>
                <label for="ile_os">Dla ilu osób wycieczka: </label>
                <input type="number" name="ile_os" min="1" required placeholder="Ile osób">
            </section>
            <section>
                <label for="ile_dni">Na ile dni wycieczka: </label>
                <input type="number" name="ile_dni" min="1" required placeholder="Ile dni">
            </section>
            <section>
                <label for="cena">Cena wycieczki: </label>
                <input type="number" name="cena" min="1" required placeholder="Cena">
            </section>
            <section>
                <label for="opsi">Opis wycieczki: </label><br>
                <textarea placeholder="Opis wycieczki..." name="opis" cols="45" rows="7" required></textarea>
            </section>
            <input type='submit' name='dodaj_oferte_bt' value='Dodaj ofertę'>
        </form>
        <?php
            if(@isset($_POST['dodaj_oferte_bt'])){
                $kier = $_POST['kierunek'];
                $ile_os = $_POST['ile_os'];
                $ile_dni = $_POST['ile_dni'];
                $cena = $_POST['cena'];
                $opis = $_POST['opis'];
                $result = mysqli_query($conn, "SELECT * FROM `oferty` WHERE `opis` = '$opis'");
                if(mysqli_num_rows($result)==0){
                    mysqli_query($conn, "INSERT INTO `oferty`(`kierunek`, `ile_osob`, `ile_dni`, `cena`, `opis`) VALUES ('$kier',$ile_os, $ile_dni, $cena, '$opis')");
                    echo "<p>Udało się dodać ofertę</p>";
                }else{
                    echo "<p>Bład, nie udało się dodać oferty!</p>";
                }
            }
        ?>
        <hr>
        <h1>Zarządzaj wpisami na blogu:</h1>
        <div id="root_blog">
            <?php
                $result = mysqli_query($conn, "SELECT wpisy_blog.temat, wpisy_blog.wpis, wpisy_blog.data_wpisu, konta.login, konta.mail, konta.utworzenie_konta, wpisy_blog.ID FROM `wpisy_blog` INNER JOIN konta ON wpisy_blog.konta_id = konta.ID order by wpisy_blog.data_wpisu DESC, wpisy_blog.ID DESC");
                while($tab = mysqli_fetch_array($result)){
                    $ile = mysqli_query($conn, "SELECT COUNT(*) FROM `wpisy_komentarze` WHERE `id_wpis` = $tab[6]");
                    $tab_ile = mysqli_fetch_array($ile);
                    echo "<div class='wpis'><h2>".$tab[0]."</h2><h4>Data dodania: <span class='ul'>".$tab[2]."</span></h4><h3>Autor: <span style='color:blue;'>".$tab[3]."</span><br>Kontakt: <span class='ul'>".$tab[4]."</span><br>Użytkownik jest z nami od: <span class='ul'>".$tab[5]."</span></h3><p>".$tab[1]."</p><div class='menu'><a href='root_blog_wpis.php?id=".$tab[6]."'>Zobacz komentarze</a><form action='' method='POST'><input type='number' value='".$tab[6]."' style='display:none;' name='wpis_numer'><input type='submit' value='Usuń wpis' name='usun_wpis'></form></div><h4>Liczba komentarzy pod postem: <span class='ul'>".$tab_ile[0]."</span></h4></div><hr>";
                }
            ?>
        </div>
        <h1>Zobacz zgłoszenia przez Kontakt</h1>
        <div id="root_kontakt">
            <div id="rezerwacje">
                <h2>Zgłoszone rezerwacje</h2>
                <?php
                    $result = mysqli_query($conn, "SELECT rezerwacje.`ID`, `login_id`, `nazwisko`, rezerwacje.`mail`, `telefon`, `data`, `ile_dni`, `uwagi`, konta.login, rezerwacje.odp FROM `rezerwacje` INNER JOIN konta ON rezerwacje.login_id = konta.ID");
                    echo "<table class='tab_oferty'><tr><th>LOGIN</th><th>MAIL</th><th>DATA</th><th>STATUS</th><th>ZARZĄDZAJ</th></tr>";
                    while($tab = mysqli_fetch_row($result)){
                        echo "<tr><td>".$tab[8]."</td><td>".$tab[3]."</td><td>".$tab[5]."</td><td><img src='".obr($tab[9])."' alt='obr'></td><td><a href='root_rezerwacje.php?id=".$tab[0]."'>KLIKNIJ</a></td></tr>";
                    }
                    echo "</table>";
                ?>
                <h2>Kontakt do Biura</h2>
                <?php
                    $result = mysqli_query($conn, "SELECT kontakt.`ID`, kontakt.`mail`, kontakt.`odp`, konta.login FROM `kontakt` INNER JOIN konta ON kontakt.login_id = konta.ID");
                    echo "<table class='tab_oferty'><tr><th>LOGIN</th><th>MAIL</th><th>STATUS</th><th>ZARZĄDZAJ</th></tr>";
                    while($tab = mysqli_fetch_row($result)){
                        echo "<tr><td>".$tab[3]."</td><td>".$tab[1]."</td><td><img src='".obr($tab[2])."' alt='obr'></td><td><a href='root_kontakt.php?id=".$tab[0]."'>KLIKNIJ</a></td></tr>";
                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>
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