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
        span{
            color: rgb(252, 102, 102);
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
    <div class="main">
        <?php
            mysqli_query($conn, "UPDATE `wiadomosci` SET `odczytano`=1 WHERE `login_id`=$log_id");
            echo "<h1>Wiadomości użytkownika <span>".$user."</span></h1><hr>";

            echo "<h2>Wiadomości w sprawie rezerwacji</h2>";
            $result = mysqli_query($conn, "SELECT * FROM `wiadomosci` WHERE `login_id`=$log_id AND `adnotacja`='rez'");
            if(mysqli_num_rows($result)>0){
                echo "<ol style='list-style-type: disc;'>";
                while($tab = mysqli_fetch_row($result)){
                    echo "<li>".$tab[2]."</li>";
                }
                echo "</ol>";
            }else{
                echo "<p style='color:red;'>Brak wiadomości</p>";
            }

            echo "<hr><h2>Wiadomości w sprawie kontaktu</h2>";
            $result = mysqli_query($conn, "SELECT * FROM `wiadomosci` WHERE `login_id`=$log_id AND `adnotacja`='kon'");
            if(mysqli_num_rows($result)>0){
                echo "<ol style='list-style-type: disc;'>";
                while($tab = mysqli_fetch_row($result)){
                    echo "<li>".$tab[2]."</li>";
                }
                echo "</ol>";
            }else{
                echo "<p style='color:red;'>Brak wiadomości</p>";
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