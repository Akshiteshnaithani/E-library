<?php
include 'connection.php';
if (isset($_GET['email'])&& isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $code = $_GET['v_code'];
    $query= "SELECT * FROM registration  WHERE  email = '$email'";
    $result = mysqli_query($con, $query);
    
    if($result) {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0)
            {

                $update="UPDATE registration SET is_verified = '1' WHERE email = '$result_fetch[email]'";
                if(mysqli_query($con,$update)){
                 
                    echo"
                    <script>
                    alert('email verification sucessfull');
                    window.location.href='login.php';
                    </script>";
                }
                else{
                    echo"
                    <script>
                    alert('cannot run query');
                    window.location.href='login.php';
                    </script>"; 
                }

            }
            else{
                echo"
                    <script>
                    alert('user alreday register');
                    window.location.href='index.php';
                    </script>";
            }


        }

    }
    else{
        echo"
                    <script>
                    alert('cannot run query');
                    window.location.href='index.php';
                    </script>";
    }
}
?>