<?php
// Konfiguracja połączenia z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontakt2"; // Zmień na nazwę swojej bazy danych

// Połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia 
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

//Obsługa Formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['imie']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Walidacja danych 
    if (!empty($name) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Przygorowanie zapytania SQL   
        $sql = "INSERT INTO kontakt (name, email, phone, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Wykonanie zapytania 
        if ($stmt->execute()) {
            echo "<p style= 'color: green;'>Wiadomość zostałą zapisana w bazie danych.</p>";
        } else {
            echo "<p style= 'color: red;'>Wystąpił błąd podczas zapisywania danych: " . $stmt->error . "</p>";

        }

        $stmt->close();
        } else {
            echo "<p style= 'color : red;'>Proszę wypełnić wszystkie pola poprawnie.</p>";
        }
}

$conn->close()
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Kontaktowy</title>
</head>


<style>
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

    }
    input, textarea, button {
        margin: 10px 0;
    }
</style>
<body>
    <form action="" method="post">
    <input type="text" name="imie" placeholder="imię i nazwisko">
    <input type="email" name="email" placeholder="Email">
    <input type="tel" name="phone" placeholder="Telefon">
    <textarea name="message" placeholder="Wiadomość"></textarea>
    <button type="submit">WYŚLIJ</button>
</form>
    
</body>
</html>