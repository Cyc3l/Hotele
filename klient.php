<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="blue-bar">
            Załóż Konto
        </div>
    </div>
    <div class="main-content">
        <form action="" method="post" onsubmit="return validateForm()">
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie"><br><br>

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko"><br><br>

            <label for="adres">Adres:</label>
            <input type="text" id="adres" name="adres"><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br><br>

            <label for="telefon">Numer Telefonu:</label>
            <input type="text" id="telefon" name="telefon"><br><br>

            <input type="submit" value="ZAŁÓŻ KONTO">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "podróże";

            $conn = new mysqli($servername, $username, $password, $dbname);

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $adres = $_POST['adres'];
            $email = $_POST['email'];
            $telefon = $_POST['telefon'];

            $_SESSION['imie'] = $imie;
            $_SESSION['nazwisko'] = $nazwisko;
            $_SESSION['adres'] = $adres;
            $_SESSION['email'] = $email;
            $_SESSION['telefon'] = $telefon;

            $sql = "INSERT INTO klienci (imię, nazwisko, adres, email, numer_telefonu) VALUES ('$imie', '$nazwisko', '$adres', '$email', '$telefon')";

            if ($conn->query($sql) === TRUE) {
                header("Location: rezerwacja.php");
                exit();
            } else {
                echo "<p>Błąd: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
    </div>
    <div class="footer">
        <div class="black-bar">
            <a href="hotel.php" style="float:left; color: #fff;">Powrót do strony hotelowej</a>
            Numer Kontaktowy: 123321231
        </div>
    </div>
    <script>
        function validateForm() {
            var imie = document.getElementById("imie").value;
            var nazwisko = document.getElementById("nazwisko").value;
            var adres = document.getElementById("adres").value;
            var email = document.getElementById("email").value;
            var telefon = document.getElementById("telefon").value;

            if (imie == '' || nazwisko == '' || adres == '' || email == '' || telefon == '') {
                alert("Nie wpisano wszystkich danych!");
                return false;
            }else {
                alert("Poprawnie utworzono konto użytkownika");
            }
            return true;
        };
    </script>
</body>
</html>