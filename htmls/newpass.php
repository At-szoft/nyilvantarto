<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
    <head>        	
            <link rel="stylesheet" type="text/css" href="../css/ondiv.css">
            <link rel="stylesheet" type="text/css" href="../css/form.css">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="Author" lang="hu" content="Nagy Attila">
            <title>Új felhasználó.</title>
    </head>
	
    <body>
        <div id="cimsor">
            JELSZÓ MÓDOSÍTÁS
        </div>
        <div id="formNewUser">
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
            <table class="tableform">

		
                    <td>Régi jelszó :</td><td><input class="textbox" type="password" name="ojelszo" size="15" maxlength="15"></td>
	 	</tr>
		<tr>
                    <td>Új jelszó :</td><td><input class="textbox" type="password" name="jelszo" size="15" maxlength="15"></td>
		</tr>
		<tr>
                    <td>Új jelszó ismét :</td><td><input class="textbox" type="password" name="jelszoismet" size="15" maxlength="15"></td>
		</tr>
		
            </table>
            <table class="tableform">
                <tr>
                    <td><input class="gombForm" type="submit" name="elkuld" value="MÓDOSÍT"></td>
                    <td><input class="gombForm" type="reset" value="TÖRÖL"></td>
                    <td><input class="gombForm" type="button" value="KILEP" onclick=window.location.href="fooldal.php"></td>
                </tr>
            </table>
	</form>
        </div>
        
      <?php
            if (isset($_POST['elkuld'])){
                ini_set("default_charset","utf-8");
		include "connection.php";			
		$ojelszo = $_POST['ojelszo'];
		$jelszo = $_POST['jelszo'];
		$jelszo2 = $_POST['jelszoismet'];
		$fnev=$_SESSION['fnev'];
		
                $ki="";
                $adat="";
		if(($ojelszo=="")||($jelszo=="")){
                    echo "<script type='text/javascript' charset='UTF-8'>alert('Hiányzó adat!');</script>";
                    echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
		}
                    else{
			if($jelszo!=$jelszo2){
                            echo "<script type='text/javascript' charset='UTF-8'>alert('A beírt jelszavak nem egyeznek!');</script>";
                            echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
			}
			else{
                            ConDb();
                            $sql=mysql_query("select pass from users where fnev='$fnev'");
							
                            while($adat=mysql_fetch_assoc($sql)){
							$ki=$adat['pass'];
						
				}
                            ClsConDb();
							
                            if ($ki!=$ojelszo){
                                 echo "<script type='text/javascript' charset='UTF-8'>alert('Hibás a megadott jelszó!');</script>";
								echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
								
                            }
                            else{
                                ConDb();
                                $sql = "UPDATE users SET pass='$jelszo' WHERE fnev='$fnev'";
                                if (mysql_query($sql,$con)){
                                    echo "<script type='text/javascript' charset='UTF-8'>alert('A jelszó módosítva !');</script>";
									echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                }
                                else{
                                    echo "<script type='text/javascript' charset='UTF-8'>alert('A módosítás sikertelen !');</script>";
									echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                }
                            ClsConDb();
                            }
                        }
                    }
		}
	
	?>
    </body>
	
</html>