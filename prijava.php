<?PHP
include_once("baza.php");
include ("meni.php");
$veza = otvori();
	if(isset($_GET["odjava"])){
		session_start();
		unset($_SESSION["id"]);
		unset($_SESSION["ime"]);
		unset($_SESSION["tip"]);
		session_destroy();
	}
	
	if(isset($_POST["salji"])){
		$greska="";
		if(isset($_POST["korime"])&&isset($_POST["lozinka"])){
			$korime=$_POST["korime"];
			$lozinka=$_POST["lozinka"];
			if(empty($korime)||empty($lozinka))
			{
				$greska="Obavezno ispuniti ova polja!";
			}
			else{
				$upit = "SELECT * FROM korisnik 
				WHERE korisnicko_ime = '".$korime."' 
				AND lozinka = '".$lozinka."'";
				$rezultat = izvrsi($upit);
				$loginOK = false;
				while($row = mysql_fetch_array($rezultat)){
					$loginOK = true;
					session_start();
					$_SESSION["id"] = $row[0];
					$_SESSION["ime"] = $row["ime"];
					$_SESSION["prezime"] = $row["prezime"];
					$_SESSION["tip"] = $row["tip_id"];
				}
				if($loginOK){
					setcookie("moj_kolacic","korisnik prijavljen");
				
					header("Location:index.php");
					exit();
				}
				else{
					$greska = "Korisničko ime ili lozinka nije ispravno!";
				}
			}
		}else
		{
			$greska="Korisničko ime ili lozinka nije postavljena!";
		}
	}
zatvori($veza);
?>
<html>
	<head>
		<title>e-Biljke prijava</title>
		<meta charset="UTF-8" />
		<meta name="author" content="Rok Šafarić" />
		<link href="dizajn.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<hr>
	<div class="prijava">
		<div name="zaglavlje" id="zaglavlje">
			Prijava korisnika
			<hr>
		</div>
		<div name="sadrzaj">
			<div style="color:red;">
				<?PHP 
					if(isset($greska)){
						echo $greska;
					}
				?>
			</div>
			<table>
			<form method="POST" action="<?PHP echo $_SERVER["PHP_SELF"];?>">
				<tr>
				<td><label for="korime">Korisničko Ime:</label></td>
				<td><input name="korime" type="text" /></td>
				</tr>
				<tr>
				<td><label for="lozinka">Lozinka:</label></td>
				<td><input name="lozinka" type="password" /></td>
				</tr>
				<tr>
				<td><input  class = "salji" name="salji" type="submit" value="Prijavi se"/></td>
				</tr>
			</form>
			</table>
		</div>
		</div>
	</body> 
</html>



