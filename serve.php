<div class="modal fade" id="view<?php echo $fetch['serve_id']?>">
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

                        <label for="mechanic" class="col-sm-3 control-label">Part</label>

                        <div class="col-sm-5">
                            <input type="hidden" name="id" value="<?php echo $fetch['serve_id'] ?>">
                            <input type="hidden" name="user" value="<?php echo $fetch['user_id'] ?>">
                            <select class="form-control" id="part" name="part" required>
                                <option>-select-</option>
                                <?php
                                $result=mysqli_query($con,"select * from parts")or die ("query 1 incorrect.....");

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
                        <label for="price" class="col-sm-1 control-label">Fee</label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="fee" name="fee" required>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="check"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>