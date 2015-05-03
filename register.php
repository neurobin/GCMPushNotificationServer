<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["regId"])) {
	$gcm_regid = $_POST["regId"];
	if(isset($_POST["name"])){$name=$_POST["name"];}
	if(isset($_POST["email"])){$email=$_POST["email"];}
	// GCM Registration ID
	// Store user details in db
	include_once 'db_functions.php';

	$db = new DB_Functions_GCM();
	if ($db -> checkUserById($gcm_regid) == false && $gcm_regid != "" && $gcm_regid != null) {
		
			$res = $db -> storeUser($name,$email,$gcm_regid);



	}
} else {

}
?>
