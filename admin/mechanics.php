<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="container-fluid">
            <h3 class="mt-4 text-gray-600">Featured mechanics</h3>
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
                <h6 class="m-0 font-weight-bold text-primary">Mechanics</h6>
                <button class=" float-right" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i> Add Mechanic</button>
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
                            <th>Services</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n=0;
                        $n++;
                        $query = mysqli_query($con, "SELECT * ,b.service_id,b.name FROM mechanic, service b WHERE service_id=b.service_id") or die(mysqli_error());
                        while($fetch = mysqli_fetch_array($query)){
                            $prof = $fetch['profession'];

                            ?>
                            <tr>
                                <td><?php echo $fetch['fname']?> <?php echo $fetch['lname']?></td>
                                <td><?php echo $fetch['email'] ?></td>
                                <td><?php echo $fetch['address'] ?></td>
                                <td><?php echo $fetch['contact'] ?></td>
                                <td><?php echo $fetch['name']?></td>
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
<?php

include 'includes/scripts.php';
include 'includes/modal.php';