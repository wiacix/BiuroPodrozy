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
    ?>
    <style>
        #kalkulator section{
            text-align:center;
        }
        span{
            color: rgb(252, 102, 102);
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
        <?php
            $kon_id = $_GET['id'];
            $result = mysqli_query($conn, "SELECT kontakt.`ID`, `login`, `nazwisko`, kontakt.`mail`, `uwagi`, `odp`, `login_id` FROM `kontakt` INNER JOIN konta ON kontakt.login_id = konta.ID WHERE kontakt.ID = $kon_id");
            $tab = mysqli_fetch_row($result);
            echo "<h1>Rezerwacja nr. <span>".$tab[0]."</span></h1>";
            echo "<h2>Użytkownik: <span>".$tab[1]."</span></h2>";
            echo "<h2>Nazwisko: <span>".$tab[2]."</span></h2>";
            echo "<h2>Mail: <span>".$tab[3]."</span></h2>";
            echo "<h2>Uwagi: <span>".$tab[4]."</span></h2>";
            $login_id = $tab[6];
            $kon_id = $tab[0];
        ?>
        <br><h2>Wyślij wiadomość do użytkownika</h2>
        <form action="" method="POST">
            <section>
            <label for='wiadomosc'>Treść wiadomości</label><br>
            <textarea name='wiadomosc' placeholder='Wiadomość do użytkowika...' cols='45' rows='7' required></textarea>
            </section>
            <input type='submit' name='wiadomosc_bt' value='Wyślij wiadomość'>
            <input type='reset'>
        </form>
        <?php
            if(@isset($_POST['wiadomosc_bt'])){
                $mess = $_POST['wiadomosc'];
                $result = mysqli_query($conn, "SELECT * FROM `wiadomosci` WHERE `login_id`=$login_id AND `wiadomosc`='$mess' AND `adnotacja`='kon'");
                if(mysqli_num_rows($result)==0){
                    mysqli_query($conn, "INSERT INTO `wiadomosci`(`login_id`, `wiadomosc`, `adnotacja`) VALUES ($login_id,'$mess','kon')");
                    mysqli_query($conn, "UPDATE `kontakt` SET `odp`=1 WHERE `ID` = $kon_id");
                    echo "Wiadomość do użytkownika wysłana, status został zmieniony";
                }else{
                    echo "Taka wiadomość już została wysłana do użytkonika";
                }
            }
        ?>
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