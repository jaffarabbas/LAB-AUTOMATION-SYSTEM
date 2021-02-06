
<?php
session_start(); 

require_once('db_connection.php');  
error_reporting(E_ERROR | E_PARSE);
// echo  $_SESSION['jj'];
// echo $_SESSION['jj2'];

//  echo $_SESSION['state_selection'] ;
//  echo $_SESSION['username2'];
// echo $_SESSION['compilation'];
// echo $_SESSION['selecter_check'];
// echo $_SESSION['test_product_name'] ;
$error = "";
$error2 = "";
$up = false;
	function validate($data){
     $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
  }
  


  
  $update = false;
  if (isset($_GET['TEST'])) {
      $id = $_GET['TEST'];
      $update = true;
      $record = mysqli_query($conn, "SELECT * FROM `test_product` WHERE id=$id");

      if (count($record) == 1 ) {
          $n = mysqli_fetch_array($record);
          $genrate_test_id = $n['genrate_id'];
          $product_test_name = $n['name_product'];
          $product_test_type = $n['name_product_type'];
          $status = $n['test_status'];
          $compilation = $n['compilation'];

          $_SESSION['genrate_test_id'] = $genrate_test_id;
          $_SESSION['productname'] = $product_test_name;
          $_SESSION['producttypes'] = $product_test_type;
      }
  }



  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST["state_selection"])){ 
        $error = "<i class='fa fa-times-circle text-danger' style='font-size:20px'></i>  Please select valid option for test ";;
      }else if(empty($_POST["beep_selection"])){ 
        $error = "<i class='fa fa-times-circle text-danger' style='font-size:20px'></i>  Please select valid option for test ";;
      }else{
          $test1 = validate($_POST['state_selection']);
          $test2 = validate($_POST['beep_selection']);
          $username = $_SESSION['username2'];
          $genrate_test_id = $_SESSION['genrate_test_id'];
          $product_test_name = $_SESSION['productname'];
          $product_test_type = $_SESSION['producttypes'];
          if($test1 == "Yes")
          {
            echo "test 1 : yes<br>";
            $test_type_1= 1;
            $test_type_2 = 0;
            $test_compilation = 1; 
            $test_status = 0;
            //query
            $query = "INSERT INTO `tested_product` (`id`, `generated_id`, `tested_product_name`, `tested_product_type_name`, `username`, `test_type_1`, `test_type_2`, `registration_date`, `update_date`, `compilation`, `test_status`) VALUES (NULL, '$genrate_test_id', '$product_test_name', '$product_test_type', '$username', '$test_type_1', '$test_type_2', current_timestamp(), current_timestamp(), '$test_compilation', '$test_status');";
            $output = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            //alerts
            if($output){
                echo "<script>alert('successfull')</script>";
            }
               else{
                echo "<script>alert('failed')</script>";
            }
            $query="";
            if($test2 == "Yes"){
                echo "test 2 : yes<br>";
                $test_type_1= 1;
                $test_type_2 = 1;
                $test_compilation = 2; 
                $test_status = 1;
                $query = "UPDATE `tested_product` SET `update_date` = current_timestamp(), `test_type_2` = '$test_type_2', `compilation` = '$test_compilation',`test_status` = '$test_status' WHERE `tested_product`.`generated_id` = '$genrate_test_id';";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            //alerts
                if($result){
                    echo "<script>alert('successfull')</script>";
                }
                else{
                    echo "<script>alert('failed')</script>"; 
                }
                $query2 = "DELETE FROM `test_product` WHERE `test_product`.`genrate_id` = '$genrate_test_id';";
                $result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn)); 

                }else if($test2 == "No"){
                $test_status = 0;
                $test_type_1 = 1;
                $test_type_2 = 0;
                $total_test_clear = $test_type_1 + $test_type_2;
                $query = "INSERT INTO `defalter_from_test` (`id`, `defaulter_generated_id`, `defaulter_product_name`, `defaulter_product_type_name`, `defaulter_insertby_user`, `defaulter_date`, `defaulter_totaltest_clear`, `defaulter_status`) VALUES (NULL,'$genrate_test_id', '$product_test_name', '$product_test_type','$username', current_timestamp(),'$total_test_clear','$test_status');";
                if(!$conn) {
                    echo "Connection failed!".mysqli_error($conn);
                }
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                $output = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
                //query for delte for test _product table and order table
                $delete_query = "DELETE FROM `test_product` WHERE `test_product`.`genrate_id` = '$genrate_test_id';";
                $resultfordelete1=mysqli_query($conn,$delete_query)or die(mysqli_error($conn)); 
                if($resultfordelete1){
                    echo "<script>alert('successfull')</script>";
                }
                else{
                    echo "<script>alert('failed')</script>";
                }
                }
          }
          else if($test1 == "No"){
            echo "test 1 : no";
                $test_status = 0;
                $test_type_1 = 0;
                $test_type_2 = 0;
                $total_test_clear = $test_type_1 + $test_type_2;
                $query = "INSERT INTO `defalter_from_test` (`id`, `defaulter_generated_id`, `defaulter_product_name`, `defaulter_product_type_name`, `defaulter_insertby_user`, `defaulter_date`, `defaulter_totaltest_clear`, `defaulter_status`) VALUES (NULL,'$genrate_test_id', '$product_test_name', '$product_test_type','$username', current_timestamp(),'$total_test_clear','$test_status');";
                if(!$conn) {
                    echo "Connection failed!".mysqli_error($conn);
                }
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                $output = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
                //query for delte for test _product table and order table
                $delete_query = "DELETE FROM `test_product` WHERE `test_product`.`genrate_id` = '$genrate_test_id';";
                $resultfordelete1=mysqli_query($conn,$delete_query)or die(mysqli_error($conn)); 
                if($resultfordelete1){
                    echo "<script>alert('successfull')</script>";
                }
                else{
                    echo "<script>alert('failed')</script>";
                }
                    }
                }
  }

 
?>

<?php  include "user_header.php"?>
<div class="container">
    

<!-- The slideshow -->
<?php if($product_test_name == "Fuses" ): ?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">FUSES TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>

<?php  elseif ($product_test_name == "Capacitor" ): ?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">CAPACITORS TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>

<?php elseif ($product_test_name == "Transisters" ):?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">TRANSISTERS TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>

<?php elseif ($product_test_name == "Switch gears" ):?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">SWITCH GEARS TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>

<?php elseif ($product_test_name == "Resistors" ):?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">RESISTORS TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>

<?php elseif ($product_test_name == "Wires" ):?>

<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h1 class="text-center">WIRES TEST</h1>

<div class="form-group">
<label>TEST 1<br><p>state check</p></label>
 <select class="form-control" id="state" name="state_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_state" >Yes</option>
         <option id="Selecter3" name="no_state" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
<div class="form-group">
<label>TEST 2<br><p>Beep check</p></label>
<select class="form-control" id="beep" name="beep_selection" value="sdfsd">
         <option id="Selecter1" name="" disabled selected>Please select</option>
         <option id="Selecter2" name="yes_beep" >Yes</option>
         <option id="Selecter3" name="no_beep" >No</option>
 </select>
 </div>
<br>
<span class="">
<div class=" text-danger border-0 mb-2"><strong class=""><?php echo $error;?></strong></div>
</span>
<br>
 <div class="form-group">
 <input type="submit" name="submit_1" class="form-control btn btn-primary   " value="TEST"/>
 </div>
</form>
<?php endif ?>

</div>

<?php  include "user_footer.php"?>