<?php
    $app_key = $_POST['app_key'];
    if (!isset($app_key) or $app_key != "12345678") {
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

    $idPoruke = $_POST['poruka_id'];
    
    $sql = "UPDATE poruka 
            SET procitana = 1 
            WHERE poruka_id = $idPoruke";
    
    $res = $konekcija->query($sql); 
    if($res){
        echo 1;//uspesno izvrsen upit
    }else{
        echo 0;//nije uspesno izvrsen upit
    }
    
    $konekcija->close();   
?>