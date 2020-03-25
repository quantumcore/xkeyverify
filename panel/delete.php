<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

function remove_line($file, $remove) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $key => $line) {
        if($line === $remove) unset($lines[$key]);
    }
    $data = implode(PHP_EOL, $lines);
    file_put_contents($file, $data);
}

remove_line("keys", $_POST['ackey']);

if(file_exists(explode(":", $_POST['ackey'])[0])){
    unlink(explode(":", $_POST['ackey'])[0]);
}

header('Location: main.php');
?>