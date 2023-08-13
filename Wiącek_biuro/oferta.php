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
        include('connect.php');


        function color($country){
            switch($country){
                case("Polska"):
                    return "rgb(255,0,0)";
                    break;
                case("Wlochy"):
                    return "rgb(17, 206, 0)";
                    break;
                case("Gruzja"):
                    return "rgb(210,105,30)";
                    break;
                case("Szkocja"):
                    return "rgb(25, 98, 255)";
                    break;
                default:
                    return "rgb(255,255,255)";
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
        <form>
            <section>
                <label for="gdzie">Kierunek*</label>
                <select id="gdzie">
                    <option disabled selected hidden>Dokąd wyjazd?</option>
                    <optgroup label="Polska">
                        <option>Tatry</option>
                        <option>Beskid Żywiecki</option>
                        <option>Karkonosze</option>
                    </optgroup>
                    <optgroup label="Włochy">
                        <option>Aply Bergamskie - Pizzo Famo</option>
                        <option>Aply Julijskie - Triglav</option>
                        <option>Piramide Vincent</option>
                        <option>Dolomity</option>
                    </optgroup>
                    <optgroup label="Gruzja">
                        <option>Góry Gomborskie</option>
                        <option>Kaukaz</option>
                    </optgroup>
                    <optgroup label="Szkocja">
                        <option>Corta-ma Law</option>
                        <option>Campsies - Meikle Bin</option>
                        <option>The Cobbler</option>
                        <option>Ben Venue</option>
                    </optgroup>
                </select>
            </section>
            <section>
                <label for="kiedy">Termin*</label>
                <input type="date" id="kiedy">
            </section>
            <section>
                <label for="ile_dni">Pobyt*</label>
                <input type="number" id="ile_dni" min="1" placeholder="Ile dni?">
            </section>
            <section>
                <label for="ile_os">Uczestnicy*</label>
                <input type="number" id="ile_os" min="1" placeholder="Ile osób?">
            </section>
            <section>
                <label for="transport">Transport*</label>
                <select id="transport">
                    <option disabled selected hidden>Jak dotrzesz?</option>
                    <option>Samolot</option>
                    <option>Autobus</option>
                    <option>Własny</option>
                </select>
            </section>
            <section>
                <label for="rabat_kod">Rabat <a href="rabat.html">Uzyskaj rabat</a></label>
                <input type="text" id="rabat_kod" placeholder="Kod rabatowy">
            </section>
            <section>
                <label for="licz"></label>
                <input type="button" value="OSZACUJ KOSZT" id="licz">
            </section>
        </form>
        <p id="calc_result"></p>
    </div>
    <div class="main">
    <?php
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM `oferty` WHERE `ID` = $id");
        $tab = mysqli_fetch_row($result);
        $color = color($tab[1]);
        echo "<h1>Kierunek wyjazdu: <span style='color:$color;'>".$tab[1]."</span></h1><h2>Ilośc dni: ".$tab[3]."</h2><h2>Ilośc osób: ".$tab[2]."</h2><h2>Cena: ".$tab[4]." PLN</h2>";
        echo "<h3>Opis wycieczki:</h3><div class='oferta_wypis'><p>".$tab[5]."<br><br><a href='kontakt.php?id=rezerwacja'>REZERWUJ</a></p></div>";
        echo "";
        mysqli_close($conn);
    ?>
    </div>
    <footer>
        <p>Stroną wykonał: Kamil Wiącek<sup>&copy;</sup></p>
        <span><a href="http://www.facebook.pl" target="_blank">Î</a></span>
        <span><a href="http://www.instagram.com" target="_blank">Ú</a></span>
        <span><a href="http://www.youtube.com" target="_blank">Ö</a></span>
    </footer>
    <script src="script_calc.js"></script>
</body>
</html>