<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta name="author" content="Jan Nowak">
<link rel="stylesheet" type="text/css" href="style.css">
<?php 

require("./tajne.php");



if (!$conn = mysql_connect($servername, $username, $password)) {

	echo 'Problem z polaczeniem z baza: '.mysql_error()."<br />";

}



if (!mysql_select_db($dbname, $conn)) {

	echo 'Problem z polaczeniem z baza: '.mysql_error()."<br />";

}



if (isset($_POST['zbierz'])) {

	if($_POST['ile_roslin']==NULL or $_POST['srednia_wielkosc']==NULL) {

		echo "Blad. Nalezy podac liczbe roslin oraz srednia wielkosc.";

	} else {

		// Szukamy aktualnego (czyli najnowszego) doswiadczenia prowadzonego na podanym obszarze

		$sql_d = 'select * from obszary as o 

		join doswiadczenie as d on o.id_obszar=d.id_obszar 

		where o.id_obszar='.$_POST['id_obszar'].' order by d.id_doswiadczenie desc limit 1';

		$result_d = mysql_query($sql_d, $conn);

		$doswiadczenia = mysql_fetch_assoc($result_d);

		$aktualne_doswiadczenie = ''.$doswiadczenia['id_doswiadczenie'].'';
		
		if($aktualne_doswiadczenie==NULL){
			echo "brak doswiadczen - zapytaj nadzorcy!";
			
		}else{
				
				echo "aktualne doswiadczenie: ".$aktualne_doswiadczenie."<br />";
				$sql_insert = 'insert into wyniki (ile_roslin,srednia_wielkosc,id_doswiadczenie,data) 

		values ('.$_POST['ile_roslin'].','.$_POST['srednia_wielkosc'].','.$aktualne_doswiadczenie.',now());';

		

		if(mysql_query($sql_insert, $conn)) {

			echo 'Podane wyniki dopisane do bazy.';

		} else {
			echo "error: ".$conn->error;

		}	
		}

		



	}

	echo '<li><a href="formularzL.php">Powrot do formularzy laboranta</a></li>';

	echo '<li><a href="index.php">Powrot do strony glownej</a></li>';

}



mysql_close($conn);

?> 
</head>
<body>
</body>
</html>




