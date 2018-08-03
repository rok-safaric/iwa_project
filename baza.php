<?php
	$server = 'localhost';
	$bazaPodataka = 'iwa_2014_vz_projekt';
	$korisnik = 'iwa_2014';
	$lozinka = 'foi2014';

	$dbc = null; 
	$db = null; 

function otvori() {
	global $dbc;
	global $db;
	global $server;
	global $bazaPodataka;
	global $korisnik;
	global $lozinka;

	$dbc = mysql_connect($server, $korisnik, $lozinka);
	if(! $dbc) {
		greska('Pogreška! ' . mysql_error());
		exit();
	}

	$db = mysql_select_db($bazaPodataka, $dbc);
	if(! $db) {
		greska('Pogreška! ' . mysql_error());
		exit();
	}
	mysql_query("set names 'utf8'",$dbc);
}

function izvrsi($upit) {
	$rezultat = mysql_query($upit);
	if(! $rezultat) {
		greska('Pogreška! ' . mysql_error());
		exit();
	}
	return $rezultat;
}	
function zatvori(){
	global $dbc;
	mysql_close($dbc);
}
function greska ($error) {
	echo $error;
}
?>