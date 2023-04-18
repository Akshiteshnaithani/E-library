<?php 
include 'connection.php';
$del_id = $_GET['id'];


$del_book_query = "DELETE FROM addbook WHERE id = '$del_id'";
$delete_book_result = mysqli_query($con, $del_book_query);
if($delete_book_result){

    header("location:mainpage.php");
}



$del_admin_query = "DELETE FROM registration WHERE id = '$del_id'";
$delete_admin_result = mysqli_query($con, $del_admin_query);
if($delete_book_result){

    header("location:all_admins.php");
}
?>