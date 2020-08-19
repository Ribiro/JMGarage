<?php
include "db.php";
include "includes/header.php";
session_start();
if (!isset($_SESSION['uid'])){
    header('location:signin.php');
}
$sql = "SELECT * FROM mechanic where mechanic_id = $_SESSION[uid]";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$service = $row['profession'];
?>


    <section class="hero-wrap hero-wrap-2" style="background-image: url('img/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">Welcome back <?php echo $row['fname'] ?></h1>
                    <p class="breadcrumbs mb-2"><span class="mr-2">Thi is your mechanic platform.</span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="profile">
        <div class="container">
            <h2 class="text-center">Your profile</h2>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 prof">
                            <h6 class="m-0 font-weight-bold text-primary">Profile info</h6>
                            <button class=" pof float-right"  data-toggle="modal" data-target="#editProf"><i class="fa fa-edit"></i> Edit profile</button>
                            <button class=" pof float-right"  data-toggle="modal" data-target="#logout"><i class="fa fa-edit"></i> logout</button>
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
                            <h4 class="small font-weight-bold">Service: </h4>
                            <?php
                            $query = "SELECT * FROM service where service_id ='$service';";
                            $sql = mysqli_query($con, $query);
                            $fetch = mysqli_fetch_array($sql);
                            $name=$fetch['name'];
                            ?>
                            <p><?php echo $name?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile">
        <div class="container">
            <h2 class="text-center"> Services</h2>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 prof">
                            <h6 class="m-0 font-weight-bold text-primary">Services</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Service</th>
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM `serve` WHERE mechanic_id='$_SESSION[uid]'") or die(mysqli_error());
                                    while($fetch = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['serve_id']?></td>
                                            <td><?php
                                                $service =$fetch['service_id'];
                                                $sql ="SELECT * FROM service WHERE service_id = $service";
                                                $run = mysqli_query($con,$sql);
                                                $row = mysqli_fetch_array($run);
                                                echo $row['name'] ?></td>
                                            <td>500</td>
                                            <td>3000</td>
                                            <td>
                                                <a href=""  data-toggle="modal" type="button" data-target="#view<?php echo $fetch['serve_id']?>" title="edit">View</a>
                                                <a href=""  data-toggle="modal" type="button" data-target="#delete_modal<?php echo $fetch['id']?>" title="delete"><span class="fas fa-trash-alt fa-lg text-danger"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                        include "serve.php";

                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- edit profile-->
    <div class="modal fade" id="editProf">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="action.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">First Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['fname']?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="col-sm-3 control-label">Last Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row['lname']?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vehicle" class="col-sm-3 control-label">Vehicle</label>

                            <div class="col-sm-5">
                                <select class="form-control" id="service" name="service" required>
                                    <option value='<?php echo $service?>'><?php echo $name ?></option>
                                    <?php

                                    $result=mysqli_query($con,"select * from service")or die ("query 1 incorrect.....");

                                    while(list($id,$name)=mysqli_fetch_array($result))
                                    {
                                        echo "
                                    <option value='$id'>$name</option>
                                   ";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="col-sm-3 control-label">Contact</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']?>" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="editmech"><i class="fa fa-save"></i> Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="action.php" method="post">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




<?php
include 'includes/footer.php';
include 'includes/scripts.php';
