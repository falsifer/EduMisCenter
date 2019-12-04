<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">

                <h4 class="page-title">การตั้งรหัสและรายชื่อวัสดุ</h4>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">

                <div class="card-box">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div id="external-events" class="m-t-20">
                                        <ul class="nav nav-pills nav-stacked">
                                            <?php
                                            $q = $this->db->query("SELECT * from tb_parcel_category where type_category = '1'");
                                            $result = $q->result_array();
                                            foreach ($result as $row88) {
                                                ?>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="?id=<?php echo $row88['id']; ?>"><?php echo $row88['name_cat']; ?></a>
                                                </li>
                                            <?php } ?>

                                        </ul>



                                    </div>



                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-9">
                            <?php
                            $id = $this->input->get('id');
                            $q = $this->db->query("SELECT * from tb_parcel_category where id = '$id'");
                            $row_member2 = $q->row_array();
                            $row_member_point = $row_member2['name_cat'];
                            ?>   
                            <h4 class="m-t-0 header-title"><b><?php echo $row_member_point; ?></b></h4>
                            <div class="btn-group pull-left m-t-15">
                                <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light w-md" data-toggle="modal" data-target="#myModal">เพิ่ม</button>
                            </div>
                            <br><br><br>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ชื่อวัสดุ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 0;
                                    $q = $this->db->query("SELECT * from  tb_parcel_product where category_id = '$id' and tb_parcel_product_department = '" . $this->session->userdata('department') . "' ");
                                    $result = $q->result_array();
                                    $i = 1;
                                    foreach ($result as $row) {
                                        $counter++;
                                        $tbl_order_pro_id = $row['id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $row['code_mat']; ?></td>
                                            <td><?php echo $row['name_mat']; ?></td>
                                            <td><a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id; ?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
                                                <!--/ <a href="" id="delete2"  get_id="<?php echo $tbl_order_pro_id ?>" category_id="<?php echo $id; ?>" title="Delete">ลบ</a></td>-->
                                                &nbsp; / &nbsp;
                                                <a href="<?php echo site_url('parcel/material/delete'); ?>?id=<?php echo $tbl_order_pro_id; ?>&category_id=<?php echo $id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>        
                                        </tr>
                                        <?php $i++;
                                    } ?> 
                                </tbody>
                            </table>
                        </div> <!-- end col -->
                    </div>  <!-- end row -->
                </div>
            </div>
            <!-- end col-12 -->
        </div> <!-- end row -->
        <!-- end row -->
    </div> <!-- container -->

    <script>
        $("#delete2").on("click", function (e) {
            alert('ooo');
        });
//                $("#delete2").on("click",function(event) {
//                    
//                    var checkstr =  confirm('คุณแน่ใจหรือว่าต้องการลบข้อมูลนี้');
//                    if(checkstr == true){
//                      $.ajax({
//                        type: "GET",
//                        url: "<?php echo site_url('parcel/material/delete'); ?>",
//                        dataType: "json",
//                        contentType: "application/json; charset=utf-8",
//                        data: {            
//                            id : $(this).attr('get_id'),
//                            category_id : $(this).attr('category_id')
//                        },
//                        success: function( data ) {   
//                            alert(data);
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            console.log(xhr.statusText);
//                            console.log(xhr.responseText);
//                            console.log(xhr.status);
//                            console.log(thrownError);
//                        }
//                    });
//                  }else{
//                    return false;
//                }
//           
//            });
    </script>






</div> <!-- End wrapper -->



<!-- Save Add -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มตั้งรหัสและรายชื่อวัสดุ</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">ลักษณะของวัสดุ</label>
                                <div class="radio-list">
                                    <div class="radio-inline pl-0">
                                        <span class="radio radio-info"> <input type="radio" name="nature_mat" id="radio_9" value="สิ้นเปลือง">
                                            <label for="radio_9">เป็นวัสดุที่ใช้สิ้นเปลือง</label>
                                        </span>
                                    </div>

                                    <div class="radio-inline pl-0">
                                        <span class="radio radio-info"> <input type="radio" name="nature_mat" id="radio_9" value="ยาวนาน">
                                            <label for="radio_10">เป็นวัสดุที่มีอายุการใช้งานยาวนาน</label>
                                        </span>
                                    </div>

                                </div>



                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">รหัสวัสดุ</label>
                                <?php
                                $id = $this->input->get('id');
                                $q = $this->db->query("select max(substr(code_mat,-3))+1 as MaxID from tb_parcel_product where category_id = '$id'");

                                $result445 = $q->row_array();
                                $row_member_point445 = $result445['MaxID'];
                                if ($row_member_point445 == '') {
                                    $autoid = '001';
                                } else {
                                    $autoid = sprintf("%03d", $row_member_point445);
                                }
                                ?>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="code_mat" value="<?php echo $autoid; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">ชื่อวัสดุ</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name_mat" placeholder="ชื่อวัสดุ">

                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">หน่วยที่ใช้นับ</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="unit_mat" placeholder="หน่วย">

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
</div><!-- /. End Save Add  -->




<!-- Edit Add -->
<?php
$counter = 0;
$q = $this->db->query("SELECT * from tb_parcel_product  
    where category_id = '$id'");
$result = $q->result_array();
$i = 1;
foreach ($result as $row) {
    $counter++;
    $tbl_order_pro_id = $row['id'];
    ?>
    <div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">แก้ไขตั้งรหัสและรายชื่อวัสดุ</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">ลักษณะของวัสดุ</label>
                                    <div class="radio-list">
                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="nature_mat" id="radio_9" value="สิ้นเปลือง" <?php if ($row['nature_mat'] == 'สิ้นเปลือง') echo 'checked' ?>>
                                                <label for="radio_9">เป็นวัสดุที่ใช้สิ้นเปลือง</label>
                                            </span>
                                        </div>

                                        <div class="radio-inline pl-0">
                                            <span class="radio radio-info"> <input type="radio" name="nature_mat" id="radio_9" value="ยาวนาน" <?php if ($row['nature_mat'] == 'ยาวนาน') echo 'checked' ?>>
                                                <label for="radio_10">เป็นวัสดุที่มีอายุการใช้งานยาวนาน</label>
                                            </span>
                                        </div>

                                    </div>



                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">รหัสวัสดุ</label>

                                    <input type="text" class="form-control" id="exampleInputEmail1" name="code_mat" value="<?php echo $row['code_mat']; ?>">

                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">ชื่อวัสดุ</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name_mat" value="<?php echo $row['name_mat']; ?>">

                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">หน่วยที่ใช้นับ</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="unit_mat" value="<?php echo $row['unit_mat']; ?>">

                                </fieldset>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button name="change22" type="submit" class="btn btn-primary waves-effect waves-light">Edit Add</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
    <?php $i++;
} ?> 
<!-- /. End Edit Add  -->

<?php
$dept = $this->session->userdata('department');
$schid = $this->session->userdata('sch_id');
$save = $this->input->post('save');
if (isset($save)) {
    $id = $this->input->get('id');
    $nature_mat = $this->input->post('nature_mat');
    $code_mat = $this->input->post('code_mat');
    $name_mat = $this->input->post('name_mat');
    $unit_mat = $this->input->post('unit_mat');

    //วันเวลา
    date_default_timezone_set("Asia/Bangkok");
    $d = date("d");
    $m = date("m");
    $Y = date("Y") + 543;
    $dateto = $d . '/' . $m . '/' . $Y;
    $time = date("H:i:s");
    $sql = "INSERT INTO tb_parcel_product (nature_mat,code_mat,name_mat,unit_mat,category_id,tb_parcel_product_department,tb_school_id) 
    value('$nature_mat','$code_mat','$name_mat','$unit_mat','$id','$dept','$schid')";
    $status = $this->db->query($sql);
    ?>
    <script>
        window.location = '?id=<?php echo $id; ?>';
    </script>
    <?php
}
?> 
<?php
$change22 = $this->input->post('change22');
if (isset($change22)) {
    $id = $this->input->get('id');
    $get_id = $this->input->post('get_id');
    $nature_mat = $this->input->post('nature_mat');
    $code_mat = $this->input->post('code_mat');
    $name_mat = $this->input->post('name_mat');
    $unit_mat = $this->input->post('unit_mat');

    $sql = "update tb_parcel_product set nature_mat='$nature_mat',
    code_mat='$code_mat',name_mat='$name_mat',unit_mat='$unit_mat',tb_parcel_product_department='$dept',tb_school_id='$schid' 
    where id='$get_id'";
    $status = $this->db->query($sql);
    ?>
    <script>
        window.location = '?id=<?php echo $id; ?>';
    </script>
    <?php
}
?>
