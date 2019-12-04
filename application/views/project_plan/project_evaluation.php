<div class="box">
    <div class="box-heading">  การติดตามและประเมินผล</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('education-planing'), 'รายละเอียดโครงการพัฒนา'); ?></li>
        <li>การติดตามและประเมินผล</li>
    </ul>
    <div class="box-body">

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ตัวชี้วัดความสำเร็จ</th>
                        <th class="no-sort">วิธีการนิเทศติดตามและประเมินผล</th>
                        <th class="no-sort">เครื่องมือที่ใช้ในการประเมินผล</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:15%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>

                    <tr>
                <form id="insert-ev-form" method="post">
                    <th class="no-sort">
                        <input type="text" name="inProjectPlanKpi" id="inProjectPlanKpi" style="background:#fff;border: 1px solid #ddd;"required autofocus/>
                    </th>
                    <th class="no-sort" >
                        <input type="text" name="inProjectPlanEvaluation" id="inProjectPlanEvaluation" style="background:#fff;border: 1px solid #ddd;"required/>
                    </th>
                    <th class="no-sort">
                        <input type="text" name="inProjectPlanEvaluationTools" id="inProjectPlanEvaluationTools" style="background:#fff;border: 1px solid #ddd;"required/>
                    </th>
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <th style="width:15%;" class="no-sort">
                            <input type="hidden" id="id" name="id" />
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment(2); ?>" />
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </th>
                    <?php endif; ?>
                </form>
                </tr>

                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:left;"><?php echo $r['project_plan_kpi']; ?></td>
                            <td style="text-align:left;"><?php echo $r['project_plan_evaluation']; ?></td>
                            <td style="text-align:left;"><?php echo $r['project_plan_evaluation_tools']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
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
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
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

    //


    $("#example").on("click",'.btn-success', function (e) {
        e.preventDefault();
        var inProjectPlanKpi = $('#inProjectPlanKpi').val();
        var inProjectPlanEvaluation = $('#inProjectPlanEvaluation').val();
        var inProjectPlanEvaluationTools = $('#inProjectPlanEvaluationTools').val();
        var uid = $('#id').val(); 
        var project_id = $('#project_id').val(); 
        $.ajax({
            url: "<?php echo site_url('EducationPlan/project_plan_evaluation_add'); ?>",
            method: "post",
            data: {project_id:project_id,id:uid,inProjectPlanKpi:inProjectPlanKpi,inProjectPlanEvaluation:inProjectPlanEvaluation,inProjectPlanEvaluationTools:inProjectPlanEvaluationTools},
            success: function (data) {
                $('#inProjectPlanKpi').val('');
                $('#inProjectPlanEvaluation').val('');
                $('#inProjectPlanEvaluationTools').val('');
                location.reload();
                alert('บันทึกเรียบร้อย');
            }
        });
    });
    //
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('EducationPlan/project_plan_evaluation_edit'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inProjectPlanKpi').val(data.project_plan_kpi);
                $('#inProjectPlanEvaluation').val(data.project_plan_evaluation);
                $('#inProjectPlanEvaluationTools').val(data.project_plan_evaluation_tools);
            }
        });
    });
    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('EducationPlan/project_plan_evaluation_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>