<?php 
 if(isset($_POST['delete_rec'])) {
        $id = mysqli_real_escape_string($conn, $_POST['delete_rec']);
        $query2 = "DELETE FROM accinfo WHERE acc_id='$id'";
        $query_run2 = mysqli_query($conn, $query2);
    
        if($query_run2) {
            $query3 = "DELETE FROM account WHERE acc_id='$id'"; 
            $query_run3 = mysqli_query($conn, $query3); 
            if ($query_run3) {
                ?> <script>
                    alert("You successfuly deleted a record of Employee <?php 'acc_id' ?> ");
                </script><?php
            }
        }
    } else {
        ?> <script>
            alert("Sorry, record is not deleted. Please try Again");
        </script><?php
    }
?>