<?
include("include/session.php");
?>
<html>
    <head>  
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
        <title>Operacija3</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <table class="center"><tr><td>
                    <img src="pictures/image.jpg"/>
                </td></tr><tr><td> 
                    <?
                    //Jei vartotojas prisijungęs
                    if ($session->logged_in) {
                        include("include/meniu.php");
                    ?>              
                        <table style="border-width: 2px;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
						<?
							if (isset($_GET['id'])) {
								$drabuziai_id = trim($_GET['id']);
								
								global $database;
								
								$q = "SELECT * " . "FROM " . TBL_DRABUZIAI . " WHERE id = '$drabuziai_id'"; // PASITIKRINT ID
								$result   = $database->query($q);
							
								/* Error occurred */
								$num_rows = mysql_numrows($result);
								if (!$result || ($num_rows < 0)) {
									echo "Nepavyko prisijungti prie duomenų bazės. Bandykite vėliau.";
									return;
								}
								if ($num_rows == 0) {
									echo "Drabužio duomenų bazėje nerasta.";
									return;
								}
								
								for ($i = 0; $i < $num_rows; $i++) {
									$id 			 = mysql_result($result, $i, "id");
									$pavadinimas 	 = mysql_result($result, $i, "pavadinimas");
									$virsutinisRubas = mysql_result($result, $i, "virsutinis_rubas");
									$kiekis 		 = mysql_result($result, $i, "kiekis");
									$spalva 		 = mysql_result($result, $i, "spalva");
									$dydis 			 = mysql_result($result, $i, "dydis");
									$data 			 = mysql_result($result, $i, "data");
								}
								
						?>
							<div style="text-align: left;color:green">                   
								<h1>Užklausos redagavimas</h1>
							</div>
							<table bgcolor=#C3FDB8 >
								<tr><td>					
								<form action="../admin/adminprocess.php" style="text-align:left;" method="POST">
Firma: 
<input type="text" name="pavadinimas" value="<?php echo $pavadinimas;?>"><Br>
Viršutinis rūbas: 
<select name="virsutinisRubas">
  <option <?php if (!strcmp($virsutinisRubas, "dzemperis")) echo 'selected' ?> value="dzemperis">Džemperis</option>
  <option <?php if (!strcmp($virsutinisRubas, "megztinis")) echo 'selected' ?> value="megztinis">Megztinis</option>
  <option <?php if (!strcmp($virsutinisRubas, "marskiniai")) echo 'selected' ?> value="marskiniai">Marškiniai</option>
</select>
<br>
Kiekis: <input type="number" name="kiekis" min="1" max="3000" value="<?php echo $kiekis;?>" ><br>
Spalva:<br>
 <input type="checkbox" name="spalva[]" value="Pilka" <?php $spalva2 = explode (" ", $spalva); if (in_array("Pilka", $spalva2)) {echo 'checked';} ?> > Pilka<br>
 <input type="checkbox" name="spalva[]" value="Melyna" <?php $spalva2 = explode (" ", $spalva); if (in_array("Melyna", $spalva2)) {echo 'checked';} ?> > Mėlyna<br>
 <input type="checkbox" name="spalva[]" value="Geltona" <?php $spalva2 = explode (" ", $spalva); if (in_array("Geltona", $spalva2)) {echo 'checked';} ?> > Geltona<br>
Dydis:<br>
  <input type="radio" name="dydis" value="S" <?php if (!strcmp($dydis, "S")) echo 'checked' ; ?> > S<br>
  <input type="radio" name="dydis" value="M" <?php if (!strcmp($dydis, "M")) echo 'checked' ; ?> > M<br>
  <input type="radio" name="dydis" value="L" <?php if (!strcmp($dydis, "L")) echo 'checked' ; ?> > L<br>
<input type="hidden" name="subedit" value="<?php echo "$drabuziai_id"; ?>">  
<input type="submit" value="Redaguoti">
								</form>
								</td></tr>
							</table>
						<?
							} else {
								echo "<h1>Nepasirinkote drabužio.</h1>";
							}
                        ?>
                    <?
						//Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                        //Jei atsiranda klaidų, rodomi pranešimai.
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
        </table>       
    </body>
</html>