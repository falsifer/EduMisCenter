<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร
   <?php
        if ($this->session->userdata('status') != "visitor_admin") {
            ?>
            <button class='btn btn-orchart btn-primary' style="float: right;margin-right: 3px;" ><i class='icon-sitemap icon-large'></i> ผังทำเนียบบุคลากร</button>
            <?php
        }
        ?>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ทะเบียนบุคลากร</li>
    </ul>
    <div class="panel-body">

        <!--<div class="table-responsive">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;">ที่</th>
                    <th class="no-sort" style="width:20%;">ชื่อ-นามสกุล</th>
                    <th class="no-sort" style="width:180px;">ประเภทบุคลากร</th>
                    
                    <th class="no-sort">กลุ่มสาระ</th>
                    <th class="no-sort">สังกัด</th>
                    
                    <th class="no-sort" style="width:10%;">โทรศัพท์มือถือ</th>
                    <?php if ($this->session->userdata("") == ""): ?>
                        <th style="width:18%;" class="no-sort"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $row; ?></td>
                        <td>
                            <?php if (file_exists(hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']) && !empty($r['hr_image'])): ?>
                                <img src="<?php echo base_url() . hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']; ?>" style="width:60px;height:65px;border:1px solid #666;" />
                            <?php endif; ?>
                            <?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?><?php echo nbs(2); ?><?php echo $r['hr_thai_lastname']; ?>
                        </td>
                        <td><?php echo $r['human_resources_type']; ?></td>
                        <td><?php echo ($r['hr_division_class'] != '') ? $r['hr_division_class'].'ฝ่าย'.$r['hr_division'] : '-' ; ?></td>
                        <td>
                            <?php echo ($r['hr_group_learning_class'] != '') ? $r['hr_group_learning_class'].'ฝ่าย'.$r['hr_group_learning'] : '-' ; ?>
                        <!--<td style="text-align:right;"><?php echo number_format($r['salary'], 2, '.', ','); ?></td>-->
                        <!--<td><?php echo $r['hr_office']; ?></td>-->
                        <td><?php echo $r['hr_mobile'] ?></td>
                        <td style="text-align:center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-folder"></i> ข้อมูลอื่น ๆ<span class="caret"></span></button>
                                <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                    <li><a href="#" class="btn-hr-01" id="<?php echo $r['id']; ?>">1) ข้อมูลทั่วไป</a></li>
                                    <li><a href="<?php echo site_url('human-resources-part-02/' . $r['id']); ?>">2) ข้อมูลที่อยู่</a></li>
                                    <!--<li><a href="<?php echo site_url('human-resources-part-03/' . $r['id']); ?>">3) ข้อมูลครอบครัว</a></li>-->
                                    <li><a href="<?php echo site_url('human-resources-part-15/' . $r['id']); ?>">4) ประวัติการศึกษา</a></li>
                                    <!--<li><a href="<?php echo site_url('human-resources-part-05/' . $r['id']); ?>">5) ประวัติการรับราชการ</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-04/' . $r['id']); ?>">6) ประวัติการปฏิบัติงาน</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-06/' . $r['id']); ?>">7) ประวัติการสอน</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-07/' . $r['id']); ?>">8) ประวัติการฝึกอบรม-ศึกษาดูงาน</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-08/' . $r['id']); ?>">9) ประวัติการเลื่อนตำแหน่ง</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-09/' . $r['id']); ?>">10) ประวัติการสร้างผลงาน</a></li>-->
                                    <!--<li><a href="<?php echo site_url('human-resources-part-10/' . $r['id']); ?>">11) ข้อมูลใบประกอบวิชาชีพ</a></li>-->
                                    <li><a href="<?php echo site_url('human-resources-part-11/' . $r['id']); ?>">12) สถิติการมาปฏิบัติงาน</a></li>
                                    <li><a href="<?php echo site_url('human-resources-part-12/' . $r['id']); ?>">13) ข้อมูลการกระทำความผิด</a></li>
                                    <!--<li><a href="<?php echo site_url('human-resources-part-13/' . $r['id']); ?>">14) ข้อมูลการรับเครื่องราชอิสริยาภรณ์</a></li>-->
                                    <li><a href="<?php echo site_url('human-resources-part-14/' . $r['id']); ?>">15) ข้อมูลด้านอื่น ๆ</a></li>
                                </ul>
                            </div>     

                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                            <a href="<?php echo site_url('print-human-resources-part-1/' . $r['id']); ?>" class="btn btn-primary" target="_blank"><i class="icon-print"></i> พิมพ์</a>
                        </td>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <!--        <div class="row">
                    <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                        <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
                    </div>
                    <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                        <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
                    </div>
                </div>-->
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
<?php
$tabName = "example";
$text = "ทำเนียบบุคลากร";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7";
$btExArr = array();

$bt = array(
    'name' => 'InsertModal',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn-primary btn-insert',
    'fn' => ''
);
array_push($btExArr, $bt);


$bt = array(
    'name' => 'DownloadTemplate',
    'title' => 'รูปแบบไฟล์ Excel (.xls)',
    'icon' => 'icon-download-alt',
    'class' => 'btn-success btn-export-excel',
    'fn' => '$(\'#hr-import-modal\').modal(\'show\')'
);
array_push($btExArr, $bt);

$bt = array(
    'name' => 'ImportExcelModalShow',
    'title' => 'นำเข้าข้อมูลจากไฟล์ Excel (.xls)',
    'icon' => 'icon-file',
    'class' => 'btn-success btn-excel',
    'fn' => '$(\'#hr-import-modal\').modal(\'show\')'
);
array_push($btExArr, $bt);


load_datatable($tabName, $btExArr, $title, $colStr);
?>

    var status = "<?php echo $this->session->userdata("status"); ?>";
    //$("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-success btn-export-excel'><i class='icon-download-alt icon-large'></i> รูปแบบไฟล์ Excel (.xls)</button>");
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-success btn-excel'><i class='icon-file icon-large'></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>");
//    }
    $(".btn-insert").click(function () {
        $("#hr-01-modal").trigger("reset");
        $("h3.modal-title").text("บันทึกบุคลากร");
        $("#hr-01-modal").modal("show");
    });
    //
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });
    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });

    // .btn-hr-01 button
    $('#example').on('click', '.btn-hr-01', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-1'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $('#inHrTypeId').val(data.hr_type_id);
                $('#inHrThaiSymbol').val(data.hr_thai_symbol);
                $('#inHrThaiName').val(data.hr_thai_name);
                $("#inHrThaiLastname").val(data.hr_thai_lastname);
                $("#inHrEngSymbol").val(data.hr_eng_symbol);
                $("#inHrEngName").val(data.hr_eng_name);
                $("#inHrEngLastname").val(data.hr_eng_lastname);
                $("#inHrIdCard").val(data.hr_id_card);
                $("#inHrBloodGroup").val(data.hr_blood_group);
                $("#inHrDayBirthday").val(data.hr_day_birthday);
                $('#inHrMonthBirthday').val(data.hr_month_birthday);
                $('#inHrYearBirthday').val(data.hr_year_birthday);
                $('#inHrNationality').val(data.hr_nationality);
                $('#inHrOrigin').val(data.hr_origin);
                $('#inHrReligion').val(data.hr_religion);
                $('#inHrStatus').val(data.hr_status);
                $('#inHrConsortName').val(data.hr_consort_name);
                $('#inHrSounAmount').val(data.hr_son_amount);
                $('#inHrDaugtherAmount').val(data.hr_daugther_amount);
                $('#inHrFatherName').val(data.hr_father_name);
                $('#inHrMotherName').val(data.hr_mother_name);
                $('#inHrMobile').val(data.hr_mobile);
                $('#inHrEmail').val(data.hr_email);
                $('#inHrOffice').val(data.hr_office);
                $('#inHrRank').val(data.hr_rank);
                $('#inSalary').val(data.salary);
                $('#inHrLevel').val(data.hr_level);
                
                $('#inHrDegree').val(data.hr_degree);
                $('#inHrGroupLearning').val(data.hr_group_learning);
                $('#inHrGroupLearningClass').val(data.hr_group_learning_class);
                $('#inHrDivision').val(data.hr_division);
                $('#inHrDivisionClass').val(data.hr_division_class);
                // 
                $("h3.modal-title").text('ปรับปรุงข้อมูลบุคลากรส่วนที่ 1 ข้อมูลทั่วไป');
                $('#hr-01-modal').modal('show');
            }
        });
    });

    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-human-resources-part-1'); ?>",
                method: "POST",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $(".btn-excel").on("click", function (e) {
        e.preventDefault();
        $("#hr-import-modal").modal("show");
    });

    $('.btn-orchart').on('click', function () {
        location.href = "<?php echo site_url('oc-base/'); ?>";
    });
</script>
<?php $this->load->view('human_resources/modals/hr_01_modal'); ?>
<?php $this->load->view('human_resources/modals/hr_import_modal'); ?>

<!---------------------------------------------------------------------------->