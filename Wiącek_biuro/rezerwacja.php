<h2 style="text-align:center;">Zarezerwuj wycieczkę dla siebie i swoich bliskich</h2>
<form action="" method="POST">
    <label for="nazwisko">Nazwisko*</label>
    <input type="text" name="nazwisko" required placeholder="Podaj nazwisko"><br>
    <label for="telefon">Numer telefonu*</label>
    <input type="number" name="telefon" min="100000000" max="999999999" required placeholder="Podaj numer telefonu"><br>
    <label for="data">Data wyjazdu*</label>
    <input type="date" name="data" required><br>
    <label for="ile_dni">Na ile dni wyjazd*</label>
    <input type="number" name="ile_dni" min="1" max="365" required placeholder="Podaj ilość dni"><br>
    <label for="uwagi">Dodatkowe informacje</label>
    <textarea name="uwagi" placeholder="Napisz tutaj dodatkowe informacje dla Nas..." cols="50" rows="7"></textarea><br>
    <div class="kont_bt">
        <input type="submit" name="rezerwacja_bt" value="REZERWUJ">
        <input type="reset" name="rezerwacja_bt_reset" value="RESETUJ">
    </div>
</form>

<?php
    if(@isset($_POST['rezerwacja_bt'])){
        $nazwisko = $_POST['nazwisko'];
        $telefon = $_POST['telefon'];
        $data = $_POST['data'];
        $ile_dni = $_POST['ile_dni'];
        @$uwagi = $_POST['uwagi'];

        $result = mysqli_query($conn, "SELECT * FROM `rezerwacje` WHERE `nazwisko` LIKE '$nazwisko' AND `data` like '$data'");
        if(mysqli_num_rows($result)==0){
            mysqli_query($conn, "INSERT INTO `rezerwacje`(`login_id`, `nazwisko`, `mail`, `telefon`, `data`, `ile_dni`, `uwagi`) VALUES ($log_id,'$nazwisko','$user_mail','$telefon','$data','$ile_dni','$uwagi')");
            echo "<p style='text-align:center;'>Udało się zgłosić rezerwację</p>";
        }
    }
?>