<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó - Kezelő módosítása</title>
		<link rel="stylesheet" type="text/css" href="../css/sajat.css">	
		<link rel="stylesheet" type="text/css" href="../css/ondiv.css">
        <link rel="stylesheet" type="text/css" href="../css/form.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="Author" lang="hu" content="Nagy Attila">
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
							  		<li><a class="newitem" href="#">Új eszköz</a></li>
							  		<li><a class="newaccessory" href="#">Új tartozék</a></li>
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
						  		<li><a class="newadmin" href="#">Új kezelő felvitele</a></li>
						 		<li><a class="moduser" href="#">Kezelő módosítása</a></li>
						  		<li><a class="newpass" href="#">Jelszó módosítása</a></li>
						  		<li><a class="exit" href="#">Kilépés</a></li>
							</ul>
					     </li>
					  </ul>
				  </nav>
			</div>
			<div id="tartalom">
				        <div id="cimsor">
            KEZELŐ MÓDOSÍTÁS
        </div>
        <div id="formModUser">
        <form name="modositas" action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
        <table class="tableform">
			<?php
				include "connection.php";
				ini_set("default_charset","utf-8");
				$ofnev=$_SESSION['fnev'];
				
				if ($ofnev=="rendszergazda"){
					echo "<tr>";
						echo "<td colspan='2'>";
							ConDb();
                                    $sql=mysql_query("select * from users");
                                    echo'<select class="selectusers" name="users" size="3" style="width:406px;">';
                                    while($sor=mysql_fetch_array($sql)){
                                    	              
                                        echo "<option value=" . $sor['azon'] .">Név:" . $sor['nev'] .
                                                "&nbsp|&nbspFnév:&nbsp" . $sor['fnev']."</option>";
                                    }
                             echo'</select>'; 
							 
						echo "</td>";
					echo "</tr>";
				
			
			echo '<tr><td colspan="2">';
			echo '<input class="gombForm" type="submit" name="kivalaszt" value="KIVÁLASZT"><input type="hidden" name="azon" size="1" maxlength="15">';
			echo '</td></tr>';
			}
			?>
			<tr>
                    <td style="color:red;">Teljes név:</td><td><input style="border: 2px double red; " class="textbox" type="text" name="tnev" size="35" maxlength="40"></td>
            </tr>
            <tr>       
                    <td>Felhasználónév :</td><td><input class="textbox" type="text" name="fnev" size="15" maxlength="15"></td>
            </tr>
		
            </table>
            <?php
            ConDb();
            $fnev=$_SESSION['fnev'];
			
                $sql=mysql_query("select nev from users where fnev='$fnev'");                 
                while($sor=mysql_fetch_assoc($sql)){
                    $nev=$sor['nev'];
					
                }
				echo '<script type="text/javascript">document.modositas.tnev.value="'.$nev.'"</script>';
				echo '<script type="text/javascript">document.modositas.fnev.value="'.$fnev.'"</script>';
				
				ClsConDb();
            ?>
            <table class="tableform">
                <tr>
                    <td><input class="gombForm" type="submit" name="modosit" value="MÓDOSÍTÁS"></td>
                    <td><input class="gombForm" type="submit" name="torol" value="TÖRLÉS" onclick="return confirm('Kérem erősítse meg a törlést!'+'\n'+'A törlés nem vonható vissza!')"></td>
                    <td><input class="gombForm" type="button" value="MÉGSE" onclick=window.location.href="fooldal.php"></td>
                </tr>
            </table>
	</form>
        </div>
        <script type="text/javascript" src="../js/handler.js"></script>
      
	<?php	
			$ffnev=$_SESSION['fnev'];
			$azon="";
      		if (isset($_POST['users'])){
      			 ConDb();
      				$azon=$_POST['users'];
					$sql=mysql_query("select * from users where azon=$azon");                 
                	while($sor=mysql_fetch_assoc($sql)){
                    	$nev=$sor['nev'];
						$ffnev=$sor['fnev'];
						$azon=$sor['azon'];
                	}
      					echo '<script type="text/javascript">document.modositas.tnev.value="'.$nev.'"</script>';
						echo '<script type="text/javascript">document.modositas.fnev.value="'.$ffnev.'"</script>';
      					echo '<script type="text/javascript">document.modositas.azon.value="'.$azon.'"</script>';
      				exit;
				ClsConDb();
			}
			
            if (isset($_POST['modosit'])){
                $nev = $_POST['tnev'];
                $fnev = $_POST['fnev'];
				$azon = $_POST['azon'];
				$ofnev=$_SESSION['fnev'];
                ini_set("default_charset","utf-8");
				if (($ofnev=="rendszergazda")&&($fnev=="rendszergazda")){
					echo "<script type='text/javascript' charset='UTF-8'>alert('A rendszergazda felhasználói név nem módosítható!');</script>";
					echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
				}else{
                if (($fnev=="")||($nev=="")){
                    echo "<script type='text/javascript' charset='UTF-8'>alert('Kötelező megadni mindkét nevet!');</script>";
					echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                }else{
                    if ($fnev!="rendszergazda"){
                                    ConDb();
									if ($ofnev!='rendszergazda'){
                                        $sql = "UPDATE users SET 
                                                nev = '$nev',
                                                fnev = '$fnev'
                                                WHERE fnev = '$ofnev'";
                                        if (mysql_query($sql,$con)){
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('Sikeres módosítás !'+'\\n'+'Kérem jelentkezzen be újra!');</script>"; 
														echo "<script type='text/javascript' charset='UTF-8'>window.location='logout.php';</script>";       
                                                    }
                                                    else{
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('A módosítás sikertelen !');</script>";
                                                    }
                                        echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                    }else{
                                    	
                                    	$sql = "UPDATE users SET 
                                                nev = '$nev',
                                                fnev = '$fnev'
                                                WHERE azon = $azon";
                                        if (mysql_query($sql,$con)){
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('Sikeres módosítás !');</script>"; 
														echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";    
                                                    }
                                                    else{
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('A módosítás sikertelen !');</script>";
                                                    }
                                        echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                    }
                                ClsConDb();
								}
						else{
							echo "<script type='text/javascript' charset='UTF-8'>alert('A rendszergazda felhasználói név nem módosítható!');</script>";
							echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
						}
                                }
                            } 
                        }
                        
				if (isset($_POST['torol'])){
                $nev = $_POST['tnev'];
                $fnev = $_POST['fnev'];
				$ofnev=$_SESSION['fnev'];
                ini_set("default_charset","utf-8");
				if ($fnev=="rendszergazda"){
					echo "<script type='text/javascript' charset='UTF-8'>alert('A rendszergazda nem törölhető!');</script>";
					echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
				}else{
                    if ($fnev==$ofnev){
                         ConDb();
                                        $sql = "DELETE FROM users WHERE fnev='$fnev'";
                                        if (mysql_query($sql,$con)){
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('A kezelőt töröltük!'+'\\n'+'A rendszer kilép!');</script>"; 
														echo "<script type='text/javascript' charset='UTF-8'>window.location='logout.php';</script>";       
                                                    }
                                                    else{
                                                        echo "<script type='text/javascript' charset='UTF-8'>alert('A törlés sikertelen !');</script>";
                                                    }
                                        echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
                                    
                                    ClsConDb();
									}
					else{
						echo "<script type='text/javascript' charset='UTF-8'>alert('Jogosulatlan művelet!');</script>";
						echo "<script type='text/javascript' charset='UTF-8'>window.location='fooldal.php';</script>";
					}
                                }
                             
                        }
					
                
            
	
	?>
			</div>
			<div id="lablec">
				Nagy Attila @ 2015<br>
            	AT-SZOFT
			</div>
		</div>
		<script type="text/javascript" src="../js/handler.js"></script>
	</body>
	
</html>


