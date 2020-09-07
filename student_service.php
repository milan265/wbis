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

        $sql = "SELECT * FROM kartica WHERE broj_kartice = $brKartice";
        $res = $konekcija->query($sql); 
        while($r = $res->fetch_assoc()){
            $kartica = $r;
        }

        $konekcija->close();

        return $kartica;
    }

?>