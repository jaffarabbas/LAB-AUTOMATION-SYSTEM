
<?php 
session_start(); 
require_once('db_connection.php');  

if (isset($_POST['username3']) && isset($_POST['password3'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username3']);
	$pass = validate($_POST['password3']);

	if (empty($uname)) {
		header("Location: login_backend.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login_backend.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM customer_login WHERE username3='$uname' AND password3='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username3'] === $uname && $row['password3'] === $pass) {
            	$_SESSION['username3'] = $row['username3'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: customer_home.php");
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