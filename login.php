<?php
include 'connection.php';
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email = "SELECT * FROM registration WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($con, $check_email);

    $check = mysqli_fetch_array($result);
    if (isset($check)) {
        ?>
    <script>
        alert ("login successful");
    </script>
    <?php
header("location:mainpage.php");
    } else {
        ?>
    <script>
        alert ("login fail");
    </script>
    <?php

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
      <div class="card bg-transparent">
        <div class="card-header text-center text-white">LOG IN HERE</div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3 text-center">
              <label for="email" class="form-label  times-new-roman">Email address</label>
              <input type="email" class="form-control" placeholder="Enter email" name="email" />
            </div>
            <div class="mb-3 text-center">
              <label for="password" class="form-label times-new-roman">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" />
            </div>
            <div class="card-body text-center">
              <button type="submit" class="btn btn-primary" name="submit">LOG IN</button>
            </div>
            <h6 class="text-center text-white">not account?<a href="registrationpage.php"class="text-decoration-none">register here</a></h6>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
