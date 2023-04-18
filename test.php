if(mysqli_num_rows($result)==1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0){
              $email =  $result_fetch['email'];
                $update="UPDATE registration SET is_verified = 1 WHERE email = '$email'";
                if(mysqli_query($con,$update)){
                    echo"
                    <script>
                    alert('email already register');
                    window.location.herf='index.php';
                    </script>";
                }  

                }