<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Új nyilvántartásba vétel</title>
		<link rel="stylesheet" type="text/css" href="../css/sajat.css">	
		<link rel="stylesheet" type="text/css" href="../css/ondiv.css">
        <link rel="stylesheet" type="text/css" href="../css/form.css">
        <link rel="stylesheet" type="text/css" href="../css/calendar.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="Author" lang="hu" content="Nagy Attila">
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                <tr>
                    <td id="ds_calclass"></td>
                </tr>
            </table>
            <script src="../js/calendar.js"></script> 
	</head>
	
	<body>
		<div id="lap">
			<div id="fejlec">
				INFORMATIKAI&nbsp; ESZKÖZ&nbsp; NYILVÁNTARTÓ
			</div>
			<div id="fomenu">
				  <nav id="menu">
					  <ul id="menusor">
						     <li><a href="#">Felvitel</a>
						        <ul>
							  		<li><a href="#">Új eszköz</a></li>
							  		<li><a href="#">Új tartozék</a></li>
							  		<li><a href="#">Beszerzési forrás</a></li>
							  		<li><a href="#">Elhelyezési hely</a></li>
							  		<li><a href="#">Eszköz használó</a></li>
								</ul>
						     </li>
					     <li><a href="#">Módosítás</a>
							<ul>
						  		<li><a href="#">Eszközök</a></li>
						 		<li><a href="#">Tartozékok</a></li>
						  		<li><a href="#">Források</a></li>
						  		<li><a href="#">Helyek</a></li>
						  		<li><a href="#">Használók</a></li>
							</ul>
					     </li>
					     <li><a href="#">Keresés</a>
					     	<ul>
						  		<li><a href="#">Egyéni keresés</a></li>
						 		<li><a href="#">Nytsz szerinti</a></li>
						  		<li><a href="#">Név szerinti</a></li>
					
							</ul>
					     </li>
					     <li><a href="#">Listázás</a>
					     	<ul>
						  		<li><a href="#">Eszközök listája</a></li>
						 		<li><a href="#">Személyek listája</a></li>
						  		<li><a href="#">Helység leltár</a></li>
						  		<li><a href="#">Statisztika</a></li>
						  		<li><a href="#">Egyéni listák</a></li>
							</ul>
					     </li>
					     <li><a href="#">Kezelés</a>
					     	<ul>
						  		<li><a href="#">Új kezelő felvitele</a></li>
						 		<li><a href="#">Kezelő módosítása</a></li>
						  		<li><a href="#">Jelszó módosítása</a></li>
						  		<li><a href="#">Kilépés</a></li>
							</ul>
					     </li>
					  </ul>
				  </nav>
			</div>
			<div id="tartalom">
				<div id="cimsor">
            		ÚJ ESZKÖZ FELVITELE
        		</div>
				<div id="bevitel">	
					<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
						<fieldset>
							<legend class="legen">Alapadatok</legend>	
								Megnevezése:&nbsp;
								<select name="megnevezes" onchange="if (this.value=='ujnev')   {
									this.form['nev'].style.visibility='visible';}
								else{
									this.form['nev'].style.visibility='hidden';};">						
								<option value="" selected="selected">Válassz...</option>
								<option value="ujnev" >Új megnevezés hozzáadása.</option>
						
								<?php
									include "connection.php";
									ConDb();
									$ki="";
									$ki1="";
									$eredmeny=mysql_query("select azon,megnevezes from eszkozok group by megnevezes");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["megnevezes"];
										echo '<option value="'.$ki.'">'.$ki1.'</option>';
									}
								?>
								</select>&nbsp;&nbsp;
								<label for="nev">Megnevezés:</label>
								<input type="textbox" name="nev" id="nev" style="visibility:hidden;"/>&nbsp;&nbsp;	
								Mennyisége:&nbsp;<input type="text" value="1" name="db" size="5"/>&nbsp;&nbsp;
								<p>
								Gyártmánya,típusa:
							<select name="gyartmany" onchange="if (this.value=='ujgyart')   {
									this.form['gynev'].style.visibility='visible';
									this.form['tnev'].style.visibility='visible';
									this.form['fajta'].style.visibility='visible';}
								else{
									this.form['gynev'].style.visibility='hidden';
									this.form['tnev'].style.visibility='hidden';
									this.form['fajta'].style.visibility='hidden';};">						
								<option value="" selected="selected">Válassz...</option>
								<option value="ujgyart" >Új gyártmány és típus hozzáadása.</option>
						
								<?php
									$ki="";
									$ki1="";
									$ki2="";
									$ki3="";
									$ki11="";
									$ki22="";
									$ki33="";
									$eredmeny=mysql_query("select azon,gyartmany,tipus, fajta from eszkozok order by gyartmany,tipus,fajta");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["gyartmany"];
										$ki2=$adat["tipus"];
										$ki3=$adat["fajta"];
										if (($ki1!=$ki11)||($ki2!=$ki22)||($ki3!=$ki33)){
											echo '<option value="'.$ki.'">'.$ki1.','.$ki2.','.$ki3.'</option>';
											$ki11=$ki1;
											$ki22=$ki2;
											$ki33=$ki3;
										}
									}
								?>
							</select>&nbsp;&nbsp;
							<label for="gyn">Gyártmány:</label>
							<input type="textbox" name="gynev" id="gyn" size="16" style="visibility:hidden;"/>&nbsp;&nbsp;
							<label for="tn">Típus:</label>
							<input type="textbox" name="tnev" id="tn" size="16" style="visibility:hidden;"/>&nbsp;&nbsp;
							<label for="faj">Fajta:</label>
							<select name="fajta" id="faj" style="visibility:hidden;">						
									<option value="" selected="selected">Válassz...</option>
									<?php
										$ki="";
										$eredmeny=mysql_query("select megnevezes from fajtak order by megnevezes");
										while($adat=mysql_fetch_assoc($eredmeny)){
											$ki=$adat["megnevezes"];
											echo '<option value="'.$ki.'">'.$ki.'</option>';
										}
									?>
							</select>
						</fieldset>	
						
						<fieldset>
							<legend class="legen">Beszerzési adatok</legend>
							Forrása:&nbsp;
							<select name="beszforr">
								<option value="" selected="selected">Válassz...</option>
								<?php	
									$ki="";
									$ki1="";
									$ki2="";
									$ki3="";
									$eredmeny=mysql_query("select * from beszerzes");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["megnevezes"];
										$ki2=$adat["ev"];
										$ki3=$adat["jelleg"];
										echo '<option value="'.$ki.'">'.$ki1.','.$ki3.','.$ki2.'</option>';
									}
								?>
							</select>
							Értéke:&nbsp;<input type="text" value="" name="ertek" size="10"/>&nbsp;&nbsp;
							Üzembehelyezés dátuma:&nbsp;<input onclick="ds_sh(this);" name="date" readonly="readonly" style="cursor: text"/>
						</fieldset>
						<br>
						<fieldset>
							<legend class="legen">Nyilvántartási adatok</legend>
							Nyt. száma:&nbsp;<input type="text" value="" name="nytsz" size="12"/>&nbsp;&nbsp;
							Előző nyt. száma:&nbsp;<input type="text" value="" name="enytsz" size="12" />&nbsp;&nbsp;
							Gyári száma:&nbsp;<input type="text" value="" name="gyszam" size="16"/>&nbsp;&nbsp;
							Állapota:&nbsp;
							<select name="allapot">
								<option value="" selected="selected">Válassz...</option>
								<?php	
									$ki="";
									$ki1="";
									$eredmeny=mysql_query("select * from allapot");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["statusz"];
										echo '<option value="'.$ki.'">'.$ki1.'</option>';
									}
								?>
							</select>
							<br><br>
							Elhelyezése:&nbsp;
							<select name="elhelyezes">
								<option value="" selected="selected">Válassz...</option>
								<?php	
									$ki="";
									$ki1="";
									$eredmeny=mysql_query("select * from elhelyezes order by hely");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["hely"];
										echo '<option value="'.$ki.'">'.$ki1.'</option>';
									}
								?>
							</select>&nbsp;&nbsp;
							Felhasználók:&nbsp;
							<select name="felhasznalok">
								<option value="" selected="selected">Válassz...</option>
								<?php	
									$ki="";
									$ki1="";
									$eredmeny=mysql_query("select * from felhasznalok order by nev");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["nev"];
										echo '<option value="'.$ki.'">'.$ki1.'</option>';
									}
									ClsConDb();
								?>
							</select>&nbsp;&nbsp;
						</fieldset>
						<fieldset>
							<legend class="legen">Megjegyzés</legend>
							<input type="text" size="130" value="" name="megj" />
						</fieldset>
						<table class="tableform">
				            <tr>
				            	<td><input class="gombForm" type="submit" name="felvisz" value="FELVITEL" onclick="return confirm('Felvisszük az új eszközt?')" /></td>
				                <td><input class="gombForm" type="reset" value="TÖRÖL"></td>
				                <td><input class="gombForm" type="submit" value="KILÉP" name="kilep" onclick="return confirm('Biztosan kilép?')" /></td>
				            </tr>
			        	</table>
					</form>
				</div>
				
			</div>
			<div id="lablec">
				Nagy Attila @ 2015<br>
	           	AT-SZOFT
			</div>
		</div>
		<script type="text/javascript" src="../js/handler.js"></script>
	</body>	
</html>

<?php
    if (isset($_POST['kilep']))	{
    	echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
		exit;
	}
	if (isset($_POST['felvisz'])){
		ConDb();	
		$eszkoz="";
		$nytsz=$_POST['nytsz'];
		$date=$_POST['date'];
		$db=$_POST['db'];
		$ertek=$_POST['ertek'];
		$enytsz=$_POST['enytsz'];
		$gyszam=$_POST['gyszam'];
		$megj=$_POST['megj'];
		$allapot=$_POST['allapot'];
		$beszforr=$_POST['beszforr'];
		$elhelyezes=$_POST['elhelyezes'];
		$felhasznalok=$_POST['felhasznalok'];
		
		$megnevezes=$_POST['megnevezes'];	// "", ujnev, eszköz azonosító
		$megnevazon=0;
		$nev=$_POST['nev'];	// ujnév, ha megnevezés újnév, "" 
		$gyartmany=$_POST['gyartmany'];		// "", ujgyart, eszköz azonosító
		$gyartazon=0;
		$gynev=$_POST['gynev'];
		$tnev=$_POST['tnev'];
		$fajta=$_POST['fajta'];
		
		if ($nytsz!=""){
			$eredmeny=mysql_query("select nytsz from nyilvantartas where nytsz='$nytsz'");
			while($adat=mysql_fetch_assoc($eredmeny)){
				echo "<script type='text/javascript' charset='UTF-8'>alert('Ez a nyilvántartási szám már használatban van !');</script>";
				ClsConDb();
				exit;					
			}
		
			if ($date!=""){
				if($db!=""){
					if($megnevezes!=""){
						if($megnevezes=="ujnev"){
							if($nev==""){
								echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg eszköznevet!');</script>";
								exit;
							}
						}else{
							$megnevazon=1;
						}
					}else{
						echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg eszköznevet!');</script>";
						exit;
					}
					if($gyartmany!=""){
						if($gyartmany=="ujnev"){
							if($fajta==""){
								echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg eszközfajtát!');</script>";
								exit;
							}
						}else{
							$gyartazon=1;	
						}
					}else{
						echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg gyártmányt!');</script>";
						exit;	
					}
					if (($megnevazon==1)||($gyartazon==1)){
						if($megnevezes==$gyartmany){
							$eszkoz=$megnevezes;
						}else{
							if ($megnevazon==1){
								$eredmeny=mysql_query("select megnevezes from eszkozok where azon='$megnevezes'");
								while($adat=mysql_fetch_assoc($eredmeny)){
									$nev=$adat['megnevezes'];
								}
							}
							if ($gyartazon==1){
								$eredmeny=mysql_query("select * from eszkozok where azon='$gyartmany'");
								while($adat=mysql_fetch_assoc($eredmeny)){
									$gynev=$adat['gyartmany'];
									$tnev=$adat['tipus'];
									$fajta=$adat['fajta'];
								}
							}
								
						}
					}
					$ki="";
					$eredmeny=mysql_query("select azon from eszkozok where megnevezes='$nev' and gyartmany='$gynev' and tipus='$tnev' and fajta='$fajta'");
					while($adat=mysql_fetch_assoc($eredmeny)){
						$ki=$adat["azon"];
						$eszkoz=$ki;
					}
					if ($eszkoz==""){
						$sql="INSERT INTO eszkozok VALUES (null,'$nev','$gynev','$tnev','$fajta')";
                    	if (mysql_query($sql,$con)){
                    		$ki="";
							$eredmeny=mysql_query("select azon from eszkozok where megnevezes='$nev' and gyartmany='$gynev' and tipus='$tnev' and fajta='$fajta'");
							while($adat=mysql_fetch_assoc($eredmeny)){
								$ki=$adat["azon"];
								$eszkoz=$ki;
							}		
                    	}
                		else{
                    		echo "<script type='text/javascript' charset='UTF-8'>alert('Az új eszközfajta létrehozása sikertelen !');</script>";
							exit;
                    	}
					}
					
					if ($allapot!=""){
						$sql="INSERT INTO nyilvantartas VALUES (null,'$eszkoz','$db','$beszforr','$ertek','$date','$nytsz','$enytsz','$elhelyezes','$felhasznalok','$gyszam','$allapot','$megj')";
                    	echo '<br>'.$sql;
						if (mysql_query($sql,$con)){
                    		echo"<script type='text/javascript' charset='UTF-8'>alert('Felvitel sikeres!');</script>";
						}else{
                    		echo "<script type='text/javascript' charset='UTF-8'>alert('Az új eszköz létrehozása sikertelen !');</script>";
							exit;
                    	}	
					}else{
						echo "<script type='text/javascript' charset='UTF-8'>alert('Nem állította be az állapotot!');</script>";
						exit;
					}		
					
				}else{
					echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg darabszámot!');</script>";
					exit;	
				}	
			}else{
				echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg üzembehelyezési dátumot!');</script>";
				exit;	
			}			
		}else{
			echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg nyilvántartási számot!');</script>";
			exit;
		}

		echo "<script type='text/javascript' charset='UTF-8'>window.location='newitem.php';</script>";
		exit;
	}
?>

