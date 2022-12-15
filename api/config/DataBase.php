<?php

header('content-type: text/html; charset=utf8');
$db_username = 'youri';
$db_password = 'admin';
$db_name     = 'carbongames';
$db_host     = 'yourithetiger.cf';
$bdd = new PDO("mysql:host=yourithetiger.cf;dbname=carbongames", $db_username, $db_password);
