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
            if(@$_SESSION['login_id']==20){
                if(@$_POST['oferty']) header("Location: root.php#root_oferta");
                elseif(@$_POST['blog']) header("Location: root.php#root_blog");
                elseif(@$_POST['kontakt']) header("Location: root.php#root_kontakt");
            }else{
                if(@$_POST['oferty']) header("Location: oferty.php");
                elseif(@$_POST['promocje']) header("Location: promocje.html");
                elseif(@$_POST['galeria']) header("Location: index.html#gallery");
                if(isset($_SESSION['login_id'])){
                    if(@$_POST['blog']) header("Location: blog.php");
                    elseif(@$_POST['kontakt']) header("Location: kontakt.php");
                }
            }
        ?>
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
        <marquee behavior="scroll" direction="left" scrollamount="17">Skorzystaj z ofert w zakładce OFERTY *** Koniecznie sprawdź aktualne promocje w zakładce PROMOCJE</marquee>
    </div>
    <div id="login">
        <div class="login_box">
            <h2>ZALOGUJ</h2>
            <p>Zaloguj się aby korzystać w pełni ze strony biura</p>
            <form method="POST" action="login.php">
                <lable for="login">LOGIN</label><br>
                <input type="text" name="login" required><br>
                <lable for="pass">HASŁO</label><br>
                <input type="password" name="pass" required><br><br>
                <input type="submit" value="Zaloguj" name="log">
            </form>
        </div>
        <hr>
        <div class="login_box">
            <h2>ZAREJESTRUJ</h2>
            <p>Zarejestruj się, jeśli nie masz konta</p>
            <form method="POST" action="">
                <lable for="login">LOGIN</label><br>
                <input type="text" name="login" required><br>
                <lable for="pass">HASŁO</label><br>
                <input type="password" name="pass" required><br>
                <lable for="mail">E-MAIL</label><br>
                <input type="email" name="mail" required><br><br>
                <input type="submit" value="Zarejestruj" name="rej">
            </form>
        </div>
    </div>
    <div id="log_result">
        <?php
            if(@$_POST['rej']){
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $mail = $_POST['mail'];
                $time = time();
                mysqli_query($conn,"INSERT INTO `konta`(`login`, `password`, `mail`, `utworzenie_konta`) VALUES ('$login', '$pass', '$mail', FROM_UNIXTIME($time))");
                echo "<h4>Konto utworzono pomyślnie!<br>Teraz się zaloguj</h4>";
            }
            if(@$_POST['log']){
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                
                $result = mysqli_query($conn, "SELECT `ID` FROM `konta` WHERE `login`='$login' AND `password`='$pass'");
                if(mysqli_num_rows($result)==1){
                    $_SESSION['login_id'] = mysqli_fetch_row($result)[0];
                    if($_SESSION['login_id']==20) header("Location: root.php");
                    else header("Location: index.html");
                }else{
                    echo "<h4>Błędne dane logowania</h4>";
                }
            }
        mysqli_close($conn);
        ?>
    </div>
    <footer>
        <p>Stroną wykonał: Kamil Wiącek<sup>&copy;</sup></p>
        <span><a href="http://www.facebook.pl" target="_blank">Î</a></span>
        <span><a href="http://www.instagram.com" target="_blank">Ú</a></span>
        <span><a href="http://www.youtube.com" target="_blank">Ö</a></span>
    </footer>
</body>
</html>