<?php


    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg';

    $konekcija = new mysqli($server, $username, $password, $baza);
    if($konekcija->connect_error){
        die("Neuspešna konekcija: " . $konekcija->connect_error);
    }

    $loz = password_hash($lozinka,PASSWORD_BCRYPT);
    password_verify($lozinka,$loz);

    $sql = "UPDATE kartica SET lozinka = \"$loz\" WHERE broj_kartice = $brKartice";
    echo "$sql <br>";
    $res = $konekcija->query($sql); 
    if($res){
        echo "TRUE";
    }else{
        echo "FALSE";
    }
?>