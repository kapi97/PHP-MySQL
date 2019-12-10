<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta name="author" content="Jan Nowak">
<link rel="stylesheet" type="text/css" href="style.css">

<?php 

require("./tajne.php");
if (!$conn = mysql_connect($servername, $username, $password)) {
	echo 'Problem z polaczeniem z baza...: '.mysql_error()."<br />";
}
if (!mysql_select_db($dbname, $conn)) {
	echo 'Problem z polaczeniem z baza...: '.mysql_error()."<br />";
}

if (isset($_POST['sprawdz'])) {
	if($_POST['id_doswiadczenie']!=NULL) {
		$sql_select1 = 'select id_doswiadczenie from doswiadczenie where id_doswiadczenie='.$_POST['id_doswiadczenie'].';';
		$sql_w = 'select * from wyniki where id_doswiadczenie=' . $_POST['id_doswiadczenie'].';';
		
		$sql_select2 = 'select d.id_doswiadczenie,r.nazwa_rosliny,n.nazwa_nawozu,o.id_obszar,o.pole 
		from doswiadczenie as d 
		join rosliny as r on d.id_roslina=r.id_roslina 
		left join nawozy as n on d.id_nawoz=n.id_nawoz 
		join obszary as o on d.id_obszar=o.id_obszar
		where d.id_doswiadczenie='.$_POST['id_doswiadczenie'].'; ';
		
		$result_d1 = mysql_query($sql_select1, $conn);
		$d1 = mysql_fetch_assoc($result_d1);
		
		$result_s2 = mysql_query($sql_select2, $conn);
		$doswiadczenia = mysql_fetch_assoc($result_s2);
		
		if(mysql_num_rows($result_d1)!=0) {
			echo 'DOSWIADCZENIE NUMER '.$doswiadczenia['id_doswiadczenie'].''."<br>"."<br>";
			echo 'Doswiadczenie przeprowadzono na obszarze '.$doswiadczenia['id_obszar'].' o polu '.$doswiadczenia['pole'].''."<br>";
			echo 'Zasadzono rosline o nazwie: '.$doswiadczenia['nazwa_rosliny'].''."<br>";
			echo 'Zastosowano nawoz: '.$doswiadczenia['nazwa_nawozu'].''."<br>"."<br>";
			
			echo 'ZEBRANE WYNIKI: '."<br>";
			$result_w = mysql_query($sql_w, $conn);
			while($wyniki = mysql_fetch_assoc($result_w)) {
				echo 'Do dnia '.$wyniki['data'].' zebrano '.$wyniki['ile_roslin'].' roslin o sredniej wielkosci '.$wyniki['srednia_wielkosc'].''."<br>";
			}
		}
		else {
			echo 'Nie ma doswiadczenia o numerze '.$_POST['id_doswiadczenie'].'';
		}
	}
	else {
		echo 'Nie podano numeru doswiadczenia';
	}
	echo '<a href="formularzN.php">Formularz nadzorcy</a><br />';
	echo '<a href="index.php">Strony glownej</a>';
}

elseif (isset($_POST['zacznij'])) {
	if($_POST['id_rosliny']==NULL) {
		echo 'Nie podano id rosliny'."<br>";
	} elseif ($_POST['id_obszar']==NULL) {
		echo 'Nie podano id_obszaru'."<br>";
	} else {
		if($_POST['nazwa_n']==NULL) {
			$czy_nawoz = 0;
			$id_nawoz = 0;
		} else {
			$czy_nawoz = 1;
			$sql_nawozy = 'select * from nawozy where nazwa_nawozu="'.$_POST['nazwa_n'].'";';
			$result_n = mysql_query($sql_nawozy, $conn);
			$nawozy = mysql_fetch_assoc($result_n);
			$id_nawoz = ''.$nawozy['id_nawoz'].'';
		}
		
		$sql_rosliny = 'select * from rosliny where id_roslina="'.$_POST['id_rosliny'].'";';
		$result_r = mysql_query($sql_rosliny, $conn);
		$rosliny = mysql_fetch_assoc($result_r);
		$id_rosliny =$_POST['id_rosliny'];
		
		$id_obszar = ''.$_POST['id_obszar'].'';
		$sql_obszary = "select * from obszary where id_obszar=$id_obszar";
		$result_o = mysql_query($sql_obszary, $conn);
		$obszary = mysql_fetch_assoc($result_o);
	
		$sql_insert = 'insert into doswiadczenie (czy_nawoz,id_obszar,id_roslina,id_nawoz) values ('.$czy_nawoz.','.$id_obszar.','.$id_rosliny.','.$id_nawoz.');';

		if(mysql_query($sql_insert, $conn)) {
			echo 'Zasiano rosline o id '.$_POST['id_rosliny'].' na obszarze numer '.$_POST['id_obszar'].' o polu '.$obszary['pole'].'. ';
			if($id_nawoz==0) {
				echo "Nie uzyto nawozu"."<br>";
			} else {
				echo 'Uzyto nawozu: '.$_POST['nazwa_n'].''."<br>";
			}
		} else {
			echo "Bład...: ".$conn->connect_error;
		}
	}
	echo '<a href="formularzN.php">Formularz nadzorcy</a><br />';
	echo '<a href="index.php">Strony glownej</a>';
} 

elseif (isset($_POST['wyswietl'])) {
	$sql_d = 'select * from (select * from doswiadczenie order by id_doswiadczenie desc) as A group by id_obszar;';
			
	$result_d = mysql_query($sql_d, $conn);

	echo 'aktualnie prowadzone doswiadczenia:'."<br><br>";

	echo "<table>";
	echo "<tr><td>"."Id obszaru: "."</td>
					<td>"."Id doswiadczenia: "."</td>
					<td>"."Id rosliny"."</td>
					<td>"."Id nawozu"."</td></tr>";
	while($d = mysql_fetch_array($result_d)) {
		
		echo "<tr><td>".$d['id_obszar']."</td>
						<td>".$d['id_doswiadczenie']."</td>
						<td>".$d['id_roslina']."</td>
						<td>".$d['id_nawoz']."</td></tr>";
	
	}
	echo "</table>";
	
	echo '<a href="formularzN.php">Formularz nadzorcy</a><br />';
	echo '<a href="index.php">Strony glownej</a>';
}

mysql_close($conn);
?> 
</head>
<body>
</body>
</html>

