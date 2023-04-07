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
        <form  action="" method="post" class="navbar-form ms-auto">
          <div class="input-group">
            <input type="text" class="form-control" name="search_value" placeholder="Search...">
            <button class="btn btn-primary me-3 "  name = "search_btn" type="submit">SEARCH</button>
          </div>
        </form>
        <a href="login.php">
          <button type="button" class="btn btn-primary me-3">LOG OUT</button>
        </a>
        <a href="addBook.php">
          <button type="button" class="btn btn-primary">ADD A BOOK</button>
        </a>
        <form action="" method="GET">
          <div class="mx-3 d-flex ">
            <select name="sort_alphabet" class="form-control">
              <option value="">--SELECT OPTION--</option>
              <option value="a-z"><?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "a-z") {echo "selected";}?>A-Z(Ascending Order)</option>
              <option value="z-a"><?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "z-a") {echo "selected";}?>Z-A(Descending Order)</option>
            </select>
            <button type="submit" class="btn btn-primary me-3" id="basic-addon2">Sort</button>
          </div>
        </form>
      </div>
    </div>
  </nav>
</div>

    <div>
      <p>Explore the world of books</p>
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
$rows_per_page = 3;
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
            <div class="card m-3" style="width: 222px;">
            <img src="bookimage/<?=$row['uploadimage'];?>" alt="Card image" class="card-img-top" style="width: 220px; height:320px; transition: transform 0.2s ease-in-out;"/>
                <div class="mt-3">
                    <h6 class="card-title about-sections times-new-roman">BOOK NAME: <?php echo $row['bookname']; ?></h6>
                    <h6 class="card-title  about-section times-new-roman">AUTHOR NAME: <?php echo $row['authorname']; ?></h6>
                  </div>
                  <div class="mt-2">
                    <a href="moreinfo.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">More Info</a>
                  </div>
            </div>
        </div>
    <?php
    }
    echo '</div>';
    echo '<nav aria-label="Pagination">';
    echo '<ul class="pagination justify-content-center">';
    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    if ($current_page < $total_pages) {
      echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
  }
  }
?>
</body>
</html>
