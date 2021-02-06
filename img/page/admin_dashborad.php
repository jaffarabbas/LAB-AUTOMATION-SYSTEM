<?php
session_start(); 
require_once('db_connection.php'); 
error_reporting(E_ERROR | E_PARSE); 
?>
<?php  include "header.php"?>

                    <!-- Begin Page Content -->
<div class="container-fluid">

                        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>



<div class="row">
<!-- Content Column -->
    <div class="col-lg-6 mb-4">
     <div class="card shadow mb-4">
         <div class="card-header py-3 px-3">
           <h6 class="m-0 font-weight-bold text-primary ">PROFILE</h6>
         </div>
         <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-12">
                   <img src="<?php echo $_SESSION['profile_admin']?>" class=" rounded-circle" height="180px" width="" class=""/>
                </div>
                <div class="col-md-8 mt-2 col-12 px-4">
                   <h5>Name = <?php  echo $_SESSION['username']?></h5>
                   <h5>Password = <?php  echo $_SESSION['password']?></h5>
                   <h5>Email = <?php  echo $_SESSION['email_admin']?></h5>
                   <h5>Number = <?php  echo $_SESSION['number_admin']?></h5>
                   <button class="btn btn-primary mt-2 ">EDIT PROFILE</button>
                </div>
            </div>
         </div>
      </div>
    </div>
  </div>



  
</div>
<div style="margin-bottom:140px"></div>                       
 <?php  include "footer.php"?>            
