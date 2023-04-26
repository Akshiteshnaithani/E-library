<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>E-Library</title>
  </head>
  <body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">E-library</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
          </div>
          <a href="login.php"> 
              <!-- back button -->
              <button type="button" class="btn btn-secondary me-3"style="width: 80px; padding: 5px; box-shadow: 2px 2px 5px #888888;">
            <i class="fa fa-backward"style="font-size:20px"></i>
            </button>
            </a>     
        </div>
      </nav>
    </div>
    <div>
      <p>Explore the world of books</p>
    </div>
    <?php
include 'connection.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendMail($email,$reset_token) 
{
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/Exception.php";
    require "PHPMailer/SMTP.php";
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'akshitesh.naithani@gmail.com';
        $mail->Password = 'lsynwtbxfzauvjyg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('akshitesh.naithani@gmail.com', 'akshitesh');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link form colord cow E-library ';
        $mail->Body = "We got a request from you to reset  your password!</br>
        Click the link below: <br>
    <a href='http://localhost:8000/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }

}

if(isset($_POST['forgot']))
{
$query ="SELECT * FROM registration WHERE email = '$_POST[email]'";
$result=mysqli_query($con,$query);
if($result)
{
 if (mysqli_num_rows($result)==1){

    $reset_token=bin2hex(random_bytes(8));
    date_default_timezone_set('Asia/kolkata');
    $date = date("Y-m-d");
    $query = "UPDATE registration SET resettoken='$reset_token', resettokenexpire='$date' WHERE email='$_POST[email]'";
   if(mysqli_query($con,$query)&& sendMail($_POST['email'],$reset_token))
   {


    echo"
    <script>
    alert('password link send to mail');
    window.location.href='login.php';
    </script>";

   }
   else{
    echo"
    <script>
    alert('Try again');
    window.location.href='login.php';
    </script>";

   }

 }
 else{
    echo"
    <script>
    alert('Inavalid email');
    window.location.href='login.php';
    </script>";
 }
}
else{
    echo"
    <script>
    alert('cannot run');
    window.location.href='login.php';
    </script>";
}

}
?>
<div class="container">
  <div class="row justify-content-center">  
    <div class="col-lg-6">
      <div class="card bg-white">
        <div class="card-header text-center ">Forgot Password</div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3 text-center">
              <label for="email" class="form-label  times-new-roman">Email address</label>
              <input type="email" class="form-control" style="border:1px solid black;" placeholder="Enter email" name="email" />
            </div>
            <div class="card-body text-center">
              <button type="submit" class="btn btn-primary" name="forgot">Send Link</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>