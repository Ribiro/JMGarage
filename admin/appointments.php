<?php

include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container-fluid">
        <h3 class="mt-4 text-gray-600">Featured Appointments</h3>
    </div>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Appointments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>AppointmentNumber</th>
                        <th>Customer Id</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n=0;
                    $n++;
                    $query = mysqli_query($con, "SELECT * FROM appointment ") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($query)){
                        $service =$fetch['service_id'];
                        ?>
                        <tr>
                            <td><?php echo $n++ ?></td>
                            <td><?php echo $fetch['user_id'] ?></td>
                            <td><?php echo $fetch['time'] ?></td>
                            <td><?php echo $fetch['status'] ?></td>
                            <td><?php echo $fetch['date'] ?></td>
                            <td>
                                <a href="#"  data-toggle="modal" type="button" data-target="#confirm<?php echo $fetch['a_id']?>" title="edit"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>

                            </td>
                        </tr>
                        <?php
                        include 'editapp.php';
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