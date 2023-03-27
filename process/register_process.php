<?php
session_start();  

if($_POST['btnsubmit']) {
	$iduser = $_POST['idreg'];
	$name = $_POST['namereg'];
	$password = $_POST['passreg'];
	$passwordrepeat = $_POST['passregrepeat'];

	if($password != $passwordrepeat)
	{
		$_SESSION['error'] = "Password tidak sama";
		header("location: ../register.php");
	}
	else 
	{
		$mysqli = new mysqli("localhost", "root", "", "mtt_lelangonline");

		$salt = substr(sha1(session_id().strtotime("now")), 0, 10);
		$pwd_hash = sha1(sha1($password).$salt);
	
		$sql = "INSERT INTO users VALUES(?,?,?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssss", $iduser, $name, $pwd_hash, $salt);
		$stmt->execute();
		$mysqli->close();

		$_SESSION['statusReg'] = "Akun Berhasil Dibuat. Silahkan Login";
		header("location: ../login.php");
	}
}