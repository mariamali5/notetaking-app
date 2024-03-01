<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
		
	</div>
	<form method="post" action="login.php">
		<div class="input-group">
			<label>username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login">login</button>
		</div>
		<p>
			Not yet a member? <a href="reg.php">Sign up</a> 
		</p>
	</form>

</body>
</html>