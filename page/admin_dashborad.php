<?php
session_start(); 
require_once('db_connection.php'); 
error_reporting(E_ERROR | E_PARSE); 
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
if (isset($_POST['product_selection']) && isset($_POST['product_Type_selection']) && isset($_POST['quantity']) && isset($_POST['address']) && isset($_POST['number'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $product = validate($_POST['product_selection']);
        $types_product = validate($_POST['product_Type_selection']);
        $quantity = validate($_POST['quantity']);
        $address = validate($_POST['address']);
        $number = validate($_POST['number']);
       
       // error_reporting(E_ERROR | E_PARSE);
    if (empty($product)) {
        header("Location: index.php?error=Product name is required");
        exit();
    }else if(empty($types_product)){
        header("Location: index.php?error=Product type is required");
        exit();
    }else if(empty($quantity)){
        header("Location: index.php?error=Quantity is required");
        exit();
    }else if(empty($address)){
        header("Location: index.php?error=Address is required");
        exit();
    }else if(empty($number)){
        header("Location: index.php?error=Number is required");
        exit();
    }else{
          $sql = "INSERT INTO `order_saver` (`product`, `product_type`, `quantity`, `address`, `number`) VALUES ( '$product', '$types_product', '$quantity', '$address' , '$number');";
          
          $result = mysqli_query($conn,$sql); 

          header("Location: index.php");
	      exit();
      }
    }
 }
    // }else{
    //     header("Location: index.php");
    //     exit();
    // }
?>
    <?php  include "header.php"?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>

                        <section class="Dashboard">
                            <div class="container">
                            <div class="header_insertion">
                                    <h1 id="main_head_insertion" class="text-center">INSERT PRODUCT DETIALS</h1>
                            </div>

                               
                            </div>
                        </section>
                    
                        <?php  include "footer.php"?>            
<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?> 