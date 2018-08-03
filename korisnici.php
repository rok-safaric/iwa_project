
<?php
	include ("baza.php");
	otvori();
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
		}

	if (isset ($_POST['salji'])) {

		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$kor_ime = $_POST['kor_ime'];
		$email = $_POST['email'];
		$lozinka = $_POST['lozinka'];
		$kor_tip = $_POST['kor_tip'];
		$greska = "";


		if (!isset($ime) || empty($ime)) {
			$greska_ime ="Niste upisali ime!";
		}
		if (!isset($prezime) || empty($prezime)) {
			$greska_prezime ="Niste upisali prezime!";
		}
		if (!isset($kor_ime) || empty($kor_ime)) {
			$greska_kor_ime ="Niste upisali korisničko ime!";	
		}
		$upit = "SELECT * FROM korisnik";
		$rezultat = izvrsi($upit);
			while ($red  =mysql_fetch_array($rezultat)) {
				if ($kor_ime === $red ['korisnicko_ime']) {
					$greska = "Korisničko ime".$kor_ime. "već postoji!";
				}
			}
		if (!isset($email) || empty($email)) {
			$greska_email ="Niste upisali email adresu!";
		}
		if (!isset($lozinka) || empty($lozinka)) {
			$greska_lozinka ="Niste upisali lozinku!";
		}
		if (!isset($kor_tip) || empty($kor_tip)) {
			$greska_kor_tip ="Niste odabrali tip korisnika!";
		}
		if (empty($greska_ime) && empty($greska_prezime) && empty($greska_kor_ime) && empty($greska_lozinka) && empty($greska_email) && empty($greska_kor_tip)) {
			$upit = "INSERT INTO korisnik (`tip_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`)
			VALUES ('{$kor_tip}', '{$kor_ime}', '{$lozinka}', '{$ime}', '{$prezime}', '{$email}')";
			izvrsi($upit);
			header("Location: korisnici.php");
			exit();
		}
	}
}

		
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Biljke - Korisnici</title>
	<link rel="stylesheet" type="text/css" href="dizajn.css">
</head>
<body>
	<div class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<a href="prijava.php">Odjava</a>
	</div>
	<h2>Novi korisnik</h2>
	<table>
		<form action="" method="POST">
			<tr>
			<td><label for ="ime"> Ime: </label></td>
			<td><input name ="ime" type="text"/></td>
			<td><?php
				if (!empty ($greska_ime)) {
					echo $greska_ime;
				}
				
				?>
			</td>
			</tr>
			<tr>
			<td><label for ="prezime"> Prezime: </label></td>
			<td><input name ="prezime" type="text"/></td>
			<td><?php
				if (!empty ($greska_prezime)) {
					echo $greska_prezime;
				}
				
				?>
			</td>		
			</tr>
			<tr>
			<td><label for ="kor_ime"> Korisničko ime: </label></td>
			<td><input name ="kor_ime" type="text"/></td>
			<td><?php
				if (!empty ($greska_kor_ime)) {
					echo $greska_kor_ime;
				}
				
				?>
			</td>
			</tr>
			<tr>
			<td><label for ="email"> Email adresa: </label></td>
			<td><input name ="email" type="text"/></td>
			<td><?php
				if (!empty ($greska_email)) {
					echo $greska_email;
				}
				
				?>
			</td>
			</tr>
			<tr>
			<td><label for ="lozinka"> Lozinka: </label></td>
			<td><input name ="lozinka" type="password"/></td>
			<td><?php
				if (!empty ($greska_lozinka)) {
					echo $greska_lozinka;
				}
				
				?>
			</td>
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
			<td><input class="btn_filtar" type="submit" name="salji" value="Unesi korisnika"/></td>
			<td><input class="btn_filtar" type="submit" name = "sort_prezime" value = "Sortiraj prema prezimenu"</td>
			<td><input class="btn_filtar" type="submit" name = "sort_tip" value = "Sortiraj prema tipu"</td>
			</tr>
		</form>
	</table>

	<table class="tablica">
	<th>Tip</th>
	<th>Ime</th>
	<th>Prezime</th>
	<th>Korisničko ime</th>
	<th>Email adresa</th>
	<th>Ažuriraj</th>

	<tr>
		<?php
		if (isset($_POST['sort_prezime'])) {
			
			$upit = "SELECT * FROM korisnik order by prezime";
			$rezultat = izvrsi($upit);
			while ($red = mysql_fetch_array($rezultat)) {
		?>
		<td><?php echo $red["tip_id"];?></td>
		<td><?php echo $red["ime"];?></td>
		<td><?php echo $red["prezime"];?></td>	
		<td><?php echo $red["korisnicko_ime"];?></td>
		<td><?php echo $red["email"];?></td>
		<td><a href="azuriranje_korisnika.php?id=<?php echo $red["korisnik_id"]?>">Ažuriraj</a></td>
	</tr>
		<?php
			}
		} elseif (isset($_POST['sort_tip'])) {
			
			$upit = "SELECT * FROM korisnik order by tip_id";
			$rezultat = izvrsi($upit);
			while ($red = mysql_fetch_array($rezultat)) {
		?>
		<td><?php echo $red["tip_id"];?></td>
		<td><?php echo $red["ime"];?></td>
		<td><?php echo $red["prezime"];?></td>	
		<td><?php echo $red["korisnicko_ime"];?></td>
		<td><?php echo $red["email"];?></td>
		<td><a href="azuriranje_korisnika.php?id=<?php echo $red["korisnik_id"]?>">Ažuriraj</a></td>
	</tr>
		<?php
	}
}	else{ 
		$upit = "SELECT * FROM korisnik";
			$rezultat = izvrsi($upit);
			while ($red = mysql_fetch_array($rezultat)) {
		?>
		<td><?php echo $red["tip_id"];?></td>
		<td><?php echo $red["ime"];?></td>
		<td><?php echo $red["prezime"];?></td>	
		<td><?php echo $red["korisnicko_ime"];?></td>
		<td><?php echo $red["email"];?></td>
		<td><a href="azuriranje_korisnika.php?id=<?php echo $red["korisnik_id"]?>">Ažuriraj</a></td>
	</tr>
	<?php
}
}
		?>
			
	</tr>
</table>
</body>
</html>