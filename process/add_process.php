<?php
session_start();
date_default_timezone_set("Asia/Jakarta");

function folder_exist($folder) 
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    if($path !== false AND is_dir($path)) 
    {
        // Return canonicalized absolute pathname
        return $path;
    }

    // Path/folder does not exist
    return false;
}

	$iduser = $_SESSION['mylogin_userid'];
	$itemname = $_POST['itemname'];
	$itemdate = date('Y-m-d H:i:s');
	$itemprice = $_POST['itemprice'];
	$itemstatus = "OPEN";
	$itempicture = substr(basename($_FILES["itempicture"]["name"]), -3);

	$mysqli = new mysqli("localhost", "root", "", "mtt_lelangonline");

	$sql = "INSERT INTO items(iduser_owner, name, date_posting, price_initial, status, image_extension) VALUES(?,?,?,?,?,?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sssdss", $iduser, $itemname, $itemdate, $itemprice, $itemstatus, $itempicture);


	if($_FILES['itempicture']['name'])  
	{       
    	//if no errors...
		if(!$_FILES['itempicture']['error'])  
		{
			$path = "../folder_item";
			if(!folder_exist($path))
		    {
		        mkdir($path, 0777);
            }
			$filename = $itemname.".".$itempicture;
            $destination = $path."/".$filename;
			move_uploaded_file($_FILES['itempicture']['tmp_name'], $destination);

			$stmt->execute();
			$_SESSION['statusAdd'] = 'Congratulations!  Your Item Successfully Added to the Bidding List.';
			header("location: ../home.php");
		}
		else
		{
			$_SESSION['statusAdd'] = 'Ooops!  Your upload triggered the following error: ' .$_FILES['itempicture']['error']; 
			header("location: ../add.php");
		}
	}
	else
	{
		$_SESSION['statusAdd'] = 'Ooops!  Your upload triggered the following error: ' .$_FILES['itempicture']['error'];
		header("location: ../add.php");
	}
	$stmt->close();
	$mysqli->close();
?>