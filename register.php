<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["regId"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$gcm_regid = $_POST["regId"];
	// GCM Registration ID
	// Store user details in db
	include_once 'db_functions.php';

	$db = new DB_Functions_GCM();
	if ($db -> checkUserById($gcm_regid) == false && $gcm_regid != "" && $gcm_regid != null) {
		$res = $db -> storeUser($name, $email, $gcm_regid);

		//$registatoin_ids = array($gcm_regid);
		//$message = array("price" => "Registration Successful!");

		// $result = $gcm->send_notification($registatoin_ids, $message);

		//echo $result;
	}
} else {
	// user details missing
}
?>
