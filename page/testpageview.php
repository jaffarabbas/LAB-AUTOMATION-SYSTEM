<?php
session_start(); 
require_once('db_connection.php');
error_reporting(E_ERROR | E_PARSE);
?>
  <?php  include "header.php"?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
    <!-- Page Heading -->
                        <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">PRODUCT FOR TESTING VIEW</h1>
                            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                             <h6 class="m-0 font-weight-bold text-primary">PRODUCT FOR TESTING TABLE</h6>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Generated Id</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Product Type</th>
                              <th scope="col">Resgestration date</th>
                              <th scope="col">Update date</th>
                              <th scope="col">COMPILATION</th>
                              <th scope="col">TEST STATUS</th>
                            
                            </tr>
                          </thead>
                          <tbody>

                          <?php

                        error_reporting(0);

                        $sql = "SELECT * FROM `test_product`";
                        $result = mysqli_query($conn, $sql);
                        $id = 0;

                        function tick($a){
                          if($a == "1"){
                              return "<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";
                          }
                          else if($a == "0"){
                              return "<i class='fa fa-times-circle' style='color:red;font-size:20px'></i>";
                          }
                        }
                        function tick2($a){
                          if($a == "1"){
                              return "<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";
                          }
                          else if($a == "0"){
                              return "<i class='fa fa-times-circle' style='color:red;font-size:20px'></i>";
                          }
                      }
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $id = $id + 1;
                            $_SESSION['status'] = $row['compilation'];
                            echo "<tr>
                                <th scope='row'>" . $id . "</th>
                                <td>" . $row['genrate_id'] . "</td>
                                <td>" . $row['name_product'] . "</td>
                                <td>" . $row['name_product_type'] . "</td>
                                <td>" . $row['genrate_time'] . "</td>
                                <td>" . $row['upgrade_time'] . "</td>
                                <td>" . tick($row['compilation']) . "</td>
                                <td>" . tick($row['test_status']) . "</td>";
                             
                            $_SESSION['test_product_generate_id'] = $row['genrate_id'];
                            $_SESSION['test_product_name'] = $row['name_product'];
                            $_SESSION['test_product_type'] = $row['name_product_type'];
                            $_SESSION['status'] = $row['test_status'];
                            $_SESSION['compilation'] = $row['compilation'];
                        } ?>
                                      </tbody>
                                      </table>
                                   </div>
                                 </div>
                          </div>

            <?php  include "footer.php"?>
<!-- <?php
// }else{
//      header("Location: login.php");
//      exit();
// }

?> -->
