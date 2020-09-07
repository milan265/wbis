<?php
    $app_key = $_POST['app_key'];
    if (!isset($app_key) or $app_key != "12345678") {
        header("Location: ./");
    }

    $brKartice = $_POST['tbBrKartice'];
    $lozinka = $_POST['tbLozinka'];

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';

    $konekcija = new mysqli($server, $username, $password, $baza);
    if($konekcija->connect_error){
        die("Neuspešna konekcija: " . $konekcija->connect_error);
    }


    $vrstaKorisnika = "";
    $uspesnaPrijava = false;

    $sql = "SELECT lozinka FROM kartica WHERE broj_kartice = $brKartice";
    $res = $konekcija->query($sql); 
    while($r = $res->fetch_assoc()){
        if(password_verify( $lozinka,$r['lozinka'])){
            $uspesnaPrijava = true;
            $vrstaKorisnika = "student";
        }
    }

    if($vrstaKorisnika==""){
        $sql = "SELECT lozinka FROM administrator WHERE administrator_id = $brKartice";
        $res = $konekcija->query($sql); 
    
        while($r = $res->fetch_assoc()){
            if(password_verify( $lozinka,$r['lozinka'])){
                $uspesnaPrijava = true;
                $vrstaKorisnika = "administrator";
            }
        }
    }

    $konekcija->close();

    if($uspesnaPrijava){
        setcookie("prijavljen", 1, time()+86400, "/");
        setcookie("broj_kartice",$brKartice,time()+86400,"/");
        if($vrstaKorisnika=="student"){
            setcookie("vrsta_korisnika",1,time()+86400,"/");
        }else{
            setcookie("vrsta_korisnika",0,time()+86400,"/");
        }  
        echo 1;  
    }else{
        echo 0;
    }
      
?>