<?php
	session_start();

	if(isset($_SESSION['mylogin_username']))
	{
		header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<?php
		if(isset($_SESSION['error'])) 
		{
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
	?>

	<form method="POST" action="process/login_process.php">
		<h2>Please Login to use the website</h2>
		<table>
			<tr>
				<td><label>Username :</label></td>
				<td><input type="text" name="idlogin" placeholder="Input Id User"></td>
			</tr>
			<tr>
				<td><label>Password :</label></td>
				<td><input type="password" name="passlogin" placeholder="Input Password"></td>
			</tr>
		</table>
		<br>
		<input type="submit" name="btnsubmit" value="Login">
		<p>Belum Punya Akun?<a href="register.php">Daftar Disini!</a></p>

		<p>Daftar Akun :</p>
		<ul>
			<li>username: yusfian</li>
			<li>password: yusfian</li>
		</ul>
		<ul>
			<li>username: arison</li>
			<li>password: arison</li>
		</ul>
		<ul>
			<li>username: admin</li>
			<li>password: admin</li>			
		</ul>
		<ul>
			<li>username: jojo</li>
			<li>password: jojo1</li>	
		</ul>
		<ul>
			<li>username: dio</li>
			<li>password: 123</li>
		</ul>	
	</form>
</body>
</html>