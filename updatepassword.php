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
            <button type="button" class="btn btn-secondary me-3"style="width: 120px; padding: 5px; box-shadow: 2px 2px 5px #888888;">
            <i class="fa fa-backward"style="font-size:24px"></i>
            </button>
            </a>
        </div>
      </nav>
    </div>
</div>

<?php
include 'connection.php';

if (isset($_GET['email']) && isset($_GET['reset_token'])) {
    date_default_timezone_set('Asia/kolkata');
    $email= $_GET['email'];
    $date = date("Y-m-d");
    $query = "SELECT * FROM registration WHERE email='$email' AND resettoken='$_GET[reset_token]' AND resettokenexpire='$date'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            ?>
            <div>
      <p>Explore the world of books</p>
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-white">
            <div class="card-header text-center ">Update Password</div>
            <div class="card-body text-center">
            <form action="" method="POST">
                <label for="password" class="form-label times-new-roman">Update Password</label>
                <input type="password" class="form-control" style="border:1px solid black;"placeholder="Update Password" name="password" />
                </div>
                <div class="card-body text-center">
                <button type="submit" class="btn btn-primary" name="update">Update Password</button>
                <input type="hidden" name="email" value="$email" />
                </div>
            </form>
        </div>
    </div>
  <?php
} else {
            echo "
                <script>
                    alert('try again later!');
                    window.location.href='login.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('try again later!');
                window.location.href='login.php';
            </script>
        ";
    }
}

?>
<?php
if (isset($_POST['update'])) {
    $email= $_GET['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $update = "UPDATE registration SET password ='$pass', resettoken=NULL, resettokenexpire=NULL WHERE email='$email'";
    $result = mysqli_query($con, $update);
    if ($result) {

        echo "
        <script>
            alert('password updated');
            window.location.href='login.php';
        </script>
    ";

    } else {
        echo "
        <script>
            alert('try again later!');
            window.location.href='updatepassword.php';
        </script>
    ";

    }
}

?>

</body>
</html>