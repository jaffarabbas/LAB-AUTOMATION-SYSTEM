
<?php 
session_start(); 
require_once('db_connection.php');  

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: login_backend.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login_backend.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM admin_login WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['email_admin'] = $row['email'];
				$_SESSION['number_admin'] = $row['number'];
				$_SESSION['profile_admin'] = $row['profile'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: admin_dashborad.php");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}