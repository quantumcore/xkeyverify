<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>New Key</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>XKEYVerify</h1>
			<form action="new.php" method="post">
                <label for="xkey">
					<i class="fas fa-globe"></i>
				</label>
				<input type="text" name="keyname" placeholder="Key Name" required>
				<label for="xkey">
					<i class="fas fa-key"></i>
				</label>
				<input type="text" name="keyval" placeholder="Key Value" required>
				<label for="date">
					<i class="fas fa-clock"></i>
				</label>
				<input type="date" name="date" placeholder="Expires on" required>
				<input type="submit" value="Create new key">
			</form>
		</div>
	</body>
</html>