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
            <title>Új beszerzési forrás.</title>
    </head>
	
    <body>
        <div id="cimsor">
            ÚJ BESZERZÉSI FORRÁS HOZZÁADÁSA
        </div>
        <div id="formNewUser">
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
            <table class="tableform">

		<tr>
                    <td style="color:red;">Megnevezése:</td><td><input style="border: 2px double red; " class="textbox" type="text" name="megnev" size="35"></td>
                </tr>
                
		
                
                
		<tr>
                    <td>Forrás jellege :</td><td><input class="textbox" type="text" name="forr" size="15"></td>
	 	</tr>
		<tr>
                    <td>Rendelkezésre állás éve :</td><td><input class="textbox" type="text" name="ev" size="15" maxlength="4"></td>
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
		$megnev = $_POST['megnev'];		
		$forr = $_POST['forr'];
		$ev = $_POST['ev'];
		$rogzit=0;
		if(($megnev=="")||($forr=="")||($ev=="")){
                    echo "<script type='text/javascript' charset='UTF-8'>alert('Hiányzó adat!');</script>";
                    echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
		}
                   
			else{
                            ConDb();
                            $ki='';
                            $sql=mysql_query("select * from beszerzes where ev=$ev and megnevezes='$megnev' and jelleg='$forr' ");
                            while($adat=mysql_fetch_array($sql)){
                            	$ki=$adat;
							}
							ClsConDb();
							if ($ki!=''){
                                echo "<script type='text/javascript' charset='UTF-8'>alert('Ebben az évben már van ilyen megnevezésű és forrású beszerzés!');</script>";
								echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";	
								exit;
							}else{
                            	ConDb();
                                $sql="INSERT INTO beszerzes VALUES (null,'$forr','$megnev',$ev)";
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
	
	?>
    </body>
	
</html>