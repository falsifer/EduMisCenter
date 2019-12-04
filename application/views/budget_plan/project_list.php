<div class="box">
    <div class="box-heading">  <?php echo $this->input->get('plan'); ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('budget-plan'), "แผนการใช้จ่ายเงิน"); ?></li>
        <li>รายละเอียดโครงการ</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:45px;" >ที่</th>
                            <th class="no-sort"  style="width:30%;">ชื่อโครงการ/รายการ</th>
                            <th class="no-sort">งบ</th>
                            <th class="no-sort">วงเงินอนุมัติตามใบจัดสรร</th>
                            <th class="no-sort">แผนการใช้จ่ายงบประมาณ</th>
                            <th class="no-sort">วงเงินคงเหลือ</th>
                            <th class="no-sort">โรงเรียน</th>
                            <th  class="no-sort" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($project as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><?php echo $r['project_name']; ?></td>
                                <td><?php echo $r['project_budget']; ?></td>
                                <td style="text-align:right;">
                                    <?php
                                    $f1 = 0;
                                    $tr = $this->ProjectPlan_model->get_budget_by_project($r['id']);
                                    $f1 = $tr['total'];
                                    echo number_format($tr['total']);
                                    ?>
                                </td>
                                <td style="text-align:right;">
                                    <?php
                                    $f2 = 0;
                                    $tr = $this->ProjectPlan_model->get_budget_plan_by_project($r['id']);
                                    $f2 = $tr['total'];
                                    echo number_format($tr['total']);
                                    ?>
                                </td>
                                <td style="text-align:right;">
                                    <?php
                                    echo number_format($f1 - $f2);
                                    ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php echo $r['project_department']; ?>
                                </td>

                                <td style="text-align:center;">
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <a href="<?php echo site_url('project-plan-loan/' . $r['id']); ?>"><button type="button" class="btn btn-primary btn-manage" title="รายการ"><i class="icon-plus icon-large"></i> รายการ</button></a>
                                    <?php endif; ?>                            
                                </td>
                            </tr>

                            <?php
                            $itmrs = $this->My_model->get_where_order('tb_project_plan_budget', array('project_id' => $r['id']), 'id');
                            $i=1;
                            foreach ($itmrs as $rr) {
                               
                                ?>
                                <tr>
                                    <td style="text-align: center;">&nbsp;</td>
                                    
                                    <td><?php echo $row; ?>.<?php echo $i; ?> <?php echo $rr['project_plan_item']; ?></td>
                                    <td style="display: none;">
                                       &nbsp;
                                    </td>
                                    
                                    <td style="text-align: right;"><?php echo number_format($rr['project_plan_budget']); ?></td>
                                    
                                    <td style="text-align:center;">
                                       
                                    </td>
                                    <td style="text-align:center;">
                                        
                                    </td>
                                    <td style="text-align:center;">
                                       
                                    </td>

                                    <td style="text-align:center;">
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <button type="button" class="btn btn-info btn-manage" title="ดำนเนินการ" id="<?php echo $rr['id']; ?>"><i class="icon-edit icon-large"></i> ดำเนินการ</button>
                                        <?php endif; ?>                            
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>


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
        "ordering": false,
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


    $("#example").on("click", ".btn-manage", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('BudgetPlan/get_budget_plan'); ?>",
            method: "post",
            data: {project_id: uid},
            dataType: "json",
            success: function (data) {
                $("#project_id").val(data.project_id);
                $("#inMainPlanName").val(data.main_plan_name);
                $("#inProjectName").val(data.project_name);
                $("h3.modal-title").text("ปรับปรุงข้อมูลจัดสรรงบ " + data.main_plan_name + " " + data.project_name);
                $("#budget-plan-modal").modal("show");
            }
        });
    });
    // delete project data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('ProjectPlan/delete_plan_plan'); ?>",
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
                ["<?php echo $r['tb_division_name']; ?>", 1/*, "orange"*/],
<?php endforeach; ?>
        ]);
        var result = google.visualization.data.group(
                data,
                [0],
                [{'column': 1, 'aggregation': google.visualization.data.sum, 'type': 'number'}]
                );
        var view = new google.visualization.DataView(result);
        var options = {
            title: "จำนวนแผน/โครงการ",
            legend: 'none'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("plan-stat"));
        chart.draw(view, options);
    }

    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200,
        elements: "inPlanRationalCriterion",
    });

//$("#inPlanRationalCriterion").Editor(
//        {"bold":false,
//         "italics": false,
//         "fonts": false
//        }
//        );
</script>
<?php $this->load->view("project_plan/modals/project_plan_modal"); ?>