<?php

include 'connection.php';

if (isset($_POST['submit'])) {

    $bookname = $_POST['booktitle'];
    $authorname = $_POST['authorname'];
    $description = $_POST['bookdescription'];

    $imgname = $_FILES['bookimage']['name'];
    $tempname = $_FILES['bookimage']['tmp_name'];
    move_uploaded_file($tempname, 'bookimage/' . $imgname);

    $save_bookdetail = "INSERT INTO addbook (bookname,authorname,description,uploadimage)
    VALUES('$bookname','$authorname','$description','$imgname')";
    $run_bookdeail = mysqli_query($con, $save_bookdetail);

    if ($run_bookdeail) {
        ?><script>
            alert('book added successfully');
        </script><?php
            header("location:mainpage.php");
    } else {
        ?><script>
            alert('try again');
        </script><?php
          header("location:addbook.php");
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>E-Library</title>
  </head>
  <body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
          <a class="navbar-brand" href="mainpage.php">E-library</a>
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
            <a href="mainpage.php">
              <button type="button" class="btn btn-primary me-3">BACK TO LIST</button>
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div>
      <p>Explore the world of books</p>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
          <div class="col-md-6 mb-3">
            <form action="" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="bookImage" class="form-label times-new-roman">Book Image</label>
                    <input type="file" class="form-control" name="bookimage" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="bookTitle" class="form-label times-new-roman">Book Title</label>
                    <input type="text" class="form-control"  name="booktitle" required>
                  </div>
                  <div class="mb-3">
                    <label for="authorName" class="form-label times-new-roman">Author Name</label>
                    <input type="text" class="form-control"  name="authorname" required>
                  </div>
                  <div class="mb-3">
                    <label for="bookDescription" class="form-label times-new-roman">Book Description</label>
                    <textarea class="form-control"  name="bookdescription" rows="3" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
          </div>
        </div>
      </div>

  </body>
</html>
