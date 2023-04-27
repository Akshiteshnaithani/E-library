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
    <?php
include 'connection.php';

$allbook_query = "SELECT * FROM addbook";
$result = mysqli_query($con, $allbook_query);
if ($row = mysqli_num_rows($result)) {
    ?>
        <div class="container-fluid">
            <table class="table table-bordered table-hover table-sm text-center" style=" border: 1px solid black;">
                <tr class="table-dark text-capitalize">
                    <th>Id</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Book Image</th>
                    <th>total books</th>
                    <th>available books</th>
                </tr>
                <tr class="fw-normal">
                    <?php
while ($row = mysqli_fetch_array($result)) {
        ?>
                        <th><?=$row['id'];?></th>
                        <th><?=$row['bookname'];?></th>
                        <th><?=$row['authorname'];?></th>
                        <th><img class="indeximg" src="bookimage/<?=$row['uploadimage'];?>" style="width: 50px; height:80;"></th>
                        <th class="fw-normal"><?= $row['total_book']; ?></th>
                    <th class="fw-normal"><?= $row['available_book']; ?></th>
                </tr>

        <?php
}
}
?>
            </table>
        </div>
?>

</body>
</html>
