<?php 

//VIEW 
//fetch-data in program table 
$query ="SELECT DISTINCT acc_type FROM account WHERE acc_type NOT IN ('admin')";
$result = $conn->query($query);
if($result->num_rows> 0){
    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}


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

//process
//ADD RECORD 
if ((isset($_POST['add_emp']))) {
    //receive all input values from the form
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $emp_fname = mysqli_real_escape_string($conn, $_POST['emp_fname']);
    $emp_mname = mysqli_real_escape_string($conn, $_POST['emp_mname']);
    $emp_lname = mysqli_real_escape_string($conn, $_POST['emp_lname']);
    $emp_DOB = date('Y-m-d', strtotime($_POST['emp_DOB']));
    $emp_type = mysqli_real_escape_string($conn, $_POST['emp_type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
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
        $query =    "INSERT INTO account (acc_id, acc_name, acc_pass, acc_type)
                    VALUES ('$emp_id', '$username', '$password', '$emp_type')";
        $done = mysqli_query($conn, $query);
        
        if ($done) {
            $query1 =    "INSERT INTO accinfo (acc_id, fname, mname, lname, email, DOB)
                    VALUES ('$emp_id', '$emp_fname', '$emp_mname', '$emp_lname', '$email', '$emp_DOB')";
            mysqli_query($conn, $query1);
            ?> <script>
                alert("Record has been successfully added"); 
            </script> <?php
        }
        
    } else {
        mysqli_rollback($conn);
        ?> <script>
                alert("Failed to add record");
        </script><?php
    }
}
mysqli_close($conn);

?>