<?php
    $const = $_POST["app_key"];
    if (!isset($const) or $const != '12345678') {
        header("Location: ./");
    }
    

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';

    $konekcija = new mysqli($server, $username, $password, $baza);
	if($konekcija->connect_error){
		die("Neuspešna konekcija: " . $konekcija->connect_error);
    }
    $konekcija->set_charset("utf8");

    $brKartice = $_COOKIE['broj_kartice'];
    $dorucak =  $_POST['dorucak'];
    $rucak = $_POST['rucak'];
    $vecera = $_POST['vecera'];
    $stanje = $_POST['stanje'];
    $racun = $_POST['racun'];

    $sql = "SELECT dorucak, rucak, vecera
            FROM kartica
            WHERE broj_kartice = $brKartice";

    $res = $konekcija->query($sql); 
    while($r = $res->fetch_assoc()){
        $kartica = $r;
    }
    $dorucakNovo = $dorucak + $kartica['dorucak'];
    $rucakNovo = $rucak + $kartica['rucak'];
    $veceraNovo = $vecera + $kartica['vecera'];
    $stanjeNovo = $stanje - $racun;

    $vreme = date('Y-m-d H:i:s');
    $sql = "INSERT INTO transakcija (vreme, dorucak, rucak, vecera, iznos, broj_kartice) 
            VALUES('$vreme', $dorucak, $rucak, $vecera, $racun, $brKartice)";
    $konekcija->query($sql); 


    $sql = "UPDATE kartica 
    SET dorucak = \"$dorucakNovo\", rucak =  \"$rucakNovo\", vecera = \"$veceraNovo\", stanje_na_racunu = \"$stanjeNovo\"
    WHERE broj_kartice = $brKartice";
    
    $res = $konekcija->query($sql); 
    if($res){
        echo $stanjeNovo;//vraca stanje na kartici ukoliko je uspesno
    }else{
            echo -1;//nije izvrsena uplata
    }
?>