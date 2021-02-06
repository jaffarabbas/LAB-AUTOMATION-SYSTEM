<?php

session_start(); 
require_once('db_connection.php');  

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

if($_SERVER['REQUEST_METHOD'] == 'POST'){  
    $username = validate($_POST['username3']);
    $password = validate($_POST['password']);
    $confirmPassowrd = validate($_POST['password_confirmation']);
    $email = validate($_POST['customeremail']);
    $number = validate($_POST['customer_number']);
    $image_name = $_FILES['image_user_profile']['name'];
    $image_temp_name = $_FILES['image_user_profile']['tmp_name'];
    $image_type = $_FILES['image_user_profile']['type'];
    $image_size = $_FILES['image_user_profile']['size'];
    $folder = "../profiles/customer_profile/";
    // echo $username."".$password."".$email."".$number."".$confirmPassowrd;

    if(empty($username)){
        header("Location: register_customer.php?error=User Name is required");
	    exit();
	}elseif(empty($number)){
        header("Location: register_customer.php?error=Number is required");
	    exit();
    }elseif(empty($email)){
        header("Location: register_customer.php?error=Email is required");
	    exit();
    }elseif(empty($password)){
        header("Location: register_customer.php?error=Password is required");
	    exit();
    }elseif(empty($confirmPassowrd)){
        header("Location: reagister_customer.php?error=Confirm Password Required");
	    exit();
    }elseif($confirmPassowrd != $password){
        header("Location: register_customer.php?error=Password is not Matched");
	    exit();
    }else{
        if($password == $confirmPassowrd){
            if(strtolower($image_type) == "image/jpg" || strtolower($image_type) == "image/jpeg" || strtolower($image_type) == "image/png"){
                if($image_size <= 50000000){
                   $folder = $folder . $image_name;
                   $query = "INSERT INTO `customer_login` (`id`, `username3`, `password3`, `customer_email`, `customer_number` , `profile`) VALUES (NULL, '$username', '$password', '$email', '$number','$folder');";                   $result=mysqli_query($conn,$query)or die(mysqli_error($conn)); 
                   if($result){
                      echo "<script>alert('successfull')</script>";
                      move_uploaded_file($image_temp_name,$folder);
                      echo "<script>window.location.href = '../page/login.php'</script>"; 
                   }
                   else{
                      echo "<script>alert('failed')</script>";
                      echo "<script>window.location.href = '../page/register_customer.php'</script>"; 
                   }
                }
                else{
                   echo "<script>alert('Unsupported file size')</script>"; 
                   echo "<script>window.location.href = '../page/register_customer.php'</script>"; 
                }
             }else{
                echo "<script>alert('Unsupported file type')</script>";
                echo "<script>window.location.href = '../page/register_customer.php'</script>"; 
             }
          }
        }
}
?>