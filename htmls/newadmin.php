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
            ÚJ FELHASZNÁLÓ HOZZÁADÁSA
        </div>
        <div id="formNewUser">
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
            <table class="tableform">

		<tr>
                    <td style="color:red;">Teljes név:</td><td><input style="border: 2px double red; " class="textbox" type="text" name="tnev" size="35" maxlength="40"></td>
                </tr>
                
		
                
                
		<tr>
                    <td>Felhasználónév :</td><td><input class="textbox" type="text" name="fnev" size="15" maxlength="15"></td>
	 	</tr>
		<tr>
                    <td>Jelszó :</td><td><input class="textbox" type="password" name="jelszo" size="15" maxlength="15"></td>
		</tr>
		<tr>
                    <td>Jelszó ismét :</td><td><input class="textbox" type="password" name="jelszoismet" size="15" maxlength="15"></td>
		</tr>
		
            </table>
            <table class="tableform">
                <tr>
                    <td><input class="gombForm" type="submit" name="elkuld" value="FELVITEL"></td>
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
		$tnev = $_POST['tnev'];		
		$fnev = $_POST['fnev'];
		$jelszo = $_POST['jelszo'];
		$jelszo2 = $_POST['jelszoismet'];
                $ki="";
                $adat="";
		if(($tnev=="")||($fnev=="")||($jelszo=="")){
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
                            $sql=mysql_query("select fnev from users where fnev='$fnev'");
                            while($adat=mysql_fetch_assoc($sql)){
					$ki=$adat;
				}
                            ClsConDb();
                            if ($ki!=""){
                                 echo "<script type='text/javascript' charset='UTF-8'>alert('Ezzel a felhasználónévvel már van regisztrálva felhasználó!');</script>";
								echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
								
                            }
                            else{
                                ConDb();
                                $sql="INSERT INTO users VALUES (null,'$tnev','$fnev','$jelszo',1)";
                                if (mysql_query($sql,$con)){
                                    echo "<script type='text/javascript' charset='UTF-8'>alert('Sikeres felvitel !');</script>";
									echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                }
                                else{
                                    echo "<script type='text/javascript' charset='UTF-8'>alert('A felvitel sikertelen !');</script>";
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