<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
	 }
	include("student_service.php");
	
	
	$neprocitanePoruke = $_COOKIE['neprocitane-poruke']??"";
?>

<header>
	<div id="header-sadrzaj">
		<div id="logo">
			<a href="./"><img src="slike/header-logo.jpg" alt="logo"/></a>
		</div>
    	<nav id="meni">
			<ul>
				<?php
					if($_COOKIE["vrsta_korisnika"]==1){
						echo "<li><a href=\"./\" class='btn'> Moji podaci</a></li>";
						echo "<li><a href=\"./index.php?stranica=uplata-obroka\" class='btn'>Uplata obroka</a></li>";
						echo "<li><a href=\"./index.php?stranica=lista-racuna\" class='btn'> Lista računa</a></li>";
						echo "<li><a href=\"./index.php?stranica=promena-lozinke\" class='btn'> Promena lozinke</a></li>";
						echo "<li><a href=\"./index.php?stranica=kontakt\" class='btn'> Kontakt</a></li>";
					}else{
						echo "<li><a href=\"./\" class='btn'>Početna</a></li>";
						echo "<li><a href=\"./index.php?stranica=kreiraj-karticu\" class='btn'> Kreiraj karticu</a></li>";
						echo "<li><a href=\"./index.php?stranica=uplate\" class='btn'> Uplate</a></li>";
						echo "<li><a href=\"./index.php?stranica=poruke\" class='btn'> Poruke <span class='badge badge-pill badge-light'>$neprocitanePoruke</span></a></li>";
						echo "<li><a href=\"./index.php?stranica=promena-lozinke\" class='btn'> Promena lozinke</a></li>";
					}
				?>
				
			</ul>
		</nav>
		<button id="odjavi-se" onclick="odjaviSe()">Odjavi se</button>
	</div>
</header>