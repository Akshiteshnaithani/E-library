<?php

include 'connection.php';
if(isset($_GET['id'])){
  $edit_id = $_GET['id'];
  $edit_query = " SELECT * FROM addbook WHERE id = '$edit_id'";
  $result = mysqli_query($con,$edit_query);
  $row = mysqli_fetch_array($result);
}

if (isset($_POST['submit'])) {
  
    $edit_id = $_GET['id'];


    $bookname = $_POST['booktitle'];
    $authorname = $_POST['authorname'];
    $description = $_POST['bookdescription'];
    
    if($_FILES['bookimage']['name'] !="" ){

      
      $imgname = $_FILES['bookimage']['name'];
      $tempname = $_FILES['bookimage']['tmp_name'];
      move_uploaded_file($tempname, 'bookimage/' . $imgname);
    }else{
      $imgname = $_POST['oldimage'];
    }

    $save_bookdetail = "UPDATE addbook SET bookname ='$bookname' , authorname = '$authorname', description = '$description', uploadimage = '$imgname' WHERE id = '$edit_id'";
    $run_bookdeail = mysqli_query($con, $save_bookdetail);

    if ($run_bookdeail) {
        ?>><?php
            header("location:mainpage.php");
    } else {
        ?><?php
          header("location:editpage.php");
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
            <a href="mainpage.php"> 
              <!-- back button -->
            <button type="button" class="btn btn-secondary me-3"style="width: 80px; padding: 5px;  box-shadow: 2px 2px 5px #888888;">
            <i class="fa fa-backward"style="font-size:20px"></i>
            </button>
            </a>     
          </div>
        </div>
      </nav>
    </div>
    <div>
      <p>Edit</p>
    </div>
    <br />
    <br />
    <div class="container">
        <form action="" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-3">
              <div class="form-editpage  times-new-roman">
                <h3 for="book-image"style="font-weight: bold;">Edit Book Image:</h3>
                <img src="bookimage/<?php echo $row ['uploadimage']?>" alt=""style="height: 350px; width: 280px;">
                <input type="hidden" name="oldimage"  value= "<?php echo $row ['uploadimage']?>">
                <input type="file" name="bookimage" value="<?php echo $imgname ['uploadimage'] ?>">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-editpage  times-new-roman">
                <h3 for="book-title"style="font-weight: bold;">Edit Book Title:</h3>
                <input type="text" class="form-control" name="booktitle"style="border:1px solid black;" value= "<?php echo $row ['bookname'] ?>" >
              </div>
              <div class="form-editpage  times-new-roman">
                <h3 for="author-name"style="font-weight: bold;">Edit Author Name:</h3>
                <input type="text" class="form-control" name="authorname" style="border:1px solid black;"value= "<?php echo $row ['authorname'];?>">
              </div>
              <div class="form-editpage times-new-roman">
                  <h3 for="bookDescription"style="font-weight: bold;">Book Description:</h3>
                  <input class="form-control"  name="bookdescription"style="border:1px solid black;" value= "<?php echo $row ['description'];?>">
              </div>
              <button type="submit" name= "submit" class="btn btn-secondary mt-3 " style=" box-shadow: 2px 2px 5px #888888;"><i class="fa fa-save"style="font-size:24px"> </i> Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
