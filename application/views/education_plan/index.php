<div class="box">
    <div class="box-heading">  รายละเอียดโครงการพัฒนา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียดโครงการพัฒนา</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-9">
                <div id="plan-stat"  class="databox"></div>
            </div>
            <div class="col-md-3">
                <!-- บล็อกด้านขวา -->
                <div class="databox" style="padding:0px;">
                    <div class="row" style="margin-top:0px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('vision'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>วิสัยทัศน์</button>
                            <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('purpose'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>วัตถุประสงค์</button>
                            <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('mission'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>พันธกิจ</button>
                            <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('provice-strategies-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>กำหนดแผนยุทธศาสตร์จังหวัด</button>
                            <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('localgov-strategies-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>กำหนดแผนยุทธศาสตร์ อปท.</button>
                            <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('localgov-sub-strategies'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>กำหนดแผนยุทธศาสตร์ย่อย</button>
                            <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('localgov-type-of-plan'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>กำหนดประเภทของแผน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:45px;" >ที่</th>
                            <th class="no-sort"  style="width:30%;">ชื่อโครงการ</th>
                            <th class="no-sort">วัตถุประสงค์</th>
                            <th class="no-sort">เป้าหมาย<br/>(ผลผลิตของโครงการ)</th>
                            <th class="no-sort">งบประมาณ<br/>ที่ผ่านมา</th>
                            <th class="no-sort">ตัวชี้วัด<br/>(KPI)</th>
                            <th class="no-sort">ผลที่คาดว่าจะได้รับ</th>
                            <th class="no-sort">ประเภท</th>
                            <th class="no-sort"  style="width:8%;">หน่วยงาน<br/>รับผิดชอบหลัก</th>
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
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-purpose/' . $r['project_id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-goal/' . $r['project_id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-loan/' . $r['project_id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-kpi/' . $r['project_id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('project-destination/' . $r['project_id']); ?>"><?php echo img("images/folder.png"); ?></a>
                                </td>
                                <td><?php echo $r['localgov_plan_type']; ?></td>
                                <td><?php echo $r['project_department']; ?></td>
                                <td style="text-align:center;">
                                    <?php if (file_exists("upload/" . $r['project_file']) && !empty($r['project_file'])): ?>
                                        <?php echo anchor(base_url() . "upload/" . $r['project_file'], img('images/data-folder.png'), array("target" => "_blank")); ?>
                                    <?php else: ?>
                                        <?php echo img('images/gray-folder.png'); ?>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <button type="button" class="btn btn-warning btn-edit" title="แก้ไข" id="<?php echo $r['project_id']; ?>"><i class="icon-pencil icon-large"></i> EDIT</button>
                                        <button type="button" class="btn btn-danger btn-delete" title="ลบ" id="<?php echo $r['project_id']; ?>"><i class="icon-trash icon-large"></i> DEL</button>
                                    <?php endif; ?>                            
                                    <a href="<?php echo site_url('print-project/' . $r['project_id']); ?>" target="_blank" class="btn btn-info"><i class="icon-print icon-large"></i> PRINT</i></a>
                                </td>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right">eSchool Version 4.0 (2018)</span>
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
    var responsible = "<?php echo $this->session->userdata('responsible'); ?>";
    // $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกแผนพัฒนาการศึกษา");
        $("#education-plan-modal").modal("show");
    });
    // edit project data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-education-plan'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.project_id);
                $("#inMainPlanName").val(data.main_plan_name);
                $("#inProvinceStrategiesId").val(data.province_strategies_id);
                $("#inLocalgovStrategiesId").val(data.localgov_strategies_id);
                $("#inLocalgovSubStId").val(data.localgov_sub_st_id);
                $("#inPlanTypeId").val(data.plan_type_id);
                $("#inProjectName").val(data.project_name);
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["หน่วยงานรับผิดชอบหลัก", "จำนวนแผน/โครงการ"/*, {role: "style"}*/],
<?php foreach ($rs as $r): ?>
                ["<?php echo $r['localgov_plan_type']; ?>", 1/*, "orange"*/],
<?php endforeach; ?>
//            ["ฝ่ายบริหารงานทั่วไป", 7, "orange"],
//            ["ฝ่ายบุคลากร", 8, "orange"],
//            ["ฝ่ายงบประมาณและแผน", 10, "green"],
//            ["ฝ่ายกิจการนักเรียน", 5, "red"],
        ]);
        var result = google.visualization.data.group(
                data,
                [0],
                [{'column': 1, 'aggregation': google.visualization.data.sum, 'type': 'number'}]
                );
        var view = new google.visualization.DataView(result);
//        view.setColumns([0, 1,
//            {calc: "stringify",
//                sourceColumn: 1,
//                type: "string",
//                role: "annotation"},
//            2]);

        var options = {
            title: "จำนวนแผน/โครงการ",
            legend: 'none'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("plan-stat"));
        chart.draw(view, options);
    }
</script>
<?php $this->load->view("education_plan/modals/education_plan_modal"); ?>