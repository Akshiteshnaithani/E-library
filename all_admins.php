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
    <nav class="navbar navbar-expand-lg bg-light"style="box-shadow: 2px 3px 5px #888888;">
    <div class="container-fluid">
      <a class="navbar-brand" href="mainpage.php" style="font-size: 25px;">E-library</a>
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
          <a href="mainpage.php">
              <!-- back button -->
              <button type="button" class="btn btn-secondary me-3"style="width: 80px; padding: 5px; box-shadow: 2px 2px 5px #888888;">
            <i class="fa fa-backward"style="font-size:20px"></i>
            </button>
            </a>
        </div>
      </nav>
    </div>
    <div>
      <p class="mt-5">Explore the world of books</p>
    </div>
    <!-- Nav tabs -->
   <ul class="nav nav-tabs justify-content-center" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#admin-tab" type="button" role="tab" aria-controls="admin-tab" aria-selected="true">Admin</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#user-tab" type="button" role="tab" aria-controls="user-tab" aria-selected="false">User</button>
  </li>
</ul>


<!-- admin table-->

<div class="tab-content">
  <div class="tab-pane active" id="admin-tab" role="tabpanel" aria-labelledby="admin-tab">
    <?php
include 'connection.php';

// delete admin
if (isset($_GET['del_admin_id'])) {
    $del_id = $_GET['del_admin_id'];
    $del_admin_query = "DELETE FROM registration WHERE id = '$del_id'";
    $delete_admin_result = mysqli_query($con, $del_admin_query);
    if ($delete_admin_result) {

        header("location:all_admins.php");
    }
}

$alluser_query = "SELECT * FROM registration WHERE user_role = 'admin' ";
$results = mysqli_query($con, $alluser_query);
if ($results === false) {
    echo "Query execution failed: " . mysqli_error($con);
} else {
    $row_count = mysqli_num_rows($results);
    if ($row_count > 0) {
        ?>
        <div class="container">
            <table class="table table-bordered table-hover table-sm text-center" style=" border: 1px solid black;">
                <tr class="table-dark text-capitalize">
                    <th>role</th>
                    <th>username</th>
                    <th>e-mail</th>
                    <!-- <th>update</th> -->
                    <th>delete</th>
                </tr>
    <?php
while ($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <th><?=$row['user_role'];?></th>
                    <th><?=$row['full_name'];?></th>
                    <th><?=$row['email'];?></th>
                    <!-- <th><a href="edit-book.php?id=<?php echo $row['id']; ?>" style="color: black;"><i class="fa fa-edit"style="font-size:20px"></i></a></th> -->
                    <th><a href="?del_admin_id=<?php echo $row['id']; ?>" style="color: black;"><i class="fa fa-trash" style="font-size:20px"></i></a></th>
                </tr>
    <?php
}
        ?>
            </table>
        </div>
    <?php
} else {
        echo "No admin found.";
    }
}
?>
  </div>


<!-- user table -->
<div class="tab-pane" id="user-tab" role="tabpanel" aria-labelledby="user-tab">
  <?php
include 'connection.php';
// delete user

if (isset($_GET['del_user_id'])) {
    $del_user_id = $_GET['del_user_id'];
    $del_user_query = "DELETE FROM registration WHERE id = '$del_user_id'";
    $delete_user_result = mysqli_query($con, $del_user_query);
    if ($delete_user_result) {

        header("location:all_admins.php");
    }
}

// Code for displaying user table goes here

$all_user_query = "SELECT * FROM registration WHERE user_role = 'user' ";
$results = mysqli_query($con, $all_user_query);
if ($results === false) {
    echo "Query execution failed: " . mysqli_error($con);
} else {
    $row_count = mysqli_num_rows($results);
    if ($row_count > 0) {
        ?>
        <div class="container">
            <table class="table table-bordered table-hover table-sm text-center" style=" border: 1px solid black;">
                <tr class="table-dark text-capitalize">
                    <th>role</th>
                    <th>username</th>
                    <th>e-mail</th>
                    <!-- <th>update</th> -->
                    <th>delete</th>
                </tr>
    <?php
while ($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <th><?=$row['user_role'];?></th>
                    <th><?=$row['full_name'];?></th>
                    <th><?=$row['email'];?></th>
                    <!-- <th><a href="edit-book.php?id=<?php echo $row['id']; ?>" style="color: black;"><i class="fa fa-edit"style="font-size:20px"></i></a></th> -->
                    <th><a href="?del_user_id=<?php echo $row['id']; ?>" style="color: black;"><i class="fa fa-trash" style="font-size:20px"></i></a></th>
                </tr>
    <?php
}
        ?>
            </table>
        </div>
    <?php
} else {
        echo "No admin found.";
    }
}
?>
  </div>
</div>


</body>
</html>
