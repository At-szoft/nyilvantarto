<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Új tartozék</title>
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
            		ÚJ TARTOZÉK FELVITELE
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
									$eredmeny=mysql_query("select azon,megnevezes from tartozekok group by megnevezes");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["megnevezes"];
										echo '<option value="'.$ki.'">'.$ki1.'</option>';
									}
								?>
								</select>&nbsp;&nbsp;
								<label for="nev">Megnevezés:</label>
								<input type="textbox" name="nev" id="nev" style="visibility:hidden;"/>&nbsp;&nbsp;	
								Mennyisége:&nbsp;<input type="text" value="1" name="db" size="5"/>&nbsp;&nbsp;&nbsp;
								Jellege:&nbsp;
								<select name="jelleg">						
									<option value="" selected="selected">Válassz...</option>
									<?php
										$ki="";
										$eredmeny=mysql_query("select megnevezes from jellegek order by megnevezes");
										while($adat=mysql_fetch_assoc($eredmeny)){
											$ki=$adat["megnevezes"];
											echo '<option value="'.$ki.'">'.$ki.'</option>';
										}
									?>
								</select>
						</fieldset>	
						<br>
						<fieldset>
							<legend class="legen">Nyilvántartási adatok</legend>
							Nyt. száma:&nbsp;<input type="text" value="" name="nytsz" size="10"/>&nbsp;&nbsp;
							Gyári száma:&nbsp;<input type="text" value="" name="gyszam" />&nbsp;&nbsp;
							Értéke:&nbsp;<input type="text" value="" name="ertek" />
						</fieldset>
						<br>
						<fieldset>
							<legend class="legen">Eszközhöz rendelési adatok</legend>
							Eszköz:&nbsp;
								<select name="eszkoz" onchange="if (this.value=='nyteszk')   {
									this.form['eszknytsz'].style.visibility='visible';}
								else{
									this.form['eszknytsz'].style.visibility='hidden';};">						
								<option value="" selected="selected">Válassz...</option>
								<option value="nyteszk" >Adott nyilvántartási számú eszköz...</option>
						
								<?php
									$ki="";
									$ki1="";
									$ki2="";
									$ki3="";
									$ki4="";
									$eredmeny=mysql_query("SELECT nyt.azon,nyt.nytsz,esz.megnevezes,esz.gyartmany,esz.tipus  FROM nyilvantartas as nyt inner join eszkozok as esz on nyt.eszkoz=esz.azon");
									while($adat=mysql_fetch_assoc($eredmeny)){
										$ki=$adat["azon"];
										$ki1=$adat["nytsz"];
										$ki2=$adat["megnevezes"];
										$ki3=$adat["gyartmany"];
										$ki4=$adat["tipus"];
										echo '<option value="'.$ki.'">Nytsz:'.$ki1.';&nbsp;&nbsp;Megnevezése:&nbsp'.$ki2.';&nbsp;&nbsp;Gyártmánya:&nbsp'.$ki3.';&nbsp;&nbsp;Típusa:&nbsp'.$ki4.'</option>';
									}
								?>
								</select>&nbsp;&nbsp;
								<label for="eszknytsz">Eszköz nyilvántartási száma:</label>
								<input type="textbox" name="eszknytsz" id="eszknytsz" style="visibility:hidden;"/>
								<br><br>	
								Mennyisége:&nbsp;<input type="text" value="1" name="db" size="5"/>&nbsp;&nbsp;&nbsp;
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
										ClsConDb();
									?>
								</select>
						</fieldset>
						<br>
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
		$eszkoz=$_POST['eszkoz'];	
		$eszknytsz=$_POST['eszknytsz'];
		$db=$_POST['db'];
		$nytsz=$_POST['nytsz'];
		$ertek=$_POST['ertek'];
		$gyszam=$_POST['gyszam'];
		$megj=$_POST['megj'];
		$allapota=$_POST['allapot'];		
		$megnevezes=$_POST['megnevezes'];	// "", ujnev, eszköz azonosító
		$nev=$_POST['nev'];	// ujnév, ha megnevezés újnév, "" 		
		$jellege=$_POST['jelleg'];
		
		if($allapota!=""){
			if ($db!=""){
				if($jellege!=""){
						if($megnevezes!=""){
							if($megnevezes=="ujnev"){
								if ($nev==""){
									echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adta meg a tartozék megnevezését!');</script>";
									exit;
								}
							}else{
								$ki="";
								$eredmeny=mysql_query("select megnevezes from tartozekok where azon='$megnevezes'");
								while($adat=mysql_fetch_assoc($eredmeny)){
									$ki=$adat["megnevezes"];
									$nev=$ki;
								}
								if ($nev==""){
									echo "<script type='text/javascript' charset='UTF-8'>alert('Nincs név ehhez a bejegyzéshez!');</script>";
									exit;
								}	
							}
							if ($eszkoz=="nyteszk"){
								$ki="";
								$eredmeny=mysql_query("select azon from nyilvantartas where nytsz='$eszknytsz'");
								while($adat=mysql_fetch_assoc($eredmeny)){
									$ki=$adat["azon"];
									$eszknytsz=$ki;
								}
								if ($ki!=$eszknytsz){
									echo"<script type='text/javascript' charset='UTF-8'>alert('Hibás eszköz nyilvántartási szám! \nNincs összerendelés!');</script>";
								}	
							}else{
								$eszknytsz=$eszkoz;
							}
							if ($eszknytsz==""){
								$sql="INSERT INTO tartozekok VALUES (null,'$nev','$nytsz','$ertek','$db','$jellege','$gyszam',null,'$allapota','$megj')";
                    		}else{
                    			$sql="INSERT INTO tartozekok VALUES (null,'$nev','$nytsz','$ertek','$db','$jellege','$gyszam','$eszknytsz','$allapota','$megj')";
                    		}
                    		if (mysql_query($sql,$con)){
                    			echo"<script type='text/javascript' charset='UTF-8'>alert('Felvitel sikeres!');</script>";
							}else{
                    			echo "<script type='text/javascript' charset='UTF-8'>alert('Az új tartozék létrehozása sikertelen !');</script>";
								exit;
                    		}
						}else{
							echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adta meg a tartozék megnevezését!');</script>";
							exit;
						}
				}else{
					echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adta meg a tartozék jellegét!');</script>";
					exit;	
				}
			}else{
				echo "<script type='text/javascript' charset='UTF-8'>alert('Nem adott meg darabszámot!');</script>";
				exit;	
			}	
		}else{
			echo "<script type='text/javascript' charset='UTF-8'>alert('Nem állította be az állapotot!');</script>";
			exit;
		}
		echo "<script type='text/javascript' charset='UTF-8'>window.location='newaccessory.php';</script>";
		exit;
	}
?>

