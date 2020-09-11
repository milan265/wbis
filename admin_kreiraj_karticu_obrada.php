<?php
    $const = $_POST["app_key"];
    if (!isset($const) or $const != '12345678') {
        header("Location: ./");
	}
	if(!isset($_POST['ime'])||
		!isset($_POST['prezime'])||
		!isset($_POST['pol'])||
		!isset($_POST['datum'])||
		!isset($_POST['beogradska'])||
		!isset($_POST['budzetska'])||
		!isset($_POST['fakultet'])||
		!isset($_POST['dom'])||
		!isset($_POST['slika'])){
			echo "Greska";
			exit();
		}
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$pol = $_POST['pol'];
	$datum = $_POST['datum'];
    $beogradska = $_POST['beogradska'];
    $budzetska = $_POST['budzetska'];
	$fakultet = $_POST['fakultet'];
    $dom = $_POST['dom'];
    $slika = $_POST['slika'];
    $trenutnoVreme = date('Y-m-d H:i:s', time());
		
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';
    
    
    $konekcija = new mysqli($server, $username, $password, $baza);
    if($konekcija->connect_error){
        die("Neuspešna konekcija: " . $konekcija->connect_error);
    }
    
    /*$sql = "INSERT INTO poruka (vreme, ime, prezime, email, naslov, tekst, procitana, broj_kartice) 
            VALUES('$vreme', '$ime', '$prezime', '$email', '$naslov', '$tekst', 0, '$brojKartice')";
    $res = $konekcija->query($sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }*/
    $konekcija->close();
?>