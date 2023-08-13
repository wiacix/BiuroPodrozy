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
        .wpis{
            border:none;
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
            $id = $_GET['id'];
            $result = mysqli_query($conn, "SELECT konta.login, wpisy_blog.temat, wpisy_blog.wpis FROM wpisy_blog INNER JOIN konta ON wpisy_blog.konta_id = konta.ID WHERE wpisy_blog.ID = $id");
            $tab = mysqli_fetch_row($result);
            echo "<h1>".$tab[1]."</h1>";
            echo "<h3>Autor: ".$tab[0]."</h3>";
            echo "<div class='wpis'><p>".$tab[2]."</p></div>";
            echo "<h2 style='margin:0px;'>Komentarze:</h2><br>";
            $result = mysqli_query($conn, "SELECT login_user, komentarz, ID FROM wpisy_komentarze WHERE id_wpis = $id");
            if(mysqli_num_rows($result)>0){
                while($tab = mysqli_fetch_row($result)){
                    echo "<div class='komentarz'><span>".$tab[0]."</span><br>".$tab[1]."</div><form class='usun_kom' action='' method='POST'><input type='number' value='".$tab[2]."' style='display:none;' name='kom_numer'><input type='submit' value='Usuń komentarz' name='usun_kom'></form><br>";
                }
            }else{
                echo "<h2>Brak komentarzy</h2>";
            }
            
            if(@isset($_POST['usun_kom'])){
                $id = $_POST['kom_numer'];
                mysqli_query($conn, "DELETE FROM `wpisy_komentarze` WHERE ID = $id");
                header('refresh: 0;');
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