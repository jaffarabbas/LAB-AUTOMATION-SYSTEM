
<?php 
session_start(); 
require_once('db_connection.php');  
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST['username2']) && isset($_POST['password2'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username2']);
	$pass = validate($_POST['password2']);

	if (empty($uname)) {
		header("Location: user_login.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: user_login.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM user_login WHERE username2='$uname' AND password2='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username2'] === $uname && $row['password2'] === $pass) {
            	$_SESSION['username2'] = $row['username2'];
            	//$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: user_dashborad.php");
		        exit();
            }else{
				header("Location: user_login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: user_login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login_page.php");
	exit();
}