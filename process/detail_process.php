<?php
session_start();

if($_POST['btnWin'])
{
	$status ="SOLD";
	$iditem = $_GET['iditem'];
	$iduser = $_GET['iduser_owner'];
	$price = $_GET['price_initial'];
	$winner = 1;

	$mysqli = new mysqli("localhost", "root", "mysql", "pweb_dbuas_bidding");

	$sql = "update items i inner join biddings b on i.iditem = b.iditem set i.status=?, b.is_winner=? where b.iditem=? AND b.iduser=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("siss", $status, $winner, $iditem, $iduser);
	$stmt->execute();

	header("location: ../detail.php?iditem=$iditem&iduser_owner=$iduser&price_initial=$price");
}
$mysqli->close();
?>