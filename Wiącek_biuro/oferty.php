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
    ?>
    <style>
        .main_oferty{
            background: transparent;
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
        <h1>Zapoznaj się z aktualnymi ofertami</h1>
    </div>
    <div id="oferty_slider">
        <div id="slider">
            <input type="button" value="&lt;" id="slider_l_bt" style="margin-right:-15px;">
            <a href="kontakt.php?id=rezerwacja"><img src="bergamo_1.png" alt="oferta" id="img_slider"></a>
            <input type="button" value="&gt;" id="slider_r_bt" style="margin-left:-15px;">
        </div>
        <div id="list-slider">
            <form>
                <input type="radio" name="slider-dot" id="0" checked>
                <input type="radio" name="slider-dot" id="1">
                <input type="radio" name="slider-dot" id="2">
                <input type="radio" name="slider-dot" id="3">
            </form>
        </div>
    </div>
    <div class="main">
    <hr>
        <h1>Znajdź coś dla siebie</h1>
    </div>
    <div class="main_oferty">
        <form method="POST" action="">
            <section>
                <label for="kierunek_o">Kierunek*</label>
                <select name="kierunek_o" required>
                    <option disabled selected hidden>Dokąd wyjazd?</option>
                    <option>Polska</option>
                    <option>Wlochy</option>
                    <option>Gruzja</option>
                    <option>Szkocja</option>
                </select>
            </section>
            <section>
                <label for="ile_os_o">Uczestnicy*</label>
                <input type="number" name="ile_os_o" placeholder="Ile osób?" min="1" required>
            </section>
            <section>
                <label for="ile_dni_o">Pobyt*</label>
                <input type="number" name="ile_dni_o" placeholder="Ile dni?" min="1" required>
            </section>
            <section>
                <input type="submit" name="btn_oferty" value="SZUKAJ">                
            </section>
        </form>
    </div>
    <?php
        if(isset($_POST['btn_oferty'])){
            if(isset($_POST['kierunek_o'])){
                $kierunek_o = $_POST['kierunek_o'];
                $ile_os = $_POST['ile_os_o'];
                $ile_dni = $_POST['ile_dni_o'];
                $result = mysqli_query($conn, "SELECT * FROM `oferty` WHERE `kierunek` LIKE '$kierunek_o' AND ((`ile_osob` BETWEEN $ile_os-5 AND $ile_os+5) OR (`ile_dni` BETWEEN $ile_dni-5 AND $ile_dni+5))");
                if(mysqli_num_rows($result)>0){
                    echo "<table class='tab_oferty'><tr><th>KIERUNEK</th><th>ILOŚĆ OSÓB</th><th>ILOŚĆ DNI</th><th>CENA</th><th>OPIS</th></tr>";
                    while($tab = mysqli_fetch_array($result)){
                        echo "<tr><td>".$tab[1]."</td><td>".$tab[2]."</td><td>".$tab[3]."</td><td>".$tab[4]."PLN</td><td><a href='oferta.php?id=".$tab[0]."'>ZOBACZ</a></td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo "<p>Brak wycieczek dla Ciebie :(<br>Ale pracujemy nad tym!!!</p>";
                }

                echo "<h3>Wszystkie wycieczki</h3>";
                $result = mysqli_query($conn, "SELECT * FROM `oferty` ORDER BY `cena`");
                echo "<table class='tab_oferty'><tr><th>KIERUNEK</th><th>ILOŚĆ OSÓB</th><th>ILOŚĆ DNI</th><th>CENA</th><th>OPIS</th></tr>";
                    while($tab = mysqli_fetch_array($result)){
                        echo "<tr><td>".$tab[1]."</td><td>".$tab[2]."</td><td>".$tab[3]."</td><td>".$tab[4]."PLN</td><td><a href='oferta.php?id=".$tab[0]."'>ZOBACZ</a></td></tr>";
                    }
                    echo "</table>";
            }else{
                echo "Błędne dane!";
            }
        }
    ?>
    <footer>
        <p>Stroną wykonał: Kamil Wiącek<sup>&copy;</sup></p>
        <span><a href="http://www.facebook.pl" target="_blank">Î</a></span>
        <span><a href="http://www.instagram.com" target="_blank">Ú</a></span>
        <span><a href="http://www.youtube.com" target="_blank">Ö</a></span>
    </footer>
    <script src="script_calc.js"></script>
    <script src="script_slider.js"></script>
</body>
</html>