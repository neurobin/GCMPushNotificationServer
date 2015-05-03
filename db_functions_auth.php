<?php
require_once 'db_functions.php';
class DB_Functions_Auth extends DB_Functions_GCM{
	private $con;
	private $db;

    function __construct() {
        $this->db= new DB_Functions_GCM();
        
    }

    // destructor
    function __destruct() {
        
    }


public function addUser($username, $password, $email) {
        $result = mysqli_query($GLOBALS['mysqli_connection'],"INSERT INTO user_pass(username, password, email) VALUES('$username', '$password', '$email')");
        if ($result) {return true;} else {return false;}
    }


    
    
    
    
    
    public function checkAuthentication($username, $password, $email="") {
    	if($email!="" && $email!=null) {
    	//$username=stripslashes($username);
    	//$password=stripslashes($password);
    	//$username=mysqli_real_escape_string($GLOBALS['mysqli_connection'],$username);
    	//$password=mysqli_real_escape_string($GLOBALS['mysqli_connection'],$password);
        $result = mysqli_query($GLOBALS['mysqli_connection'],"SELECT username from user_pass WHERE username = '$username' AND password = '$password'");
        $no_of_rows = mysqli_num_rows($result);
        if (($no_of_rows > 0)) {return true;} else {return false;}
    		
    	}
    	else {
        $result = mysqli_query($GLOBALS['mysqli_connection'],"SELECT username from user_pass WHERE username = '$username' AND password = '$password' AND email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {return true;} else {return false;}
     }
    }
    
    
    
    
    
    	public function changeUserPass($curUsername, $curPassword, $username, $password) {
				
		$result1 = mysqli_query($GLOBALS['mysqli_connection'],"UPDATE user_pass SET username= '$username',password= '$password' WHERE username= '$curUsername' AND password= '$curPassword'");
	    
	        if ($result1) {return true;} else {return false;} 
	    }
	    
	    
	    
	    
	    public function checkFlagByName($username,$flag){
	    $result = mysqli_query($GLOBALS['mysqli_connection'],"SELECT username from user_pass WHERE username = '$username' AND flag = '$flag'");
        $no_of_rows = mysqli_num_rows($result);
        if (($no_of_rows > 0)) {return true;} else {return false;}
	    }
	    
	    
	    
	  public function checkFlagByEmail($email,$flag){
	    $result = mysqli_query($GLOBALS['mysqli_connection'],"SELECT email from user_pass WHERE email = '$email' AND flag = '$flag'");
        $no_of_rows = mysqli_num_rows($result);
        if (($no_of_rows > 0)) {return true;} else {return false;}
	    }
	    
	    
	    
	  public function checkFlagByNameAndEmail($username,$email,$flag){
	    $result = mysqli_query($GLOBALS['mysqli_connection'],"SELECT * from user_pass WHERE email = '$email' AND flag = '$flag' AND username = '$username'");
        $no_of_rows = mysqli_num_rows($result);
        if (($no_of_rows > 0)) {return true;} else {return false;}
	    }
	    
	    



}



?>