
<?php 

//ADD RECORD 
//initialize variables 
$emp_id = ""; 
$emp_fname = ""; 
$emp_mname = ""; 
$emp_lname = ""; 
$emp_DOB = ""; 
$emp_type = ""; 
$email = ""; 
$username = "";
$password = "";
$password_1 = ""; 
$password_2 = ""; 
$errors = array();


//EDIT RECORD 
    if ((isset($_POST['edit_emp']))) {
        //receive all input values from the form
        $emp_id = mysqli_real_escape_string($conn, $_POST['acc_id']);
        $emp_fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $emp_mname = mysqli_real_escape_string($conn, $_POST['mname']);
        $emp_lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $emp_DOB = date('Y-m-d', strtotime($_POST['DOB']));
        $emp_type = mysqli_real_escape_string($conn, $_POST['acc_type']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['acc_name']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        
        //validate if both entered password match
        if ($password_1 != $password_2) {
            array_push($errors, "Password does not match");
        }

        //check if record exists 
        $employee_check_query = "SELECT * FROM accinfo WHERE acc_id = '$emp_id' AND acc_name = '$username' LIMIT 1";
        $result = mysqli_query($conn, $employee_check_query);
        $account = mysqli_fetch_assoc($result);

        if ($account) {
            if ($account['acc_id']==$emp_id) {
                array_push($errors, "Account already exist"); 
            }
            if ($account['acc_name']==$username) {
                array_push($errors, "Username already exist");
            }
        }

        //save record into account 
        if (count($errors) == 0 ) {
            $password = md5($password_1); //password encryption before saving in the database
            $query =    "UPDATE account SET 
                acc_name = '$username',
                acc_pass = '$password',
                acc_type = '$emp_type'
                WHERE acc_id = '$emp_id'";
            $done = mysqli_query($conn, $query);
            
            if ($done) {
                $query1 =  "UPDATE accinfo SET
                    fname = '$emp_fname',
                    mname = '$emp_mname',
                    lname = '$emp_lname',
                    email = '$email',
                    DOB = '$emp_DOB'
                    WHERE acc_id = '$emp_id'";
                mysqli_query($conn, $query1);

                ?> <script>
                    alert("Record has been successfully updated"); 
                </script> <?php
            }
            
        } else {
            mysqli_rollback($conn);
            ?> <script>
                    alert("Failed to update record");
            </script><?php
        }
    }
    mysqli_close($conn);

     ?>
    