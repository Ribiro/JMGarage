<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container-fluid">
        <h3 class="mt-4 text-gray-600">Featured car parts</h3>
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
            <h6 class="m-0 font-weight-bold text-primary">Car parts</h6>
            <button class=" float-right"  data-toggle="modal" data-target="#newPart"><i class="fa fa-plus"></i> Add part</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>PartImage</th>
                        <th>Car</th>
                        <th>PartName</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n=0;
                    $n++;
                    $query = mysqli_query($con, "SELECT *,b.car_id,b.car_name FROM parts,car b WHERE brand=b.car_id") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($query)){

                    ?>
                    <tr>
                        <td><?php echo $n++ ?></td>
                        <td><img src="img/<?php echo $fetch['p_image'] ?>" style="height: 50px; width: 50px;">
                            <span><a href="" data-toggle="modal" data-target="#update_product<?php echo $fetch['p_id']?>" title="edit photo"><i class='fa fa-edit'></i> </a></span>
                        </td>
                        <td><?php echo $fetch['car_name'] ?></td>
                        <td><?php echo $fetch['p_name'] ?></td>
                        <td><?php echo $fetch['price'] ?></td>
                        <td><?php echo $fetch['quantity'] ?></td>
                        <td>
                            <a href="#"  data-toggle="modal" type="button" data-target="#update_product<?php echo $fetch['p_id']?>" title="edit"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                            <p></p>
                            <a href="#" data-toggle="modal" type="button" data-target="#delete_product<?php echo $fetch['p_id']?>" title="delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
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
    <!-- Add product-->
    <div class="modal fade" id="newPart">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="action.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label" >Part Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <label for="category" class="col-sm-3 control-label">Car</label>

                            <div class="col-sm-5">
                                <select class="form-control" id="car" name="car" required>
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
                            <label for="price" class="col-sm-1 control-label">Price</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <label for="quantity" class="col-sm-1 control-label">Quantity</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <label for="photo" class="col-sm-1 control-label">Photo</label>

                            <div class="col-sm-5">
                                <input type="file" id="image" name="image">
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="addPart"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/scripts.php';
include 'includes/modal.php';