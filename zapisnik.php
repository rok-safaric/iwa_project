
<html>
	<head>
		<title> Zapisnik </title>
		<link href="dizajn.css" rel="stylesheet" type="text/css" />
	</head>
	<body> 
	<div class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<a href="prijava.php">Odjava</a>
	</div>
	<a class ="natrag" href="index.php">Natrag </a>
	
	<div class="zapisnik">
		<h1 class="zap"> Novi zapisnik </h1>
		<table>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">	
			<tr>
			<td><label class="labela" for="naziv"> Naziv zapisnika </label></td>
			<td><input type="text" name="naziv" /></td>
			</tr>
			<tr>
			<td><label class="labela" for="opis"> Opis </label></td>
			<td><textarea name="opis"></textarea></td>
			</tr>
			<tr>
			<td><input class="btn_zapisnik" type="submit" name="zapisnik" value="Stvori zapisnik" /></td>
			</tr>
		</form>
		</table>
		</div>
	
		
	</body>
</html>
<?php
	session_start();
	include ("baza.php");
	otvori();
if (!isset($_SESSION['id'])) {
	header("Location:index.php");
	exit();
}
else {
if(isset($_POST['zapisnik'])){
		$naziv=$_POST['naziv'];
		$opis = $_POST['opis'];
		$id = $_SESSION['id'];
		$datum = date("Y-m-d");
		$greska = "";
		if (!isset($naziv) || empty($naziv)) {
			$greska = "Unesite naziv zapisnika!";
			echo $greska;
		}
		?>
		<br>
		<?php
		if (!isset($opis) || empty($opis)) {
			$greska = "Unesite opis zapisnika!";
			echo $greska;
		}
		if(isset($naziv) && !empty($naziv)){
			$unos = "INSERT INTO zapisnik (zapisnik_id, korisnik_id, naziv, datum_kreiranja, opis) 
			VALUES (DEFAULT,'{$id}', '{$naziv}','{$datum}','{$opis}')";
			izvrsi($unos);
			header("Location:index.php");
			exit();
		}
	}
}
?>