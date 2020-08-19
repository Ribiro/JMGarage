<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container-fluid">
        <h3 class="mt-4 text-gray-600">Featured sales</h3>
    </div>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sales</h6>
            <button class=" float-right" data-toggle="modal" data-target="#addOrder"><i class="fa fa-plus"></i> Add order</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SalesNumber</th>
                        <th>CustomerName</th>
                        <th>PartName</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>001</td>
                        <td>Everlyn</td>
                        <td>Brakepads</td>
                        <td>2500</td>
                        <td>Paid</td>
                        <td>
                            <a href="#" title="edit"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                            <a href="#" title="delete"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                        </td>
                    </tr>

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