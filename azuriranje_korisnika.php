<?php
	include ("baza.php");
	include ("meni.php");
	otvori();
	session_start();

			if (!isset($_SESSION["id"])) {
			header("Location:index.php");
			exit();
		}
		else {
			if ($_SESSION['tip']==2 || $_SESSION['tip']==1) {
			 	header("Location:index.php");
			 	exit();
			 }
			$azur_korisnik = $_GET ['id'];
			$upit = "SELECT * FROM korisnik WHERE korisnik_id ='".$azur_korisnik."'";
			$rezultat = izvrsi ($upit);
			while ($red = mysql_fetch_array($rezultat)) {
				$ime = $red['ime'];
				$prezime = $red['prezime'];
				$kor_ime = $red['korisnicko_ime'];
				$email = $red['email'];
				$lozinka = $red['lozinka'];
				$kor_tip = $red['tip_id'];
			}
		}

		if (isset($_POST['azuriranje'])) {
			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];
			$kor_ime = $_POST['kor_ime'];
			$email = $_POST['email'];
			$lozinka = $_POST['lozinka'];
			$kor_tip = $_POST['kor_tip'];
			$greska = "";

		if (!isset($ime) || empty($ime)) {
			$greska = "Unesite ime!";
			echo $greska;
		}
		?>
		<br>
		<?php
		if (!isset($prezime) || empty($prezime)) {
			$greska = "Unesite prezime!";
			echo $greska;
		}
			
			if (!isset($greska) || empty($greska)) {
				$azur = "UPDATE korisnik SET  ime = '{$ime}',  prezime = '{$prezime}', korisnicko_ime = '{$kor_ime}',  email = '{$email}', lozinka = '{$lozinka}', tip_id = '{$kor_tip}' WHERE korisnik_id = '{$azur_korisnik}'";
				izvrsi($azur);
				header("Location:korisnici.php");
				exit();
			}
		}
?>

<html>
<head>
	<title>Ažuriranje korisnika</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="dizajn.css"/>
</head>
<body>
<a class ="natrag" href="korisnici.php">Natrag </a>
<div class="korisnici">
	<h1 align="center"> Ažuriranje korisnika </h1>

	<table>
		<form action = "" method="POST">
			<tr>
				<td><label for = "ime">Ime: </label></td>
				<td><input type ="text" name = "ime" value ="<?php echo $ime; ?>"/></td>
			</tr>
			<tr>
				<td><label for = "prezime">Prezime:</label></td>
				<td><input name = "prezime" value="<?php echo $prezime;?>"/></td>
			</tr>
			<tr>
				<td><label for = "kor_ime">Korisničko ime:</label></td>
				<td><input name = "kor_ime" value ="<?php echo $kor_ime;?>"/></td>
			</tr>
			<tr>
				<td><label for = "email">Email adresa:</label></td>
				<td><input name = "email" value ="<?php echo $email;?>"/></td>
			</tr>
			<tr>
				<td><label for = "lozinka">Lozinka:</label></td>
				<td><input name = "lozinka" type="password" value ="<?php echo $lozinka;?>"/></td>
			</tr>
			<tr>
			<td><label for ="kor_tip"> Tip korisnika: </label></td>
				<?php
					$upit = "SELECT * FROM tip_korisnika";
					$rezultat = izvrsi($upit);
					while ($red = mysql_fetch_array($rezultat)) {
				?>
			<td><input name ="kor_tip" type="radio" value="<?php echo $red["tip_id"];?>" checked/><?php echo $red["naziv"];?></td>
				<?php
					}
				?>
			</tr>
			<tr>
				<td> <input class = "btn_zapisnik" type ="submit" name ="azuriranje" value ="Ažuriraj zapisnik"</td>
			</tr>
		</form>
	</table>
	</div>
</body>
</html>



