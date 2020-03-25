<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

function alert($message) { 
    echo "<script>alert('$message');</script>"; 
} 

$arr = explode(":", $_POST['ackey']);
$keyfilename = $arr[0];
$keyval = $arr[1];

if(file_exists($keyfilename)){
    $ermsg = 'Key already Activated. ('.$keyfilename . ')';
    alert($ermsg);
    header('Location: main.php');
    
} else {
    $keyfl = fopen($keyfilename, "w+");
    fwrite($keyfl, $keyval);
    fclose($keyfl);   
    $msg = 'Key Activated ('.$keyfilename . ':' .$keyval . ')';
    alert($msg);
    header('Location: main.php');
   
}

?>