<?php
include "db.php";
include 'includes/header.php';
include 'includes/nav.php';
if (!isset($_SESSION['uid'])){
    header('location:login.php');
}

$sql = "SELECT * FROM users where user_id = $_SESSION[uid]";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$car = $row['vehicle'];

?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('img/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <h1 class="mb-0 bread">Welcome back <?php echo $row['fname'] ?></h1>
                    <p class="breadcrumbs mb-2"><span class="mr-2">We are here ready to serve you.</span></p>
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
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 prof">
                            <h6 class="m-0 font-weight-bold text-primary">Profile info</h6>
                            <button class=" pof float-right"  data-toggle="modal" data-target="#editProf"><i class="fa fa-edit"></i> Edit profile</button>
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
                            <h4 class="small font-weight-bold">Vehicle type: </h4>
                            <?php
                            $query = "SELECT * FROM car where car_id ='$car';";
                            $sql = mysqli_query($con, $query);
                            $fetch = mysqli_fetch_array($sql);
                            $carname=$fetch['car_name'];
                            $carid = $fetch['car_id'];
                            ?>
                            <p><?php echo $carname?></p>
                            <h4 class="small font-weight-bold">Number Plate: </h4>
                            <p><?php echo $row['numberplate']?></p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 prof">
                            <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM `serve` WHERE user_id='$_SESSION[uid]'") or die(mysqli_error());
                                    while($fetch = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td>oil change</td>
                                            <td>3000</td>
                                            <td>pending</td>
                                        </tr>
                                        <?php


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

    <!--Appointment-->

    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img bg-light">
        <div class="container">
            <div class="row d-md-flex justify-content-end">
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white home">
                    <h2 class="mb-4 " style="font-weight: 800; ">Make Appointment</h2>
                    <form action="action.php" class="appointment" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="service" id="service" class="form-control">
                                                <option value="">Select services</option>
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" value="<?php echo $row['fname']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" value="<?php echo $row['email']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                        <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
                                        <input type="text" name="date" class="form-control appointment_date" placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-clock-o"></span></div>
                                        <input type="text" name="time" class="form-control appointment_time" placeholder="Time">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" name="book" value="Book appointment" class="btn btn-dark py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
                    <h2 class="mb-4" style="font-weight: 800; ">Make Complain</h2>
                    <form action="action.php" method="post" class="appointment">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" value="<?php echo $row['fname'] .' '. $row['lname']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="email" value="<?php echo $row['email']?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $row['user_id']?>">
                                    <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" name="complain" value="Send message" class="btn btn-dark py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
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
                                    $query = mysqli_query($con, "SELECT * FROM `serve` WHERE user_id='$_SESSION[uid]'") or die(mysqli_error());
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
                                <select class="form-control" id="car" name="car" required>
                                    <option value='<?php echo $carid?>'><?php echo $carname ?></option>
                                    <?php

                                    $result=mysqli_query($con,"select * from car")or die ("query 1 incorrect.....");

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
                            <label for="numberplate" class="col-sm-5 control-label">Number Plate</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="plate" name="plate" value="<?php echo $row['numberplate']?>" required>
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
                    <button type="submit" class="btn btn-primary btn-flat" name="editprof"><i class="fa fa-save"></i> Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
