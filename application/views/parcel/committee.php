        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">

                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มกรรมการ </button>

                        </div>
                        <h4 class="page-title">กำหนดรายชื่อผู้เป็นกรรมการตรวจรับหลักงานหน่วยงาน</h4>
                    </div>
                </div>


                





                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>ตำแหน่ง</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   $counter = 0;
                                   $i=1;
                                   foreach ($committee as $row) {
                                    $counter++;
                                    $tbl_order_pro_id=$row['id'];

                                    ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $row['name_com']; ?></td>
                                        <td><?php echo $row['last_com']; ?></td>
                                        <td><?php echo $row['position_com']; ?></td>
                                        <td>
                                            <a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
                                            &nbsp; / &nbsp;
                                            <a href="<?php echo site_url('committee/delete_committee'); ?>?id=<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>                            

                                        </td>
                                    </tr>
                                    <?php  $i++;} ?> 

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
            
            
            
            <!-- sample modal content -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <?php 
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open_multipart('committee/procress', $attributes);?>   
                    ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มกรรมการ</h4>
                        </div>
                        <div class="modal-body">

                         <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                 <label for="exampleInputEmail1">ชื่อ</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="name_com" placeholder="ชื่อ">

                             </fieldset>
                         </div>
                         <div class="col-sm-6">
                            <fieldset class="form-group">
                             <label for="exampleInputEmail1">นามสกุล</label>
                             <input type="text" class="form-control" id="exampleInputEmail1" name="last_com" placeholder="นามสกุล">

                         </fieldset>
                     </div>
                 </div>
                 <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                         <label for="exampleInputEmail1">ตำแหน่ง</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" name="position_com" placeholder="ตำแหน่ง">

                     </fieldset>
                 </div>

             </div>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button name="save" type="submit" class="btn btn-primary waves-effect waves-light">Save add</button>
        </div>
    </div><!-- /.modal-content -->
</form>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- edit modal content -->
<?php
$counter = 0;
$i=1;
foreach ($committee as $row) {
    $counter++;
    $tbl_order_pro_id=$row['id'];

    ?>
    <div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg">
            <?php 
            $attributes = array('class' => 'form-horizontal');
            echo form_open_multipart('committee/procress', $attributes);?>   
            ?>
            <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id;?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขกรรมการ</h4>
                </div>
                <div class="modal-body">

                 <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                         <label for="exampleInputEmail1">ชื่อ</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" name="name_com" value="<?php echo $row['name_com']; ?>">

                     </fieldset>
                 </div>
                 <div class="col-sm-6">
                    <fieldset class="form-group">
                     <label for="exampleInputEmail1">นามสกุล</label>
                     <input type="text" class="form-control" id="exampleInputEmail1" name="last_com" value="<?php echo $row['last_com']; ?>">

                 </fieldset>
             </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
                <fieldset class="form-group">
                 <label for="exampleInputEmail1">ตำแหน่ง</label>
                 <input type="text" class="form-control" id="exampleInputEmail1" name="position_com" value="<?php echo $row['position_com']; ?>">

             </fieldset>
         </div>

     </div>

 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
    <button name="change" type="submit" class="btn btn-warning waves-effect waves-light">Save Edit</button>
</div>
</div><!-- /.modal-content -->
</form>
</div><!-- /.modal-dialog -->
</div><!-- /.edit modal -->
<?php  $i++;} ?> 



        </div> <!-- End wrapper -->