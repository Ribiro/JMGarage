<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>

<?php

if(isset($_SESSION['error'])){
    echo "
                                              <div class='alert alert-danger text-center'>
                                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                                <p>".$_SESSION['error']."</p> 
                                              </div>
                                            ";
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
    echo "
                                              <div class='alert alert-success text-center'>
                                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                                <p>".$_SESSION['success']."</p> 
                                              </div>
                                            ";
    unset($_SESSION['success']);
}
?>
<?php
$sql = "SELECT * FROM users ]";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

?>
    <div class="container-fluid">
        <div class="container-fluid">
            <h3 class="mt-4 text-gray-600">Featured users</h3>
        </div>
        <div class="row">
            <!-- Profile info -->
            <div class="col-lg-6">
                <div class="card shadow mb-4  prof">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile info</h6>
                        <button class=" pof float-right"  data-toggle="modal" data-target="#profile"><i class="fa fa-edit"></i> Edit profile</button>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Name: </h4>
                        <p><?php echo $row['fname'],' ',$row['lname']?></p>
                        <h4 class="small font-weight-bold">Email: </h4>
                        <p><?php echo $row['email']?></p>
                        <h4 class="small font-weight-bold">Contact: </h4>
                        <p><?php echo $row['contact']?></p>
                        <h4 class="small font-weight-bold">Address: </h4>
                        <p><?php echo $row['address']?></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

include 'includes/scripts.php';
include 'includes/modal.php';