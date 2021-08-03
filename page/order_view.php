<?php
session_start();
require_once('db_connection.php');
error_reporting(E_ERROR | E_PARSE);
function Unique_Id_genetrater()
{
    $n = 12;
    function getName($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    return getName($n);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $test_genrate_id = Unique_Id_genetrater();
    $test_product = $_SESSION['test_product'];
    $test_product_type = $_SESSION['test_product_type'];
    $sql = "INSERT INTO `test_product` (`id`, `genrate_id`, `name_product`, `name_product_type`, `genrate_time`, `compilation`,`test_status`)
    VALUES (NULL, '$test_genrate_id', '$test_product', '$test_product_type ', current_timestamp(), '0','0');";
    $result = mysqli_query($conn, $sql);
}
?>
<!--header file-->
<?php include "header.php" ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ORDER VIEW</h1>
        <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ORDERVIEW TABLE</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Address</th>
                            <th scope="col">Number</th>
                            <th scope="col">TEST</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        error_reporting(0);

                        $sql = "SELECT * FROM `order_saver` join product join products_types on order_saver.product=product.id and order_saver.product_type=products_types.id ORDER BY order_saver.id desc";

                        $result = mysqli_query($conn, $sql);

                        $id = 0;
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $id + 1;
                            $_SESSION['check_id'] = $row['id'];
                            $_SESSION['test_product'] = $row['name'];
                            $_SESSION['test_product_type'] = $row['typename'];
                            echo "<tr>
                                <th scope='row'>" . $id . "</th>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['typename'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['number'] . "</td>
                                <td><form method='post' action='order_view.php'><input class='btn btn-primary' href='order_view.php' id=".$row['id']." type='submit' name='test_view' value='TEST'/></form></td>";
                                }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>

</body>

</html>
<!-- <?php
        // }else{
        //      header("Location: login.php");
        //      exit();
        // }
        ?> -->