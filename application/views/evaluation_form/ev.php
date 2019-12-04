<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>งานประเมิน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานประเมิน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th class="no-sort">ที่</th>
                        <th class="no-sort">งาน</th>
                        <th class="no-sort">หัวข้อ</th>
                        <th class="no-sort">ระดับผลการประเมิน</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <?php // if ($r['username'] != 'admin'): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['tb_division_name']; ?></td>
                            <td><?php echo $r['tb_ev_title_detail'] /* === null ? '<button type="button" class="btn btn-save btn-success" id="' . $r['id'] . '"><i class="icon-plus icon-large"></i> เพิ่มหัวข้อ</button>' : $r['tb_supervision_issue_detail'] */; ?></td>                                         
                            <td style="text-align:center;"><?php echo $r['rating'] == null ? '<button type="button" class="btn btn-save btn-warning" id="' . $r['id'] . '"><i class="icon-check icon-large"></i> บันทึกผลการประเมิน</button>' : number_format($r['rating'], 2); ?></td>

                            <?php if ($r['rating'] === null) { ?> 
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-manage btn-primary" id="<?php echo $r['id']; ?>"><i class="icon-list icon-large"></i> บริหารจัดการข้อมูล</button>
                                </td>
                            <?php } else { ?>
                                <td style="text-align: center;">
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" /* && $this->session->userdata('responsible') == 'งานนิเทศการศึกษา' */): ?>
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                    <?php endif; ?>
                                <!--<a href="<?php echo site_url('print-ev-data/' . $r['id']); ?>" class="btn btn-primary" target="_blank"><i class="icon-print icon-2x"></i></a>-->
                                </td>
                            <?php } ?>
                        </tr>
                        <?php // endif; ?>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>                          
            </table>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("vichakarn/modals/supervision_report_modal"); ?>
<?php $this->load->view("modals/vichakarn/supervision_insert_modal"); ?>
<?php $this->load->view("modals/vichakarn/supervision_subtitle_insert"); ?>
<?php $this->load->view("modals/vichakarn/supervision_modal"); ?>




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
        },
    });





    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                                ?>";
    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button  class='btn btn-success' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อ</button>");
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-report btn-primary ' data-toggle='modal' data-target='#supervision-report-modal'><i class='icon-bar-chart icon-large'></i> รายงาน</button>");
    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('print-supervision-form'); ?>' class='btn btn-warning' style='height:34px;vertical-align: middle;' id='supervision-form-print' target='_blank'><i class='icon-check icon-large'>พิมพ์แบบฟอร์ม</i></a>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Vichakarn/activity_plan_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $('#inActivityPlanSubject').val(data.tb_activity_plan_subject);
                $("#inActivityPlanDetail").val(data.tb_activity_plan_detail);
                $("#inActivityPlanStartDate").val(data.tb_activity_plan_start_date);
                $("#inActivityPlanEndDate").val(data.tb_activity_plan_end_date);
                $("#inActivityPlanType").val(data.tb_activity_plan_type);
                $('h4.modal-title').text('แก้ไขข้อมูลรายละเอียดแผนการศึกษาและปฏิทินปฏิทินปฏิบัติ');
                if (data.tb_activity_plan_public === 'Y') {
                    $('input[name="inActivityPlanPublic"]')[0].checked = true;
                } else {
                    $('input[name="inActivityPlanPublic"]')[1].checked = true;
                }
                $('#insert-modal').modal('show');

            }
        });
    });

    $("#example").on("click", ".btn-manage", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Supervision/get_title'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#inDivision2').val(data.tb_division_id);
                $('#inSupervissionTitleId1').val(data.id);
                $('#inSupervisionTitleDetail1').val(data.id);
                $('#insert-subtitle-modal').modal('show');

            }
        });
    });

    $("#example").on("click", ".btn-save", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('Supervision/get_supervision_form'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $('#inDivision3').val(data.title[0].tb_division_id);
                $('#inSupervisionTitleDetail2').val(data.title[0].id);
                $('#inSupervisionTitleType').html(data.inSupervisionTitleType);
                $.ajax({
                    url: "<?php echo site_url('Supervision/get_subtitle_form'); ?>",
                    method: "post",
                    data: {inSupervisionTitleType: data.inSupervisionTitleType, subtitle: data.subtitle},
                    success: function (data) {

                        $('#tab01').html(data);

                    }
                });
                $('#supervision-modal').modal('show');


            }
        });
    });



</script>
