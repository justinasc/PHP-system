<?
include("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
        <title>Paskyros redagavimas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>       
        <table class="center"><tr><td>
                    <img src="pictures/image.jpg"/>
                </td></tr><tr><td> 
                    <?
                    /**
                     * User has submitted form without errors and user's
                     * account has been edited successfully.
                     */
                    if ($session->logged_in) {
                        include("include/meniu.php");
                        ?>
                        <table style="border-width: 2px"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
                        <?
                        if (isset($_SESSION['useredit'])) {
                            unset($_SESSION['useredit']);
                            echo "<p><b>$session->username</b>, Jūsų paskyra buvo sėkmingai atnaujinta.<br><br>";
                        } else {
                            echo "<div align=\"center\">";
                            if ($form->num_errors > 0) {
                                echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                            } else {
                                echo "";
                            }
                            ?>
                            <table bgcolor=#a14167 >
                                <tr><td>
                                        <form action="process.php" style="text-align:left;" method="POST">
                                            <p>Dabartinis slaptažodis:<br>
                                                <input type="password" name="curpass" maxlength="30" size="25" value="<?php echo $form->value("curpass"); ?>">
                                                <br><? echo $form->error("curpass"); ?></p>
                                            <p>Naujas slaptažodis:<br>
                                                <input type="password" name="newpass" maxlength="30" size="25" value="<? echo $form->value("newpass"); ?>">
                                                <br><? echo $form->error("newpass"); ?></p>
                                            <p>E-paštas:<br>
                                                <input type="text" name="email" maxlength="30" size="25" value="<?
                    if ($form->value("email") == "") {
                        echo $session->userinfo['email'];
                    } else {
                        echo $form->value("email");
                    }
                            ?>"> <br><? echo $form->error("email"); ?></p>
                                            <input type="hidden" name="subedit" value="1">
                                            <input type="submit" value="Atnaujinti">
                                        </form>
                                    </td></tr>
                            </table>
                        
                            <?
                            echo "</div>";
                        }
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