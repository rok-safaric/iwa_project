<?php
	include ("baza.php");
	otvori();
	session_start();
		if (!isset($_SESSION["id"])) {
			header("Location:index.php");
			exit();
		}
		else
			 {
			 	if ($_SESSION['tip']==2) {
			 	header("Location:index.php");
			 	exit();
			 }

			 	$id_vrsta = $_GET ['id'];
			 	if ($_SESSION['tip']== 0) {
			 		$upit = "SELECT * FROM vrsta";
			 		$upit1 = "SELECT * FROM biljka WHERE biljka_id =".$id_vrsta;
			 	}
			 	else {
			
		$nazivb;
			$upit = "SELECT * FROM vrsta WHERE korisnik_id =".$_SESSION['id'];
			$upit1 = "SELECT * FROM biljka WHERE biljka_id =".$id_vrsta;
			
			
			}
			$rezultat = izvrsi ($upit);	
			
			$rezultat1 = izvrsi ($upit1);	
				
	 		$red1 = mysql_fetch_array($rezultat1);
{
$nazivb=$red1["naziv"];
}
if (isset($_POST["salji"])) {
		$vrsta_id = $_POST["vrsta"];
		$naziv = $_POST["naziv"];

	$upit = "UPDATE biljka SET  vrsta_id = '{$vrsta_id}', naziv = '{$naziv}' WHERE biljka_id = '$id_vrsta' ";
	$rezultat1 = izvrsi($upit);
}
?>

<html>
<head>
	<title>Ažuriranje biljaka</title>
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
<table>
<h1>Ažuriranje biljaka</h1>
		<form action = "" method="POST">
			<tr>
			<td><label for = "vrsta">Odabir vrste: </label></td>
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
			<td><label for = "naziv">Naziv biljke:</label></td>
			<td><input type="text" name = "naziv" value="<?php echo $nazivb;?>"/></td>
			</tr>
			<tr>
			<td><input class ="azuriraj" type ="submit" name ="salji" value ="Ažuriraj"></td>
			<?php
				}
			?>
			</tr>
		</form>
	</table>
</body>
</html>



