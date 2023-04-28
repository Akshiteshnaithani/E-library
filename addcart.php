<?php
session_start();

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
            aria-label="Toggle navigation">
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
    <div class="container">
 <!-- Nav tabs -->
 <ul class="nav nav-tabs justify-content-center" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#want_to_read-tab" type="button" role="tab" aria-controls="want_to_read-tab" aria-selected="true">Want to Read</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#issued-tab" type="button" role="tab" aria-controls="issued-tab" aria-selected="false">Issued Book</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#readed-tab" type="button" role="tab" aria-controls="readed-tab" aria-selected="false">Readed Book</button>
  </li>
</ul>


<!-- Tab for want to read code -->
<div class="tab-content">
  <div class="tab-pane active" id="want_to_read-tab">
  <?php
include 'connection.php';

// to delete book from wish-list
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $sql = "DELETE FROM readerbook_details WHERE book_id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// wishlist button
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // fetch data using session
    $data = $_SESSION['record'];
    $username = $data['1'];
    $email = $data['2'];

    // check if book already exists in wishlist
    $query = "SELECT * FROM readerbook_details WHERE book_id = '$book_id' AND username = '$username' AND email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Book already exists in wishlist.')</script>";
    } else {
        $query = "SELECT bookname,uploadimage FROM addbook WHERE id = '$book_id' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $bookname = $row['bookname'];
        $bookimage = $row['uploadimage'];

        $query = "INSERT INTO readerbook_details (book_id,username, email, bookname, bookimage) VALUES('$book_id','$username','$email','$bookname','$bookimage')";
        $results = mysqli_query($con, $query);

        if ($results) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// fetch wishlist data for the current user
$search_query = "SELECT * FROM readerbook_details WHERE username = '{$_SESSION['record']['1']}' AND email = '{$_SESSION['record']['2']}'";
$result = mysqli_query($con, $search_query);
?>


<div class="">
    <table class="table table-bordered table-hover table-sm text-center" style=" border: 1px solid black;">
        <tr class="table-dark text-capitalize">
            <th>S No</th>
            <th>book id</th>
            <th>Book Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th class="text-center">Book Image</th>
            <th class="text-center">Delete</th>
        </tr>

        <?php
$a = 1;
while ($row = mysqli_fetch_array($result)) {
    ?>
            <tr>
                <th class="fw-normal"><?php echo $a; ?></th>
                <th class="fw-normal"><?php echo $row['book_id']; ?></th>
                <th class="fw-normal"><?php echo $row['bookname']; ?></th>
                <th class="fw-normal"><?php echo $row['username']; ?></th>
                <th class="fw-normal"><?php echo $row['email']; ?></th>
                <th class="text-center"><img class="indeximag" src="bookimage/<?=$row['bookimage'];?>" style="width: 40px; height:50px;"></th>
                <th><a href="?delete_id=<?php echo $row['book_id']; ?>" style="color: black;"onclick="alert('Are you sure you want to Delete?')"><i class="fa fa-trash" style="font-size:20px"></i></a></th>
            </tr>
        <?php

    $a++;
}
?>

    </table>
</div>

  </div>




  <div class="tab-pane" id="issued-tab" role="tabpanel" aria-labelledby="issued-tab">
    <?php
// Code for displaying issued table goes here
include 'connection.php';
// to delete book from issued book
if (isset($_GET['del_issue_id'])) {
    $id = $_GET['del_issue_id'];

    $sql = "DELETE FROM issue_book WHERE book_id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // avalable book
        $search_query = "SELECT available_book FROM addbook WHERE id ='$id' ";
        $result = mysqli_query($con, $search_query);
        $row = mysqli_num_rows($result);

        if ($row) {
            $book_record = mysqli_fetch_assoc($result);
            $available_book = $book_record['available_book'];

            $update_query = "UPDATE addbook SET available_book = $available_book + 1 WHERE id = '$id' ";
            $update_result = mysqli_query($con, $update_query);
        }
    }
}

// issued button
$search_query = "SELECT * FROM issue_book";
$result = mysqli_query($con, $search_query);
$row = mysqli_num_rows($result);
?>
    <div class="">
        <table class="table table-bordered table-hover table-sm text-center" style=" border: 1px solid black;" >
            <tr class="table-dark text-capitalize">
                <th>S no.</th>
                <th>Id</th>
                <th>Book Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Number of Book</th>
                <th>Issued Date</th>
                <th>Return Date</th>
                <th class="text-center">Book Image</th>
                <th class="text-center">Return Book</th>
            </tr>

            <tr>
                <?php
$a = 1;
while ($row = mysqli_fetch_array($result)) {

    ?>
                    <th class="fw-normal"><?php echo $a; ?></th>
                    <th class="fw-normal"><?php echo $row['book_id']; ?></th>
                    <th class="fw-normal"><?php echo $row['book_name']; ?></th>
                    <th class="fw-normal"><?php echo $row['user_name']; ?></th>
                    <th class="fw-normal"><?php echo $row['email']; ?></th>
                    <th class="fw-normal"><?php echo $row['no_of_book']; ?></th>
                    <th class="fw-normal"><?php echo $row['issue_date']; ?></th>
                    <th class="fw-normal"><?php echo $row['return_date']; ?></th>
                    <th class="text-center"><img class="indeximg" src="bookimage/<?=$row['bookimg'];?>" style="width: 20px; height:30px;"></th>
                    <th class="text-center"><a href="?del_issue_id=<?php echo $row['book_id']; ?>" onclick="return confirm('Are you sure you want to return this book?')"><i class="fa fa-rotate-left"style="font-size:20px ; color: red;"></i></a></th>

            </tr>
        <?php
$a++;
}
?>
        </table>
    </div>
</div>




  <div class="tab-pane" id="readed-tab" role="tabpanel" aria-labelledby="readed-tab">
    <?php
// to delete book from book readed
if (isset($_GET['delete_reader'])) {
    $id = $_GET['delete_reader'];

    $sql = "DELETE FROM book_readed WHERE book_id = '$id'";
    $result = mysqli_query($con, $sql);
}

// book readed button
if (isset($_GET['readed_id'])) {
    $id_book = $_GET['readed_id'];

    // get user data from session
    $data = $_SESSION['record'];
    $username = $data['1'];
    $email = $data['2'];

    // get book data from bookdetail table
    $query = "SELECT bookname,uploadimage FROM addbook WHERE id = '$id_book' ";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $bookname = $row['bookname'];
    $bookimage = $row['uploadimage'];

    // check the book in book_readed
    $duplicacy_query = "SELECT book_id FROM book_readed WHERE book_id = '$id_book'";
    $duplicacy_result = mysqli_query($con, $duplicacy_query);
    $record = mysqli_fetch_assoc($duplicacy_result);
    $db_book_id = $record['book_id'];

    if ($id_book !== $db_book_id) {
        // insert data into user_book_details when click on book_readed button
        $query = "INSERT INTO book_readed (book_id,username, email, bookname, bookimg) VALUES('$id_book','$username','$email','$bookname','$bookimage')";
        $results = mysqli_query($con, $query);
        echo '<script>alert("Book added to book readed"); window.location.href = "mainpage.php";</script>';
    } else {
        echo '<script>alert("Book already added in book readed"); window.location.href = "mainpage.php";</script>';
    }
}

// Code for displaying readed table goes here

$search_query = "SELECT * FROM book_readed";
$result = mysqli_query($con, $search_query);
$row = mysqli_num_rows($result);

?>
  <div class="">
      <table class="table table-bordered table-hover table-sm text-center">
          <tr class="table-dark text-capitalize">
              <th>S no.</th>
              <th>book id</th>
              <th>bookname</th>
              <th>username</th>
              <th>email</th>
              <th class="text-center">book image</th>
              <th class="text-center">delete</th>
          </tr>

          <tr>
              <?php $a = 1;while ($row = mysqli_fetch_array($result)) {?>
                  <th class="fw-normal"><?php echo $a; ?></th>
                  <th class="fw-normal"><?php echo $row['book_id']; ?></th>
                  <th class="fw-normal"><?php echo $row['bookname']; ?></th>
                  <th class="fw-normal"><?php echo $row['username']; ?></th>
                  <th class="fw-normal"><?php echo $row['email']; ?></th>
                  <th class="text-center"><img class="indeximg" src="bookimage/<?=$row['bookimg'];?>" style="width: 20px; height:30px;"></th>
                  <th class="text-center"><a href="?delete_reader=<?php echo $row['book_id']; ?>"><i class="fa fa-trash text-danger"></i></a></th>
          </tr>
      <?php
$a++;
}

?>
</table>
    </div>
</div>
</div>
</body>
</html>
