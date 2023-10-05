<?php
session_start();

//initializing variables
$errors = array();

//connect to database
$db = mysqli_connect('localhost', 'root', 'xoxad', 'capstone');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//LOGIN USER 
if (isset($_POST['login_user'])) {
    $time=time()-30;
    $ip_address=getIpAddr();

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $query1=mysqli_query($db,"select count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'");
    $check_login_row=mysqli_fetch_assoc($query1);
    $total_count=$check_login_row['total_count'];

    if($total_count==3){
        array_push($errors, "To many failed login attempts. Please login after 30 sec");
    } else {
    // Coding for login
        if (count($errors) == 0) {
            $password = md5($password); //encrypting password
            $query = "SELECT * FROM account WHERE acc_name='$username' AND acc_pass='$password'";
            $results = mysqli_query($db, $query);
            $row = mysqli_fetch_array($results);
    
            if (mysqli_num_rows($results)==1) {
                if($row["acc_type"]=="cashier") {
                    $userid=$_SESSION['user']['acc_id'];
                    echo $_SESSION['acc_name'] = $username; 
                    echo $_SESSION['success'] = "You are now logged in";
                    header('location: ../cashier/dash.php');
                } 
                if($row["acc_type"]=="kitchen") {
                    $userid=$_SESSION['user']['acc_id'];
                    echo $_SESSION['acc_name'] = $username; 
                    echo $_SESSION['success'] = "You are now logged in";
                    header('location: ../kitchen/dash.php');
                } 
                if($row["acc_type"]=="admin") {
                    echo $_SESSION['acc_name'] = $username; 
                    echo $_SESSION['success'] = "You are now logged in as an admin";
                    header('location: ../admin/dash.php');
                }
                mysqli_query($db,"delete from loginlogs where IpAddress='$ip_address' AND datelog=current_date()");
                echo "<script>window.location.href='../admin/dash.php';</script>";
            } else {
                $total_count++;
                $rem_attm=3-$total_count;
                if($rem_attm==0){
                    array_push($errors, "To many failed login attempts. Please login after 30 sec");
                }else{
                    array_push($errors, "Please enter valid login details.<br/>$rem_attm attempts remaining...");
                }
                $try_time=time();
                mysqli_query($db,"insert into loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')");
            }
        }
    }
}

// Getting IP Address
function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
    $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
    }

?>
