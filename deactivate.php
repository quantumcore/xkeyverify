<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$arr = explode(":", $_POST['ackey']);
$keyfilename = $arr[0];
$keyval = $arr[1];

if(!file_exists($keyfilename)){
    header('Location: main.php');
    
} else {
    unlink($keyfilename);
    header('Location: main.php');
}

?>