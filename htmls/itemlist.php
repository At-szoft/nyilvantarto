<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Eszközök listája</title>
		<link rel="stylesheet" type="text/css" href="../css/sajat.css">	
		<link rel="stylesheet" type="text/css" href="../css/ondiv.css">
        <link rel="stylesheet" type="text/css" href="../css/form.css">
        <link rel="stylesheet" type="text/css" href="../css/calendar.css">
        <script src="../js/print.js"></script>
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
	            Eszközök listája
	        </div>
	        <div id="formUserList">
		        	<table class='tablelist'>
		        		<tr>
		                	<th>NYT.SZÁMA</th><th>MEGNEVEZÉSE</th><th>GYÁRTMÁNYA</th><th>TÍPUSA</th><th>FAJTÁJA</th><th>ELHELYEZÉSE</th><th>ÁLLAPOTA</th>
		                </tr>
		                <?php
		                include "connection.php";
						ConDb();
						$sql=mysql_query("select sel2.nytsz,sel2.megnevezes,sel2.gyartmany,sel2.tipus,sel2.fajta,el.hely,sel2.statusz 
						from (select sel1.nytsz,sel1.megnevezes,sel1.gyartmany,sel1.tipus,sel1.fajta,sel1.elhelyezese,al.statusz 
						from (SELECT nytsz,megnevezes,gyartmany,tipus,fajta,allapot,elhelyezese 
						FROM nyilvantartas as nyt inner join eszkozok as esz on nyt.eszkoz=esz.azon)as sel1 inner join allapot as al on sel1.allapot=al.azon)as sel2 inner join elhelyezes as el on sel2.elhelyezese=el.azon");
						while($sor=mysql_fetch_array($sql)){
		                    echo "<tr>";
		                    	echo "<td>" . $sor['nytsz'] . "</td>";
		                    	echo "<td>" . $sor['megnevezes'] . "</td>";
		                    	echo "<td>" . $sor['gyartmany'] . "</td>";
		                    	echo "<td>" . $sor['tipus'] . "</td>";
								echo "<td>" . $sor['fajta'] . "</td>";
								echo "<td>" . $sor['hely'] . "</td>";
		                    	echo "<td>" . $sor['statusz'] . "</td>";
							echo "</tr>";                  
		                }
						ClsConDb();
		                ?>
	        	</table>
	        </div>	        	
	    	<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
	        	<table class="tableform">
					<tr>
						<td><button class="gombForm" onclick="printContent('formUserList','ESZKÖZ LISTA')">NYOMTAT</button></td>
					    <td><input class="gombForm" type="submit" value="KILÉP" name="kilep" onclick="return confirm('Biztosan kilép?')" /></td>
					</tr>
				</table>
			</form> 
		</div>
		<div id="lablec">
				Nagy Attila @ 2015<br>
	           	AT-SZOFT
		</div>
		<script type="text/javascript" src="../js/handler.js"></script>
	</body>	
</html>  


<?php
if (isset($_POST['kilep']))	{
    	echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
		exit;
	}
if (isset($_POST['nyomtat']))	{
		echo "<script type='text/javascript' charset='UTF-8'>window.location='newitem.php';</script>";
		exit;
	}
?>
