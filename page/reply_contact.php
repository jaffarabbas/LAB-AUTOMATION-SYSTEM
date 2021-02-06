<?php
session_start(); 
require_once('db_connection.php'); 

error_reporting(E_ERROR | E_PARSE);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../mail/vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$email = "";
$id = "";
$mail = new PHPMailer(true);
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
    }  
if (isset($_GET['Contact'])) {
        $id = $_GET['Contact'];
        $update = true;
        $record = mysqli_query($conn, "SELECT * FROM `contact` WHERE id=$id");
    
        if (count($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            global $email;
            $email = $n['email'];
        }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$body =  validate($_POST['message_reply']);
if(empty($body)){
    header("Location: reply_contact.php?error=Message is required");
    exit();
}else{
if(isset($_POST['submit_reply'])){
  try{  
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('', '');
    $mail->addAddress($email);     // Add a recipient
    // // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "REPLY FROM LABAUTOMATION";
    $mail->Body    = $body;

    $mail->send();
    $query = "UPDATE `contact` SET `status` = '1' WHERE `contact`.`id` = '$id';";
    $output = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
    
    echo "<script>alert('Successfull')</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}
}


?>
<?php  include "header.php"?>
<div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">REPLY</h1>
                            <a href="#dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <form class="" method="post">
                      <a name="back" href="admin_contact_display.php" class="btn btn-primary btn mb-5">BACK TO CONTACT<a> 
                     <?php if (isset($_GET['error'])) { ?>
     		         <p class="text-danger"><?php echo $_GET['error']; ?></p>
                  	 <?php } ?>
                      <textarea class="form-control" rows="4" name="message_reply"></textarea>
                      <input type="submit" name="submit_reply" class="form-control btn btn-primary mt-3"/>
                    </form>
                    </div>
                 </div>

<?php  include "footer.php"?> 
