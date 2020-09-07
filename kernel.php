<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
	   header("Location: ./");
	}
	
	include('pocetak.php');
	include('header.php');

	$stranica = isset($_GET['stranica']) ? $_GET['stranica'] : '';
	if(isset($_COOKIE['vrsta_korisnika'])){
		if($_COOKIE['vrsta_korisnika']==1){
			switch ($stranica){
				case '':
				   echo "<script>document.title='Moji podaci'</script>";
				   include('student_moji_podaci.php');
				   break;
				case 'uplata-obroka':
					 echo "<script>document.title='Uplata obroka'</script>";
					 include('student_uplata_obroka.php');
				   break;
				case 'uplata-doma':
					if(studentUDomu()){
						echo "<script>document.title='Uplata doma'</script>";
				   		include('student_uplata_doma.php');
					}else{
						header("Location: ./");
					}
				   	break;
				case 'lista-racuna':
				   	echo "<script>document.title='Lista računa'</script>";
				   	include('student_lista_racuna.php');
				   	break;
				case 'kontakt':
				   	echo "<script>document.title='Kontakt'</script>";
				   	include('student_kontakt.php');
					break;
				default:
				   	echo "<script>document.title='Stranica nije pronađena'</script>";
				   	include('404.php');
				   	break;		
			 }
		}else{
			switch ($stranica){
				case '':
				   echo "<script>document.title='Dodaj karticu'</script>";
				   include('admin_dodaj_karticu.php');
				   break;
				default:
				   echo "<script>document.title='Stranica nije pronađena'</script>";
				   include('404.php');
				   break;		
			 }
		}
	}
    

	include('footer.php');
	include('kraj.php');
?>