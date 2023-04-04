<?php 
include 'connection.php';
$del_id = $_GET['id'];

$del_query = "DELETE FROM addbook WHERE id = '$del_id'";
$result = mysqli_query($con, $del_query);
header("location:mainpage.php");
?>
