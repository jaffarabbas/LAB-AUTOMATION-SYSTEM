<?php
require_once('db_connection.php');
 $output='';
 $sql = "SELECT * FROM `products_types` where cid='".$_POST['courseID']."'";
 $result = mysqli_query($conn,$sql) ;
 $output .='  <option id="Selecter" disabled selected>Please select</option>';
 while($row = mysqli_fetch_assoc($result)){
    $output .='  <option value="'.$row['id'].'" name="types_products">'.$row['typename'].'</option>';
 }
 echo $output;

?>


