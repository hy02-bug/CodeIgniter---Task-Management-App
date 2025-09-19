<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<style>
		body {
			background-color: #f4f6f9;
			margin: 0;
			font-family: Arial, sans-serif;
		}
		#container {
			width: 400px;
			margin: 80px auto;
			padding: 20px;
			background: #fff;
			border: 1px solid #ddd;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
			border-radius: 8px;
		}
		h1 {
			text-align: center;
			font-size: 22px;
			margin-bottom: 20px;
		}
		form p {
			margin: 10px 0;
		}
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 10px;
			box-sizing: border-box;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		button {
			width: 100%;
			padding: 10px;
			background: #007bff;
			border: none;
			color: white;
			font-weight: bold;
			border-radius: 4px;
			cursor: pointer;
		}
		button:hover {
			background: #0056b3;
		}
		.links {
			text-align: center;
			margin-top: 15px;
		}
		.links a {
			margin: 0 10px;
			color: #007bff;
			text-decoration: none;
		}
		.links a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>

<div id="container">
	<h1>User Login</h1>

	<form method="post" action="<?php echo site_url('Auth/login'); ?>">
		<p>
			<label for="username">Username / Email</label>
			<input type="text" name="username" id="username" required>
		</p>

		<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
		</p>

		<p>
			<button type="submit">Login</button>
		</p>
	</form>

	<div class="links">
		<a href="<?php echo site_url('auth/register'); ?>">Register</a> | 
		<a href="<?php echo site_url('auth/forgot_password'); ?>">Forgot Password?</a>
	</div>
</div>

</body>
</html>
