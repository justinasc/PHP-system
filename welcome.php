<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>

Viršutinis rūbas: <?php echo $_POST["virsutinisRubas"]; ?><br>
Kiekis: <?php echo $_POST["kiekis"]; ?><br>
Spalva: <?php echo $_POST["spalva"]; ?><br>
Dydis: <?php echo $_POST["dydis"]; ?><br>

<?php
$servername = "localhost";
$username = "justinas_baze";
$password = "PauliavojimasAitra";
$dbname = "justinas_baze";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO drabuziai (virsutinis_rubas, kiekis, spalva, dydis, data)
VALUES ('".$_POST['virsutinisRubas']."', '".$_POST['kiekis']."', '".$_POST['spalva']."', '".$_POST['dydis']."', now())";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT * FROM drabuziai";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Virsutinis Rubas: " . $row["virsutinis_rubas"]. ",". " kiekis: " . $row["kiekis"]. ",". " spalva: " . $row["spalva"]. ",". " dydis: " . $row["dydis"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>


</body>
</html 	