<?php
session_start(); 
require_once('db_connection.php');  
 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
<style>

.carousel-control-prev-icon,
.carousel-control-next-icon {
  height: 100px;
  width: 100px;
  outline: black;
  background-size: 100%, 100%;
  border-radius: 50%;
  background-image: none;
}

.carousel-control-next-icon:after
{
  content: '>';
  font-size: 55px;
  color: blue;
  font-weight:bold;
}

.carousel-control-prev-icon:after {
  content: '<';
  font-size: 55px;
  color: blue;
  font-weight:bold;
}
</style>
    </head>

    <body id="page-top">



        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        
                        <div id="demo" class="carousel slide" data-ride="carousel">

                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                    <li data-target="#demo" data-slide-to="2"></li>
                                </ul>

                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <div class="card-body p-0">             <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-images" id="bg-login-image"><img src="../img/pexel.jpg" height="600" weight="800px"/></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                         <?php if (isset($_GET['error'])) { ?>
                                            <span class="error text-danger p-2" style="font-size:15px;"><?php echo $_GET['error']; ?></span> 
                                         <?php } ?>
                                        <form class="user" method="post" action="login_backend.php">
                                        
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                           <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Login"> 
                                            <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                         <div class="carousel-item">
                        <div class="card-body p-0">             <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-images" id="bg-login-image"><img src="../img/pexel.jpg" height="600" weight="800px"/></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome User</h1>
                                        </div>
                                        <form class="user" method="post" action="user_login_backend.php">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <span class="error text-danger p-2" style="font-size:15px;"><?php echo $_GET['error']; ?></span> 
     	                                <?php } ?>
                                            <div class="form-group">
                                                <input type="text" name="username2" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password2" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                           <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Login"> 
                                            <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         </div>
                         <div class="carousel-item">
                         <div class="card-body p-0">             <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-images" id="bg-login-image"><img src="../img/pexel.jpg" height="600" weight="800px"/></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back! Customer</h1>
                                        </div>
                                        <form class="user" method="post" action="customer_login_backend.php">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <span class="error text-danger p-2" style="font-size:15px;"><?php echo $_GET['error']; ?></span> 
     	                                <?php } ?>
                                            <div class="form-group">
                                                <input type="text" name="username3" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password3" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                           <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Login"> 
                                            <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                         <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev" style="margin-left:-100px">
                                    <span class="carousel-control-prev-icon text-danger" style="color: black"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next" style="margin-right:-100px">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                </div>

            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <!-- <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
        <!-- <script src="../vendor/chart.js/Chart.min.js"></script> -->

        <!-- Page level custom scripts -->
        <script src="../js/demo/chart-area-demo.js"></script>
        <script src="../js/demo/chart-pie-demo.js"></script>
        <script src="../js/app.js"></script>

        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    </body>

    </html>























    