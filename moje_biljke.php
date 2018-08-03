<!DOCTYPE html>
<html>
<head>
	<title>e-biljke</title>
	<link rel="stylesheet" type="text/css" href="dizajn.css">
	

</head>

<?php

include ("baza.php");
	otvori ();
	session_start();

	if (!isset($_SESSION['id'])) {
		header ("Location:index.php");
		exit();
	}
	else {
			if ($_SESSION['tip']==2) {
			 	header("Location:index.php");
			 	exit();
			 }
		if ($_SESSION['tip']==1 || $_SESSION['tip']==0) {
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
						
				}

if ($_SESSION ['tip']== 1) {
	$upit = "SELECT * FROM vrsta WHERE korisnik_id =".$_SESSION['id'];
}
	else {
		$upit ="SELECT * FROM vrsta";
	}
	$rezultat = izvrsi($upit);
	$i = 1;
						$upit2 = "SELECT * FROM biljka WHERE vrsta_id=";
						while($red = mysql_fetch_array($rezultat)){
							if($i == 1){
								$upit2 .= $red["vrsta_id"];
							}else{
								$upit2 .= " OR vrsta_id=" . $red["vrsta_id"];

							}
							$vrsta[$red["vrsta_id"]] = $red["naziv"];

							$i++;
						}
						$upit2.= " order by vrsta_id";
						$_SESSION["upit"] = $upit2;
						$rezultat2 = izvrsi($upit2);
?>	
<body>		
<a href="index.php">Početna</a>
<a align ="center" href="moderator.php">Uređivanje biljaka</a>	
	<table class="tablica2">
			<th>Naziv</th>
			<th>Vrsta</th>
			<th>Broj zapisa</th>
			<th>Ažuriraj</th>
	<?php				
		
						$i = 0;
						while($red = mysql_fetch_array($rezultat2)){
							$i = $i + 1;
							$idd1= $red["biljka_id"];
							$upit = "SELECT count(*) FROM zapis WHERE biljka_id = " . $red["biljka_id"];
							$rezultat = izvrsi($upit);
	
	?>
	
		<tr>
			<td><?php echo $red["naziv"]; ?>&nbsp</td>
			<td><?php echo $vrsta[$red["vrsta_id"]]; ?>&nbsp </td>
			<td><?php while($red = mysql_fetch_array($rezultat)){echo $red[0];}?></td>
			<?php
			if ($_SESSION['tip']==1) {
			?>
			<td><a href="azuriranje_biljaka.php?id=<?php echo $idd1 ?>">Ažuriraj</a></td>
			<?php
			}
			elseif ($_SESSION['tip']==0){
			?>
			<td><a href="azuriranje_biljaka.php?id=<?php echo $idd1 ?>">Ažuriraj</a></td>
			<?php
			}

			?>
			<br>
		</tr>
	
	<?php
	}	
	}
	}
	?>
	</table>
</body>
</html>