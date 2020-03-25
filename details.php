<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Details</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>XKEYVERIFY by QuantumCore</h1>
				<a href="details.php"><i class="fas fa-user-circle"></i>Details</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>XKEYVERIFY Details</h2>
			<div>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
				</table>
				<br><br><hr>
				<p style="color:powderblue">
				XKEYVERIFY is a really simple Key verification system.<br>
				You can use it for various purposes.<br> <br>
				For example, You need to create a Trial
				Version of your Application. You can setup XKEYVERIFY and create a key<br>
				Your Program would send a GET Request to the key and see if it's valid<br>
				If it is, Continue, Else, Quit.
				<br>
				See Keys are set to Expire on a date, If no date is specified the Key won't expire.

				<br><br>
				Contact me <strong style="color:cyan">@QuantumCore</strong><br><br>
				<a href="https://discordapp.com/invite/8snh7nx">Discord</a><br><br>
				<a href="https://github.com/quantumcore">GitHub</a><br><br>
				<a href="https://github.com/quantumcored/xkeyverify">XKEYVERIFY Repository</a><br><br>
				</p>
			</div>
		</div>
	</body>
</html>