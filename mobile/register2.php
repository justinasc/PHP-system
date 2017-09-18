<?php

$username = $_GET['username'];
$password = $_GET['password'];
$email = $_GET['email'];

if ($username == '' || $password == '' || $email == '') {
    echo 'Prašome užpildyti visus laukelius';
} else {
    require_once('dbConnect.php');
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check = mysqli_fetch_array(mysqli_query($con, $sql));

    if (isset($check)) {
        echo 'Toks vartotojo vardas arba el. pašto adresas egzistuoja.';
    } else {
        $ulevel = -1;
        if (strcasecmp($username, "Administratorius") == 0) {
            $ulevel = 9;
        } else {
            $ulevel = 1;
        }

        $passwordHashed = md5($password);
        $userID = generateRandID();
        $timestamp = time();

        $sql = "INSERT INTO " . users . " VALUES ('$username', '$passwordHashed', '$userID', '$ulevel', '$email', '$timestamp')";

        if (mysqli_query($con, $sql)) {
            echo 'Vartotojas sėkmingai užregistruotas ' . " " . $username . " " . $passwordHashed . " " . $userID . " " . $ulevel . " " . $email . " " . $timestamp;
        } else {
            echo 'Registracija nesėkminga. Bandykite vėliau';
        }
    }
    mysqli_close($con);
}

/**
 * generateRandID - Generates a string made up of randomized
 * letters (lower and upper case) and digits and returns
 * the md5 hash of it to be used as a userid.
 */
function generateRandID() {
    return md5(generateRandStr(16));
}

/**
 * generateRandStr - Generates a string made up of randomized
 * letters (lower and upper case) and digits, the length
 * is a specified parameter.
 */
function generateRandStr($length) {
    $randstr = "";
    for ($i = 0; $i < $length; $i++) {
        $randnum = mt_rand(0, 61);
        if ($randnum < 10) {
            $randstr .= chr($randnum + 48);
        } else if ($randnum < 36) {
            $randstr .= chr($randnum + 55);
        } else {
            $randstr .= chr($randnum + 61);
        }
    }
    return $randstr;
}

?>