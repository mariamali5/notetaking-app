<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
		
	</div>
	<form method="post" action="reg.php">
		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>email</label>
			<input type="text" name="email">
		</div>
		<div class="input-group">
			<label>password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register">Register</button>
		</div>
		<p>
			Aready a member? <a href="login.php">Sign in</a> 
		</p>
	</form>

</body>
</html>