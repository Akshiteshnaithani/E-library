<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $upassword = $_POST['upassword'];

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $upass = password_hash($upassword, PASSWORD_BCRYPT);

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
        if ($passowrd === $upassword) {
            $insertquery = "insert into registration( full_name , email , password ) values( '$name' , '$email' , '$pass' )";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
                ?>
              <script>
                  alert("insert successfully");
              </script>
          <?php
header("Location:login.php");
            }
        } else {
            ?>
              <script>
                  alert("no insert");
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
          <a class="navbar-brand mx-auto">Explore the world of books</a>
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
            <div class="card">
              <div class="card-header text-center text-white">
                REGISTER HERE
              </div>
              <div class="card-body text-center">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="fullName" class="form-label  times-new-roman">Full Name</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Enter full name">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label  times-new-roman">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label  times-new-roman">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary" name="submit">REGISTER</button>
                  </div>
                  <h6 class="text-center text-white">already have an account? <a href="login.php"class="text-decoration-none">Log in here</a></h6>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  </body>
</html>
