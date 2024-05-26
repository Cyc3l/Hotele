<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podróże</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="blue-bar">Podróże Po Europie</div>
    </div>
    <div class="main-content">
        <div class="dropdown">
            <button id="selectedCountry" class="dropbtn">Wybierz destynację</button>
            <div class="dropdown-content">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "podróże";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "SELECT kraj FROM destynacje";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='#' onclick='selectCountry(\"" . $row["kraj"] . "\")'>" . $row["kraj"] . "</a>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div class="dropdown">
            <button onclick="searchHotels()">Szukaj</button>
        </div>
    </div>
    <div class="footer">
        <div class="black-bar">Numer Kontaktowy: 123321231</div>
    </div>
    <script>
        function selectCountry(country) {
            document.getElementById("selectedCountry").innerText = country;
        }
        function searchHotels() {
            var selectedCountry = document.getElementById("selectedCountry").innerText;
            if (selectedCountry === "Wybierz destynację") {
                alert("Proszę wybrać destynację.");
            } else {
                location.href = 'hotel.php?country=' + encodeURIComponent(selectedCountry);
            }
        }
    </script>
</body>
</html>