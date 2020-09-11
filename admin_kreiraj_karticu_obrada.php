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
		!isset($_POST['slika'])||
		!isset($_POST['indeks'])||
		!isset($_POST['lozinka'])){
			echo "Greska";
			exit();
		}
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$pol = $_POST['pol'];
	$datumRodjenja = $_POST['datum'];
    $beogradska = $_POST['beogradska'];
    $budzetska = $_POST['budzetska'];
	$fakultet = $_POST['fakultet'];
    $dom = $_POST['dom'];
    $slika = $_POST['slika'];
    $indeks = $_POST['indeks'];
    $lozinka = $_POST['lozinka'];
    $datumIzdavanja = date('Y-m-d', time());
    $godinaIsteka = date('Y', strtotime('+2 year'));
    $datumIsteka = $godinaIsteka.'-10-31';
    
    $novaLozinkaHash = password_hash($lozinka,PASSWORD_BCRYPT);

    $slika = str_replace(" ","+",$slika);
		
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';
    
    $konekcija = new mysqli($server, $username, $password, $baza);
    if($konekcija->connect_error){
        die("Neuspešna konekcija: " . $konekcija->connect_error);
    }
    $konekcija->set_charset("utf8");

    $sql = "INSERT INTO student (ime, prezime, pol, datum_rodjenja, slika) 
            VALUES('$ime', '$prezime', '$pol', '$datumRodjenja','$slika')";
    $konekcija->query($sql); 

    $sql = "SELECT max(student_id) AS student_id
            FROM student";

    $res = $konekcija->query($sql); 

    $student_id = 0;
    while($r = $res->fetch_assoc()){
        $student_id = $r['student_id'];
    }
    
    $sql = "SELECT max(broj_kartice) AS broj_kartice
                FROM kartica";
        
    $res = $konekcija->query($sql); 

    while($r = $res->fetch_assoc()){
        $brojKartice = $r['broj_kartice'];
    }
    $brojKartice++;
    if($dom==0){
        $dom = 'null';
    }else{
        $dom = "'".$dom."'";
    }
    if($fakultet==0){
        $fakultet = 'null';
    }else{
        $fakultet = "'".$fakultet."'";
    }
    $sql = "INSERT INTO kartica (broj_kartice,lozinka, datum_izdavanja, vazi_do, validna, beogradska, 
                                budzet, stanje_na_racunu, dorucak, rucak, vecera, student_id, dom_id, fakultet_id) 
            VALUES('$brojKartice', '$novaLozinkaHash', '$datumIzdavanja', '$datumIsteka', '1', '$beogradska', '$budzetska',
                    '0','0','0','0','$student_id', $dom, $fakultet)";

    $res = $konekcija->query($sql);

    if($res){
        echo $brojKartice;
    }else{
        echo 0;
    }

    $konekcija->close();
?>