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
      <p>Explore the world of books</p>
    </div>
    <?php
include 'connection.php';
session_start();
// get id of book
if (isset($_GET['id'])) {
 $id_book = $_GET['id'];
 
 $record = $_SESSION['record'];
 $username = $record['1'];
 $email = $record['2'];
 $id_book = $_GET['id'];
 
 $query = "SELECT bookname,authorname,uploadimage FROM addbook WHERE id = '$id_book' ";
 $result = mysqli_query($con, $query);
 $row = mysqli_fetch_array($result);
 $bookname = $row['bookname'];
 $authorname = $row['authorname'];
 $bookimage = $row['uploadimage'];
 
 if (isset($_POST['submit'])) {
   
   $no_book = $_POST['no_book'];
   $issue_date = $_POST['issue_date'];
   $return_date = $_POST['return_date'];
   
   // check the book in wish-list
   $duplicacy_query = "SELECT email FROM issue_book WHERE email = '$email'";
   $duplicacy_result = mysqli_query($con, $duplicacy_query);
   $record = mysqli_fetch_assoc($duplicacy_result);
   $db_email = $record['email'];
  //  var_dump($db_email); die();
   
   if ($email !== $db_email) {
     $query = "INSERT INTO issue_book (book_id,user_name, email, book_name, bookimg, no_of_book, issue_date, return_date) VALUES('$id_book','$username','$email','$bookname','$bookimage',' $no_book','$issue_date',' $return_date')";
     $results = mysqli_query($con, $query);
     
     echo '<script>alert("Book added to issued book"); window.location.href = "mainpage.php";</script>';
 } else {
    echo '<script>alert("Book already added to issued book"); window.location.href = "mainpage.php";</script>';
 }
 }
}
?>
<!-- main -->
<form action="" enctype="multipart/form-data" method="post">
   <div class="container">
   <div class="card">
    <div class="row justify-content-center">
   
   <div class="col-12 col-sm-12 col-md-12 col-lg-6 p-3">
   
    <div class="d-flex flex-column justify-content-center align-items-center">
   
   
   <label class="mb-1 fw-bold fs-5 text-capitalize text-dark text-center">book cover</label>
 
 
 <img src="bookimage/<?= $bookimage; ?>" style="width:380px" class="img-fluid rounded-start">
 
  </div>
 
 </div>

<div class="text-capitalize col-12 col-sm-12 col-md-12 col-lg-6 p-3">
     
      <div class="justify-content-center align-items-center">

  <div class="mb-2">
     
     
      <label for="bookname" class="form-label fw-bold">Book Name</label>
    
    
     <input type="text" name="bookname" class="form-control" value="<?= $bookname; ?>" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="authorname" class="form-label fw-bold">Author Name</label>
    
    
     <input type="text" name="authorname" class="form-control" value="<?= $authorname; ?>" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="username" class="form-label fw-bold">User Name</label>
    
    
     <input type="text" name="username" class="form-control" value="<?= $username; ?>" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="email" class="form-label fw-bold">email</label>
    
    
     <input type="email" name="email" class="form-control" value="<?= $email; ?>" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="book" class="form-label fw-bold text-danger">you can issue only one book</label>
    
    
     <input type="text" name="no_book" min="0" max="1" class="form-control" value="1" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="issued" class="form-label fw-bold">issued date</label>
    
    
     <input type="text" name="issue_date" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly>
   
   
   </div>
    
    
    <div class="mb-2">
     
     
      <label for="return" class="form-label fw-bold">return date</label>
    
    
     <input type="text" name="return_date" class="form-control" value="<?php echo date("Y-m-d", strtotime('+7 days')); ?>" readonly>
   
   
   </div>

   <div class="mt-5">
     
     
      <button type="submit" name="submit" class="btn btn-secondary col-12 text-capitalize">get the book</button>
   
   
   </div>
   
    </div>
   
   </div>
    </div>
   </div>
   </div>
</form>
?>
  </body>
</html>
