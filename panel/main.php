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
		<title>XKEYVERIFY</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>XKEYVERIFY by QuantumCore</h1>
				<a href="details.php"><i class="fas fa-info"></i>Details</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>XKEYVERIFY Key Management</h2>
			<br>
			<input type="submit" class="inputs" value="Create new key" onclick="location.href = '/newkey.php';">
		</div>	
		<br><br>
		<?php
		if(filesize("keys") > 0){
			foreach(file("keys") as $line){
				$expiry_date =  explode(":", $line)[2];
				$date = date("Y-m-d", time());
				$expiry = strtotime($expiry_date);
				$dtwo = strtotime($date);
				if($expiry >= $dtwo) {
					// If today is expiry date
					$contents = file_get_contents("keys");	
					$contents = str_replace($expiry_date, 'EXPIRED', $contents);
					file_put_contents("keys", $contents);

					if(file_exists(explode(":", $line)[0])){
						unlink(explode(":", $line)[0]);
					}

				} 
				echo '<br><br><form action="/managekey.php" method="post">';
				echo '<div class="box">';
				echo '<input type="text" class="inputs" name="key" value="' . $line  . '" readonly>';
				if(file_exists(explode(":", $line)[0])){
					echo '<br><br>Activated : <strong style="color:limegreen">True</strong>';
					echo '<br><br>Path : ' .getcwd() . '\\' . explode(":", $line)[0];
				} else {
					echo '<br><br>Activated : <strong style="color:red">False</strong>';
				}
				echo '<br>Expires : <strong style="color:powderblue">'. explode(":", $line)[2] . '</strong>';
				echo '</p><br><input type="submit" class="inputs" value="Manage this key">';
				echo '</div>';
				echo '</form>';
				
			}
		} else {
			echo "<div class='content'><p>No Keys currently. ( ͡° ͜ʖ ͡°)</p></div>";
		}
		?>
		</p>
		</div>
		</form>
	</body>
</html>