<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="blue-bar">
            Rezerwacja
        </div>
    </div>
    <div class="main-content">
        <form method="post">
            <label for="data_przyjazdu">Data Przyjazdu:</label>
            <input type="date" id="data_przyjazdu" name="data_przyjazdu"><br><br>

            <label for="data_wyjazdu">Data Wyjazdu:</label>
            <input type="date" id="data_wyjazdu" name="data_wyjazdu"><br><br>

            <label for="liczba_osob">Liczba Osób:</label>
            <input type="number" id="liczba_osob" name="liczba_osob"><br><br>

            <input type="submit" value="REZERWUJ">
        </form>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "podróże";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data_przyjazdu = $_POST['data_przyjazdu'];
            $data_wyjazdu = $_POST['data_wyjazdu'];
            $liczba_osob = $_POST['liczba_osob'];

            $imiee = $_SESSION['imie'];
            $nazwiskoo = $_SESSION['nazwisko'];
            $adress = $_SESSION['adres'];
            $emaill = $_SESSION['email'];
            $telefonn = $_SESSION['telefon'];

            $query = "SELECT klienci.klient_id FROM klienci WHERE klienci.imię = '$imiee' AND klienci.nazwisko = '$nazwiskoo' AND  klienci.adres = '$adress' AND klienci.email = '$emaill' AND klienci.numer_telefonu = '$telefonn'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $klient_id = $row['klient_id'];
            
            $nazwaa = $_SESSION['nazwa'];

            $queryy = "SELECT hotele.hotel_id FROM hotele WHERE hotele.nazwa = '$nazwaa'";
            $resultt = $conn->query($queryy);
            $roww = $resultt->fetch_assoc();
            $hotel_id = $roww['hotel_id'];

            if (empty($data_przyjazdu) || empty($data_wyjazdu) || empty($liczba_osob)) {
                echo "Nie wpisano wszystkich danych!";
            } else {                
                $sql = "INSERT INTO rezerwacje (klient_id, hotel_id, data_przyjazdu, data_wyjazdu, liczba_osób) VALUES ('$klient_id', '$hotel_id', '$data_przyjazdu', '$data_wyjazdu', '$liczba_osob')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script> alert('Rezerwacja została dokonana pomyślnie!') </script>";
                } else {
                    echo "<script> alert('Błąd podczas rezerwacji: ') </script>". $conn->error;
                }
            }
        }
        ?>
    </div>
    <div class="footer">
        <div class="black-bar">
            <a href="klient.php" style="float:left; color: #fff;">Powrót do strony klienta</a>
            Numer Kontaktowy: 123321231
        </div>
    </div>
</body>
</html>