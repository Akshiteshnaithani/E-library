<?php
$server="localhost";
$user="root";
$password="";
$db="e-library";
$con = mysqli_connect($server,$user,$password,$db);

if($con){
    
}else{
    ?>
        <script>
            alert("no connection");
        </script>
    <?php
}

?>
