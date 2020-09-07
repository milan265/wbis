<?php
    $const = $_POST["const"];
    if (!isset($const) or $const != '12345678') {
        header("Location: ./");
	}
	if(!isset($_POST['tbIme'])||
		!isset($_POST['tbPrezime'])||
		!isset($_POST['tbEmail'])||
		!isset($_POST['tbNaslov'])||
		!isset($_POST['taPoruka'])){
			echo "Greska";
			exit();
		}
	$ime = $_POST['tbIme'];
	$prezime = $_POST['tbPrezime'];
	$email = $_POST['tbEmail'];
	$naslov = $_POST['tbNaslov'];
    $tekst = $_POST['taPoruka'];
    $vreme = date('Y-m-d H:i:s', time());
		
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';
    
    
    $konekcija = new mysqli($server, $username, $password, $baza);
    if($konekcija->connect_error){
        die("Neuspešna konekcija: " . $konekcija->connect_error);
    }
    
    $brojKartice = $_COOKIE['broj_kartice'];
    $sql = "INSERT INTO poruka (vreme, ime, prezime, email, naslov, tekst, procitana, broj_kartice) 
            VALUES('$vreme', '$ime', '$prezime', '$email', '$naslov', '$tekst', 0, '$brojKartice')";
    $res = $konekcija->query($sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
    $konekcija->close();
?>