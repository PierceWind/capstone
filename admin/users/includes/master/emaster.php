<?php
// ADD RECORD
// initialize variables
$emp_id = "";
$emp_fname = "";
$emp_mname = "";
$emp_lname = "";
$emp_DOB = "";
$emp_type = "";
$email = "";
$username = "";
$password_1 = "";
$password_2 = "";
$errors = array();

// EDIT RECORD
if (isset($_POST['edit_emp'])) {
    // receive all input values from the form
    $emp_id = mysqli_real_escape_string($conn, $_POST['acc_id']);
    $emp_fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $emp_mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $emp_lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $emp_DOB = date('Y-m-d', strtotime($_POST['DOB']));
    $emp_type = mysqli_real_escape_string($conn, $_POST['acc_type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['acc_name']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['Password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['Password_2']);

    // Check if both entered passwords match
    if ($password_1 != $password_2) {
        ?>
        <script>
            alert("Password does not match");
        </script>
        <?php
    } else {
        // Validate if the entered password is similar to the stored password
        $employee_check_query = "SELECT acc_pass FROM account WHERE acc_id = '$emp_id' LIMIT 1";
        $result = mysqli_query($conn, $employee_check_query);
        $account = mysqli_fetch_assoc($result);
        $db_hashedpass = $account["acc_pass"];

        // Hash the inputted password with md5 for comparison
        $inputted_pass_hash = md5($password_1);

        if ($inputted_pass_hash == $db_hashedpass) {
            // If similar, update all fields except acc_pass
            $query = "UPDATE account SET 
                        acc_name = '$username',
                        acc_type = '$emp_type', 
                        date_modified = NOW()
                        WHERE acc_id = '$emp_id'";
            $done = mysqli_query($conn, $query);

            if ($done) {
                $query1 = "UPDATE accinfo SET
                            fname = '$emp_fname',
                            mname = '$emp_mname',
                            lname = '$emp_lname',
                            email = '$email',
                            DOB = '$emp_DOB', 
                            date_modified = NOW()
                            WHERE acc_id = '$emp_id'";
                mysqli_query($conn, $query1);

                ?>
                <script>
                    alert("Record has been successfully updated");
                </script>
                <?php
            }
        } else if ($inputted_pass_hash != $db_hashedpass) {
            // If not similar, update all fields
            $password = md5($password_1); // password encryption before saving in the database
            $query = "UPDATE account SET 
                        acc_name = '$username',
                        acc_pass = '$password',
                        acc_type = '$emp_type', 
                        date_modified = NOW()
                        WHERE acc_id = '$emp_id'";
            $done = mysqli_query($conn, $query);

            if ($done) {
                $query1 = "UPDATE accinfo SET
                            fname = '$emp_fname',
                            mname = '$emp_mname',
                            lname = '$emp_lname',
                            email = '$email',
                            DOB = '$emp_DOB', 
                            date_modified = NOW()
                            WHERE acc_id = '$emp_id'";
                mysqli_query($conn, $query1);

                ?>
                <script>
                    alert("Password and other information has been successfully updated");
                </script>
                <?php
            }
        } else {
            ?>
                <script>
                    alert("Record has not heen successfully updated. Try again later.");
                </script>
                <?php
        }
    }
}
mysqli_close($conn);
?>
