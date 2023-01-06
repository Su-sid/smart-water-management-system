<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="registration.css">
</head>
<body>
	
	<div class="form-header">
		<h2>Smart Water Management System</h2>
		<h2>Login</h2>
	</div>

	<form method="post" action="login.php">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<?php include('errors.php') ?>
		<p>
			Not yet a member ? <a href="register.php">Sign Up</a>
		</p>
	</form>
	
</body>
</html>