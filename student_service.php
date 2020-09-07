<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
	}


    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg'; 

    
    function studentUDomu(){
        
        global $server, $username, $password, $baza;

		$konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        
		$brKartice = $_COOKIE["broj_kartice"];
		$sql = "SELECT dom_id FROM kartica WHERE broj_kartice = $brKartice";
        $res = $konekcija->query($sql); 
        $t = false;
		while($r = $res->fetch_assoc()){
            if($r["dom_id"]!=""){
				$t = true;
			}
		}
		$konekcija->close();
		
		return $t;
    }
    
?>