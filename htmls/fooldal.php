<?php
    session_start();
    if($_SESSION['valid'] != 1){
	echo "<script type='text/javascript' charset='UTF-8'>window.location='logon.php';</script>";
    }    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
	<head>
		<title>Informatikai eszköz nyilvántartó.</title>	
		<link rel="stylesheet" type="text/css" href="../css/sajat.css">
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
							  		<li><a href="newitem.php">Új eszköz</a></li>
							  		<li><a href="newaccessory.php">Új tartozék</a></li>
							  		<li><a class="addsources" href="#">Beszerzési forrás</a></li>
							  		<li><a class="addplace" href="#">Elhelyezési hely</a></li>
							  		<li><a class="adduser" href="#">Eszköz használó</a></li>
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
						  		<li><a href="itemlist.php">Eszközök listája</a></li>
						 		<li><a href="userlist.php">Személyek listája</a></li>
						  		<li><a href="#">Helység leltár</a></li>
						  		<li><a href="#">Statisztika</a></li>
						  		<li><a href="uniquelist.php">Egyéni listák</a></li>
							</ul>
					     </li>
					     <li><a href="#">Kezelés</a>
					     	<ul>
						  		<li><a class="newadmin" href="#">Új kezelő felvitele</a></li>
						 		<li><a href="moduser.php">Kezelő módosítása</a></li>
						  		<li><a class="newpass" href="#">Jelszó módosítása</a></li>
						  		<li><a class="exit" href="#">Kilépés</a></li>
							</ul>
					     </li>
					  </ul>
				  </nav>
			</div>
			<div id="tartalom">
				
			</div>
			<div id="lablec">
				Nagy Attila @ 2015<br>
            	AT-SZOFT
			</div>
		</div>
		<script type="text/javascript" src="../js/handler.js"></script>
	</body>
	
</html>




