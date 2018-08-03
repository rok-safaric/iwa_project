<?php
	if (!isset($_SESSION['id'])) {
		header ("Location:index.php");
		exit();
	}
	else {
	include ("baza.php");
	include ("meni.php");
	otvori();
	$novi_zapis = "";
	session_start();
	$zapis_id = $_GET["id"];
	if (isset($_POST["azuriraj"])) {
		$greska = "";
		$biljka = $_POST["vrsta"];
		$datum = $_POST["datum"];
		$opis = $_POST["opis"];
		$vrijeme = $_POST["vrijeme"];
		$broj_parcele = $_POST["broj_parcele"];
		$broj_biljke = $_POST["broj_biljke"];

		if (!isset($biljka) || empty($biljka)) {
			$greska = "Unesite ime biljke!";
			echo $greska;
		}
		if (!isset($datum) || empty($datum)) {
			$greska = "Unesite datum promatranja!";
			echo $greska;
		}
		if (!isset($opis) || empty($opis)) {
			$greska = "Unesite opis!";
		}
		if (!isset($vrijeme) || empty($vrijeme)) {
			$greska = "Unesite vrijeme promatranja!";
		}
		if (!isset($broj_parcele) || empty($broj_parcele)) {
			$greska = "Unesite broj parcele!";
		}

		
			$poruka = "Uspješno ste ažurirali zapisnik!";
			$upit = "UPDATE zapis SET  datum = '{$datum}', opis = '{$opis}', vrijeme = '{$vrijeme}', broj_parcele = '{$broj_parcele}', broj_biljke = '{$broj_biljke}' WHERE zapis_id = '{$zapis_id}'";
			izvrsi($upit);
			header("Location: index.php");
			exit ();
		
		
	}
	
			$upit = "SELECT * FROM biljka";
			$rezultat = izvrsi($upit);

?>


<!DOCTYPE html>
<html>
<head>
	<title>e-Biljke - Ažuriranje zapisa</title>
	<link rel="stylesheet" type="text/css" href="dizajn.css">
</head>
<a class ="natrag" href="zapisi.php">Natrag </a>
<body>
<div class="zapisnik">
<h1 align="center"> Ažurianje zapisa</h1>
	
	<table>
		<form action = "" method="POST">
			<tr>
			<td><label for = "vrsta">Odabir biljke: </label></td>
			<td><select name = "vrsta">
				<?php

	
	 		while($red = mysql_fetch_array($rezultat))
					{      
		?>
			<option value = "<?php $red["biljka_id"];?>">  <?php echo $red["naziv"];?> </option>
		<?php				
					}	
			$id_zapisa = $_GET["id"];
							
						$upit = "SELECT * FROM zapis WHERE zapis_id = '$zapis_id'";
						$rezultat = izvrsi($upit);

			while($red = mysql_fetch_array($rezultat))
			{
	 	?>
			</select></td>
			</tr>
			<tr>
			<td><label for = "datum">Datum</label></td>
			<td><input type="text" name = "datum" value=" <?php echo $red["datum"];?>"/></td>
			</tr>
			<tr>
			<td><label for = "opis">Opis</label></td>
			<td><textarea name ="opis"><?php echo $red["opis"];?></textarea></td>
			</tr>
			<tr>
			<td><label for = "vrijeme">Vrijeme</label></td>
			<td><input type="text" name="vrijeme" value="<?php echo $red["vrijeme"];?>"/></td>
			</tr>
			<tr>
			<td><label for = "broj_parcele">Broj parcele</label></td>
			<td><input type="text" name ="broj_parcele"value="<?php echo $red["broj_parcele"];?>"/></td>
			</tr>
			<td><label for = "broj_biljke">Broj biljke</label></td>
			<td><input type="text" name ="broj_biljke"value="<?php echo $red["broj_biljke"];?>"/></td>
			</tr>
			<tr>
			<td><input type ="submit" name ="azuriraj" value ="Ažuriraj zapis"></td>

			<?php
}
			?>
			</tr>
		</form>
	</table>
	</div>
</body>
</html>
<?php
}
?>