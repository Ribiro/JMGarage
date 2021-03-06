<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="container-fluid">
            <h3 class="mt-4 text-gray-600">Featured admins</h3>
        </div>
        <br>
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
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admins</h6>
                <button class=" float-right" data-toggle="modal" data-target="#addAdmin"><i class="fa fa-plus"></i> Add admin</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Names</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n=0;
                        $n++;
                        $query = mysqli_query($con, "SELECT * FROM admin ") or die(mysqli_error());
                        while($fetch = mysqli_fetch_array($query)){

                            ?>
                            <tr>
                                <td><?php echo $fetch['fname']?> <?php echo $fetch['lname']?></td>
                                <td><?php echo $fetch['email'] ?></td>
                                <td><?php echo $fetch['address'] ?></td>
                                <td><?php echo $fetch['contact'] ?></td>
                                <td>
                                    <a href="#" title="edit"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                                    <a href="#" title="delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <!-- Add admin-->
    <div class="modal fade" id="addAdmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="action.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">First Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="col-sm-3 control-label">Last Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>

                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repassword" class="col-sm-5 control-label">Confirm Password</label>

                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="repass" name="repass" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="col-sm-3 control-label">Contact</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="register"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

include 'includes/scripts.php';
include 'includes/modal.php';