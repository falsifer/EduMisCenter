<div class="box">
    <div class="box-heading">วิธีการดำเนินงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="javascript:window.history.go(-1);">โครงการดำเนินการ</a></li>
        <li>วิธีการดำเนินงาน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">กิจกรรม</th>
                        <th class="no-sort">ระยะเวลา</th>
                        <th class="no-sort">ผู้รับผิดชอบ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:10%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $r['process_seq']; ?></td>
                            <td><?php echo $r['process']; ?></td>
                            <td><?php echo shortdate($r['process_start']).' ถึง '.shortdate($r['process_end']); ?></td>
                            <td><?php echo $r['responsible']; ?></td>
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
    //
    <?php
        $tabName = "example";
        $text = "วิธีการดำเนินงานโครงการ";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3";
        $btExArr = array();
        
        $bt = array(
            'name'=>'add_topic',
            'title'=>'เพิ่มข้อมูล',
            'icon'=>'icon-plus',
            'class'=>'btn btn-primary btn-insert',
            'fn'=>''
        );
        array_push($btExArr,$bt);
    
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//
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
    var status = "<?php echo $this->session->userdata("status"); ?>";
    // $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกวิธีการดำเนินงาน");
        $("#project-kpi-modal").modal("show");
    });
    // edit data
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('EducationPlan/project_plan_timeline_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inProcessSeq").val(data.process_seq);
                $("#inProcess").val(data.process);
                $("#inProcessStart").val(data.process_start);
                $("#inProcessEnd").val(data.process_end);
//                $("#inProcessEnd").val(data.kpi_detail);
                $("h3.modal-title").text("ปรับปรุงข้อมูลวิธีการดำเนินงาน");
        $("#project-kpi-modal").modal("show");
            }
        });
    });

    // delete project kpi
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('EducationPlan/project_plan_timeline_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

</script>
<?php $this->load->view("project_plan/modals/project_timeline_modal"); ?>