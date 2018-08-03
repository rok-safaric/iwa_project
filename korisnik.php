<!DOCTYPE html>
<html>
<head>
	<title>e-Biljke</title>
</head>
<body>
<div class="korisnik">

	
	<?php

		if (isset($_SESSION['id'])) {
			if ($_SESSION['tip']==2 || $_SESSION['tip']==1 || $_SESSION['tip']==0){
		
			$upit = "SELECT * FROM zapisnik WHERE korisnik_id = '".$_SESSION['id']."' ";
			$rezultat = izvrsi ($upit);
		?>
	<?php
		if (!isset($_SESSION['id'])) {
			echo "Niste registrirani korisnik";
		} else {
			echo "Dobrodošli! Trenutno ste prijavljeni kao: <strong>".$_SESSION['ime']." ". $_SESSION['prezime']."</strong>";
		}
		
	?>
	<?php
		if ($_SESSION['tip']==1) {
		?>
			<a href="moderator.php">Uredi biljke</a>
		<?php
		}
		elseif ($_SESSION['tip']==0){
		?>

			<a class ="dodaj_zapis" href="admin_biljke.php">Uredi biljke</a>
			<a class ="dodaj_zapis" href="nova_vrsta.php">Uredi vrste</a>

		<?php
		}
		?>
</div>
	<h2> Zapisnici </h2>
		<a class ="dodaj_zapis" href="zapisnik.php">Dodaj zapisnik</a>
	</br>
	<h3> Postojeći zapisnici</h3>
	
		<table class="tablica">
		<tr>
			<th>ID</th>
			<th>Naziv</th>
			<th>Datum kreiranja</th>
			<th>Opis</th>
			<th>Ažuriranje</th>
			<th>Pregled</th>
		</tr>
		<?php
			while ($red = mysql_fetch_array($rezultat)) {
		?>
			<tr>
			<td><?php echo $red["zapisnik_id"]?></td>
			<td><?php echo $red["naziv"]?></td>
			<td><?php echo $red["datum_kreiranja"]?></td>
			<td><?php echo $red["opis"]?></td>
			<td><a href ="azuriranje_zapisnika.php?id=<?php echo $red["zapisnik_id"];?>">Ažuriraj</a></td>
			<td><a href ="zapisi.php?id=<?php echo $red["zapisnik_id"];?>">Pregledaj</a></td>
			</tr>
		<?php
				

			}
		?>

	</table>
	</div>
	</br>
	
	</br>
	
</div>
<?php }}?>
</body>
</html>


