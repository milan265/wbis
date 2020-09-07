<?php
	if (!defined('APP_KEY') or APP_KEY != '12345678') {
		header("Location: ./");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="./slike/logo.jpg"/>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
        <div id="cookie-info">
            <p>Ovaj sajt koristi kolačiće</p>
            <button onclick="prihvatiCookie();"id="cookie-button">Prihvatam</a>
        </div>   
