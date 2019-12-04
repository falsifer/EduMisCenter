<div class="box">
    <div class="box-heading">
        <i class='icon-calendar icon-large'>  </i> 
        บันทึกปฏิทินการศึกษา<span class="pull-right" style="margin-right:15px;"><?php echo $this->session->userdata('department'); ?></span>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกปฏิทินการศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class=" col-md-12" >
                <!-- ปฏิทินกิจกรรม -->
                <table class="table table-hover table-striped table-bordered display" id="example" style='width:100%;'>
                    <thead>
                        <tr>
                            <th style="width:5%;">ที่</th>
                            <th style="width:20%;" class="no-sort">วันที่</th>
                            <th style="width:10%;" class="no-sort">โครงการ/กิจกรรม</th>
                            <th style="width:20%;" class="no-sort">หัวข้อ</th>
                            <th style="width:30%;" class="no-sort">รายละเอียด</th>
                            <th style="width:5%;" class="no-sort">การเผยแพร่</th>
                            
                            <!--<th class="no-sort">ผู้รับผิดชอบ</th>-->
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:10%;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rsAct as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? datethaifull($r['tb_activity_plan_start_date']) : datethaifull($r['tb_activity_plan_start_date']) . " จนถึง " . datethaifull($r['tb_activity_plan_end_date']); ?></td>
                                <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                <td><?php echo $r['tb_activity_plan_detail']; ?></td>
                                <td><?php echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน"; ?></td>
                                <!--<td><?php echo $r['tb_activity_plan_recorder']; ?></td>-->
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
<?php $this->load->view("modals/vichakarn/active_plan_insert_modal"); ?>
<script>
    <?php
        $tabName = "example";
        $text = "ปฏิทินการปฏิบัติงาน/ปฏิทินการศึกษา";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5";
        $btExArr = array();
        $bt = array(
            'name'=>'add_topic',
            'title'=>'เพิ่มข้อมูล',
            'icon'=>'icon-plus',
            'class'=>'btn btn-primary',
            'fn'=>'$(\'#plan-insert-modal\').modal(\'show\');'
        );
        array_push($btExArr,$bt);
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
 /*$('#example').DataTable({
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
*/
    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
//    }
//    $(".btn-insert").on("click", function () {
//        $('#plan-insert-modal').modal('show');
//    });

$("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('School_calendar/activity_plan_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inActivityPlanSubject").val(data.tb_activity_plan_subject);
                $("#inActivityPlanDivision").val(data.tb_activity_plan_responsible);
                $("#inActivityPlanStartDate").val(data.tb_activity_plan_start_date);
                $("#inActivityPlanEndDate").val(data.tb_activity_plan_end_date);
                $("#inActivityPlanPlace").val(data.tb_activity_plan_place);
                $("#inActivityPlanType").val(data.tb_activity_plan_type);
                $("#inActivityPlanDetail").val(data.tb_activity_plan_detail);
                
                $("h3.modal-title").text("ปรับปรุงข้อมูลแผนการศึกษาและปฏิทินปฏิบัติงาน");
                $("#plan-insert-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('School_calendar/activity_plan_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    

</script>

