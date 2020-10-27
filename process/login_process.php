<?php  
session_start();

if(isset($_GET['action'])) {
	if($_GET['action']=="logout") {
		unset($_SESSION['mylogin_username']);
		header("location: ../login.php");
	}
}

if(isset($_POST['btnsubmit'])) {
	$iduser = $_POST['idlogin'];
	$password = $_POST['passlogin'];

	$mysqli = new mysqli("localhost", "root", "mysql", "pweb_dbuas_bidding");

	$sql0 = "select salt from users where iduser=?";
	$stmt = $mysqli->prepare($sql0);
	$stmt->bind_param("s", $iduser);
	$stmt->execute();

	$result = $stmt->get_result();
	if($row = $result->fetch_assoc()){
		$salt = $row['salt'];
		$pwd_hash = sha1(sha1($password).$salt);

		$sql = "select * from users where iduser=? And password=?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss", $iduser, $pwd_hash);
		$stmt->execute();
		$result = $stmt ->get_result();
		if($row = $result->fetch_assoc()){
			$_SESSION['mylogin_username'] = $row['name'];
			$_SESSION['mylogin_userid'] = $row['iduser'];
			header("location: ../home.php");
		} else{
			$_SESSION['error'] = "Salah User ID/password";
			header("location: ../login.php");
		}
	} else {
		$_SESSION['error'] = "Salah User ID/password";
		header("location: ../login.php");
	}
}

?>