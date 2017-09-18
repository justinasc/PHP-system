<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['vartotojas'];
    $name = $_POST['pavadinimas'];
    $virsutinisRubas = $_POST['virsutinis_rubas'];
    $kiekis = $_POST['kiekis'];
    $spalva = $_POST['spalva'];
    $dydis = $_POST['dydis'];

    require_once('dbConnect.php');

    //$timestamp = NOW();
     $sql = "INSERT INTO " . TBL_DRABUZIAI . " (vartotojas, pavadinimas, virsutinis_rubas, kiekis, spalva, dydis, data)
	VALUES ('" . $username . "', '" . $name . "', '" . $virsutinisRubas . "', '" . $kiekis . "', '" . $spalva . "', '" . $dydis . "')";

    if (mysqli_query($con, $sql)) {
        echo 'Irašas įkeltas';
    } else {
        echo 'oops nepaejo';
    }
    mysqli_close($con);
}
?>

function addNewEntry($username, $name, $virsutinisRubas, $kiekis, $spalva, $dydis) {
			$q = "INSERT INTO " . TBL_DRABUZIAI . " (vartotojas, pavadinimas, virsutinis_rubas, kiekis, spalva, dydis, data) VALUES ('$username', '$name','$virsutinisRubas','$kiekis','$spalva','$dydis',now())";
			return mysql_query($q, $this->connection);