<?php
    if (!defined('APP_KEY') or APP_KEY != '12345678') {
        header("Location: ./");
     }

?>

<header>
	<div id="header-sadrzaj">
		<div id="logo">
			<a href="./"><img src="slike/header-logo.jpg" alt="logo"/></a>
		</div>
    	<nav id="meni">
			<ul>
				<li><a href="./"> Moji podaci</a></li>
				<li><a href="./index.php?stranica=uplata-obroka">Uplata obroka</a></li>
				<li><a href="./index.php?stranica=uplata-doma">Uplata doma</a></li>
				<li><a href="./index.php?stranica=lista-racuna"> Lista računa</a></li>
				<li><a href="./index.php?stranica=kontakt"> Kontakt</a></li>
			</ul>
		</nav>
		<button id="odjavi-se" onclick="odjaviSe()">Odjavi se</button>
	</div>
</header>