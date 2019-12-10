<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta name="author" content="Jan Nowak">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<b>Dostepne dzialania dla Laboranta: </b><br><br>
<form action="laborant.php" method="POST">
1. Zbieranie wynikow<br><hr>
	Numer obszaru: 
	
	<select name="id_obszar">
	
		<?php
		require("./tajne.php");
			$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * from obszary;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<option> '.	$row[0].'</option>  ';
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
	</select>
	<br>
	
	Ile roslin uroslo dotychczas? <input name="ile_roslin"><br>
	Jaka byla ich srednia wielkosc? <input name="srednia_wielkosc"><br>

<input type="submit" value="Zbierz" name="zbierz">

</form>
</body>
</html>

	
