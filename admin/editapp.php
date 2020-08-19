
<div class="modal fade" id="confirm<?php echo $fetch['a_id']?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="action.php" enctype="multipart/form-data">
                    <div class="form-group">

                        <label for="mechanic" class="col-sm-3 control-label">Mechanic</label>

                        <div class="col-sm-5">
                            <input type="hidden" name="id" value="<?php echo $fetch['a_id'] ?>">
                            <input type="hidden" name="user" value="<?php echo $fetch['user_id'] ?>">
                            <input type="hidden" name="service" value="<?php echo $fetch['service_id'] ?>">
                            <select class="form-control" id="mech" name="mech" required>
                                <?php
                                $result=mysqli_query($con,"select * from mechanic WHERE profession='$service'")or die ("query 1 incorrect.....");

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
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="confirm"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
