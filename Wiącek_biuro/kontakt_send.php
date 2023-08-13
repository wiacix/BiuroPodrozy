<h2 style="text-align:center;">Skontaktuj się z biurem</h2>
<form action="" method="POST">
    <label for="nazwisko">Nazwisko*</label>
    <input type="text" name="nazwisko" required placeholder="Podaj nazwisko"><br>
    <label for="uwagi">Uwagi*</label>
    <textarea name="uwagi" placeholder="Co chcesz Nam przekazać..." cols="50" rows="7" required></textarea><br>
    <div class="kont_bt">
        <input type="submit" name="kontakt_bt" value="WYŚLIJ">
        <input type="reset" name="rezerwacja_bt_reset" value="RESETUJ">
    </div>
</form>

<?php
    if(@isset($_POST['kontakt_bt'])){
        $nazwisko = $_POST['nazwisko'];
        $uwagi = $_POST['uwagi'];

        $result = mysqli_query($conn, "SELECT * FROM `kontakt` WHERE `uwagi` LIKE '$uwagi'");
        if(mysqli_num_rows($result)==0){
            mysqli_query($conn, "INSERT INTO `kontakt`(`login_id`, `nazwisko`, `mail`, `uwagi`) VALUES ($log_id,'$nazwisko','$user_mail','$uwagi')");
            echo "<p style='text-align:center;'>Udało się wysłać informację do Biura</p>";
        }
    }
?>