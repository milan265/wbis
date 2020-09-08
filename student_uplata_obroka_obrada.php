<?php
    $const = $_POST["app_key"];
    if (!isset($const) or $const != '12345678') {
        header("Location: ./");
	}


    echo 1000;//vraca stanje na kartici
?>