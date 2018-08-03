<!DOCTYPE html>
<html>
	<head>
		<title>Početna stranica</title>
		<meta charset = "utf-8">
		<link rel="stylesheet" type="text/css" href="dizajn.css">
	</head>
	<body>
		<div class="izbornik">
			<?php
				session_start();
				include ("meni.php");
			?>
			
			<h1>e-Biljke</h1>
		</div>
		<?php

	 		include ("baza.php");
	 		otvori ();
	 		$upit = "SELECT * FROM vrsta";
				$vrste = izvrsi($upit);
		?>
		<?php
		include ("korisnik.php");
		?>
	 	
		<div class="forma">
		
	
	<h2> Ispis biljaka </h2>
	<form  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">	
		
		<label for="vrsta">Vrste biljaka: </label>
				<select name="vrsta" id="vrsta_id">
					<?php
						while($red = mysql_fetch_array($vrste))
						{
					?>
							<option value = "<?php echo $red["vrsta_id"];?>">  <?php echo $red["naziv"];?> </option>
							
					<?php
						}
					?>
				</select>
			<input class= "btn_ispisi" type="submit" name="ispisi" value="Ispiši po vrsti">
	</form>
	
		<?PHP
			if (isset($_POST['ispisi'])){
				$id_vrsta = $_POST['vrsta'];
				$upit = "SELECT * FROM biljka WHERE vrsta_id = $id_vrsta";
				$rezultat = izvrsi($upit);
				while($red = mysql_fetch_array($rezultat)){
					$naziv_biljke = $red['naziv'];
					echo $naziv_biljke."<br/>";		
				}
			}
		 ?>

		
</div>
	</body>
</html>
