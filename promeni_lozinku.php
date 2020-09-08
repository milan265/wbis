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

    $brKartice = $_COOKIE['broj_kartice'];
    $staraLozinka =  $_POST['stara_lozinka'];
    $novaLozinka = $_POST['nova_lozinka'];
    
    if($_COOKIE['vrsta_korisnika'] == 1){
        $sql = "SELECT lozinka 
                FROM kartica
                WHERE broj_kartice = $brKartice";
    }else{
        $sql = "SELECT lozinka
                FROM administrator
                WHERE administrator_id = $brKartice";
    }
    

    $lozinka = "";
    $res = $konekcija->query($sql);
    while($r = $res->fetch_assoc()){
        $lozinka = $r['lozinka'];
    }

        
    if(password_verify($staraLozinka,$lozinka)){
        $novaLozinkaHash = password_hash($novaLozinka,PASSWORD_BCRYPT);
        if($_COOKIE['vrsta_korisnika']==1){
            $sql = "UPDATE kartica 
                    SET lozinka = \"$novaLozinkaHash\" 
                    WHERE broj_kartice = $brKartice";
        }else{
            $sql = "UPDATE administrator 
                    SET lozinka = \"$novaLozinkaHash\" 
                    WHERE administrator_id = $brKartice";
        }
        
        $res = $konekcija->query($sql); 
        if($res){
            echo 1;//promenjena lozinka
        }else{
            echo 0;//nije promenjena lozinka
        }
    }else{
        echo -1;//trenutna lozinka i uneta lozinka se ne poklapaju
    }

    $konekcija->close();   
?>