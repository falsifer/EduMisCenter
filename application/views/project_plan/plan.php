<div class="box">
    <div class="box-heading">  งานแผนและโครงการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียดงานแผนและโครงการ</li>
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
                            <div style="margin-bottom:5px;"  class="btn btn-primary btn-exam" onclick="javascript:location.href = '<?php echo site_url('vision'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>วิสัยทัศน์</div>
                            <div  style="margin-bottom:5px;"  class="btn btn-primary btn-exam" onclick="javascript:location.href = '<?php echo site_url('purpose'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>วัตถุประสงค์</div>
                            <div  style="margin-bottom:5px;"  class="btn btn-primary btn-exam" onclick="javascript:location.href = '<?php echo site_url('mission'); ?>';"><i class="icon-list icon-large pull-left""></i><?php echo nbs(3); ?>พันธกิจ</div>
                            <?php
                            if($this->session->userdata('department')=='กองการศึกษา'){
                            ?>
                            <div  style="margin-bottom:5px;" class="btn-info btn-exam" onclick="javascript:location.href = '<?php echo site_url('provice-strategic-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>แผนยุทธศาสตร์จังหวัด</div>
                            <div  style="margin-bottom:5px;" class="btn-info btn-exam" onclick="javascript:location.href = '<?php echo site_url('localgov-strategic-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>แผนยุทธศาสตร์องค์การบริหารส่วนจังหวัด</div>
                            <div  style="margin-bottom:5px;" class="btn-info btn-exam" onclick="javascript:location.href = '<?php echo site_url('education-strategic-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>แผนยุทธศาสตร์กอง/สำนักการศึกษา</div>
                            <?php
                            }else{
                            ?>
                            <div  style="margin-bottom:5px;"  class="btn-info btn-exam" onclick="javascript:location.href = '<?php echo site_url('school-strategic-definetion'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>แผนยุทธศาสตร์<?php echo $this->session->userdata('department'); ?></div>
                            <?php
                            }
                            ?>
                            <!--<div  style="margin-bottom:5px;"  class="btn btn-success btn-exam" onclick="javascript:location.href = '<?php echo site_url('localgov-type-of-plan'); ?>';"><i class="icon-list icon-large pull-left"></i><?php echo nbs(3); ?>ประเภทของแผน</div>-->
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
                            <th class="no-sort">แผนงาน</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:18%;" class="no-sort" ></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($plan as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><?php echo $r['tb_project_plan_name']; ?></td>
                               
                                <td style="text-align:center;">
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <button type="button" class="col-md-12 btn btn-info btn-view" title="โครงการ" id="<?php echo $r['id']; ?>"><i class="icon-search icon-large"></i> โครงการ</button>
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit" title="แก้ไข" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="col-md-6 btn btn-danger btn-delete" title="ลบ" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
//     $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-print-all'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกแผน");
        $("#insert-plan-modal").modal("show");
    });
    
    $("#example").on("click", ".btn-print-all", function () {
        var obj = $(this).attr("id");
                location.href = "<?php echo site_url('print-project'); ?>";
    });
    // edit project data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('ProjectPlan/edit_plan'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inMainPlanName").val(data.tb_project_plan_name);
                $("#inProjectStart").val(data.tb_project_plan_startdate);
                $("#inProjectEnd").val(data.tb_project_plan_enddate);
                $("h3.modal-title").text("ปรับปรุงข้อมูลแผนงานโครงการ");
                $("#insert-plan-modal").modal("show");
            }
        });
    });
    // delete project data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('ProjectPlan/delete_plan'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    
     $("#example").on("click", ".btn-view", function () {
        var uid = $(this).attr('id');
        location.href  = "<?php echo site_url('school-planing'); ?>/"+uid;
    });
</script>

<?php $this->load->view("project_plan/modals/plan_modal"); ?>