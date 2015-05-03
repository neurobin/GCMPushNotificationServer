<html>
    <head>
        <title>Push Notification Admin Panel</title>
        <style type="text/css">



html { height: 100%; font-size: 62.5% }

body { height: 100%; background-color: #FFFFFF; font: 1.4em Verdana, Arial, Helvetica, sans-serif; }

/* ==================== Form style sheet ==================== */

/*div { align-content: center; padding-bottom: 30px; }*/

fieldset { display:inline; align-content: center; border: 1px solid #095D92; background-color: #DFF3FF; width: 50%}
legend { font-size: 1.1em; background-color: #095D92; color: #FFFFFF; font-weight: bold;}

input.submit-button { font: 1.4em Georgia, "Times New Roman", Times, serif; letter-spacing: 1px; display: block; width:25em; height:2em; background-color:#d57079; }

/* ==================== Form style sheet END ==================== */

</style>
    </head>
    <body>
 
        <?php
        require_once 'db_functions_auth.php';
			$db=new DB_Functions_Auth();
        $users = $db->getAllUsers();
        if ($users != false)
            $no_of_users = mysqli_num_rows($users);
        else
            $no_of_users = 0;
        ?>
        <div><fieldset>
    <h1>NASA Transient Watch</h1>
    <h3>Push Notification Admin Panel</h3></fieldset></div><br></br>
     <div><fieldset><legend>Current Registered users</legend>
    <?php echo $no_of_users; ?></fieldset></div><br></br>
    <form method = 'POST' action = 'gcm_main.php/?push=1' enctype="multipart/form-data">
    <div><fieldset><legend>Notification Type</legend>
 
<select name="dropdown">
  <option value="news" selected="selected">News</option>
</select></fieldset>
</div><br></br>
<div><fieldset><legend>Notification Message</legend>
    
        <div>

            <textarea rows = "3" name = "message" cols = "75" placeholder = "Type message here (keep as short as possible)"></textarea>
        </div></fieldset></div><br>
        <div>
            <input type = "submit" value = "Send Notification">
        </div>
        
    </form>
    </body>
</html>