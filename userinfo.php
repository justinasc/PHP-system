<?
include("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Mano paskyra</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>       
        <table class="center" ><tr><td>
            <center><img src="pictures/image.jpg"/></center>
        </td></tr><tr><td>  
            <?
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
                <table>
                    <tr><td>
                            Atgal į [<a href="index.php">Pradžia</a>]
                        </td></tr></table>               
                <br> 
                <?
                /* Requested Username error checking */
                if (isset($_GET['user'])) {
                    $req_user = trim($_GET['user']);
                } else {
                    $req_user = null;
                }
                if (!$req_user || strlen($req_user) == 0 ||
                        !eregi("^([0-9a-z])+$", $req_user) ||
                        !$database->usernameTaken($req_user)) {
                    echo "<br><br>";
                    die("Vartotojas nėra užsiregistravęs");
                }

                /* Display requested user information */
                $req_user_info = $database->getUserInfo($req_user);

//                <table><tr><td>Vartotojo vardas:</td>
//                        <td><?$req_user_info['username']</td>                       
                //     </tr>
                //   <tr><td>E-paštas:</td>
                //   <td>//<?$req_user_info['email']</td>                       
                //  </tr>   
                // </table>


                echo "<br><table border=1 style=\"text-align:left;\" cellspacing=\"0\" cellpadding=\"3\"><tr><td><b>Vartotojo vardas: </b></td>"
                . "<td>" . $req_user_info['username'] . "</td></tr>"
                . "<tr><td><b>E-paštas:</b></td>"
                . "<td>" . $req_user_info['email'] . "</td></tr></table><br>";
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