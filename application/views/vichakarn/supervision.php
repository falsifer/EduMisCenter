<!------------------------------------------------------------------------------
|  Title      Supervison plan
| ------------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       กำหนดแผนการนิเทศ
| Author	นายบัณฑิต ไชยดี
| Create Date
| Last edit	-
| Comment	-
| ----------------------------------------------------------------------------->

<div class="panel panel-primary">
    <div class="panel-heading">การนิเทศการเรียนการสอนประจำปีการศึกษา <?php echo loan_year(date('Y')); ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>
            รายการดำเนินงาน
            <?php
            if($this->session->userdata('status')!="visitor_admin"){
            ?>
            <div class="dropdown" style="display: inline-block;">
                <button id="dLabel" type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ข้อมูล
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <li><a href="<?php echo site_url('supervision-schedule'); ?>">1 <i class="icon-angle-right"></i> แผนการจัดการนิเทศการเรียนการสอน</a></li>
                    <li><a href="<?php echo site_url('supervision'); ?>">2 <i class="icon-angle-right"></i> การดำเนินงานนิเทศการเรียนการสอน</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="<?php echo site_url('define-education-supervision-task'); ?>">A <i class="icon-angle-right"></i> กำหนดรายการกิจกรรมสำหรับการนิเทศ</a></li>

                </ul>
            </div>    
            <?php
            }
            ?>
        </li>
    </ul>
    <div class="panel-body" style="padding-top:0px;">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">ปีการศึกษา</th>
                        <th class="no-sort" rowspan="2">เทอมที่</th>
                        <th class="no-sort" rowspan="2">วัน เดือน ปี นิเทศ</th>
                        <th class="no-sort" rowspan="2">กลุ่มสาระการเรียนรู้</th>
                        <th class="no-sort" colspan="3">รายการนิเทศ</th>
                        <th class="no-sort" rowspan="2">ผู้รับการนิเทศ</th>
                        <th class="no-sort" rowspan="2">ผู้นิเทศ</th>
                        <th style="width:8%;border-right: none;" class="no-sort" rowspan="2"></th>
                    </tr>
                <th class="no-sort">ระดับชั้น</th>
                <th class="no-sort">รหัสวิชา</th>
                <th class="no-sort">ชื่อวิชา</th>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td style="text-align:center;"><?php echo $r['loan_year']; ?></td>
                            <td style="text-align:center;"><?php echo $r['loan_term']; ?></td>
                            <td><?php echo datethai($r['schedule_date']); ?></td>
                            <td><?php echo $r['learning_group'] ?></td>
                            <td style="text-align:center;"><?php echo $r['class'] ?></td>
                            <td style="text-align:center;"><?php echo $r['tb_course_id']; ?></td>
                            <td><?php echo $r['tb_subject_name']; ?></td>
                            <td><?php echo $r['teacher_name']; ?></td>
                            <td><?php echo $r['supervision_name']; ?></td>
                            <td style="text-align:center;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown">ข้อมูลนิเทศ <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                        <!--<li><a href="<?php echo site_url('supervision-plan-detail/' . $r['detail_id']); ?>">แผนการนิเทศ</a></li>-->
                                        <li><a href="<?php echo site_url('supervision-observ-information/' . $r['detail_id']); ?>">บันทึกการสังเกตการสอน</a></li>
                                        <li><a href="<?php echo site_url('supervision-destination-note/' . $r['detail_id']); ?>">บันทึกการนิเทศ</a></li>
                                        <li><a href="<?php echo site_url('supervision-final/' . $r['detail_id']); ?>">บันทึก/สรุปผลการนิเทศ</a></li>
                                    </ul>
                                </div>                                 
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "example";
        $text = "การนิเทศการเรียนการสอนประจำปีการศึกษา";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
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
    //
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });
    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // Add data button;
    //$("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus'></i> กำหนดผู้นิเทศ</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('supervision-print-data'); ?>' class='btn btn-default'><i class='icon-print'></i> พิมพ์</a>");
    // Call insert modal;
    $('.btn-insert').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('กำหนดผู้นิเทศการศึกษา');
        $('#supervision-plan-modal').modal('show');
    });

    // แก้ไขข้อมูล
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-plan'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSupervisionName').val(data.supervision_name);
                $('#inSupervisionDestination').val(data.supervision_destination);
                $('#inSupervisionPurpose1').val(data.supervision_purpose1);
                $('#inSupervisionPurpose2').val(data.supervision_purpose2);
                $('#inSupervisionPurpose3').val(data.supervision_purpose3);
                $('#inSupervisionPurpose4').val(data.supervision_purpose4);
                $('#inSupervisionPurpose5').val(data.supervision_purpose5);
                $('#inSupervisionPurpose6').val(data.supervision_purpose6);
                $('#inSupervisionPurpose7').val(data.supervision_purpose7);
                $('#inSupervisionPurpose8').val(data.supervision_purpose8);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลแผนการนิเทศ');
                $('#supervision-plan-modal').modal('show');
            }
        });
    });
    // ลบข้อมูล
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-plan'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // พิมพ์ข้อมูล
    $('.btn-print').on('click', function () {

    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vichakarn/modals/supervision_plan_modal'); ?>

