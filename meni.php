<div name="navigacija" class="izbornik">
	<a href="index.php">Početna</a>
	<a href="o_autoru.html">O autoru</a>
	<?PHP 
		if(isset($_SESSION["tip"])&&$_SESSION["tip"] == 0) { 
	?>
		<a href="korisnici.php">Korisnici</a>
	<?PHP } ?>
	<?PHP
	 if(!isset($_SESSION["id"])) { ?>
		<a href="prijava.php">Prijava</a><br>
	<?PHP } else { ?>
		<a href="prijava.php?odjava=1">Odjava</a>
	<?PHP } ?>
</div>