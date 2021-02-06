<?php 
session_start(); 
include "db_connection.php";

if (isset($_POST['email']) && isset($_POST['message'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // error_reporting(E_ERROR | E_PARSE);
            $email = validate($_POST['email']);
            $message = validate($_POST['message']);
           
            if(empty($email)){           
                header("Location: customer_home.php?error=Email is required");            
                exit();
            }else if(empty($message)){
                header("Location: customer_home.php?error=Message is required");
                exit();
            }else{
            
            $sql = "INSERT INTO `contact` (`id`, `email`, `message`) VALUES (NULL,'$email', '$message');";
            
            $result = mysqli_query($conn,$sql); 
            //mail sender in php
            header("Location: customer_home.php");
            echo "<script>window.location.href('cuctomer_home.php#contact');</script>";
	        exit();
            }
         }
}else{
	header("Location: customer_home.php");
	exit();
}