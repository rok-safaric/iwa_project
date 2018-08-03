<?php
	include ("baza.php");
	otvori ();
	session_start();
	if (!isset($_SESSION['id'])) {
		header ("Location:index.php");
		exit();
	}
	else {
	if (!isset($_SESSION['id'])) {
		header ("Location:prijava.php");
		exit();
	}
	else {
			if ($_SESSION['tip']==2) {
			 	header("Location:index.php");
			 	exit();
			 }
		if ($_SESSION['tip']==1) {
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
			$upit = "INSERT INTO biljka (`biljka_id`, `vrsta_id`, `naziv`) VALUES (DEFAULT, '{$id_vrsta}', '{$naziv}')";
			izvrsi($upit);
			header("Location: index.php");
			exit();
		}		
		}
		
	}

	}
if ($_SESSION['tip'] == 1) {
$upit = "SELECT * FROM vrsta WHERE korisnik_id =".$_SESSION['id'];
			$rezultat = izvrsi($upit);
}elseif ($_SESSION['tip']== 0){
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


</body>
</html>
<?php
}
?>