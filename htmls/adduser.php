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
            <title>Új eszközhasználó.</title>
    </head>
	
    <body>
        <div id="cimsor">
            ÚJ ESZKÖZHASZNÁLÓ HOZZÁADÁSA
        </div>
        <div id="formNewPlace">
	       	<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
		        <table class="tableform">
					<tr>
			        	<td>Használó neve:</td><td><input style="border: 2px double red; " class="textbox" type="text" name="nev" size="35"></td>
			        </tr>              
					<tr>
			            <td>Használat jellege :</td>
			            <td>
			            	<select name="jelleg" class="textbox" onchange="if (this.value=='ujjelleg')   {
									this.form['ujjell'].style.visibility='visible';
								}
								else{
									this.form['ujjell'].style.visibility='hidden';							
								};">			
								<option value="" selected="selected">Válassz...</option>
								<option value="ujjelleg" >Új jelleg hozzáadása...</option>
								<?php
									include "connection.php";
									ConDb();
									$ki="";
									$ki2="";
									$eredmeny=mysql_query("select * from felhasznalok group by jelleg");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki2=$adat["jelleg"];
										echo '<option value="'.$ki.'">'.$ki2.'</option>';
									}
									ClsConDb();
								?>
							</select>&nbsp;&nbsp;
			            </td>
				 	</tr>
				 	<tr>
				 		<td><label for="ujj">Jelleg:</label></td>
				 		<td><input class="textbox" type="textbox" name="ujjell" id="ujj" style="visibility:hidden;" size="15"/></td>
				 	</tr>
		        </table>
		        <table class="tableform">
		            <tr>
		            	<td><input class="gombForm" type="submit" name="elkuld" value="FELVITEL"></td>
		                <td><input class="gombForm" type="reset" value="TÖRÖL"></td>
		                <td><input class="gombForm" type="button" value="KILÉP" onclick=window.location.href="fooldal.php"></td>
		            </tr>
		        </table>
			</form>
        </div>
        
      	<?php
        if (isset($_POST['elkuld'])){
        	ini_set("default_charset","utf-8");			
			$nev = $_POST['nev'];		
			$jelleg = $_POST['jelleg'];
			if ($jelleg=="ujjelleg"){	
				$jelleg=$_POST['ujjell'];
			}else{
				if ($jelleg!=""){	
					ConDb();
                	$ki='';
                	$sql=mysql_query("select jelleg from felhasznalok where azon='$jelleg'");
                	while($adat=mysql_fetch_array($sql)){
                		$ki=$adat['jelleg'];
					}
					$jelleg=$ki;
					ClsConDb();
				}
			}
			$rogzit=0;
			if(($nev=="")||($jelleg=="")){
            	echo "<script type='text/javascript' charset='UTF-8'>alert('Hiányzó adat!');</script>";
                echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
			}          
			else{
                ConDb();
                $ki='';
                $sql=mysql_query("select nev from felhasznalok where nev='$nev'");
                while($adat=mysql_fetch_array($sql)){
                	$ki=$adat;
				}
				ClsConDb();
				if ($ki!=''){
                	echo "<script type='text/javascript' charset='UTF-8'>alert('Ez az elhelyezési hely már létezik!');</script>";
					echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";	
					exit;
				}
				else{
                	ConDb();
                    $sql="INSERT INTO felhasznalok VALUES (null,'$nev','$jelleg')";
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