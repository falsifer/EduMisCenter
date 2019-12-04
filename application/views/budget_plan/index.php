<div class="box">
    <div class="box-heading">  แผนการใช้จ่ายเงิน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>แผนการใช้จ่ายเงิน</li>
    </ul>
    <div class="box-body">
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
                                        <button type="button" class="col-md-12 btn btn-info btn-view" title="โครงการ" id="<?php echo $r['tb_project_plan_name']; ?>"><i class="icon-search icon-large"></i> โครงการ</button>
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
        $title = "แผนการใช้จ่ายเงิน";
        $colStr = "0,1";
        $btExArr = array();
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
        location.href  = "<?php echo site_url('budget-plan-list'); ?>?plan="+uid;
    });
</script>

<?php $this->load->view("project_plan/modals/plan_modal"); ?>