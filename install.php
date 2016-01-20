<?php header('Content-type:text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INFORMATIKAI NYILVÁNTARTÓ ADATBÁZIS INSTALLÁLÁS</title>
    </head>
    
    <?php    	
        if (isset($_POST['ok'])){
            if ((empty($_POST['dbuser']))||(empty($_POST['dbpass']))){
               echo "<script type='text/javascript'>alert('Hiányosak a megadott adatok!');</script>";
               echo "<a href='javascript:window.location.href=window.location.href'/a>";
            }
            else {         
                $dbu = $_POST['dbuser'];
                $dbp = $_POST['dbpass'];
                $dbn = 'infodb';
				$dbf = 'santaclaus';
                $dbfp ='artic';
                $con=mysqli_connect("localhost",$dbu,$dbp);					
					
                // Csatlakozás ellenőrzés
                if (mysqli_connect_errno()){
                    echo "<script type='text/javascript'>alert('Hiba a MYSQL -hez csatlakozáskor !');</script>" . mysqli_connect_error();
                    echo "<a href='javascript:window.location.href=window.location.href'/a>";                     
                    }
                // Adatbázis létrehozása						
                $sql="CREATE DATABASE ".$dbn." DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_hungarian_ci";
                if (mysqli_query($con,$sql)){
                    mysqli_close($con);  
                    $con=mysqli_connect("localhost",$dbu,"$dbp",$dbn);		                    
                      
                    $sql="CREATE TABLE IF NOT EXISTS users(
                    	azon int(10) NOT NULL auto_increment,
  						nev char(30) COLLATE utf8_hungarian_ci not null,
  						fnev char(30) COLLATE utf8_hungarian_ci not null,
  						pass char(10) COLLATE utf8_hungarian_ci not null,
  						statusz int(1) not null default '1',
  						PRIMARY KEY(azon),
  						UNIQUE(fnev))";
                    mysqli_query($con,$sql);
					
                    $sql="CREATE TABLE IF NOT EXISTS allapot(
                    	azon int(10) NOT NULL auto_increment,
  						statusz char(30) COLLATE utf8_hungarian_ci not null,
  						PRIMARY KEY(azon),
  						UNIQUE(statusz))";
                    mysqli_query($con,$sql);
                                        
                    $sql="CREATE TABLE IF NOT EXISTS beszerzes(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						jelleg char(20) NOT NULL COLLATE utf8_hungarian_ci,
  						megnevezes char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						ev int(4) NOT NULL,
  						PRIMARY KEY(azon))";
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS elhelyezes(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						hely char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						jelleg char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon))";
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS eszkozok(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						megnevezes char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						gyartmany char(30) COLLATE utf8_hungarian_ci,
  						tipus char(30) COLLATE utf8_hungarian_ci,
  						fajta char(30) not null COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon))";
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS felhasznalok(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						nev char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						jelleg char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon))";
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS nyilvantartas(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						eszkoz int(10) NOT NULL,
  						darab int(5) NOT NULL,
  						beszerzes int(10),
  						ertek int(10),
  						uzembehelyezve date NOT NULL,
  						nytsz char(20) NOT NULL COLLATE utf8_hungarian_ci,
  						enytsz char(20)COLLATE utf8_hungarian_ci,
  						elhelyezese int(10),
  						felhasznalok int(10),
  						gyszam char(50) COLLATE utf8_hungarian_ci,
  						allapot int(10) NOT NULL,
  						megjegyzes varchar(2048) COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon),
  						foreign key (eszkoz) references eszkozok(azon),
  						foreign key (beszerzes) references beszerzes(azon),
  						foreign key (elhelyezese) references elhelyezes(azon),
  						foreign key (felhasznalok) references felhasznalok(azon),
  						foreign key (allapot) references allapot(azon))";
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS tartozekok(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						megnevezes char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						nytsz char(20) DEFAULT NULL COLLATE utf8_hungarian_ci,
  						erteke int(10) DEFAULT NULL,
  						mennyisege int(5) NOT NULL,
  						jellege char(20) NOT NULL COLLATE utf8_hungarian_ci,
  						gyszam char(50) DEFAULT NULL COLLATE utf8_hungarian_ci,
  						eszkoz int(10) DEFAULT NULL,
  						allapota int(10) NOT NULL,
  						megjegyzes varchar(2048) DEFAULT NULL COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon),
  						foreign key(eszkoz) references  nyilvantartas(azon))";                    
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS jellegek(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						megnevezes char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon))";                    
                    mysqli_query($con,$sql);
                    
                    $sql="CREATE TABLE IF NOT EXISTS fajtak(
  						azon int(10) NOT NULL AUTO_INCREMENT,
  						megnevezes char(50) NOT NULL COLLATE utf8_hungarian_ci,
  						PRIMARY KEY (azon))";                    
                    mysqli_query($con,$sql);
                            
                    $sql="CREATE USER '".$dbf."'@'localhost' IDENTIFIED BY '".$dbfp."'";
                    mysqli_query($con,$sql);
                    $sql="CREATE USER '".$dbf."'@'%' IDENTIFIED BY '".$dbfp."'";
                    mysqli_query($con,$sql);
                    $sql="REVOKE ALL PRIVILEGES ON ".$dbn." . * FROM '".$dbf."'@'localhost'";
                    mysqli_query($con,$sql);
                    $sql="GRANT ALL PRIVILEGES ON ".$dbn." . * TO '".$dbf."'@'localhost' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ";
                    mysqli_query($con,$sql);
                    $sql="REVOKE ALL PRIVILEGES ON ".$dbn." . * FROM '".$dbf."'@'%'";
                    mysqli_query($con,$sql);
                    $sql="GRANT ALL PRIVILEGES ON ".$dbn." . * TO '".$dbf."'@'%' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ";
                    mysqli_query($con,$sql);

                    $sql="INSERT INTO users (nev,fnev,pass,statusz) 
                        VALUES('Nagy Attila','rendszergazda','admin',0)";
                    mysqli_query($con,$sql);
                    $sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, 'Új')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, 'Használatban')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, 'Hibás')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, 'Javítás alatt')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, \'Selejtezésre vár (Használható)\')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, \'Selejtezésre vár (Hibás)\')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO allapot (azon,statusz)
						VALUES (NULL, \'Selejtezve (Törölhető)\')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO jellegek (azon,megnevezes)
						VALUES (NULL,'Periféria')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO jellegek (azon,megnevezes)
						VALUES (NULL,'Kiegészítő')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO jellegek (azon,megnevezes)
						VALUES (NULL,'Egyéb...')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO jellegek (azon,megnevezes)
						VALUES (NULL,'Dokumentáció')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO jellegek (azon,megnevezes)
						VALUES (NULL,'Fő tartozék')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Hardver')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Szoftver')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Műszaki cikk')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Műszer')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Hálózat')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Felszerelés')";
					mysqli_query($con,$sql);	
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Oktatási eszköz')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO fajtak (azon,megnevezes)
						VALUES (NULL,'Egyéb...')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO felhasznalok (azon,nev,jelleg)
						VALUES (1,'Nincs felhasználóhoz kötve!','-')";
					mysqli_query($con,$sql);
					$sql = "INSERT INTO elhelyezes (azon,hely,jelleg)
						VALUES (1,'Nincs helyhez kötve!','-')";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW tview1 as SELECT tart.azon, tart.megnevezes, 
					tart.nytsz, tart.erteke, tart.mennyisege, jell.megnevezes AS jellege, 
					tart.gyszam, tart.eszkoz, tart.allapota, tart.megjegyzes
					FROM tartozekok AS tart INNER JOIN jellegek AS jell ON tart.azon = jell.azon";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW tview2 as SELECT sel1.azon, sel1.megnevezes, 
					sel1.nytsz, sel1.erteke, sel1.mennyisege, sel1.jellege, sel1.gyszam, 
					sel1.eszkoz, alla.statusz AS allapota, sel1.megjegyzes FROM tview1 AS sel1
					INNER JOIN allapot AS alla ON sel1.allapota = alla.azon";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW eview as select es.azon,es.megnevezes,
					es.gyartmany,es.tipus,faj.megnevezes as fajta from 
					eszkozok as es inner join fajtak as faj on es.fajta=faj.megnevezes";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW nyview1 as select nyt.azon,nyt.eszkoz,nyt.darab,
					nyt.beszerzes,nyt.ertek,nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,
					nyt.elhelyezese,nyt.felhasznalok,nyt.gyszam,alla.statusz as allapot,
					nyt.megjegyzes from nyilvantartas as nyt inner join allapot as alla on nyt.allapot=alla.azon";					
                    mysqli_query($con,$sql);
                    $sql = "CREATE VIEW nyview2 as select nyt.azon,nyt.eszkoz,nyt.darab,
                    nyt.beszerzes,nyt.ertek,nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,
                    nyt.elhelyezese,felh.nev as felhasznalonev,felh.jelleg as felhasznalojelleg,
                    nyt.gyszam,nyt.allapot,nyt.megjegyzes from nyview1 as nyt
                    inner join felhasznalok as felh on nyt.felhasznalok=felh.azon";
                    mysqli_query($con,$sql);
                    $sql = "CREATE VIEW nyview3 as select nyt.azon,nyt.eszkoz,nyt.darab,
                    nyt.beszerzes,nyt.ertek,nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,
                    elh.hely as helye,elh.jelleg as helyjellege,nyt.felhasznalonev,
                    nyt.felhasznalojelleg,nyt.gyszam,nyt.allapot,nyt.megjegyzes from nyview2 as nyt 
                    inner join elhelyezes as elh on nyt.elhelyezese=elh.azon";
                    mysqli_query($con,$sql);
					$sql = "CREATE VIEW nyview4 as select nyt.azon,nyt.eszkoz,
					nyt.darab,besz.jelleg as beszjelleg, besz.megnevezes as besznev,
					besz.ev as beszeve,nyt.ertek,nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,
					nyt.helye,nyt.helyjellege,nyt.felhasznalonev,nyt.felhasznalojelleg,
					nyt.gyszam,nyt.allapot,nyt.megjegyzes from nyview3 as nyt 
					inner join beszerzes as besz on nyt.beszerzes=besz.azon";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW nyview5 as select nyt.azon,ev.megnevezes,
					ev.gyartmany,ev.tipus,ev.fajta,nyt.darab,nyt.beszjelleg, nyt.besznev,
					nyt.beszeve,nyt.ertek,nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,nyt.helye,
					nyt.helyjellege,nyt.felhasznalonev,nyt.felhasznalojelleg,nyt.gyszam,
					nyt.allapot,nyt.megjegyzes from nyview4 as nyt inner join eview as ev on nyt.eszkoz=ev.azon";
					mysqli_query($con,$sql);
					$sql = "CREATE VIEW nytviewall as select nyt.azon,nyt.megnevezes,nyt.gyartmany,
					nyt.tipus,nyt.fajta,nyt.darab,nyt.beszjelleg, nyt.besznev,nyt.beszeve,nyt.ertek,
					nyt.uzembehelyezve,nyt.nytsz,nyt.enytsz,nyt.helye,nyt.helyjellege,nyt.felhasznalonev,
					nyt.felhasznalojelleg,nyt.gyszam,nyt.allapot,nyt.megjegyzes,
					tv.megnevezes as tartozeknev,tv.nytsz as tartnytsz, tv.erteke as tartertek,
					tv.mennyisege as tartdb, tv.jellege as tartjellege, tv.gyszam as tartgyszam,
					tv.allapota as tartallapot, tv.megjegyzes as tartmegjegyzes 
					from nyview5 as nyt left outer join tview2 as tv on nyt.azon=tv.eszkoz";
					mysqli_query($con,$sql);
                    mysqli_close($con);
                    echo "<script type='text/javascript'>alert('Az adatbázis elkészült !');</script>";                      
                 }
                 else{
                    echo "<script type='text/javascript'>alert('Hiba az adatbázis létrehozásakor !');</script>" . mysqli_error();
                    echo "<a href='javascript:window.location.href=window.location.href'/a>";
                 }    
             }
        }
    ?>
    <body>
    <p>Kérem adja meg az adatbázis létrehozásához szükséges adatokat !</p>    
    </body>
    <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
          Az adatbázis root felhasználó neve: <input type='text' name='dbuser'/><br><br>
          Az adatbázis root felhasználó jelszava: <input type='text' name='dbpass'/><br><br>
          <input type='submit' name='ok' value='Létrehozás'/>
          <input type='reset' name='reset'/>
    </form>
</html>
