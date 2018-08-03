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
			$korisnik = $_POST['korisnik'];
			$greska = "";
			

			if (!isset($naziv) || empty($naziv)) {
				$greska_naziv = "Nije unešen naziv biljke!";
				echo $greska;
			}
			if (empty($greska)) {
			$upit = "INSERT INTO vrsta (`naziv`,`korisnik_id`) VALUES ('{$naziv}','{$korisnik}')";
			izvrsi($upit);
			header("Location: index.php");
			exit();
		}		
		}
		
	}

	}

	if ($_SESSION['tip'] == 0) {
$upit = "SELECT * FROM korisnik WHERE tip_id =1";
			$rezultat = izvrsi($upit);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Unos vrste i voditelja</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="dizajn.css">
</head>
<body>
<div class="izbornik">
<a href="index.php">Početna</a>
<a href="moje_biljke.php">Moje biljke</a>
</div>
<div class="zapisnik">
<h1 align="center"> Unos vrste i voditelja:</h1>
	<table>
		<form action = "" method="POST">
			<tr>
			<td><label for = "korisnik">Moderator: </label></td>
			<td><select name = "korisnik">
				<?php

			
	 		while($red = mysql_fetch_array($rezultat))
					{      
				?>
				<option value = "<?php echo $red["korisnik_id"];?>">  <?php echo $red["korisnicko_ime"];?> </option>
				<?php			
					}	
					

				
	 			?>
			</select></td>
			</tr>
			<tr>
				<td><label for="naziv">Naziv: </label></td>
				<td><input type="text" name = "naziv"/></td>
			</tr>
			<tr>
				<td><input class="btn_zapisnik" type ="submit" name ="salji" value ="Unesi vrstu"></td>
			</tr>
		</form>
	</table>
	</div>