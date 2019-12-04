<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">

                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มชื่อหน่วยงานผู้เบิกใช้พัสดุ </button>

                </div>
                <h4 class="page-title">บันทึกชื่อหน่วยงานผู้เบิกใช้พัสดุ</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อหน่วยงาน</th>
                                <th>ชื่อหัวหน้างาน</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $counter = 0;
                            $i=1;
                            foreach ($department as $key => $row) {
                                $counter++;
                                $tbl_order_pro_id=$row['id'];

                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['name_de']; ?></td>
                                    <td><?php echo $row['name_head_de']; ?></td>
                                    <td>
                                        <a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
                                        &nbsp; / &nbsp;
                                        <a href="<?php echo site_url('department/delete'); ?>?id=<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>                           
                                        
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
               echo form_open_multipart('parcel/department/procress', $attributes);?>   
               ?>

               <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มชื่อหน่วยงานผู้เบิกใช้พัสดุ</h4>
                </div>
                <div class="modal-body">

                   <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                           <label for="exampleInputEmail1">ชื่อหน่วยงาน</label>
                           <input type="text" class="form-control" id="exampleInputEmail1" name="name_de" placeholder="หน่วยงาน">

                       </fieldset>
                   </div>
                   <div class="col-sm-6">
                    <fieldset class="form-group">
                       <label for="exampleInputEmail1">ชื่อหัวหน้างาน</label>
                       <input type="text" class="form-control" id="exampleInputEmail1" name="name_head_de" placeholder="หัวหน้างาน">

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




<!-- sample modal content -->
<?php

$counter = 0;
$i=1;
foreach ($department as $row) {
    $counter++;
    $tbl_order_pro_id=$row['id'];

    ?>
    <div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg">
            <?php 
               $attributes = array('class' => 'form-horizontal');
               echo form_open_multipart('parcel/department/procress', $attributes);?>   
               ?>
               <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id;?>">
               <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อหน่วยงานผู้เบิกใช้พัสดุ</h4>
                </div>
                <div class="modal-body">

                 <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                         <label for="exampleInputEmail1">ชื่อหน่วยงาน</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" name="name_de" value="<?php echo $row['name_de']; ?>">

                     </fieldset>
                 </div>
                 <div class="col-sm-6">
                    <fieldset class="form-group">
                     <label for="exampleInputEmail1">ชื่อหัวหน้างาน</label>
                     <input type="text" class="form-control" id="exampleInputEmail1" name="name_head_de" value="<?php echo $row['name_head_de']; ?>">

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
</div><!-- /.modal -->
<?php  $i++;} ?> 
</div> <!-- End wrapper -->