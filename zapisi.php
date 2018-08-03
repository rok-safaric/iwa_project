<?php
	include ("baza.php");
	otvori();
	session_start();
	if (!isset($_SESSION['id'])) {
		header ("Location:index.php");
		exit();
	}
	else {
		if ($_SESSION['tip']==2 || $_SESSION['tip']==1 || $_SESSION['tip']==0) {
				if (isset($_GET['id'])) {
					$id = $_GET['id'];	
				}else $id = isset($_GET['id']);
				
	if (isset($_POST['filtriraj'])) {
		$datum_od = $_POST['datum_1'];
		$datum_do = $_POST['datum_2'];
		$greska = "";

		if (!isset($datum_od)|| empty($datum_od)) {
			$greska .= "Niste unijeli prvi datum!";
			echo $greska;
		}
		if (!isset($datum_do) || empty($datum_do)) {
			$greska .= "Niste unijeli drugi datum!";
			echo $greska;
		}
		if (empty($greska)) {
			$upit = "SELECT * FROM zapis WHERE zapisnik_id = '{$id}' and datum>'{$datum_od}' and datum <'{$datum_do}' order by broj_parcele";
			$rezultat = izvrsi($upit);
		}
		
		}else {
			$upit = "SELECT * FROM zapis WHERE zapisnik_id = '{$id}' order by broj_parcele";
			
			$rezultat = izvrsi($upit);
		}
	}
		
		}
		?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Biljke - Zapisi</title>
</head>

<link rel="stylesheet" type="text/css" href="dizajn.css">

<body>
	<div class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<a href="prijava.php">Odjava</a>
	</div>
	
		<a class ="natrag" href="index.php">Natrag </a>
		

		<br>
		<h2>Filtriranje</h2>
		<form action="" method="POST">
			<label for ="datum_od">Od:</label>
			<input type = "text" name="datum_1"/>
			<br>
			<label for ="datum_do">Do:</label>
			<input type = "text" name="datum_2"/>
			<br>
			<input class="btn_filtar" type = "submit" name="filtriraj" value = "Filtriraj"/>
		</form>
		<div class="zapisi">
		<table class="tablica">
			<tr>
				<th>Biljka</th>
				<th>Datum</th>
				<th>Vrijeme</th>
				<th>Opis</th>
				<th>Broj parcele</th>
				<th>Broj biljke</th>
			</tr>
	
		
		<?php	
			
			while ($red = mysql_fetch_array($rezultat)) {
			
			
		?> 		
				<td></td>
			 	<td><?php echo $red ["datum"]; ?></td>
			 	<td><?php echo $red ["vrijeme"];?></td>
			 	<td><?php echo $red ["opis"];?></td>
			 	<td><?php echo $red ["broj_parcele"]; ?></td>
			 	<td><?php echo $red["broj_biljke"];?></td>
			 	<td><a href ="azuriranje_zapisa.php?id=<?php echo $red["zapis_id"];?>">Ažuriraj</a></td>
			</tr>
		<?php
		}
		?>

		<?php
		
		?>	 	
	
		</table>
		<a class ="dodaj_zapis" href="novi_zapis.php?id=<?php echo $id; ?>">Dodaj zapis </a>
	</div>

</body>
</html>