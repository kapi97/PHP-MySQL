<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta name="author" content="Jan Nowak">
<link rel="stylesheet" type="text/css" href="style.css">
<?php
		require("./tajne.php");
			$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}



    if (!isset($_POST['login'] )) {
		echo '<p class="alert">Wypełnij pole z loginem!</p>';
	}else{
		$login = $_POST['login'];
	}
    if (!isset($_POST['haslo'] )) {
		echo '<p class="alert">Wypełnij pole z haslem!</p>';
	}else{
		$haslo = $_POST['haslo'];
	}
	
	
if (isset($_POST['login'] ) AND isset($_POST['haslo'] )) {	
	$is_nick = "SELECT admin FROM `uzytkownik` WHERE `login` = '$login' AND `pass` = '$haslo'"; 
		$czy_admin = $conn->query($is_nick);
		
		if ($czy_admin->num_rows > 0) {
			
			while($row = $czy_admin->fetch_array()) {
				if($row[0]==0){
					echo 'Laborant - po chwili przejdziesz do strony';
					
					header("Refresh: 0; url=\"formularzL.php\"");
				}elseif($row[0]==1){
					echo 'Nadzorca - po chwili przejdziesz do strony';
					header("Refresh: 0; url=\"formularzN.php\"");
				}else{
					echo "błąd logowania #1";
				}
			}
		} else {
			echo "błąd logowania #2";
		}
	}
	/////////////////

	
?>
</head>
<body>
<form method="POST" action="index.php">
<hr />
<table>

<tr><td>Zaloguj się!<br></td></tr>
<tr><td width="50">Login:</td><td><input type="text" name="login" maxlength="32"></td></tr>
<tr><td width="50">Hasło:</td><td><input type="password" name="haslo" maxlength="32"></td></tr>
<tr><td align="center" colspan="2"><input type="submit" value="Zaloguj"><br></td></tr>

</table>
</form>
<?php
	echo "<hr /><h3>wszystkie dane z bazy:</h3>";
	
	/////////////////
	///////////////// uzytkownicy
{
	echo "<hr /><h4>uzytkownicy</h4>";	
		$uzytkownik = "SELECT * from uzytkownik;";
		$result = $conn->query($uzytkownik);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id:</b> '.$row[0].' <b>Uzytkownik:</b> '.$row[1].' <b>Hasło:</b> '.$row[2].' <b>Czy admin?:</b> '.$row[3].'<br />';
			}
		} else {
			echo "error";
		}
		/////////// wpisywanie do bazy
		
if (isset($_POST['1_login']) AND isset($_POST['1_haslo']) AND isset($_POST['1_czy_admin']))
{
   $login = ($_POST['1_login']);
   $haslo = $_POST['1_haslo'];
   $czy_admin = $_POST['1_czy_admin'];
            
        $sql = "INSERT INTO uzytkownik (login, pass, admin) VALUES ('$login', '$haslo', '$czy_admin');";
		$conn->query($sql);

}
echo "<form method='POST' action='index.php'>
<b>Login:</b> <input type='text' name='1_login'>
<b>Hasło:</b> <input type='password' name='1_haslo'>
	<select name='1_czy_admin'>
		<option value='0'>Brak admina</option>
		<option value='1'>Admin</option>
	</select>
<input type='submit' value='Wyślij' name='Wyślij'>
</form>";
}

    /////////////////
	///////////////// rosliny
	{
	echo "<hr /><h4>rosliny</h4>";	
		$rosliny = "SELECT * from rosliny;";
		$result = $conn->query($rosliny);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id rosliny:</b> '.$row[0].' <b>Kwiatek:</b> '.$row[1].'<br />';
			}
		} else {
			echo "error";
		}		
		/////////// wpisywanie do bazy		
				
if (isset($_POST['2_kwiatek']))
{
   $kwiatek = ($_POST['2_kwiatek']);
            
        $sql = "INSERT INTO rosliny (nazwa_rosliny) VALUES ('$kwiatek');";
		$conn->query($sql);

}
echo "<form method='POST' action='index.php'>
<b>Roślina:</b> <input type='text' name='2_kwiatek'>
<input type='submit' value='Wyślij' name='Wyślij'>
</form>";
	}
    /////////////////
	///////////////// nawozy
	
	{
	echo "<hr /><h4>nawozy</h4>";	
		$nawozy = "SELECT * from nawozy;";
		$result = $conn->query($nawozy);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id nawozy:</b> '.$row[0].' <b>Nawoz:</b> '.$row[1].'<br />';
			}
		} else {
			echo "error";
		}				
		/////////// wpisywanie do bazy
		
if (isset($_POST['3_nawoz']))
{
   $nawoz = ($_POST['3_nawoz']);

            
        $sql = "INSERT INTO nawozy(nazwa_nawozu) VALUES ('$nawoz');";
		$conn->query($sql);

}
echo "<form method='POST' action='index.php'>
<b>Nawoz:</b> <input type='text' name='3_nawoz'>
<input type='submit' value='Wyślij' name='Wyślij'>
</form>";
	}

    /////////////////
	///////////////// obszary
	{
	echo "<hr /><h4>obszary</h4>";	
		$obszary = "SELECT * from obszary;";
		$result = $conn->query($obszary);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id:</b> '.$row[0].' <b>Obszar:</b> '.$row[1].'<br />';
			}
		} else {
			echo "error";
		}			
		/////////// wpisywanie do bazy
		
if (isset($_POST['4_obszary']))
{
   $obszary = ($_POST['4_obszary']);

            
        $sql = "INSERT INTO obszary(pole) VALUES ('$obszary');";
		$conn->query($sql);

}
echo "<form method='POST' action='index.php'>
<b>Obszar:</b> <input type='text' name='4_obszary'>
<input type='submit' value='Wyślij' name='Wyślij'>
</form>";
	}
    /////////////////
	///////////////// doswiadczenie
	echo "<hr /><h4>doswiadczenie</h4>";	
		$doswiadczenie = "SELECT * from doswiadczenie;";
		$result = $conn->query($doswiadczenie);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id doswiadczenia:</b> '.$row[0].'  <b>Czy nawoz?:</b> '.$row[1].' <b>Id obszar:</b> '.$row[2].' <b>Id roslina:</b> '.$row[3].' <b>Id nawoz:</b> '.$row[4].'<br />';
			}
		} else {
			echo "Brak bazy!";
		}	
		

	echo "<hr /><h4>wyniki</h4>";	
		$wyniki = "SELECT * from wyniki;";
		$result = $conn->query($wyniki);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_array()) {
				echo '<b>Id wynik:</b> '.$row[0].' <b>Ile roslin:</b> '.$row[1].' <b>Średnia wielkosc:</b> '.$row[2].' <b>Id doświadczenie:</b> '.$row[3].' <b>Data:</b> '.$row[4].'<br />';
			}
		} else {
			echo "Brak bazy!";
		}			
		$conn->close();
?>

 </body>
 </html>
