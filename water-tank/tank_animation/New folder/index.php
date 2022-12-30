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
	<!-- tank animation links  -->
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
	<!-- js script for controlling behavior of the tank -->
	<script type="text/javascript" src="tank_animation.js"></script>
	<script type="text/javascript" src='jquery.min.js'></script>
	<script type="text/javascript" src='tank-data-infomation.js'></script>

</head>
<body onload="data_request_timer()">



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
				<p >The dashboard displays real time water level in a tank. Tank level is updated every minute on arrival of sensor data from Raspberry Pi. <a href='tank_simulation' target='_blank'>Simulation</a></p>
			</div> 
			
				<!-- the tank animation div  -->
				<div class=tank-animation > 
					<div id='chart-container'>Reload Page if you don't see animation</div>
				</div> 
				<!-- the data for the tank data -->
			<div class=tank-data> 
				<!--  This is where the data is displayed -->
				<div class='tank-information'>
					<p id='info'></p>
				<!--  Dummy value insertion link -->
				<button class="btn">
					<a  href='./insert_data.php?dist=65' target='_blank'>Insert dummy values</a>
				</button>

				</div>




			</div> 

		<?php endif ?>	
	</div>	
	<footer>
	
			<p>onesud</p>
	
		</footer>
		
</body>
</html>