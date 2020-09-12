<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
	}


    $server = 'localhost';
    $username = 'root';
    $password = '';
    $baza = 'studentski_centar_bg'; 

    $brKartice = $_COOKIE["broj_kartice"];

    //da li je student u domu
    function studentUDomu(){
        
        global $server, $username, $password, $baza;

		$konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

		global $brKartice;
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

    function getStudent(){
        global $server, $username, $password, $baza;

        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        global $brKartice;

        $student = [];
        $sql = "SELECT  student.student_id,student.ime, student.prezime, student.pol, student.datum_rodjenja, student.slika, zgrada.naziv AS 'fakultet', kartica.fakultet_id
                FROM student 
                INNER JOIN kartica 
                ON student.student_id = kartica.student_id
                INNER JOIN fakultet
                ON kartica.fakultet_id = fakultet.fakultet_id
                INNER JOIN zgrada
                ON zgrada.fakultet_id = fakultet.fakultet_id
                WHERE kartica.broj_kartice = $brKartice";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $student = $r;
        }

        $konekcija->close();
        
        $student['broj_indeksa'] = getBrojIndeksa($student['student_id'],$student['fakultet_id']);
        
        return $student;
    }

    function getBrojIndeksa($studentID, $fakultetID){
        global $server, $username, $password, $baza;

        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $brIndeksa = 0;
        $sql = "SELECT  student_fakultet.broj_indeksa
                FROM student 
                INNER JOIN student_fakultet 
                ON student.student_id = student_fakultet.student_id
                INNER JOIN fakultet
                ON student_fakultet.fakultet_id = fakultet.fakultet_id
                WHERE student.student_id = $studentID AND fakultet.fakultet_id = $fakultetID";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $brIndeksa = $r['broj_indeksa'];
        }

        $konekcija->close();
    
        return $brIndeksa;
    }

    function getKartica(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        global $brKartice;

        $kartica = [];

        $sql = "SELECT * 
                FROM kartica 
                WHERE broj_kartice = $brKartice";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $kartica = $r;
        }

        $konekcija->close();

        return $kartica;
    }


    function getTransakcije(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        global $brKartice;

        $transakcije = [];

        $sql = "SELECT * 
                FROM transakcija 
                WHERE broj_kartice = $brKartice";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            array_push($transakcije,$r);
        }

        $konekcija->close();

        return $transakcije;
    }

    function getUplate(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $transakcije = [];

        $sql = "SELECT * 
                FROM transakcija_uplata";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            array_push($transakcije,$r);
        }

        $konekcija->close();

        return $transakcije;
    }

    function getPoruke(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $poruke = [];

        $sql = "SELECT * 
                FROM poruka";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            array_push($poruke,$r);
        }

        $konekcija->close();

        return $poruke;
    }

    function getFakulteti(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $fakulteti = [];

        $sql = "SELECT naziv,fakultet_id 
                FROM zgrada
                WHERE fakultet_id>0";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            array_push($fakulteti,$r);
        }

        $konekcija->close();

        return $fakulteti;
    }

    function getDomovi(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $domovi = [];
    
        $sql = "SELECT naziv,dom_id 
                FROM zgrada
                WHERE dom_id>0";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            array_push($domovi,$r);
        }

        $konekcija->close();

        return $domovi;
    }

    function getBrojValidnih(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $validni = 0;
    
        $sql = "SELECT count(*) AS validni 
                FROM kartica
                WHERE validna=1";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $validni = $r['validni'];
        }

        $konekcija->close();

        return $validni;
    }

    function getBrojBeogradskih(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $bg = 0;
    
        $sql = "SELECT count(*) AS bg 
                FROM kartica
                WHERE beogradska=1 AND validna=1";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $bg = $r['bg'];
        }

        $konekcija->close();

        return $bg;
    }

    function getBrojBudzetskih(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $budzet = 0;
    
        $sql = "SELECT count(*) AS budzet 
                FROM kartica
                WHERE budzet=1 AND validna=1";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $budzet = $r['budzet'];
        }

        $konekcija->close();

        return $budzet;
    }

    function getBrojUplata(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $uplate = 0;
    
        $sql = "SELECT count(*) AS uplata 
                FROM transakcija_uplata";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $uplate = $r['uplata'];
        }

        $konekcija->close();

        return $uplate;
    }

    function getSumaUplata(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $iznos = 0;
    
        $sql = "SELECT SUM(iznos) AS iznos 
                FROM transakcija_uplata";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $iznos = $r['iznos'];
        }

        $konekcija->close();

        return $iznos;
    }

    function getBrojTransakcija(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $uplate = 0;
    
        $sql = "SELECT count(*) AS uplata 
                FROM transakcija";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $uplate = $r['uplata'];
        }

        $konekcija->close();

        return $uplate;
    }

    function getSumaTransakcija(){
        global $server, $username, $password, $baza;
    
        $konekcija = new mysqli($server, $username, $password, $baza);
		if($konekcija->connect_error){
			die("Neuspešna konekcija: " . $konekcija->connect_error);
        }
        $konekcija->set_charset("utf8");

        $iznos = 0;
    
        $sql = "SELECT SUM(iznos) AS iznos 
                FROM transakcija";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $iznos = $r['iznos'];
        }

        $konekcija->close();

        return $iznos;
    }

?>