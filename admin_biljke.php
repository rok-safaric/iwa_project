<?php
	include ("baza.php");
	otvori ();
	session_start();

	if (!isset($_SESSION['id'])) {
		header ("Location:index.php");
		exit();
	}
	else {
		if ($_SESSION['tip']==2 || $_SESSION['tip']==1) {
			 	header("Location:index.php");
			 	exit();
			 }

		if ($_SESSION['tip']==0) {
				if (isset($_GET['id'])) {
					$id = $_GET['id'];		
				}
			else $id = isset($_GET['id']);
			
		if (isset($_POST['salji'])) {
			$naziv = $_POST['naziv'];
			$id_vrsta = $_POST['vrsta'];
			$greska = "";
			

			if (!isset($naziv) || empty($naziv)) {
				$greska_naziv = "Nije unešen naziv biljke!";
				echo $greska;
			}
			if (empty($greska)) {
			$upit = "INSERT INTO biljka (`vrsta_id`, `naziv`)
			VALUES ('{$id_vrsta}', '{$naziv}')";
			izvrsi($upit);
			header("Location: index.php");
			exit();
		}		
		}
		
	}

	}
if ($_SESSION['tip'] == 0) {
	$upit = "SELECT * FROM vrsta";
			$rezultat = izvrsi($upit);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Unos biljke</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="dizajn.css">
</head>
<body>
<div class="izbornik">
<a href="index.php">Početna</a>
<a href="moje_biljke.php">Moje biljke</a>
</div>
<h1 > Unos biljke</h1>
	<table>
		<form action = "" method="POST">
			<tr>
			<td><label for = "vrsta">Odabir biljke: </label></td>
			<td><select name = "vrsta">
				<?php

			
	 		while($red = mysql_fetch_array($rezultat))
					{      
				?>
				<option value = "<?php echo $red["vrsta_id"];?>">  <?php echo $red["naziv"];?> </option>
				<?php			
					}	
					

				
	 			?>
			</select></td>
			</tr>
			<tr>
			
			<td><label for = "naziv">Naziv</label></td>
			<td><input type="text" name = "naziv" value=" <?php echo $red["naziv"];?>"/></td>
			</tr>
			<tr>
			<td><input class ="btn_zapisnik" type ="submit" name ="salji" value ="Šalji"></td>
			<?php
				
			?>
			</tr>
		</form>
	</table>

<?php

			if ($_SESSION['tip']== 0){
			$upit="SELECT * FROM vrsta vrsta, korisnik korisnik WHERE vrsta.korisnik_id = korisnik.korisnik_id"; 
				$rezultat = izvrsi($upit);
}

if (isset($_GET['id_vrste'])) {
$id_vrste = $_GET['id_vrste'];
$upit3 = "SELECT biljka.naziv as ime_biljke, count(*) as broj FROM biljka biljka, zapis zapis WHERE zapis.biljka_id=biljka.biljka_id and biljka.vrsta_id = '".$id_vrste."'GROUP BY biljka.naziv";
			$rezultat3 = izvrsi($upit3);

}
?>
	<h2>Pregled moderatora prema vrstama</h2>
	<table class="tablica">
		<th>Naziv vrste</th>
		<th>Broj biljaka</th>
		<th>Moderator</th>
		<th>Ažuriraj</th>
		<th>Pregledaj</th>
		<tr>
			<?php
				while ($red = mysql_fetch_array($rezultat)) {

	$id_moderatora=$red['korisnik_id'];
	$id_biljke = $red['vrsta_id'];
	$naziv=$red['naziv'];
	$vrsta_id=$red['vrsta_id'];


	$upit1 = "SELECT * FROM biljka WHERE vrsta_id=$vrsta_id";
	$rezultat2=izvrsi($upit1);
	$i=0;
	while($red2 = mysql_fetch_array($rezultat2)) {
$i++;
	}
			?>
				<td><?php echo $red["naziv"];?></td>
				<td>	<?php		
				echo $i;
			
			?></td>
				<td><?php echo $red["ime"]." ". $red["prezime"];?></td>
				<td><a class ="dodaj_zapis" href="azuriranje_moderatora.php?id_biljke=<?php echo $id_biljke; ?>&id_moderatora=<?php echo $id_moderatora;?>">Ažuriraj </a></td>
				<td><a href="admin_biljke.php?id_vrste=<?php echo $red["vrsta_id"]; ?>&id_moderatora=<?php echo $id_moderatora;?>">Pregledaj </a></td>
				
				
		</tr>
			<?php		
				}
			
			?>

		
	</table>

	<table class="tablica">
		<th>Ime biljke</th>
		<th>Broj zapisa</th>
		
		
		<?php
		if (isset($rezultat3)) {
			while ($red = mysql_fetch_array($rezultat3)) {
		?>	
		<tr>
		<td><?php echo $red['ime_biljke'];?></td>
		<td><?php echo $red['broj'];?></td>	
		</tr>
		<?php
		}	
		}
		?>
		
	</table>
</body>
</html>