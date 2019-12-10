<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta name="author" content="Jan Nowak">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
Dostepne dzialania dla Nadzorcy: <br /><hr />
<form action="nadzorca.php" method="POST">
Sprawdz wyniki doswiadczenia o nr: <input name="id_doswiadczenie">

<input type="submit" value="Sprawdz" name="sprawdz"><br />
</form>
<hr>
<form action="nadzorca.php" method="POST">
Aktualne doswiadczenia

<input type="submit", value="Wyswietl" name="wyswietl"><br>
</form>
<hr />
<form action="nadzorca.php" method="POST">	
Zacznij nowe doswiadczenie: <br>
	Nazwa rosliny:<select name="id_rosliny">
			<?php
		require("./tajne.php");
			$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * from rosliny;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<option value='.$row[0].'>'.
					$row[1].
					'</option>';
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
	
	</select><br>
	
	
	Numer obszaru: <select name="id_obszar">
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
				echo '<option value='.$row[0].'>'.
					$row[1].
					'</option>';
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
						</select><br />
	Czy stosowac nawoz?:<select name="nazwa_n">
			<?php
		require("./tajne.php");
			$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * from nawozy;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<option value='.$row[1].'>'.
					$row[1].
					'</option>';
			}
		} else {
			echo "0 results";
		}
			echo '<option value="">nie</option>';
		$conn->close();
		?>
		</select>
			<br />
<input type="submit" value="Zacznij" name="zacznij">


</form>
</body>
</html>
