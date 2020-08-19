<?php
session_start();
include 'db.php';

//register user
if (isset($_POST['signup'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $car = $_POST['car'];
    $plate = $_POST['plate'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact) || empty($car) || empty($plate)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: sign.php');

    }
    else {
        if(strlen($password) < 8 ){
            $_SESSION['error'] = 'Password is weak';
            header('location: signup.php');
            exit;
        }
        if($password != $repassword){
            $_SESSION['error']= 'Passwords dont match';
            header('location: signup.php');
            exit;
        }

        //existing email address in our database
        $sql = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 0){
            $_SESSION['error']='Email already exists, <a href="login.php">login</a> instead';
            header('location:sign.php');

        }
        else {

            $sql = "INSERT INTO `users` 
		(`user_id`, `fname`, `lname`, `email`, 
		`password`,`address`,`contact`,`vehicle`,`numberplate`,`created_on`) 
		VALUES (NULL, '$first', '$last', '$email', 
		'$password','$address','$contact','$car','$plate','$date')";
            $run_query = mysqli_query($con,$sql);
            $_SESSION["uid"] = mysqli_insert_id($con);
            $_SESSION["name"] = $first;

            if($run_query){
                echo 'login_success';
                header('location: login.php');
                exit;
            }
        }
    }

}

//login action
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
    $_SESSION["uid"] = $row["user_id"];
    $_SESSION["name"] = $row["fname"];

    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Fill in the form first';
        header('location:login.php');
    }
    else{
        if ($count == 1){
            echo 'login_success';
            header('location: home.php');
        }
        else{
            $_SESSION['error'] = 'Incorrect login credentials';
            header('location:login.php');
        }
    }
}
//logout

if (isset($_POST['logout'])){
    unset($_SESSION['uid']);
    unset($_SESSION['name']);

    header('location:index.php');
}

//edit user
if (isset($_POST['editprof'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $car = $_POST['car'];
    $plate = $_POST['plate'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact) || empty($car) || empty($plate)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: home.php');

    }
    $query = "UPDATE users SET fname='$first', lname ='$last',email='$email',address='$address',contact='$contact',vehicle='$car',numberplate='$plate' WHERE user_id = '$_SESSION[uid]'";
    $run_query = mysqli_query($con,$sql);

    if ($run_query){
        $_SESSION['success']='Profile updated successfully';
        header('location:home.php');
    }
    else{
        $_SESSION['error']='Profile not updated';
        header('location:home.php');
    }
}

//appointment
if (isset($_POST['book'])){
    $user = $_POST['id'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'pending';

    $sql = "INSERT INTO appointment (`a_id`,`user_id`,`service_id`,`status`,`time`,`date`) VALUES(NULL,'$user','$service','$status','$time','$date') ";
    $query = mysqli_query($con,$sql);

    if ($query){
        $_SESSION['success']='Appointment booked successfully';
        header('location:home.php');
    }
    else{
        $_SESSION['error']='Appointment not booked ';
        header('location:home.php');
    }
}

//complain
if (isset($_POST['complain'])){
    $user = $_POST['id'];
    $message = $_POST['message'];
    $date = date('d-m-Y');

    $sql = "INSERT INTO complains (`c_id`,`user_id`,`message`,`date`) VALUES(NULL,'$user','$message','$date') ";
    $query = mysqli_query($con,$sql);

    if ($query){
        $_SESSION['success']='Complain made successfully';
        header('location:home.php');
    }
    else{
        $_SESSION['error']='Complain not made ';
        header('location:home.php');
    }
}

//register mechanic
if (isset($_POST['signup1'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $profession = $_POST['prof'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact) || empty($profession)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: sign.php');

    }
    else {
        if(strlen($password) < 8 ){
            $_SESSION['error'] = 'Password is weak';
            header('location: signup.php');
            exit;
        }
        if($password != $repassword){
            $_SESSION['error']= 'Passwords dont match';
            header('location: signup.php');
            exit;
        }

        //existing email address in our database
        $sql = "SELECT mechanic_id FROM mechanic WHERE email = '$email' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 0){
            $_SESSION['error']='Email already exists, <a href="login.php">login</a> instead';
            header('location:signup.php');

        }
        else {

            $sql = "INSERT INTO `mechanic` 
		(`mechanic_id`, `fname`, `lname`, `email`, 
		`password`,`address`,`contact`,`profession`,`created_on`) 
		VALUES (NULL, '$first', '$last', '$email', 
		'$password','$address','$contact','$profession','$date')";
            $run_query = mysqli_query($con,$sql);
            $_SESSION["uid"] = mysqli_insert_id($con);
            $_SESSION["name"] = $first;

            if($run_query){
                echo 'login_success';
                header('location: signin.php');
                exit;
            }
        }
    }

}

//login action
if (isset($_POST['login1'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM mechanic WHERE email = '$email'AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
    $_SESSION["uid"] = $row["mechanic_id"];
    $_SESSION["name"] = $row["fname"];

    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Fill in the form first';
        header('location:signin.php');
    }
    else{
        if ($count == 1){
            echo 'login_success';
            header('location: mechanic.php');
        }
        else{
            $_SESSION['error'] = 'Incorrect login credentials';
            header('location:signin.php');
        }
    }
}

//logout

if (isset($_POST['logout'])){
    unset($_SESSION['uid']);
    unset($_SESSION['name']);

    header('location:index.php');
}

//edit mechanic
if (isset($_POST['editmech'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $service = $_POST['service'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact) || empty($service)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: mechanic.php');

    }
    $query = "UPDATE mechanic SET fname='$first', lname ='$last',email='$email',address='$address',contact='$contact',profession='$service' WHERE mechanic_id = '$_SESSION[uid]'";
    $run_query = mysqli_query($con,$sql);

    if ($run_query){
        $_SESSION['success']='Profile updated successfully';
        header('location:mechanic.php');
    }
    else{
        $_SESSION['error']='Profile not updated';
        header('location:mechanic.php');
    }
}

//check services
if (isset($_POST['check'])){
    $id=$_POST['id'];
    $part=$_POST['part'];
    $fee=$_POST['fee'];
    $user=$_POST['user'];

        $sql="SELECT * FROM parts where p_id='$part'";
        $quer = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($quer);

        $price = $row['price'];
        $amount = $price + $fee;


        $query = "UPDATE serve SET part='$part', fee ='$fee',amount='$amount' WHERE serve_id = '$id'";
        $run_query = mysqli_query($con,$query);
        if ($run_query){
            $_SESSION['success']='Completed';
            header('location:mechanic.php');
        }
        else{
            $_SESSION['error']='Check';
            header('location:mechanic.php');
        }

}