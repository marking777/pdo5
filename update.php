<?php
$host = 'localhost:3307';
$db   = 'Winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['submit'])) {
    $naam = $_POST["product_naam"];
    $prijs = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];

    $sql = "UPDATE winkel SET product_naam =
    :product_naam, prijs_per_stuk = :prijs_per_stuk,
    omschrijving = :omschrijving WHERE product_code = 2";

    $stmt = $pdo->prepare($sql);
    $data = [
        'product_naam' => $naam,
        'prijs_per_stuk' => $prijs,
        'omschrijving' => $omschrijving,
    ];
    $stmt->execute($data);

if ($stmt->execute($data) == true){
    echo "de product is toegevoegd";
}
else{
    echo "error";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Document</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="form-container">
        <h1>Winkel</h1>
        <form method="post">
            <div class="form-group">
                <label for="input1">product_naam:</label>
                <input type="text" id="input1" name="product_naam" placeholder="Voer de naam in" required>
            </div>
            <div class="form-group">
                <label for="input2">prijs_per_stuk</label>
                <input type="text" id="input2" name="prijs_per_stuk" placeholder="voer de prijs in " required>
            </div>
            <div class="form-group">
                <label for="input3">omschrijving</label>
                <input type="text" id="input3" name="omschrijving" placeholder="Voer een omschrijving in" required>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

</body>

</html>