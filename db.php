<?php
$bdd = new PDO('mysql:host=localhost;dbname=test_inscription', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$bdd->exec("SET CHARACTER SET utf8 ")
?>