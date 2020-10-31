<?php
session_start();

if($_POST['btnCancel'])
{
	$status ="CANCEL";
	$iditem = $_GET['iditem'];
	$iduser = $_GET['iduser_owner'];

	$mysqli = new mysqli("localhost", "root", "mysql", "pweb_dbuas_bidding");

	$sql = "update items set status=? where iditem=? and iduser_owner=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sis", $status, $iditem, $iduser);
	$stmt->execute();
	header("location: ../home.php");
}

if ($_POST['btnOpen'])
{
	$status ="OPEN";
	$iduser = $_GET['iduser_owner'];
	$iditem = $_GET['iditem'];

	$mysqli = new mysqli("localhost", "root", "mysql", "pweb_dbuas_bidding");

	$sql = "UPDATE items set status=? where iditem=? AND iduser_owner=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sis", $status, $iditem, $iduser);
	$stmt->execute();
	header("location: ../home.php");
}

$mysqli->close();
?>