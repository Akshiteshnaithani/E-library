wishlist issued book:-
 <!-- issue bbok detail tab -->
        <div class="tab-pane" id="issued">
            <?php
            include 'connection.php';
            // to delete book from issued book
            if (isset($_GET['del_id'])) {
                $id = $_GET['del_id'];

                // get user data from session
                $data = $_SESSION['user_data'];
                $email = $data['1'];

                // delete issued book
                $sql = "DELETE FROM issued_book WHERE book_id = '$id' AND email ='$email' ";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    // get available book data from 
                    $search_query = "SELECT available_book FROM bookdetail WHERE id ='$id' ";
                    $result = mysqli_query($con, $search_query);
                    $row = mysqli_num_rows($result);
                    if ($row) {
                        $record = mysqli_fetch_assoc($result);
                        $available_book = $record['available_book'];

                        $update_query = "UPDATE bookdetail SET available_book = $available_book + 1 WHERE id = '$id' ";
                        $update_result = mysqli_query($con, $update_query);
                    }
                }
            }

            // issued button
            $search_query = "SELECT * FROM issued_book";
            $result = mysqli_query($con, $search_query);
            $row = mysqli_num_rows($result);

            ?>