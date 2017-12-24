<?php
try
{
	$ini_array = parse_ini_file("config.ini");
	$username = $ini_array['username'];
	$password = $ini_array['password'];
    $pdo = new PDO('mysql:host=localhost;dbname=newdatabase', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
    $error = 'Unable to connect to the database server.';
    include 'error.html.php';
    exit();
}
