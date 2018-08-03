<?php
	include ("baza.php");
	otvori();
	session_start();
		if (!isset($_SESSION["id"])) {
			header("Location:index.php");
			exit();
		}
		else {
			$azur_zapisnik = $_GET ['id'];
			$upit = "SELECT * FROM zapisnik WHERE zapisnik_id ='".$azur_zapisnik."'";
			$rezultat = izvrsi ($upit);
			while ($red = mysql_fetch_array($rezultat)) {
				$naziv = $red['naziv'];
				$opis = $red['opis'];
			}
		}

		if (isset($_POST['azuriranje'])) {
			$naziv = $_POST['naziv'];
			$opis = $_POST['opis'];
			$datum = date("Y-m-d");
			$greska = "";

		if (!isset($naziv) || empty($naziv)) {
			$greska = "Unesite naziv zapisnika!";
			echo $greska;
		}
		?>
		<br>
		<?php
		if (!isset($opis) || empty($opis)) {
			$greska = "Unesite opis zapisnika!";
			echo $greska;
		}
			
			if (!isset($greska) || empty($greska)) {
				$azur = "UPDATE zapisnik SET  naziv = '{$naziv}',  opis = '{$opis}' WHERE zapisnik_id = '{$azur_zapisnik}'";
				izvrsi($azur);
				header("Location:index.php");
				exit();
			}
		}
?>

<html>
<head>
	<title>Ažuriranje zapisnika</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="dizajn.css"/>
</head>
<body>
	<div class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<a href="prijava.php">Odjava</a>
	</div>
	<a class ="natrag" href="index.php">Natrag </a>
<div class="zapisnik">
	<h1 align="center"> Ažuriranje zapisnika </h1>
	<table>
		<form action = "" method="POST">
			<tr>
				<td><label for = "naziv">Naziv zapisnika:</label></td>
				<td><input type ="text" name = "naziv" value ="<?php echo $naziv; ?>"/></td>
			</tr>
			<tr>
				<td><label for = "opis">Opis:</label></td>
				<td><textarea name = "opis"> <?php echo $opis;?></textarea></td>
			</tr>
			<tr>
				<td> <input class="btn_zapisnik" type ="submit" name ="azuriranje" value ="Ažuriraj zapisnik"</td>
			</tr>
		</form>
	</table>
</div>
</body>
</html>



