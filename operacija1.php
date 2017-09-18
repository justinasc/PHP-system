<?
include("include/session.php");
?>
<html>
    <head>  
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
        <title>Operacija1</title>
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
                        <table style="border-width: 2px"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br>  
						<div style="text-align: center;color:green"> 
						
						</div>
						<?php
						if (isset($_SESSION['regsuccess'])){
						unset($_SESSION['regsuccess']);	
						echo "<p><b>$session->username</b> , naujas rūbas buvo sėkmingai įtrauktas.<br><br>";
						} 
						else {
							echo "<div align=\"center\">";
							
							if($form->num_errors > 0){
								echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
							}
							echo "</div>";
						
						}
						?>
                                         
                            <h1>Drabužių parduotuvė</h1>
                            Pasirinkite savo norimus parametrus. 
						<br>
                         
					<table bgcolor=#a14167 >
						<tr><td>
						<form action="process.php" style="text-align:left;" method="POST">
Firma: 
<input type="text" name="pavadinimas" value="<? echo $form->value("pavadinimas");?>"/><Br><? echo $form->error("pavadinimas");?>
Viršutinis rūbas: 
<select name="virsutinisRubas">
  <option value="dzemperis">Džemperis</option>
  <option value="megztinis">Megztinis</option>
  <option value="marskiniai">Marškiniai</option>
</select>
<br>
Kiekis: <input type="number" name="kiekis" min="1" max="3000" ><br>
Spalva:<br>
 <input type="checkbox" name="spalva[]" value="Pilka" checked> Pilka<br>
 <input type="checkbox" name="spalva[]" value="Melyna"> Mėlyna<br>
 <input type="checkbox" name="spalva[]" value="Geltona"> Geltona<br>
Dydis:<br>
  <input type="radio" name="dydis" value="S" checked> S<br>
  <input type="radio" name="dydis" value="M"> M<br>
  <input type="radio" name="dydis" value="L"> L<br>
<input type="hidden" name="subnew" value="1">  
<input type="submit">
					</form>
				</td></tr>
			</table>
                
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