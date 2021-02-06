<?php
session_start(); 
require_once('db_connection.php'); 
error_reporting(E_ERROR | E_PARSE); 

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = validate($_POST['user_name']);
   $password = validate($_POST['user_password']);
   $email = validate($_POST['user_email']);
   $number = validate($_POST['user_number']);
   $image_name = $_FILES['user_image_file']['name'];
   $image_temp_name = $_FILES['user_image_file']['tmp_name'];
   $image_type = $_FILES['user_image_file']['type'];
   $image_size = $_FILES['user_image_file']['size'];
   $folder = "../profiles/user_profile/";
   if(empty($name)){
      header("Location: add_user_for_admin.php?error=Name is required");
   }else if(empty($password)){
      header("Location: add_user_for_admin.php?error=Password is required");
      exit();
   }else if(empty($password)){
      header("Location: add_user_for_admin.php?error=Email is required");
      exit();
   }else if(empty($password)){
      header("Location: add_user_for_admin.php?error=Number is required");
      exit();
   }else{
   if(strtolower($image_type) == "image/jpg" || strtolower($image_type) == "image/jpeg" || strtolower($image_type) == "image/png"){
      if($image_size <= 50000000){
         $folder = $folder . $image_name;
         $query = "INSERT INTO `user_login` (`id`, `username2`, `password2`, `user_email`, `user_number`, `profile`) VALUES (NULL, '$name', '$password', '$email', '$number', '$folder');";
         $result=mysqli_query($conn,$query)or die(mysqli_error($conn)); 
         if($result){
            echo "<script>alert('successfull')</script>";
            move_uploaded_file($image_temp_name,$folder);
            echo "<script>window.location.href = '../page/add_user_for_admin.php'</script>"; 
         }
         else{
            echo "<script>alert('failed')</script>";
            echo "<script>window.location.href = '/add_user_for_admin.php'</script>"; 
         }
      }
      else{
         echo "<script>alert('Unsupported file type')</script>"; 
         echo "<script>window.location.href = '/add_user_for_admin.php'</script>"; 
      }
   }else{
      echo "<script>alert('Unsupported file type')</script>";
      echo "<script>window.location.href = '/add_user_for_admin.php'</script>"; 
   }
}
}






?>
<?php  include "header.php"?>

<div class="container-fluid">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">USER/TESTER ADDER</h1>
      <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<?php if (isset($_GET['error'])) { ?>
     		<p class="text-danger"><?php echo $_GET['error']; ?></p>
<?php } ?>
    <form class="form" action="add_user_for_admin.php" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" name="user_name" id="user_name_id" placeholder="Enter User Name"/><br>
        <input type="password" class="form-control" name="user_password" id="user_password_id" placeholder="Enter User Pasword"/><br>
        <input type="email" class="form-control" name="user_email" id="user_email_id" placeholder="Enter User Email"/><br>
        <input type="number" class="form-control" name="user_number" id="user_number_id" placeholder="Enter User Number"/><br>
        <input type="file" class="" name="user_image_file" id="user_file_id" required/><br><br>
        <input type="submit" class="form-control btn btn-primary" name="profile_submit_user"/>
    </form>
</div> 
<div style="margin-bottom:130px"></div>                   
<?php  include "footer.php"?>            
