<?php
session_start();
if (!isset($_SESSION['record'])) {
    header('location:login.php');
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
            <?php
if (isset($_SESSION['record'])) {
    $data = $_SESSION['record'];
    $role = $data['0'];
    if ($role == 'admin') {?>
            <button type="button" class="btn btn-secondary me-3" style="width: 100px; padding: 5px;  box-shadow: 2px 2px 5px #888888;" ><a style = "text-decoration:none; color:white;"href="editpage.php? id=<?php echo $_GET['id']; ?>">
              Edit <i class="fa fa-pencil"style="font-size:20px"></i></a>
            </button>
            <button type="button" class="btn btn-danger" style="width: 100px; padding: 5px; box-shadow: 2px 2px 5px #888888;"><a style = "text-decoration:none; color:white;"href="delete.php?id=<?php echo $_GET['id']; ?>">Delete <i class="fa fa-trash"style="font-size:20px"></i></a></button>
            <?php
}
}
?>
          </div>
        </div>
      </nav>
    </div>
    <div>
      <p>Explore the world of books</p>
    </div>
    <br/>
    <br/>
    <?php
include 'connection.php';
if (isset($_GET['id'])) {
    $new_id = $_GET['id'];

    $query = "SELECT * FROM addbook WHERE id = '$new_id' ";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($query_run);
    ?>

    <div class="container">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-4">
            <img src="bookimage/<?php echo $row['uploadimage']; ?>" class="img-fluid" style="width: 220px;"/>
          </div>
          <div class="col-md-8">
            <div class="form-group times-new-roman"style="font-size: 35px;">
              <label for="book-title">Book Title:</label>
              <h3><?php echo $row['bookname'] ?></h3>
            </div>
            <div class="form-group times-new-roman"style="font-size: 35px;">
              <label for="author-name">Author Name:</label>
              <h3><?php echo $row['authorname'] ?></h3>
            </div>
            <div class="form-group times-new-roman"style="font-size: 35px;">
              <label for="book-description">Book Description:</label>
              <h3><?php echo $row['description'] ?></h3>
            </div>
          </div>
        </div>
      </form>
    </div>
   <?php
} else {
    ?>
    <script>
      alert("No details avilable")
      </script>
      <?php

}
?>
  </body>
</html>
