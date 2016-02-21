<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Név szerinti keresés</title>
		<link rel="stylesheet" type="text/css" href="../css/sajat.css">	
		<link rel="stylesheet" type="text/css" href="../css/ondiv.css">
        <link rel="stylesheet" type="text/css" href="../css/form.css">
        <link rel="stylesheet" type="text/css" href="../css/calendar.css">
        <link rel="stylesheet" type="text/css" href="../css/multiple-select.css">
    	<script src="../js/jquery-1.11.3.js"></script>
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
	            Név szerinti keresés
	        </div>
	        <div id="formNameSearch">
	        	<form id="lista" action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
		        	<table class="tableform">
		       			<tr>
			       			<td align="left">
								KERESENDŐ NÉV:&nbsp;
			        		</td>
							<td align="left">
							<input type="text" class="textbox" name="search" value="" size="20">
							</td>
							<td align="left">
								<input type="radio" name="searchtype" value="pontos" checked>Pontos keresés<br>
								<input type="radio" name="searchtype" value="kozelito">Közelítő keresés
			        		</td>
			        		<td><input class="gombForm" type="submit" name="kuld" value="KERES" /></td>
						    <td><input class="gombForm" type="submit" value="KILÉP" name="kilep" onclick="return confirm('Biztosan kilép?')" /></td>
						</tr>
					</table>
				</form>
	        </div>
	        
			<?php
				if (isset($_POST['kilep']))	{
						echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
						exit;
					}
				
				if (isset($_POST['kuld']))	{
						$adat=$_POST['search'];
						if ($adat!=""){
							$stype=$_POST['searchtype'];
							include "connection.php";
							ConDb();
							if ($stype=='pontos'){	
								$sql="select * from nytviewall where megnevezes='$adat' order by nytsz";
							}else{
								$adat="%".$adat."%";
								$sql="select * from nytviewall where megnevezes like '$adat' order by nytsz";
							}
							$result = mysql_query($sql);
							if (mysql_num_rows($result) == 0) {
							    echo "<script type='text/javascript' charset='UTF-8'>alert('A keresés nem hozott találatot!');</script>";
							    exit;
							}
							echo '<div id="formSearchName">';
							
							while($sor=mysql_fetch_array($result)){
								echo "Nyilvántartási száma:&nbsp".$sor['nytsz']."<br>";
								echo "Az eszköz megnevezése:&nbsp".$sor['megnevezes']."<br>";
								echo "Gyártmánya:&nbsp".$sor['gyartmany']."<br>";
								echo "Típusa:&nbsp".$sor['tipus']."<br>";
								echo "Fajtája:&nbsp".$sor['fajta']."<br>";
								echo "Mennyisége:&nbsp".$sor['darab']."<br>";
								echo "Beszerzés forrása:&nbsp".$sor['beszjelleg']."<br>";
								echo "Beszerzés neve:&nbsp".$sor['besznev']."<br>";
								echo "Beszerzés éve:&nbsp".$sor['beszeve']."<br>";
								echo "Elhelyezése:&nbsp".$sor['helye']."<br>";
								echo "Nyilvántartási száma:&nbsp".$sor['nytsz']."<br>";
								echo "<hr>";
							}
													
							echo '</div>';
							ClsConDb();
						
						
							echo '<table class="tableform"><tr>';
							echo '<td><button class="gombForm" onclick="printContent(\'formSearchName\',\'NÉV SZERINTI KERESÉS\')">NYOMTAT</button></td>';
							echo '</tr></table>';
					}
				}
				$exit;
				
			?>
			
		</div>
		<div id="lablec">
				Nagy Attila @ 2015<br>
	           	AT-SZOFT
		</div>
		
	</body>	
</html>  


