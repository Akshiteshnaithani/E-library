<?php

session_start();
include 'connection.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendMail($email, $v_code)
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
        $mail->Subject = 'Email verification form colord cow ';
        $mail->Body = "Thanks for registration ! click here for verify the email adress
    <a href='http://localhost:8000/verify.php?email=$email&v_code=$v_code'>verify</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $upassword = $_POST['upassword'];
    $role = $_POST['role'];

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $upass = password_hash($upassword, PASSWORD_BCRYPT);
    $v_code = bin2hex(random_bytes(8));

    $emailquery = " SELECT * FROM registration WHERE email = '$email' ";

    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount > 0) {
        ?>
    <script>
        alert("email already exists")
    </script>
    <?php
} else {
        if ($password) {
            $insertquery = "insert into registration( full_name,email,password ,user_role,verification_code,is_verified) values( '$name' , '$email' , '$pass','$role','$v_code','0' )";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery && sendMail($_POST['email'], $v_code)) {
                ?>
              <script>
                  alert("registration successfully");
              </script>
          <?php
header("Location:login.php");
            }
        } else {
            ?>
              <script>
                  alert("fail");
              </script>
          <?php
}
    }
}
?>

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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>E-Library</title>
  </head>
  <body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
         <a class="navbar-brand mx-auto"style="text-shadow: 2px 2px 2px #888888;">Explore the world of books</a>
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
        </div>
      </nav>
    </div>
    <div>
        <p class="mt-5"></p>
      </div>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card" style="border: 1px solid black; box-shadow: 2px 2px 2px #888888;" >
              <div class="card-header text-center ">
                REGISTER HERE
              </div>
              <div class="card-body text-center">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="fullName" class="form-register times-new-roman">Full Name</label>
                    <input type="text" class="form-control"style="border:1px solid black;" name="full_name" placeholder="Enter full name">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-register times-new-roman">Email address</label>
                    <input type="email" class="form-control"style="border:1px solid black;"  name="email" placeholder="Enter email">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-register times-new-roman">Password</label>
                    <input type="password" class="form-control" style="border:1px solid black;" name="password" placeholder="Password">
                  </div>
                  <?php

// Default role is 'user'
$role = 'user';

if (isset($_SESSION['record'])) {
    $data = $_SESSION['record'];
    $role = $data[0];

    // Check if user has been promoted to admin
    if ($role == 'user' && isset($_SESSION['promoted_to_admin']) && $_SESSION['promoted_to_admin'] == true) {
        $role = 'admin';
    }
}

?>
                  <div class="mb-3">
                    <label for="Role" class="form-register times-new-roman">Role</label>
                    <input class="form-control" type="text"style="border:1px solid black;"value="<?php echo $role ?>" name="role" readonly>
                  </div>
                  <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary" name="submit">REGISTER</button>
                  </div>
                  <h6 class="text-center ">Already have an account? <a href="login.php"class="text-decoration-none">Log in here</a></h6>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
  </body>
</html>
