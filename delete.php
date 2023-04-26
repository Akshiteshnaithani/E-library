<?php 
include 'connection.php';
if (isset($_GET['id'])) {
    $del_id = $_GET['id'];


    $del_book_query = "DELETE FROM addbook WHERE id = '$del_id'";
    $delete_book_result = mysqli_query($con, $del_book_query);
    if($delete_book_result) {

        header("location:mainpage.php");
    }
}


?>