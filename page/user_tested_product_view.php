<?php
session_start();
require_once('db_connection.php');
error_reporting(E_ERROR | E_PARSE);
?>
<?php include "user_header.php" ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">TESTED PRODUCTS VIEW</h1>
        <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">TESTED PRODUCTS TABLE</h6>
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
                            <th scope="col">User Name</th>
                            <th scope="col">Test Type 1</th>
                            <th scope="col">Test Type 2</th>
                            <th scope="col">Resgestration date</th>
                            <th scope="col">Update date</th>
                            <th scope="col">COMPILATION</th>
                            <th scope="col">TEST STATUS</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php


                        error_reporting(0);

                        $sql = "SELECT * FROM `tested_product`";
                        $result = mysqli_query($conn, $sql);
                        $id = 0;


                        function tick($a)
                        {
                            if ($a == "1") {
                                return "<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";
                            } else if ($a == "0") {
                                return "<i class='fa fa-times-circle' style='color:red;font-size:20px'></i>";
                            }
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $id + 1;
                            $_SESSION['status'] = $row['compilation'];
                            echo "<tr>
                                            <th scope='row'>" . $id . "</th>
                                            <td>" . $row['generated_id'] . "</td>
                                            <td>" . $row['tested_product_name'] . "</td>
                                            <td>" . $row['tested_product_type_name'] . "</td>
                                            <td>" . $row['username'] . "</td>
                                            <td>" . $row['test_type_1'] . "</td>
                                            <td>" . $row['test_type_2'] . "</td>
                                            <td>" . $row['registration_date'] . "</td>
                                            <td>" . $row['update_date'] . "</td>
                                            <td>" . $row['compilation'] . "</td>
                                            <td>" . tick($row['test_status']) . "</td>";
                            $_SESSION['test_product_generate_id'] = $row['genrate_id'];
                            $_SESSION['test_product_name'] = $row['name_product'];
                            $_SESSION['test_product_type'] = $row['name_product_type'];
                            $_SESSION['status'] = $row['test_status'];
                        }  ?>
                </table>
            </div>
        </div>
    </div>

    <?php include "user_footer.php" ?>