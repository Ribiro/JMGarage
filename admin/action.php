<?php
session_start();
include 'db.php';

//add service
if (isset($_POST['addSer'])){
    $name = $_POST['name'];
    $info = $_POST['info'];

    $sql = "INSERT INTO service (`service_id`, `name`, `info`) VALUES(NULL,'$name','$info') ";
    $query = mysqli_query($con,$sql);

    if ($query){
        $_SESSION['success']='Service added successfully';
        header('location:service.php');
    }
    else{
        $_SESSION['error']='Service not added successfully';
        header('location:service.php');
    }
}

//add car brand
if (isset($_POST['addBrand'])){
    $name = $_POST['name'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "img/".basename($image);

    $sql = "INSERT INTO car (`car_id`, `car_name`,`image`) VALUES(NULL,'$name','$image') ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:brand.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:brand.php');
    }
    if ($query){
    $_SESSION['success']='Brand added successfully';
    header('location:brand.php');
    }
    else{
        $_SESSION['error']='Brand not added successfully';
        header('location:brand.php');
    }
}
//edit car brand
if (isset($_POST['editBrand'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "img/".basename($image);

    $sql = "UPDATE car SET `car_name`= '$name',`image` = '$image'  WHERE car_id = '$id' ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:brand.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:brand.php');
    }
    if ($query){
        $_SESSION['success']='Brand added successfully';
        header('location:brand.php');
    }
    else{
        $_SESSION['error']='Brand not added successfully';
        header('location:brand.php');
    }
}

//add parts
if (isset($_POST['addPart'])){
    $name = $_POST['name'];
    $brand = $_POST['car'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "img/".basename($image);

    $sql = "INSERT INTO parts (`p_id`,`p_name`,`price`,`brand`,`quantity`,`p_image`) VALUES(NULL,'$name','$price','$brand','$quantity','$image') ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:parts.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:parts.php');
    }
    if ($query){
        $_SESSION['success']='Product added successfully';
        header('location:parts.php');
    }
    else{
        $_SESSION['error']='Product not added successfully';
        header('location:parts.php');
    }
}

//edit part
if (isset($_POST['editPart'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "../images/".basename($image);

    $sql = "UPDATE parts SET `brand`= '$brand',`p_name` = '$name',`quantity` = '$quantity',`price` = '$price',`image` = '$image'  WHERE p_id = '$id' ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:parts.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:parts.php');
    }
    if ($query){
        $_SESSION['success']='Product updated successfully';
        header('location:parts.php');
    }
    else{
        $_SESSION['error']='Product not updated';
        header('location:parts.php');
    }
}



//admin login
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email'AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
    $_SESSION["uid"] = $row["admin_id"];
    $_SESSION["name"] = $row["fname"];

    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Fill in the form first';
        header('location:login.php');
    }
    else{
        if ($count == 1){
            echo 'login_success';
            header('location: index.php');
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

    header('location:login.php');
}

//register admin
if (isset($_POST['register'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repass'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: sign.php');

    }
    else {
        if(strlen($password) < 8 ){
            $_SESSION['error'] = 'Password is weak';
            header('location: admin.php');
            exit;
        }
        if($password != $repassword){
            $_SESSION['error']= 'Passwords dont match';
            header('location: admin.php');
            exit;
        }

        //existing email address in our database
        $sql = "SELECT admin_id FROM admin WHERE email = '$email' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 0){
            $_SESSION['error']='Email already exists.';
            header('location:admin.php');

        }
        else {

            $sql = "INSERT INTO `admin` 
		(`admin_id`, `fname`, `lname`, `email`, 
		`password`,`address`,`contact`,`date`) 
		VALUES (NULL, '$first', '$last', '$email', 
		'$password','$address','$contact','$date')";
            $run_query = mysqli_query($con,$sql);
            $_SESSION["uid"] = mysqli_insert_id($con);
            $_SESSION["name"] = $first;

            if($run_query){
                $_SESSION['success']='Admin added successfully';
                header('location:admin.php');
                exit;
            }
        }
    }

}
//confirm appointment
if (isset($_POST['confirm'])){
    $id = $_POST['id'];
    $user = $_POST['user'];
    $service = $_POST['service'];
    $mech = $_POST['mech'];
    $dat = date('Y-m-d');
    $sql = "INSERT INTO serve (`serve_id`,`a_id`,`user_id`,`service_id`,`mechanic_id`,`date`) VALUES(NULL,'$id','$user','$service','$mech',date) ";
    $query = mysqli_query($con,$sql);

    if ($query){
        $status = 'confirmed';
        $run ="UPDATE appointment SET status='$status' WHERE a_id = '$id'";
        $query_run = mysqli_query($con,$run);
        if ($query_run){
            $_SESSION['success']='Appointment confirmed';
            header('location:appointments.php');
        }

    }
    else{
        $_SESSION['error']='Appointment not confirmed';
        header('location:appointments.php');
    }

}