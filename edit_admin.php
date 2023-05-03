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

    <?php
session_start();
include 'connection.php';

if (isset($_GET['edit_admin_id'])) {
    $edit_admin_id = $_GET['edit_admin_id'];

    $edit_query = "SELECT * FROM registration WHERE user_role = 'admin' AND id = '$edit_admin_id' ";
    $result = mysqli_query($con, $edit_query);
    $single_row = mysqli_fetch_array($result);
}

if (isset($_POST['submit'])) {
    $username = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['user_role'];

    $edit_query = "SELECT * FROM registration WHERE id = '$edit_admin_id' ";
    $result = mysqli_query($con, $edit_query);
    $single_row = mysqli_fetch_array($result);

    $save_admindetail = "UPDATE registration SET full_name = '$username',email ='$email', user_role = '$role', password = '$password' WHERE id = '$edit_admin_id' ";
    $run_admindetail = mysqli_query($con, $save_admindetail);

    if ($run_admindetail) {
        echo "<script>alert('Admin Profile Updated Successfully')</script>";
?>
        <meta http-equiv="refresh" content="0; url = http://localhost:8888/all_admins.php" />
<?php
    }
}
?>



    <div class="container mt-5">
  <div class="row justify-content-center">  
    <div class="col-lg-6">
      <div class="card" style="border: 1px solid black;box-shadow: 2px 2px 2px #888888;"">
        <div class="card-header text-center ">Edit Admin Detail's</div>
        <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
                <div class="mb-3 text-center">
                    <label for="full_name" class="form-login times-new-roman">User Name</label>
                    <input type="text" name="full_name" class="form-control text-capitalize"style="border:1px solid black;" id="full_name" value="<?= $single_row['full_name']; ?>">
                </div>
                <div class="mb-3 text-center">
                    <label for="email" class="form-login times-new-roman">Email</label>
                    <input type="text" name="email" class="form-control"style="border:1px solid black;" id="email" value="<?= $single_row['email']; ?>">
                </div>
                <div class="mb-3 text-center">
                    <label for="role" class="form-login times-new-roman">Role</label>
                    <input type="text" class="form-control" name="user_role"style="border:1px solid black;"id="user_role" value="<?= $single_row['user_role']; ?>">
                </div>
                <div class="mb-3 text-center">
                    <label for="password" class="form-login times-new-roman">Password</label>
                    <input type="password" class="form-control"style="border:1px solid black;"name="password" id="password" value="<?= $single_row['password']; ?>">
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
if (isset($_POST['submit'])) {
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $update = "UPDATE registration SET password ='$pass', resettoken=NULL, resettokenexpire=NULL WHERE email='$email'";
    $result = mysqli_query($con, $update);
}

?>

</body>
</html>

