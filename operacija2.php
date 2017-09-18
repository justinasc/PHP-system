<?
include("include/session.php");
?>
<html>
    <head>  
        <meta http-equiv="X-UA-Compatible" content="IE=9"; type="text/html"; charset="utf-8"/> 
        <title>Operacija2</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <table class="center" >
            <tr><td>
                    <img src="pictures/image.jpg"/>
                </td></tr><tr><td> 
                    <?
//user logged in
if ($session->logged_in) {
    include("include/meniu.php");
?>
                        <table style="border-width: 2px;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
						
						<?
    function displayEntries($name, $paieska)
    {
        global $database;
        if (!get_magic_quotes_gpc()) {
            $name = addslashes($name);
        }

		$username = $_SESSION['username'];
		/* checks who is logged in */
		
		$q = "";
		if (strcasecmp($username, ADMIN_NAME) == 0) { //admin
			if (!$name || strlen($name = trim($name)) == 0) { // empty search - display all results
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " ORDER BY pavadinimas ASC";
			} else if($paieska == "pavadinimas"){ // exactly or similar clothes name
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE pavadinimas LIKE '%$name%' ORDER BY pavadinimas ASC";
			}
			else if($paieska == "virsutinisRubas"){ 
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE virsutinis_rubas LIKE '%$name%' ORDER BY virsutinis_rubas ASC";
			}
			else if($paieska == "spalva"){ 
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE spalva LIKE '%$name%' ORDER BY spalva ASC";
			}
			else if($paieska == "dydis"){ 
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE dydis LIKE '%$name%' ORDER BY dydis ASC";
			}
		} else { //user
			if (!$name || strlen($name = trim($name)) == 0) { // empty search - display exact user entries
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE vartotojas LIKE '$username' ORDER BY pavadinimas ASC";
			} else if($paieska == "pavadinimas"){ // exactly or similar clothes name
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE pavadinimas LIKE '%$name%' AND vartotojas LIKE '$username' ORDER BY pavadinimas ASC";
			}
			else if($paieska == "virsutinisRubas"){ // exactly or similar clothes name
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE virsutinis_rubas LIKE '%$name%' AND vartotojas LIKE '$username' ORDER BY virsutinis_rubas ASC";
			}
			else if($paieska == "spalva"){ // exactly or similar clothes name
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE spalva LIKE '%$name%' AND vartotojas LIKE '$username' ORDER BY spalva ASC";
			}
			else if($paieska == "dydis"){ // exactly or similar clothes name
				$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE dydis LIKE '%$name%' AND vartotojas LIKE '$username' ORDER BY dydis ASC";
			}
		}
		
		$result = $database->query($q);
		// if error occures, return given name by default
		$num_rows = mysql_numrows($result);
		if (!$result || ($num_rows < 0)) {
			echo "Nepavyko prisijungti prie duomenų bazės, pabandykit vėliau.";
			return;
		}
		if ($num_rows == 0) {
			echo "Tokios firmos drabužių nėra.";
			return;
		}
        /* Display table contents */
        echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
        echo "<tr><td><b>Eil.Nr.</b></td><td><b>Firma</b></td><td><b>Viršutinis rūbas</b></td><td><b>Kiekis</b></td><td><b>Spalva</b></td><td><b>Dydis</b></td><td><b>Įrašas sukurtas</b></td></tr>\n";
        for ($i = 0; $i < $num_rows; $i++) {
			$id 				= mysql_result($result, $i, "id");
			$pavadinimas 		= mysql_result($result, $i, "pavadinimas");
			$virsutinisRubas 	= mysql_result($result, $i, "virsutinis_rubas");
			$kiekis 			= mysql_result($result, $i, "kiekis");
			$spalva 			= mysql_result($result, $i, "spalva");
			$dydis 				= mysql_result($result, $i, "dydis");
			$data 				= mysql_result($result, $i, "data");
			$eil_nr 			= $i + 1; // numbering clothes from 1
			
			if (strcasecmp($username, ADMIN_NAME) == 0) { //admin
				echo "<tr>
				<td>$eil_nr</td>
				<td><a href=\"../operacija3.php?id=$id\">$pavadinimas</a></td>
				<td>$virsutinisRubas</td>
				<td>$kiekis</td>
				<td>$spalva</td><td>$dydis</td>
				<td>$data</td>\n";
				echo "<td>"
				?>
				<form action="../admin/adminprocess.php" method="POST">
					<input type="hidden" name="subdelentry" value="<?php echo "$id"; ?>">
					<input type="image" src="pictures/delete.png" alt="submit" align="left" width="40px">
				</form>
				<?
			echo "</td></tr>\n";
			} else { //user
					echo "<tr><td>$eil_nr</td><td>$pavadinimas</td><td>$virsutinisRubas</td><td>$kiekis</td><td>$spalva</td><td>$dydis</td><td>$data</td></tr>\n";
			}
			

        }
        echo "</table><br>\n";
    }
    
    if (isset($_POST['search'], $_POST['paieska'])) {
?>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
						<tr><td>
						<h3>Pateikiami jūsų paieškos rezultatai:</h3>
						<?
        displayEntries($_POST['search'], $_POST['paieska']);
        unset($_POST['search'], $_POST['paieska']);
?>
						<br>
						<tr><td><hr></td></tr>
						</td></tr>
						<?
    }
?>
						
                        <div style="text-align: left">                   
                            <h1>Drabužių paieška</h1>
						</div>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Paieška pagal: <br>
<select name="paieska">
  <option value="pavadinimas">Pavadinimas</option>
  <option value="virsutinisRubas">Viršutinis rūbas</option>
  <option value="spalva">Spalva</option>
  <option value="dydis">Dydis</option>
</select> 
									
									<input type="text" name="search" maxlength="30" value="">
									<input type="hidden" name="subsearch" value="1">
									<input type="submit" value="Ieškoti">
								</form>               
                        <br>                               
						</table>
                        <?
    // If user is not logged in, showing the login form
} else {
    echo "<table align=\"center\" class=\"center\"><tr><td>";
    include("include/loginForm.php");
    echo "</td></tr></table><br></td></tr>";
}
echo "<tr><td>";
include("include/footer.php");
echo "</td></tr>";
?>
                </td></tr>
    </body>
</html>