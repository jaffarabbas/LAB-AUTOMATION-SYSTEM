<?php
session_start(); 
require_once('db_connection.php'); 
error_reporting(E_ERROR | E_PARSE); 

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `user_login` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('successfull')</script>";
    }
    else{
        echo "<script>alert('failed')</script>";
    }
  }


?>
<?php  include "header.php"?>

 <div class="container-fluid">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">USER/TESTER LIST VIEW</h1>
                            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                             <h6 class="m-0 font-weight-bold text-primary">USER/TESTER LIST TABLE</h6>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">USER Name</th>
                            <th scope="col">USER Password</th>
                            <th scope="col">USER Email</th>
                            <th scope="col">USER Number</th>
                            <th scope="col">USER Profile</th>
                            <th scope="col">USER Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php  
                            error_reporting(0);
                        
                            $sql = "SELECT * FROM `user_login`";
                            $result = mysqli_query($conn,$sql) ;
                            $id = 0;

                            while($row = mysqli_fetch_assoc($result)){
                                $id = $id +1;
                                echo "<tr>
                                <th scope='row'>".$id."</th>
                                <td>".$row['username2']."</td>
                                <td>".$row['password2']."</td>
                                <td>".$row['user_email']."</td>
                                <td>".$row['user_number']."</td>
                                <td><img src='".$row['profile']."' class='' width='30px' height='30px' alt='profile'/></td>
                                <td><button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button> </td>";
                            }  ?>
                    </tbody>
                 </table>
            </div>
        </div>
    </div>      
</div>
<script>
    deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                id = e.target.id.substr(1);
                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `/LAB-AUTOMATION-PROJECT/page/user_list_for_admin.php?delete=${id}`;
                } else {
                    console.log("no");
                }
            })
        });
</script>
<?php  include "footer.php"?>  