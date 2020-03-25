<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$keyname = $_POST['keyname'];
$keyvalue = $_POST['keyval'];
$expires = $_POST['date'];

$add = fopen("keys", "a+");
fwrite($add, "$keyname:$keyvalue:$expires\n");
fclose($add);

header("Location: main.php")
?>