<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Egyéni listája</title>
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
	            Eszközök listája
	        </div>
	        <div>
	        	<form id="lista" action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
		        	<table class="tableform">
		       			<tr>
			       			<td align="left">
								<input type="radio" name="listtype" value="hor" checked>Oszlopos elrendezés<br>
								<input type="radio" name="listtype" value="ver">Listás elrendezés
			        		</td>
							<td align="left">
							<select name="order" multiple="multiple">
									<option value="0" selected>Válaszd ki a rendezési alapot!</option>	
	        						<option value="1">Nyilvántartási szám</option>
							       	<option value="2">Eszköz név</option>
							       	<option value="3">Eszköz gyártmány</option>
							       	<option value="4">Eszköz típus</option>
							       	<option value="5">Eszköz fajta</option>
									<option value="6">Mennyisége</option>
									<option value="7">Beszerzés jellege</option>
									<option value="8">Beszerzés megnevezése</option>
									<option value="9">Beszerzés éve</option>
									<option value="10">Üzemeltetés helye</option>
									<option value="11">Eszköz értéke</option>
									<option value="12">Üzembehelyezés éve</option>
									<option value="13">Előző nyilvántartási száma</option>
									<option value="14">Gyári száma</option>
							        <option value="15">Állapota</option>
							        <option value="16">Eszköz megjegyzés</option>
									<option value="17">Tartozék megnevezése</option>
									<option value="18">Tartozék nyilvántartási száma</option>
									<option value="19">Tartozék értéke</option>
									<option value="20">Tartozék száma</option>
									<option value="21">Tartozék jellege</option>
									<option value="22">Tartozék gyáriszáma</option>
									<option value="23">Tartozék állapota</option>
									<option value="24">Tartozék megjegyzés</option>
							    </select>
								<script src="../js/multiple-select.js"></script> 
								<script>
							        $('select').multipleSelect({
							        	width: 250,
							        	placeholder: "Válaszd ki a rendezési alapot!",
							        	selectAll: false,
										single:true
							        });
					    		</script>
							</td>
			        		<td align="left">
			        			<select name="adat" multiple="multiple" >
	        						<option value="1">Nyilvántartási szám</option>
							       	<option value="2">Eszköz név</option>
							       	<option value="3">Eszköz gyártmány</option>
							       	<option value="4">Eszköz típus</option>
							       	<option value="5">Eszköz fajta</option>
									<option value="6">Mennyisége</option>
									<option value="7">Beszerzés jellege</option>
									<option value="8">Beszerzés megnevezése</option>
									<option value="9">Beszerzés éve</option>
									<option value="10">Üzemeltetés helye</option>
									<option value="11">Eszköz értéke</option>
									<option value="12">Üzembehelyezés éve</option>
									<option value="13">Előző nyilvántartási száma</option>
									<option value="14">Gyári száma</option>
							        <option value="15">Állapota</option>
							        <option value="16">Eszköz megjegyzés</option>
									<option value="17">Tartozék megnevezése</option>
									<option value="18">Tartozék nyilvántartási száma</option>
									<option value="19">Tartozék értéke</option>
									<option value="20">Tartozék száma</option>
									<option value="21">Tartozék jellege</option>
									<option value="22">Tartozék gyáriszáma</option>
									<option value="23">Tartozék állapota</option>
									<option value="24">Tartozék megjegyzés</option>
							    </select>
							    <script src="../js/multiple-select.js"></script> 
								<script>
							        $('select').multipleSelect({
							        	width: 250,
							        	placeholder: "Válaszd ki a listázandó adatokat!",
							        	selectAll: false
							        });
					    		</script>
			        		</td>

			        		<td><input class="gombForm" type="button" id="kuld" value="LISTÁZ" /></td>
						    <td><input class="gombForm" type="submit" value="KILÉP" name="kilep" onclick="return confirm('Biztosan kilép?')" /></td>
							<td><input type="hidden" id="varc" name="varchange" /></td>
						</tr>
					</table>
				</form>
				<script src="../js/multiple-select.js"></script> 
				<script>
					$("#kuld").click(function() {
		        	var adatok=$("select").multipleSelect("getSelects");
		        	document.getElementById("varc").value=adatok;
		        	document.getElementById("lista").submit();
		        	});
				</script>
	        </div>
	        
			<?php
				if (isset($_POST['kilep']))	{
						echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
						exit;
					}
				
				if (isset($_POST['varchange']))	{
						$adat=$_POST['varchange'];
						$order=$_POST['order'];
						if ($order==0)$order=1;
						
						$type=$_POST['listtype'];
						if ($adat!=""){
						$elem = explode(",", $adat);
						$elemszam=sizeof($elem);
						$felirat=array("-","NYT.SZÁMA","ESZKÖZ NEVE","GYÁRTMÁNYA","TÍPUSA","BESOROLÁSA","MENNYISÉGE",
											"BESZERZÉS JELLEGE","BESZERZÉS NEVE","BESZERZÉS ÉVE","ÜZEMELTETÉS HELYE",
											"ESZKÖZ ÉRTÉKE","ÜZEMBEHELYEZÉS ÉVE","ELŐZŐ NYTSZ","GYÁRI SZÁMA","ÁLLAPOTA","ESZKÖZ MEGJEGYZÉS",
											"TARTOZÉKOK NEVE","TARTOZÉKOK NYTSZ-e","TARTOZÉKOK ÉRTÉKE","TARTOZÉKOK SZÁMA",
											"TARTOZÉKOK JELLEGE","TARTOZÉKOK GYÁRISZ -a","TARTOZÉKOK ÁLLAPOTA","TARTOZÉKOK MEGJEGYZÉS");
						$selarray=array("-","nytsz","megnevezes","gyartmany","tipus","fajta","darab",
											"beszjelleg","besznev","beszeve","helye",
											"ertek","uzembehelyezve","enytsz","gyszam","allapot","megjegyzes",
											"tartozeknev","tartnytsz","tartertek","tartdb",
											"tartjellege","tartgyszam","tartallapot","tartmegjegyzes");
						$select="azon";
						include "connection.php";
						ConDb();
						if (($elemszam>6)&&($type!="ver")){
							$type='ver';
							echo "<script type='text/javascript' charset='UTF-8'>alert('Több mint 6 kiválasztott jellemző! Csak listás elrendezés lehetséges!');</script>";
						}
						if ($type=='hor'){
							echo '<div id="formItemList">';
							echo '<table class="tablelist">';
							echo '<tr>';
								$i=0;
			                	for ($i=0;$i<$elemszam;$i++){
									echo'<th>'.$felirat[$elem[$i]].'</th>';
									$select=$select.','.$selarray[$elem[$i]];			
								}							
			                echo '</tr>';
							
							$tempazon="0"; 
							$elembeir="";
							$sql=mysql_query("select $select from nytviewall order by $selarray[$order]");
							while($sor=mysql_fetch_array($sql)){
			                    if ($tempazon!=$sor['azon']){	
				                    echo "<tr>";
					                    $i=0;
					                	for ($i=0;$i<$elemszam;$i++){
					                		$elembeir=$sor[$selarray[$elem[$i]]];
											if ($elembeir=="")$elembeir="&nbsp";
											echo'<td style="border-top: 3px solid #000000";>'.$elembeir.'</td>';
										}				                    	
									echo "</tr>";
									$tempazon=$sor['azon'];
								}else{
									if ($elem[$elemszam-1]>16){
										echo "<tr>";
						                    $i=0;
						                	for ($i=0;$i<$elemszam;$i++){
						                		if ($elem[$i]>16){	
						                			$elembeir=$sor[$selarray[$elem[$i]]];
												}else{
													$elembeir="";
												}
												if ($elembeir=="")$elembeir="&nbsp";
												echo'<td style="border-top: 1px solid #000000";>'.$elembeir.'</td>';
											}				                    	
										echo "</tr>";
									}
								}                  
			                }	
							echo '</table>';						
							echo '</div>';
						}
					
						if ($type=='ver'){
							echo '<div id="formItemList">';
							echo '<table class="tablelist">';
							$i=0;
							$select=$select.",nytsz";
			                for ($i=0;$i<$elemszam;$i++){
								$select=$select.','.$selarray[$elem[$i]];			
							}										
							$tempazon="0"; 
							$elembeir="";
							$sql=mysql_query("select $select from nytviewall order by $selarray[$order]");
							while($sor=mysql_fetch_array($sql)){ 
			                    if ($tempazon!=$sor['azon']){
			                    	if ($tempazon!=0)echo '<tr><td colspan="3" style="background-color:#ffffff;">&nbsp</td></tr>'; 	
				                    
				                    echo '<tr>';
									$elembeir=$sor['nytsz'];
									echo'<th style="text-align: left; border-top: 3px solid #000000"; colspan="3">NYTSZ: '.$elembeir.'</th>';
									echo "</tr>";
					                    $i=0;
					                	for ($i=0;$i<$elemszam;$i++){
					                		if ($elem[$i]<17){
						                		$elembeir=$sor[$selarray[$elem[$i]]];
												if ($elembeir=="")$elembeir="&nbsp";
												if (($i==0)||($i==3)||($i==6)||($i==9)||($i==12)||($i==15)||($i==18)||($i==21)) echo "<tr>";
												echo'<td style="text-align:left;">'.$felirat[$elem[$i]].':&nbsp<b>'.$elembeir.'</b></td>';
												if (($i==2)||($i==5)||($i==8)||($i==11)||($i==14)||($i==17)||($i==20)||($i==23)) echo "</tr>";
											}
										}				                    	
										if (($i!=2)||($i!=5)||($i!=8)||($i!=11)||($i!=14)||($i!=17)||($i!=20)||($i!=23)) echo "</tr>";
									$tempazon=$sor['azon'];
								}
								if ($elem[$elemszam-1]>16){
									echo '<tr>';
									echo'<td style="text-align: center; border-top: 2px solid #000000" colspan="3">Tartozék:</td>';
									echo'</tr>';
									$i=0;
					                for ($i=0;$i<$elemszam;$i++){
					                	if ($elem[$i]>16){
						                	$elembeir=$sor[$selarray[$elem[$i]]];
											if ($elembeir=="")$elembeir="&nbsp";
											if (($i==0)||($i==3)||($i==6)||($i==9)||($i==12)||($i==15)||($i==18)||($i==21)) echo "<tr>";
											echo'<td style="text-align:left;">'.$felirat[$elem[$i]].':&nbsp<b>'.$elembeir.'</b></td>';
											if (($i==2)||($i==5)||($i==8)||($i==11)||($i==14)||($i==17)||($i==20)||($i==23)) echo "</tr>";
										}
									}				                    	
									if (($i!=2)||($i!=5)||($i!=8)||($i!=11)||($i!=14)||($i!=17)||($i!=20)||($i!=23)) echo "</tr>";
								}
								
								                
			                }	
							echo '</table>';						
							echo '</div>';
						}
					ClsConDb();	
					echo '<table class="tableform"><tr>';
					echo '<td><button class="gombForm" onclick="printContent(\'formItemList\',\'ESZKÖZ LISTA\')">NYOMTAT</button></td>';
					echo '</tr></table>';
					}
					$exit;
				}
			?>
			
		</div>
		<div id="lablec">
				Nagy Attila @ 2015<br>
	           	AT-SZOFT
		</div>
		
	</body>	
</html>  


