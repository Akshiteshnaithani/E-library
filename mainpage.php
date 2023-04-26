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
        <form  action="" method="post" class="navbar-form ms-auto">
          <div class="input-group">
            <input type="text" class="form-control" name="search_value" placeholder="Search...">
            <button class="btn btn-secondary me-3 " style="box-shadow: 2px 2px 5px #888888;" name = "search_btn" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </form>
        <form action="" method="get">
      <div class="mx-3 d-flex">
        <select name="sort_alphabet" class="form-control">
            <option value="">--SELECT OPTION--</option>
            <option value="a-z" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "a-z") {echo "selected";}?>>
                A-Z(Ascending Order)
            </option>
            <option value="z-a" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "z-a") {echo "selected";}?>>
                Z-A(Descending Order)
            </option>
        </select>
        <button type="submit" class="btn btn-secondary me-3" id="basic-addon2" style="box-shadow: 2px 2px 5px #888888;"><i class="fa fa-sort"></i></button>
      </div>

    </form>


</div>


<!-- button only admin can acess -->

          <?php
if (isset($_SESSION['record'])) {
    $data = $_SESSION['record'];

    $role = $data['0'];
    if ($role == 'admin') {?>
    <div class="btn-group">
  <button type="button" class="btn btn-secondary" style="width: 90px; padding: 3px;  box-shadow: 2px 2px 5px #888888;">Action <i class="fa fa-wrench"></i></button>
  <button type="button" class="btn btn-light  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; padding: 2px;  box-shadow: 2px 2px 5px #888888;">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu "style="background-color: transparent;border-color: transparent;">
  <a href="addBook.php">
  <button type="button" class="btn btn-light"  style="width: 120px; padding: 5px; box-shadow: 2px 2px 5px #888888;">Add Book <i class="fa fa-book"></i></button>
</a>
<a href="registrationpage.php">
  <button type="button" class="btn btn-light mt-2" style="width: 120px; padding: 5px; box-shadow: 2px 2px 5px #888888;">Add Admin <i class="fa fa-user"></i></button>
</a>
<a href="all_admins.php">
  <button type="button" class="btn btn-light mt-2" style="width: 120px; padding: 5px; box-shadow: 2px 2px 5px #888888;">Details <i class="fa fa-user"></i></button>
</a>
</a>
<a href="booklist.php">
  <button type="button" class="btn btn-light mt-2" style="width: 120px; padding: 5px; box-shadow: 2px 2px 5px #888888;">Book List <i class="fa fa-address-book"></i></button>
</a>
  </ul>


<?php

    }
}
?>

<!-- button only user can acess -->
<?php
if (isset($_SESSION['record'])) {
    $data = $_SESSION['record'];

    $role = $data['0'];
    if ($role == 'user') {?>

 <form action="addcart.php" method="post">
<button type="submit" name="addcart" class="btn btn-success mx-3 "style=" box-shadow: 2px 2px 5px #888888;"><i class="fa fa-shopping-cart"></i></button>
</form>
<?php

    }
}
?>
<form action="logout.php" method="post">
<button type="submit" name="logout" class="btn btn-danger mx-1 me-1"style=" box-shadow: 2px 2px 5px #888888;"><i class="fa fa-power-off"></i></button>
</form>
      </div>
    </div>
  </nav>
</div>

    <div>
      <p class="mt-5">Explore the world of books</p>
    </div>
    <br />

    <?php
include 'connection.php';

// sorting
$sort_option = "";
if (isset($_GET['sort_alphabet'])) {
    if ($_GET['sort_alphabet'] == "a-z") {
        $sort_option = "ASC";
    } elseif ($_GET['sort_alphabet'] == "z-a") {
        $sort_option = "DESC";
    }
}
$query_sort = "SELECT * FROM addbook ORDER BY bookname $sort_option";

// searching
if (isset($_POST['search_btn'])) {
    $search_filter = $_POST['search_value'];
    $query_search = "SELECT * FROM  addbook WHERE CONCAT(bookname) LIKE '%$search_filter%'";
    $query_sort = $query_search . " ORDER BY bookname $sort_option";
}

// pagination
$rows_per_page = 6;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $rows_per_page;

$query_count = "SELECT COUNT(*) as count FROM addbook";
$result_count = mysqli_query($con, $query_count);
$total_rows = mysqli_fetch_assoc($result_count)['count'];

$total_pages = ceil($total_rows / $rows_per_page);

$query_sort .= " LIMIT $rows_per_page OFFSET $offset";

$query_sort_run = mysqli_query($con, $query_sort);
if (mysqli_num_rows($query_sort_run) > 0) {
    echo '<div class="row">';
    foreach ($query_sort_run as $row) {
        ?>
        <div class="col-md-4 justify-content-center d-flex">
            <div class="card m-3" style="width: 222px; background-color: transparent; border-color: transparent;">
            <img src="bookimage/<?=$row['uploadimage'];?>" alt="Card image" class="card-img-top" style="width: 220px; height:320px; box-shadow: 10px 10px 10px #888888; transition: transform 0.2s ease-in-out;"/>
                <div class="mt-3">
                    <h6 class="card-title about-sections times-new-roman">BOOK NAME: <?php echo $row['bookname']; ?></h6>
                    <h6 class="card-title  about-section times-new-roman">AUTHOR NAME: <?php echo $row['authorname']; ?></h6>
                  </div>
                  <div class="mt-2">
                  <a href="moreinfo.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary" style="font-size: 15px; padding: 8px 8px; box-shadow: 2px 2px 5px #888888;">More Info <i class="fa fa-arrow-right"></i></a>



                    <?php
if (isset($_SESSION['record'])) {
            $data = $_SESSION['record'];

            $role = $data['0'];
            if ($role == 'user') {?>
 <a class="btn btn-light" name="wish" style="font-size: 15px; padding: 8px 8px; box-shadow: 2px 2px 5px #888888;" href="addcart.php?id=<?=$row['id'];?>"><i class="fa fa-heart"></i></i></a>
 <a class="btn btn-light" name="issue" style=" font-size: 15px; padding: 8px 8px;box-shadow: 2px 2px 5px #888888;" href="issuebook.php?id=<?=$row['id'];?>"><i class="fa fa-book"></i></i></a>
 <a class="btn btn-light" name="reader" style=" font-size: 15px; padding: 8px 8px;box-shadow: 2px 2px 5px #888888;" href="addcart.php?readed_id=<?=$row['id'];?>"><i class="fa fa-check"></i></i></a>

<?php

            }
        }
        ?>
                    </div>
            </div>
        </div>
    <?php
}
    echo '<ul class="pagination justify-content-center">';
    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link bg-secondary"style="box-shadow: 2px 2px 5px #888888;" href="?page=' . ($current_page - 1) . '"><i class=" fa fa-regular fa-backward"></i></a></li>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active"><a class="page-link bg-secondary"style="box-shadow: 2px 2px 5px #888888;" href="#">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link bg-secondary"style="box-shadow: 2px 2px 5px #888888;" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link bg-secondary"style="box-shadow: 2px 2px 5px #888888;" href="?page=' . ($current_page + 1) . '"><i class="fa fa-regular fa-forward"></i></a></li>';
    }
    echo '</ul>';
}
?>
</body>
</html>









