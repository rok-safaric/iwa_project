<!DOCTYPE html>
<html>
<head>
	<title>e-Biljke - Novi zapis</title>
	<link rel="stylesheet" type="text/css" href="dizajn.css">
</head>
<body>
		<div class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<a href="prijava.php">Odjava</a>
	</div>
	<?php
		
		include ("baza.php");
		otvori ();
		session_start();

		if (!isset($_SESSION['id'])) {
			header("Location:index.php");
			exit();
		}
		else {
			if ($_SESSION['tip']==2 || $_SESSION['tip']==1 || $_SESSION['tip']==0) {
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					
				}
				
				$upit = "SELECT * FROM biljka order by vrsta_id";
				$biljka = izvrsi($upit);
		

			if (isset($_POST['dodaj_zapis'])){
				
				$biljka = $_POST['vrsta'];
				$datum = $_POST['datum'];
				$opis = $_POST['opis'];
				$broj_parcele = $_POST['parcela'];
				$broj_biljke = $_POST['broj_biljke'];
				$vrijeme = $_POST['vrijeme'];

			
		$dodaj = "";
		$dodaj = "INSERT INTO zapis (zapis_id, zapisnik_id, biljka_id, datum, vrijeme, opis, broj_parcele, broj_biljke)
			VALUES (DEFAULT, '{$id}', '{$biljka}','{$datum}', '{$vrijeme}', '{$opis}', '{$broj_parcele}', '{$broj_biljke}')";
			izvrsi($dodaj);
			header("Location: index.php");
			exit();

		}
	}
}
?>
<a class ="natrag" href="zapisi.php">Natrag </a>
<div class="zapisnik">
<h1 align="center">Novi zapis </h1>

<table>
	
	<form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id;?>" method="POST">
		<tr>
		<td><label for = "vrsta">Odabir biljke: </label></td>
		<td><select name = "vrsta">
				<?php
					while($red = mysql_fetch_array($biljka))
					{      
						echo "<option value = " .$red["biljka_id"];
						echo ">".$red["naziv"]."</option>";
					}
				?>
			</select></td>
			</tr>

			<tr>
			<td><label for = "datum">Datum:</label></td>
			<td><input type="text" name = "datum"/></td>
			</tr>
			<tr>
			<td><label for = "vrijeme">Vrijeme promatranja:</label></td>
			<td><input type="text" name = "vrijeme"/></td>
			</tr>
			<tr>
			<td><label for = "opis">Opis:</label></td>
			<td><textarea type="text" name = "opis"> </textarea></td>
			</tr>
			<tr>
			<td><label for = "parcela">Broj parcele:</label></td>
			<td><input type="text" name = "parcela"/></td>
			</tr>
			<tr>
			<td><label for = "broj_biljke">Broj biljke:</label></td>
			<td><input type="text" name = "broj_biljke"/></td>
			</tr>
			<tr>
			<input type="hidden" value="<?php echo "string";?>" >
			</tr>
			<tr>
			<td><input class="btn_zapisnik" type="submit" name ="dodaj_zapis" value = "Dodaj zapis"/></td>
			</tr>
	</form>
</table>
</div>
</body>
</html>
