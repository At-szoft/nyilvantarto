<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
	
<?php
	if (isset($_POST['belep'])){
		ini_set("default_charset","utf-8");
		include "connection.php";
		$fnev=$_POST['uname'];
		$jelszo=$_POST['pwd'];
		$adat="";
		$ki="";
		if ($fnev==""){
			echo "<script type='text/javascript' charset='UTF-8'>alert('Nincs megadva felhasználónév !');</script>";
		}
		else{
			if ($jelszo==""){
				echo "<script type='text/javascript' charset='UTF-8'>alert('Nincs megadva jelszó !');</script>";
			}
			else{
				ConDb();
				$eredmeny=mysql_query("select pass from users where fnev='$fnev'");
				while($adat=mysql_fetch_assoc($eredmeny)){
					$ki=$adat;
				}
				ClsConDb();
				if ($ki==""){
					echo "<script type='text/javascript' charset='UTF-8'>alert('Nincs regisztrálva ilyen felhasználó !');</script>";
				}
				else{
					if ($ki["pass"]==$jelszo){
						session_start();
						$_SESSION['valid']=1;
						$_SESSION['fnev']=$fnev;
						header("Location: fooldal.php");						
					}
					else{
						echo "<script type='text/javascript' charset='UTF-8'>alert('Hibás a megadott jelszó !');</script>";
					}
				}
			}
		}		
	}
?>
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="hu">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/logon.css">
	<title>Informatikai eszköz nyilvántartó</title>
</head>
<body>
	<div id="logonhead" class="cimsor">	
		INFORMATIKAI ESZKÖZ NYILVÁNTARTÓ	
	</div>
	<div id="logonwindow">
		<div id="logonarea">
			<h2><b>BEJELENTKEZÉS</b></h2>
			<p>
				Kérem adja meg a felhasználónevét és jelszavát!
			</p>
			<p>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<b>Felhasználónév:</b><br>
					<input class="textbox" type="text" name="uname" size="14" />
					<br><br>
					<b>Jelszó:</b><br> 
					<input class="textbox" type="password" name="pwd" size="14" />
					<br><br>
					<input class="gombForm" type="submit" name="belep" value="BELÉPÉS">
				</form>
			</p>
		</div>
	</div>
        <div id="foot">
            Nagy Attila @ 2015<br>
            AT-SZOFT
        </div>
</body>
</html>

