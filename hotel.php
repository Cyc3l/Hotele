<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="blue-bar">
            <?php
            $country = isset($_GET['country']) ? $_GET['country'] : 'brak';
            echo "Hotele w $country";
            ?>
        </div>
    </div>
    <div class="main-content">
        <div class="hotel-column">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "podróże";

            $conn = new mysqli($servername, $username, $password, $dbname);

            $country = isset($_GET['country']) ? $_GET['country'] : '';

            $sql = "SELECT hotele.nazwa, hotele.opis, hotele.liczba_gwiazdek, hotele.adres, hotele.ocena FROM hotele INNER JOIN destynacje ON hotele.destination_id = destynacje.destination_id WHERE destynacje.kraj = '$country'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='hotel'>";
                    echo "<h2>" . $row["nazwa"] . "</h2>";
                    echo "<p><strong>Opis:</strong> " . $row["opis"] . "</p>";
                    echo "<p><strong>Liczba gwiazdek:</strong> " . $row["liczba_gwiazdek"] . "</p>";
                    echo "<p><strong>Adres:</strong> " . $row["adres"] . "</p>";
                    echo "<p><strong>Ocena:</strong> " . $row["ocena"] . "</p>";
                    $nazwa = $row["nazwa"];
                    $_SESSION['nazwa'] = $nazwa;
                    echo "<a href='klient.php'><button>Wybierz</button></a>";
                    echo "</div>";
                };
            };
            $conn->close();
            ?>
        </div>
    </div>
    <div class="footer">
        <div class="black-bar">
            <a href="index.php" style="float:left; color: #ffffff;">Powrót do strony głównej</a>
            Numer Kontaktowy: 123321231
        </div>
    </div>
</body>
</html>