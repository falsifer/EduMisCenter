<div class="box">
    <div class="box-heading"> <?php echo nbs(); ?> กำหนดแผนยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url() . '/education-planing', "รายละเอียดโครงการพัฒนา"); ?></li>
        <li>กำหนดแผนยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น</li>
    </ul>
    <div class="box-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <div class="row">
                <form method="post" id="insert-form" class="col-md-9 form-horizontal">
                    <div class="col-md-4 form-group">
                        <label class="control-label col-md-6">ยุทธศาสตร์ที่</label>
                        <div class="col-md-6">
                            <input type="number" name="inLocalgovStNo" id="inLocalgovStNo" class="form-control" autofocus required />
                        </div>
                    </div>
                    <div class="col-md-7 form-group">
                        <label class="control-label col-md-3">ชื่อยุทธศาสตร์</label>
                        <div class="col-md-8">
                            <input type="text" name="inLocalgovStName" id="inLocalgovStName" class="form-control" required/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-alrge"></i> บันทึก</button>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <hr/>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>

                        <th class="no-sort">ยุทธศาสตร์ที่</th>
                        <th class="no-sort">ชื่อยุทธศาสตร์</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:25%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>

                            <td style="text-align:center;"><?php echo $r['localgov_st_no'] ?></td>
                            <td><?php echo $r['localgov_st_name'] ?>

                                <div class="col-md-12">
                                    <?php
                                    $rst = $this->My_model->get_where_order("tb_localgov_strategies", array('tb_localgov_strategic_id' => $r['id']), "localgov_st_no asc");
                                    foreach ($rst as $itm) {
                                        ?>
                                        <div class="row col-md-12">
                                            กลยุทธ์ที่ <?php echo $itm['localgov_st_no'] . nbs(2) . $itm['localgov_st_name'] . nbs(4) ?>
                                            <button class="btn btn-link" id="<?php echo $itm['id']; ?>" value='<?php echo $r['id']; ?>' onclick='EditThisSubRow(this)'><i style='color:orange;' class='icon-edit icon-large'></i></button> 
                                            <button class="btn btn-link" id="<?php echo $itm['id']; ?>" value='<?php echo $r['id']; ?>' onclick='DeleteThisSubRow(this)'><i style='color:red;' class='icon-trash icon-large'></i></button>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <div class='btn-group'>
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit"  id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button><button type="button" class="col-md-6 btn btn-danger btn-delete"  id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                    </div>
                                    <button type="button" class="col-md-12 btn btn-info btn-strategy" alt='ยุทธศาสตร์ที่ <?php echo $r['localgov_st_no'] . ' ' . $r['localgov_st_name'] ?>' id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> เพิ่มกลยุทธ์</button>

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
            <div class="col-md-8">
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
<?php
$tabName = "example";

$text = "กำหนดยุทธศาสตร์จังหวัด";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1";
$btExArr = array();

$bt = array(
    'name' => 'DownloadTemplate',
    'title' => 'รูปแบบไฟล์ Excel (.xls)',
    'icon' => 'icon-download-alt',
    'class' => 'btn-success',
    'fn' => '$(\'#std-sis-insert-modal\').modal(\'show\')'
);
array_push($btExArr, $bt);

$bt = array(
    'name' => 'ImportExcelModalShow',
    'title' => 'นำเข้าข้อมูลจากไฟล์ Excel (.xls)',
    'icon' => 'icon-file',
    'class' => 'btn-success',
    'fn' => '$(\'#std-sis-insert-modal\').modal(\'show\')'
);
array_push($btExArr, $bt);
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('EducationPlan/localgov_strategic_insert'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย...');
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('EducationPlan/localgov_strategic_edit'); ?>",
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
//                alert(data.id)
                $("#id").val(data.id);

                $("#inLocalgovStNo").val(data.localgov_st_no);
                $("#inLocalgovStName").val(data.localgov_st_name);
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('EducationPlan/localgov_strategic_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



    $('.btn-strategy').on("click", function () {
        $("h3.modal-title").text($(this).attr('alt'));
        $("#stid").val($(this).attr('id'));
         $("#insert-local-st-form")[0].reset();
        $("#st-modal").modal("show");
    });

//------------- Fluke 

    function EditThisSubRow(e) {
        $.ajax({
            url: "<?php echo site_url('EducationPlan/localgov_strategic_sub_edit'); ?>",
            method: "POST",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#myrowid").val(data.id);
                $("#stid").val(e.value);
                
                $("#inSubLocalgovStNo").val(data.localgov_st_no);
                $("#inSubLocalgovStName").val(data.localgov_st_name);
                $("#st-modal").modal("show");
            }
        });
    }


    function DeleteThisSubRow(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('EducationPlan/localgov_strategic_sub_delete'); ?>",
                method: "post",
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

</script>

<?php
$this->load->view("education_plan/modals/localgov_strategies_modal");
