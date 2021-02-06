<?php
session_start(); 
require_once('db_connection.php'); 

error_reporting(E_ERROR | E_PARSE);
?>
<?php  include "header.php"?>
<div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">MESSAGES</h1>
                            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                             <h6 class="m-0 font-weight-bold text-primary">MESSAGES TABLE</h6>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Repy</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php   
                        
                        function tick($a){
                            if($a == "1"){
                                return "<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";
                            }
                            else if($a == "0"){
                                return "<i class='fa fa-times-circle' style='color:red;font-size:20px'></i>";
                            }
                        }
                            $sql = "SELECT * FROM `contact` WHERE 1";
                            $result = mysqli_query($conn,$sql) ;
                            $id = 0;
                            $op = "";
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $id +1;
                                echo "<tr>
                                <th scope='row'>".$id."</th>
                                <td>".$row['email']."</td>
                                <td>".$row['message']."</td>    
                                <td>".$row['message_date']."</td>    
                                <td>".tick($row['status'])."</td>    
                                <td><a href='reply_contact.php?Contact=".$row['id']."'  id='emailpicker' class='submit_req btn btn-primary text-light' >REPLY</a></td>    
                                </tr>";
                            }?>                          
                       </tbody>
                    </table>
                    </div>
                 </div>
            </div>
       </div>
<?php  include "footer.php"?> 