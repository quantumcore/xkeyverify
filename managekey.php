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
				<a href="details.php"><i class="fas fa-user-circle"></i>Details</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav><br><br><br>
		<div class="box">
			<h1><?php echo explode(":",$_POST['key'])[0] ?></h1>
            <p>
                KEY NAME :  <?php echo explode(":",$_POST['key'])[0]?><br><br>
                KEY VALUE :  <?php echo explode(":",$_POST['key'])[1]?><br><br>
                EXPIRES :  <?php echo explode(":",$_POST['key'])[2]?><br><br>
                <?php 
                if(file_exists(explode(":",$_POST['key'])[0])){
                    echo '<strong style="color:limegreen">Activated</strong>';
                    echo '<form action="/deactivate.php" method="post">';
                    echo '<input type="text" class="inputs" name="ackey" value="' .$_POST['key'] . '" readonly hidden>';
                    echo '  <input type="submit" class="inputs" value="Deactivate">';
                    echo '</form>';
                } else {
                    echo '<form action="/activate.php" method="post">';
                    echo '<strong style="color:red">Not Activated</strong><br><br>';
                    echo '<input type="text" class="inputs" name="ackey" value="' .$_POST['key'] . '" readonly hidden>';
                    echo '  <input type="submit" class="inputs" value="Activate">';
                    echo '</form>';
                }

                echo '<form action="/delete.php" method="post">';
                echo '<input type="text" class="inputs" name="ackey" value="' .$_POST['key'] . '" readonly hidden><br>';
                echo '  <input type="submit" class="inputs" value="Delete this key Permenantly">';
                echo '</form>';

                ?>
            </p>
			
		</div>	
		</div>
		</form>
	</body>
</html>