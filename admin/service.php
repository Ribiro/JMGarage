<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';
include 'db.php';

?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <div class="container-fluid">
        <h3 class="mt-4 text-gray-600">Featured services</h3>
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
            <h6 class="m-0 font-weight-bold text-primary">Services</h6>
            <button class=" float-right" data-toggle="modal" data-target="#addService"><i class="fa fa-plus"></i> Add service</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ServiceName</th>
                        <th>Information</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    $n=0;
                    $n++;
                    $query = mysqli_query($con, "SELECT * FROM service") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($query)){
                      ?>
                    <tbody>
                        <tr>
                            <td><?php echo $n++ ?></td>
                            <td><?php echo $fetch['name']?></td>
                            <td><?php echo $fetch['info']?></td>
                            <td>
                                <a href="#" title="edit"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                                <a href="#" title="delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                            </td>
                        </tr>

                    </tbody>
                    <?php
                    }
                    ?>


                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
    <!-- Add service-->
    <div class="modal fade" id="addService">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="action.php" >
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <p class="col-sm-3 control-label"><b>Information</b></p>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <textarea id="info" name="info" rows="10" cols="40" required></textarea>
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="addSer"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php

include 'includes/scripts.php';
include 'includes/modal.php';