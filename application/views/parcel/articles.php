<div class="box">
    <div class="box-heading">  ระบบงานพัสดุ
        <!--<button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>-->
<!--        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> ค้นหาเรื่องเดิมที่ทำไว้ </button>-->
        
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>การตั้งรหัสและรายชื่อครุภัณฑ์</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card-box">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div id="external-events" class="m-t-20">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="nav-item">
                                                <button  class="btn btn-primary " style="text-align:left;width:100%;" onclick="addArticle()"><i class="icon-plus"></i> เพิ่มข้อมูลประเภทครุภัณฑ์</button>
    
                                            </li>
                                            <?php
                                            $q = $this->db->query("SELECT * from tb_parcel_category where type_category = '2'");
                                            $result = $q->result_array();
                                            foreach ($result as $row88) {
                                                ?>
                                                <li class="nav-item">
                                                    <a class="btn btn-info" style="text-align:left ;" href="?id=<?php echo $row88['id']; ?>">
                                                        <i class="icon-list"></i> 
                                                        <?php echo $row88['name_cat']; ?></a>
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

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ชื่อครุภัณฑ์</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $counter = 0;
                                    $q = $this->db->query("SELECT * from  tb_parcel_product where category_id = '$id'");
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
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id; ?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >
                                                        <button class="col-md-6 btn btn-warning"><i class="icon-pencil icon-lagre"></i> แก้ไข</button></a>

                                                    <a href="<?php echo site_url('parcel/articles/delete'); ?>?id=<?php echo $tbl_order_pro_id; ?>&category_id=<?php echo $id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>
                                                        <button class="col-md-6 btn btn-danger"><i class="icon-trash icon-lagre"></i> ลบ</button></a>        
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </div> <!-- end col -->
                    </div>  <!-- end row -->
                </div>
                <script>
                    $(document).ready(function () {
                        $("#delete").click(function (event) {
                            var checkstr = confirm('คุณแน่ใจหรือว่าต้องการลบข้อมูลนี้');
                            if (checkstr == true) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo site_url('Articles/delete'); ?>",
                                    dataType: "json",
                                    contentType: "application/json; charset=utf-8",
                                    data: {
                                        id: $(this).attr('get_id'),
                                        category_id: $(this).attr('category_id')
                                    },
                                    success: function (data) {
                                        alert(data);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        console.log(xhr.statusText);
                                        console.log(xhr.responseText);
                                        console.log(xhr.status);
                                        console.log(thrownError);
                                    }
                                });
                            } else {
                                return false;
                            }
                        });
                    });
                </script>

            </div>
            <!-- end col-12 -->
        </div> <!-- end row -->
        <!-- end row -->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>



<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">

            <div class="modal-content">

                <?php
                $data['MyHeadTitle'] = 'เพิ่มตั้งรหัสและรายชื่อครุภัณฑ์';
                $this->load->view('layout/my_school_modal_header', $data);
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">รหัสครุภัณฑ์</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="code_mat" value="<?php echo $autoid; ?>">

                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">ชื่อครุภัณฑ์</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name_mat" placeholder="ชื่อครุภัณฑ์">

                                </fieldset>
                            </div>


                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">หน่วยที่ใช้นับ</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="unit_mat" placeholder="หน่วย">

                                </fieldset>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button name="save" type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                        </div>
                    </div>

                </div>

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




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

                    <?php
                    $data['MyHeadTitle'] = 'แก้ไขตั้งรหัสและรายชื่อครุภัณฑ์';
                    $this->load->view('layout/my_school_modal_header', $data);
                    ?>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="exampleInputEmail1">รหัสครุภัณฑ์</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="code_mat" value="<?php echo $row['code_mat']; ?>">

                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="exampleInputEmail1">ชื่อครุภัณฑ์</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name_mat" value="<?php echo $row['name_mat']; ?>">

                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="exampleInputEmail1">หน่วยที่ใช้นับ</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="unit_mat" value="<?php echo $row['unit_mat']; ?>">

                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button name="change22" type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>

                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
    $i++;
}
?> 
<!-- /. End Edit Add  -->
<?php
$dept = $this->session->userdata('department');
$schid = $this->session->userdata('sch_id');
$save = $this->input->post('save');
if (isset($save)) {
    $id = $this->input->get('id');
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
    $sql = "insert into  tb_parcel_product (code_mat,name_mat,unit_mat,category_id,tb_parcel_product_department,tb_school_id)  value ('$code_mat','$name_mat','$unit_mat','$id','$dept','$schid') ";
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
    $code_mat = $this->input->post('code_mat');
    $name_mat = $this->input->post('name_mat');
    $unit_mat = $this->input->post('unit_mat');

    $sql = "update tb_parcel_product set code_mat='$code_mat',name_mat='$name_mat',unit_mat='$unit_mat',tb_parcel_product_department='$dept',tb_school_id='$schid' where id='$get_id'";
    $status = $this->db->query($sql);
    ?>
    <script>
        window.location = '?id=<?php echo $id; ?>';



    </script>
    <?php
}

$this->load->view('parcel/modals/articles_modal');
?>

<script>

    function addArticle() {
        $('#articles-modal').modal('show');
    }
<?php
$tabName = "datatable";

$text = "ระบบงานพัสดุ : รายชื่อครุภัณฑ์";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2";
$btExArr = array();
//$(\'#insert-form\').trigger(\'reset\');
if ($id != null && $id != "") {
    $bt = array(
        'name' => 'add_topic',
        'title' => 'เพิ่มข้อมูล',
        'icon' => 'icon-plus',
        'class' => 'btn btn-primary',
        'fn' => '$(\'#myModal\').modal(\'show\');'
    );
    array_push($btExArr, $bt);
}

load_datatable($tabName, $btExArr, $title, $colStr);
?>
</script>