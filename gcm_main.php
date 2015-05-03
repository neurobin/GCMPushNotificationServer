<?php

require_once 'db_functions.php';
$db = new DB_Functions_GCM();
require_once 'urls.php';

function sendPushNotification($registration_ids, $message) {

    $url = 'https://android.googleapis.com/gcm/send';
    
    $fields = array(
        'registration_ids' => $registration_ids,
        'data' => $message,
    );


    $headers = array(
        'Authorization:key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    echo json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    if($result === false)
        die('Curl failed ' . curl_error());

    curl_close($ch);
    return $result;

}

function redirect($url)
{
    if (!headers_sent()) 
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}


$pushStatus = '';



    $query = "SELECT gcm_regid FROM gcm_users";
    if($query_run = mysqli_query($GLOBALS['mysqli_connection'],$query)) {

        $gcmRegIds = array();
        while($query_row = mysqli_fetch_assoc($query_run)) {

            array_push($gcmRegIds, $query_row['gcm_regid']);

        }

    }
    if(isset($_POST['message'])) {
    $pushMessage = $_POST['message'];
 }
 else {echo "Are you somehow trying to hack me?\nForget it buddy...\nclose your computer and go to sleep...\n";exit;}
     $nottype=(isset($_REQUEST['dropdown'])?$_REQUEST['dropdown']:"default");
    
    if(isset($gcmRegIds) && isset($pushMessage)) {
$pushMessage=html_entity_decode($pushMessage);
        $message = array($nottype => $pushMessage);
        $regIdChunk=array_chunk($gcmRegIds,1000);
        foreach($regIdChunk as $RegId){
        $pushStatus = sendPushNotification($RegId, $message);}
       redirect(PWD);
    }
    else{
    echo "Unknown error occured, contact your Push Notification Service Provider";

    exit;
    }   

     


?>


