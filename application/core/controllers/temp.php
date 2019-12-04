<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */
?>


<ul class="breadcrumb">
    <li><?php echo anchor("หน้าแรก", "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
    <li><?php echo anchor("", ""); ?></li>
    <li>รายละเอียด</li>
</ul>


<div class="breadcrumb">
    <div id="bc2" class="btn-group btn-breadcrumb">
        <?php echo anchor("หน้าแรก", "<i class='icon-home icon-large'></i> หน้าแรก", array("class" => "btn btn-default")); ?> 
        <?php echo anchor(" ", " ", array("class" => "btn btn-default")); ?> 
        <?php echo anchor(current_url(), "  ", array("class" => "btn btn-primary", "disabled" => "disabled")); ?>
    </div>
</div>    


<div class="form-group">
    <select name="inHr05DayGet" id="inHr05DayGet" class="my-select" required>
        <option value="">--วันที่--</option>
        <?php for ($i = 1; $i <= 31; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
    <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
    <select name="inHr05MonthGet" id="inHr05MonthGet" class="my-select" required>
        <option value="">--เดือน--</option>
        <?php foreach ($arr as $key => $value): ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php endforeach; ?>

    </select>
    <select name="inHr05YearGet" id="inHr05YearGet" class="my-select" required>
        <option value="">--พ.ศ.--</option>
        <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</div>





<!---------------------------------------------------------------------------->
<!-- Modal -->
<div id="-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
</script>

<span class="star">&#42;</span>

<!---------------------------------------------------------------------------->

<div class="row">
    <div class="form-group col-md-2">
        <label class="control-label">ที่อยู่เลขที่</label>
        <input type="text" name="" id="" class="form-control" />
    </div>
</div>


<td>
    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
</td>


<div class="box">
    <div class="box-heading">  </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort"></th>
                        <?php if ($this->session->userdata("") == ""): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td></td>
                            <?php if ($this->session->userdata("status") == "ผู้ดูแลระบบ"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึก");
        $("#trafficsign-modal").modal("show");
    });
</script>
<?php //$this->load->view('modals/');  ?>
<!---------------------------------------------------------------------------->

<?php if ($this->session->userdata("status") == "ผู้ดูแลระบบ"): ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form method="post" id="insert-form">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">ชื่อ อปท. (ภาษาไทย)</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovThaiName" id="inLocalgovThaiName" class="form-control" required autofocus />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">ชื่อ อปท. (ภาษาอังกฤษ)</label>
                        <input type="text" name="inLocalgovEngName" id="inLocalgovEngName" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ที่อยู่เลขที่</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovAddNo" id="inLocalgovAddNo" class="form-control" />
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label">หมู่ที่</label>
                        <input type="text" name="inLocalgovAddMoo" id="inLocalgovAddMoo" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class="control-label">หมู่บ้าน</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">ถนน</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">แขวง/ตำบล</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">เขต/อำเภอ</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class="control-label">จังหวัด</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">รหัสไปรษณีย์</label><span class="star">&#42;</span>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">โทรศัพท์</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>                  
                    <div class="col-md-3 form-group">
                        <label class="control-label">โทรสาร</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class="control-label">อีเมล์</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">เวบไซต์</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">พิกัดละติจูด</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>                  
                    <div class="col-md-3 form-group">
                        <label class="control-label">พิกัดลองจิจูด</label>
                        <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                </div>
                <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
            </form>
        </div>
    </div>
<?php endif; ?>







<?php
// ตรวจสอบ session ประเภทสำนักงาน
if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {

    //
} elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
    if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
        if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
            
        } else {
            
        }
    } else {
        
    }
} elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
    
} else {
    
}

//
//
$pdf->Setfont("thniramit", "B", 14);
if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
    $pdf->Cell(0, 7, iconv('UTF-8', 'cp874', 'หน่วยดำเนินการ ' . $this->session->userdata("office_name") . ' ' . $this->session->userdata("drr_office") . "  " . $this->session->userdata("drr_buero")), 0, 1, 'C', FALSE);
} elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
    $pdf->Cell(0, 7, iconv('UTF-8', 'cp874', "หน่วยดำเนินการ " . $this->session->userdata("drr_office") . "  " . $this->session->userdata("drr_buero") . "  กรมทางหลวงชนบท"), 0, 1, 'C', FALSE);
} else {
    $pdf->Cell(0, 7, iconv('UTF-8', 'cp874', "หน่วยดำเนินการ " . $this->session->userdata("drr_buero") . "  กรมทางหลวงชนบท"), 0, 1, 'C', FALSE);
}
?>

<div class="row-fluid">
    <?= form_label("รหัสสายทาง", '', array("class" => "title")); ?><?= nbs(1) ?><?= $road['road_id'] ?><?= nbs(3) ?><?= form_label("ชื่อสายทาง", "", array("class" => "title")); ?><?= nbs(1) ?><?= $road['road_name'] ?>
    <?= nbs(3) ?><?= form_label("ตำบล", "", array("class" => "title")); ?> <?= $road['tambon'] ?>
    <?= nbs(3) ?><?= form_label("อำเภอ", "", array("class" => "title")); ?> <?= $road['amphur'] ?>
    <?= nbs(3) ?><?= form_label("จังหวัด", "", array("class" => "title")); ?> <?= $road['province'] ?>
    <?= nbs(3) ?><?= form_label("ระยะทางทั้งสิ้น", "", array("class" => "title")); ?> <?= number_format($road['road_long'], 3, '.', ',') ?> กม.
    <?= nbs(3) ?><?= form_label("ระยะทางดำเนินงาน", "", array("class" => "title")); ?> <?= number_format(($road['road_long'] - $road['road_lat']), 3, '.', ',') ?> กม.
</div>
<div class="row-fluid" style="margin-bottom:15px;">
    <?= form_label("ผู้รับผิดชอบ", "", array("class" => "title")); ?> <?= $road['owner']; ?>
</div>


<?php
$this->session->set_flashdata("message", "<div class='alert alert-danger'><span class='blink' style='color:green;font-weight:bold;display:block;margin-bottom:15px;'>บันทึกข้อมูลเรียบร้อย...</span><a class='close' data-dismiss='alert'><span style='font-size:13px;'>ปิดหน้าต่างนี้</span></a></div>");
$this->session->set_flashdata("message", "<div class='blink'>บันทึกข้อมูลเรียบร้อย...</div>");
?>
<div class="row" style="padding-top:8px;padding-bottom: 15px;">
    <span style="margin-left:10px;"><?php echo validation_errors(); ?><?php echo $this->session->flashdata("message"); ?></span>
</div>


<?php
// Pagination;
$config['base_url'] = base_url() . 'index.php/';
$config['total_rows'];
$config['per_page'] = 15;
$config["uri_segment"] = 3;
$this->pagination->initialize($config);
//
$data["rs"] = $this->mm;
$this->load->view("layout/header");
$this->load->view("roadstock/index", $data);
$this->load->view("layout/footer");
?>


<?php
$frm = $this->form_validation;
$arr = array(
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
    array("field" => "", "label" => "", "rules" => ""),
);
$frm->set_rules($arr);
$frm->set_message("required", "%s <span style='color:green;'>ต้องกรอก</span>");
$frm->set_error_delimiters("<span class='error'>", "</span>" . nbs(3));
if (empty($_FILES['inFieldcutImage']["name"])) {
    $this->form_validation->set_rules("inFieldcutImage", "", "required");
}
if ($frm->run() == FALSE) {
    
} else {
    
}
?>

<?= form_label("จังหวัด", "", array("class" => "title")); ?>
<select  name="inProvinceId" class="input-large">
    <option value="">---เลือกข้อมูล---</option>
</select>


<?php
if (!empty($_FILES["inSurfaceImage"]["name"])) {
    $config = array(
        "upload_path" => "road_survey/",
        "allowed_types" => "jpg",
        "max_size" => 0,
        "file_name" => md5(date("YmdHis"))
    );
    $this->upload->initialize($config);
    $this->upload->do_upload("inSurfaceImage");
    $data = $this->upload->data();

    $this->load->library("image_lib");
    $config['image_library'] = "gd2";
    $config["source_image"] = "road_survey/" . $data['file_name'];
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 600;
    $config['height'] = 500;

    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $filename = $data['file_name'];
} else {
    $filename = "";
}


###############################################################################
# Pagination
$config['base_url'] = base_url("");
$config['uri_segment'] = 3;
$config['per_page'] = 20;
$config['total_rows'] = "";
$this->pagination->initialize($config);
// หาผลรวมของสายทาง
$data['result'] = $this->my_model->get_sum_where("tb_roadstock", "road_long", array("owner" => $this->session->userdata("office_name")));
$data['road_ac'] = $this->my_model->get_sum_where("tb_roadstock", "road_ac", array("owner" => $this->session->userdata("office_name")));
$data['road_cs'] = $this->my_model->get_sum_where("tb_roadstock", "road_cs", array("owner" => $this->session->userdata("office_name")));
$data['road_lat'] = $this->my_model->get_sum_where("tb_roadstock", "road_lat", array("owner" => $this->session->userdata("office_name")));
$data['road_concrete'] = $this->my_model->get_sum_where("tb_roadstock", "road_concrete", array("owner" => $this->session->userdata("office_name")));
//
$data['last_page'] = $config['total_rows'] + 1; // เพื่อกำหนดให้เท่ากับจำนวนบรรทัด
$data['rs'] = $this->my_model->page_divide_where("tb_roadstock", array("owner" => $this->session->userdata("office_name")), "index_no ASC", $config['per_page']);
$this->load->view("roadstock/index", $data);
?>

<!--Other option -->
<li class = "dropdown">
    <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown"><i class = "glyphicon glyphicon-cog"></i> ตัวเลือก<b class = "caret"></b></a>
    <ul class = "dropdown-menu">
        <li><?php echo anchor(current_url(), "พิมพ์ข้อมูลสายทาง"); ?>
        <li><?php echo anchor(current_url(), "MENU 1"); ?>
        <li><?php echo anchor(current_url(), "MENU 1"); ?>
    </ul>
</li>


<!-- Upload file by Ajax jQuery -->
<script>
    $(function () {
        $('#upload_file').submit(function (e) {
            e.preventDefault();
            $.ajaxFileUpload({
                url: './upload/upload_file/',
                secureuri: false,
                fileElementId: 'userfile',
                dataType: 'json',
                data: {
                    'title': $('#title').val()
                },
                success: function (data, status)
                {
                    if (data.status != 'error')
                    {
                        $('#files').html('<p>Reloading files...</p>');
                        refresh_files();
                        $('#title').val('');
                    }
                    alert(data.msg);
                }
            });
            return false;
        });
    });
</script>

<div id="insert-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- datepicker -->
<?php echo form_input(array("type" => "text", "name" => "inActionDate", "class" => "form-control", "value" => $rs['action_date'], "data-provide" => "datepicker", "data-date-language" => "th", "data-date-format" => "yyyy-mm-dd")); ?>

<?php
$rs = $this->my_model->get_where_row("tb_illegal_all", array("id" => $id));
$config['center'] = $rs['road_lat'] . ',' . $rs['road_long'];
$config['zoom'] = '17';
$this->googlemaps->initialize($config);
// ดึงข้อมูลตำแหน่ง
$marker = array();
$marker['position'] = $rs["road_lat"] . ',' . $rs["road_long"];
$marker['infowindow_content'] = "";
$marker['icon'] = base_url() . "images/map_point.png";
$marker['draggable'] = false;
$marker['clickable'] = true;
//$marker['animation'] = 'DROP';
//$marker['title'] = 'คลิกเพื่อดูรายละเอียดข้อมูล';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();
?>
<tr style="background:#e1f5fe;"><td colspan="4"><b>แผนที่</b></td></tr>
<tr>
    <td colspan="4"><?php echo $map['js']; ?></td>
</tr>
<tr>
    <td colspan="4"><?php echo $map['html']; ?></td>
</tr>