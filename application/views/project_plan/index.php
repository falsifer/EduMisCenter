<div class="box">
    <div class="box-heading">  งานแผนและโครงการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('project-plan'), "แผนงาน"); ?></li>
        <li>รายละเอียดโครงการ</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:45px;" >ที่</th>
                            <th class="no-sort"  style="width:30%;">ชื่อโครงการ</th>
                            <th class="no-sort">งบ</th>
<!--                            <th class="no-sort">ตัวชี้วัด<br/>(KPI)</th>
                            <th class="no-sort">วัตถุประสงค์</th>
                            <th class="no-sort">เป้าหมาย</th>-->
                            <th class="no-sort">วิธีดำเนินงาน</th>
                            <th class="no-sort">งบประมาณ</th>
<!--                            <th class="no-sort">การติดตาม</th>
                            <th class="no-sort">ผลที่คาดว่าจะได้รับ</th>-->
                            <!--<th class="no-sort">ประเภท</th>-->
                            <th class="no-sort"  style="width:8%;">หน่วยงาน<br/>รับผิดชอบ</th>
                            <th class="no-sort">ไฟล์เอกสาร</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:18%;" class="no-sort" ></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><?php echo $r['project_name']; ?></td>
                                <td><?php echo $r['project_budget']; ?></td>
    <!--                               <td style="text-align:center;">
                                   <a href="<?php echo site_url('project-plan-kpi/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                               </td>
                               <td style="text-align:center;">
                                   <a href="<?php echo site_url('project-plan-purpose/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                               </td>
                               <td style="text-align:center;">
                                   <a href="<?php echo site_url('project-plan-goal/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                               </td>-->
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-plan-timeline/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-plan-loan/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
    <!--                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-plan-evaluation/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-plan-destination/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>-->
                                <!--<td><?php echo $r['localgov_plan_type']; ?></td>-->
                                <td><?php echo isset($r['responsible']) ? $r['responsible'] : '&nbsp;'; ?></td>
                                <td style="text-align:center;">
                                    <?php if (file_exists("upload/" . $r['project_file']) && !empty($r['project_file'])): ?>
                                        <?php echo anchor(base_url() . "upload/" . $r['project_file'], img('images/data-folder.png'), array("target" => "_blank")); ?>
                                    <?php else: ?>
                                        <?php echo img('images/gray-folder.png'); ?>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit" title="แก้ไข" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-medium"></i> แก้ไข</button>
                                        <button type="button" class="col-md-6 btn btn-danger btn-delete" title="ลบ" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-medium"></i> ลบ</button>
                                    <?php endif; ?>                            
                                </td>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
<?php
$tabName = "example";
$title = "งานแผนและโครงการ";
$colStr = "0,1,2,5";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary',
    'fn' => '$("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกแผนพัฒนาการศึกษา");
        $("#education-plan-modal").modal("show");'
);
array_push($btExArr, $bt);

load_datatable($tabName, $btExArr, $title, $colStr);
?>
//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
//        "language": {
//            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//            "zeroRecords": "## ไม่มีข้อมูล ##",
//            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//            "infoEmpty": "",
//            "infoFiltered": "",
//            "sSearch": "ระบุคำค้น",
//            "sPaginationType": "full_numbers"
//        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
//    //
//    var status = "<?php echo $this->session->userdata("status"); ?>";
//    var responsible = "<?php echo $this->session->userdata('responsible'); ?>";
//     $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-print-all'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
//    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกแผนพัฒนาการศึกษา");
        $("#education-plan-modal").modal("show");
    });

    $("#example").on("click", ".btn-print-all", function () {
        var obj = $(this).attr("id");
        location.href = "<?php echo site_url('print-project'); ?>";
    });
    // edit project data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('EducationPlan/edit_project_plan'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inMainPlanName").val(data.main_plan_name);
                $("#inProjectPlanBudget").val(data.project_budget);
                $("#inProvinceStrategiesId").val(data.province_strategies_id);
                $("#inLocalgovStrategiesId").val(data.localgov_strategies_id);
                $("#inLocalgovSubStId").val(data.localgov_sub_st_id);
                $("#inPlanTypeId").val(data.plan_type_id);
                $("#inProjectName").val(data.project_name);
                $("#inProjectStart").val(data.tb_project_plan_start);
                $("#inProjectEnd").val(data.tb_project_plan_end);
                $('#inResponsible').val(data.responsible);
                $('#inEducationStId').val(data.education_st_id);
                $('#inSchoolStId').val(data.school_strategies_id);
//                $('#inPlanRationalCriterion').html(data.tb_plan_rational_criterion);
                tinymce.get('inPlanRationalCriterion').setContent(data.tb_plan_rational_criterion);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลแผนงานโครงการ");
                $("#education-plan-modal").modal("show");
            }
        });
    });
    // delete project data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-education-plan'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // Project purpose
    $("#example").on("click", ".btn-purpose", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('push-data-form-project'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                var obj = JSON.parse(data);
                location.href = "<?php echo site_url('project-purpose/'); ?>" + obj.id;
            }
        });
    });
    // เป้าหมาย
    $("#example").on("click", ".btn-goal", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('push-data-form-project'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                var obj = JSON.parse(data);
                location.href = "<?php echo site_url('project-goal/'); ?>" + obj.id;
            }
        });
    });
    // งบประมาณที่ผ่านมา
    $("#example").on("click", ".btn-loan", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('push-data-form-project'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                var obj = JSON.parse(data);
                location.href = "<?php echo site_url('project-loan/'); ?>" + obj.id;
            }
        });
    });
    // ตัวชี้วัด
    $("#example").on("click", ".btn-kpi", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('push-data-form-project'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                var obj = JSON.parse(data);
                location.href = "<?php echo site_url('project-kpi/'); ?>" + obj.id;
            }
        });
    });
    // ผลที่คาดว่าจะได้รับ
    $("#example").on("click", ".btn-destination", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('push-data-form-project'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                var obj = JSON.parse(data);
                location.href = "<?php echo site_url('project-destination/'); ?>" + obj.id;
            }
        });
    });
</script>
<script type="text/javascript">


    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200,
        elements: "inPlanRationalCriterion",
    });
</script>
<?php $this->load->view("project_plan/modals/project_plan_modal"); ?>