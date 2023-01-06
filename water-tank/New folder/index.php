<!-- recognize if a user is logged in -->
<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>
<!--  thes start of the html page-->
<!DOCTYPE html>
<html>
<head>
	<title>Smart Water Management System</title>

	<!-- look into how to separate files in php js and css -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class= header-wrapper>
	<div class="header">
				<h1>Smart Water Management System</h1>
		
	</div>


	<div class="notification-bar">
	
	

		<?php if (isset($_SESSION['username'])) : ?>
			<!-- the welcome function  -->
			<div class="welcome-user">
				<h3> Welcome: <?php echo $_SESSION['username']; ?> </h3>	
			</div>
		<?php endif ?>	
			<!-- 
		insert a timeout function that disapears 3 seconds after loging into the system.// -->
		<div class="success-bar">
			<?php if (isset($_SESSION['success'])) :	?>
				<h3 class='error success'>
					<!-- the green success on the screen -->  
					<?php 
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			<?php endif ?>

		</div>
		<!-- the logout function  -->
		<div class="logout-link">
		<a class="btn" href="index.php?logout='1'" style="color:white border: 1px;">Logout</a>
		</div>
		<br>
	</div> 
</div>
	
<div class=sensor-and-data>
		<?php if (isset($_SESSION['username'])) : ?>

			<div>
				<p style='font-size:12px;color:grey'>The dashboard displays real time water level in a tank. Tank level is updated every minute on arrival of sensor data from Raspberry Pi. <a href='tank_simulation' target='_blank'>Simulation</a></p>
			</div> 
			
				<!-- the tank animation div  -->
				<div class=tank-animation > 
					<iframe class=tank-animation-iframe src='tank_animation/' name='iframe_a'></iframe>
				</div> 
				<!-- the data for the tank data -->
				<div class=tank-data> 
					<iframe class=tank-data-iframe src='basic_page/' name='iframe_a'></iframe>
				</div> 

		<?php endif ?>	
	</div>	
	<footer>
	
			<p>onesud</p>
	
		</footer>
		
</body>
</html>