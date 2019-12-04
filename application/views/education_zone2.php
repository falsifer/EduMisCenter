<div class="box" style="width:95%;">
    <div class="box-heading">ระบบบริหารจัดการศีกษาอิเลคทรอนิกส์ (eSchool 4.0) 2018 <span class="pull-right" style="margin-right:15px;">กองการศึกษา/สำนักการศึกษา</span></div>
    <ul class="breadcrumb" style="padding:0px;">

        <div class="TickerNews" id="T1">
            <div class="ti_wrapper">
                <div class="ti_slide">
                    <div class="ti_content">
                        <div style="z-index:6000">
                            <?php foreach ($advertising as $ad): ?>
                                <span class="ti_news"><a href="#"><i class="icon-comments icon-large"></i> <?php echo $ad['pr_topic']; ?></a></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        

    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- Pricing -->
                    <div class="col-md-3">
                        <div class="pricing hover-effect">
                            <div class="pricing-head pricing-head-active">
                                <h3>วิชาการ<span>รายการข้อมูลกลุ่มงานวิชาการ</span></h3>
                                <div class="row" style="padding-top:20px;padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <?php echo img("images/admin/professor.png"); ?>
                                    </div>
                                </div>
                            </div>
                            <ul class="pricing-content list-unstyled" style="padding-left:10px;padding-right:10px;">
                                <?php if (!empty($vichakarn)): ?>
                                    <?php foreach ($vichakarn as $vk): ?>
                                        <li><i class="icon-angle-right icon-large"></i> <a href="<?php echo site_url($vk['data_address']); ?>"><?php echo $vk['data_name']; ?></a></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span style="color:#999;">ระบบการวางแผนพัฒนาการศึกษาและปฏิทินปฏิบัติงาน</span></li>
                                    <li><span style="color:#999;">ระบบส่งเสริม สนับสนุน กำกับดูแล ติดตามและประเมินผลคุณภาพการศึกษาของสถานศึกษาในสังกัด</span></li>
                                    <li><span style="color:#999;">ระบบแหล่งเรียนรู้ภายในท้องถิ่น</span></li>
                                    <li><span style="color:#999;">ระบบนิเทศการศึกษา</span></li>
                                    <li><span style="color:#999;">ระบบรายงานการประกันคุณภาพภายในของสถานศึกษาในสังกัด</span></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pricing hover-effect">
                            <div class="pricing-head">
                                <h3>บริหาารงานทั่วไป
                                    <span>รายการข้อมูลกลุ่มงานบริหารงานทั่วไป</span>
                                </h3>
                                <div class="row" style="padding-top:20px;padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <?php echo img("images/admin/subject_name.png"); ?>
                                    </div>
                                </div>
                            </div>
                            <ul class="pricing-content list-unstyled">
                                <?php if (!empty($management)): ?>
                                    <?php foreach ($management as $mn): ?>
                                        <?php if (!empty($mn['data_name'])): ?>
                                            <li><a href="<?php echo site_url($mn['data_address']); ?>"><?php echo $mn['data_name']; ?></a></li>
                                        <?php else: ?>
                                            <li><span style="color:#999;"><?php echo $mn['data_name'] ?></span></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span style="color:#999;">ระบบและเครือข่ายข้อมูลสารสนเทศทางการศึกษา</span></li>
                                    <li><span style="color:#999;">ระบบงานธุรการที่เชื่อมโยงระหว่างสำนัก/กองการศึกษา กับสถานศึกษาในสังกัดและสถานศึกษาอื่นที่เกี่ยวข้อง</span></li>
                                    <li><span style="color:#999;">การประชาสัมพันธ์งานการศึกษา</span></li>
                                <?php endif; ?>
                                <li><?php echo anchor('stock-of-documents', "<i class='icon-archive icon-large'></i> คลังเอกสาร"); ?></li>
                                <li><?php echo anchor('picture-stock', "<i class='icon-camera icon-large'></i> คลังภาพ"); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pricing hover-effect">
                            <div class="pricing-head">
                                <h3>บุคลากร
                                    <span>รายการข้อมูลกลุ่มงานบุคลากร</span>
                                </h3>
                                <div class="row" style="padding-top:20px;padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <?php echo img("images/admin/user.png"); ?>
                                    </div>
                                </div>

                            </div>
                            <ul class="pricing-content list-unstyled">
                                <?php if (!empty($human)): ?>
                                    <?php foreach ($human as $h): ?>
                                        <li><a href="<?php echo site_url($h['data_address']); ?>"><?php echo $h['data_name']; ?></a></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span style="color:#999;">ข้อมูลการวางแผนอัตรากำลัง</span></li>
                                    <li><span style="color:#999;">ข้อมูลการลาทุกประเภท/การมาปฏิบัติงาน</span></li>
                                    <li><span style="color:#999;">การประเมินผลการปฏิบัติงาน</span></li>
                                    <li><span style="color:#999;">ทำเนียบบุคลากร</span></li>
                                    <li><span style="color:#999;">การส่งเสริมยกย่องเชิดชูเกียรติ/รางวัลเกียรติยศ</span></li>
                                    <li><span style="color:#999;">การพัฒนาข้าราชการครูและบุคลากรทางการศึกษา</span></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pricing hover-effect">
                            <div class="pricing-head">
                                <h3>งบประมาณ<span>
                                        รายการข้อมูลกลุ่มงานงบประมาณ</span>
                                </h3>
                                <div class="row" style="padding-top:20px;padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <?php echo img("images/admin/school.png"); ?>
                                    </div>
                                </div>
                            </div>
                            <ul class="pricing-content list-unstyled">
                                <?php if (!empty($loan)): ?>
                                    <?php foreach ($loan as $l): ?>
                                        <li><?php echo anchor(site_url($l['data_address']), $l['data_name']); ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span style="color:#999;">ระบบจัดสรรงบประมาณให้สถานศึกษาในสังกัด</span></li>
                                    <li><span style="color:#999;">ระบบจัดสรรงบประมาณให้สถานศึกษาที่ขอรับการสนับสนุนงบประมาณจากองค์กรปกครองส่วนท้องถิ่น</span></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- End of col-md-9 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="databox" style="padding-top:10px;border-top:2px solid #EE7808;">
                    <h3>ปฏิทินการศึกษา</h3>
                    <div id="calendar"></div>
                </div>
                <?php $this->load->view("modals/vichakarn/active_plan_insert_modal"); ?>
                <!-- TAB -->
                <div class="databox" style="margin-top:20px;border-top:2px solid #EE7808;">
                    <div id="exTab2" class="container-fluid">	
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a  href="#1" data-toggle="tab"><b>กิจกรรมเดือน <?php echo month_num(date("m")); ?> <?php echo (date("Y") + 543); ?></b></a>
                            </li>
                            <li><a href="#3" data-toggle="tab"><b>กิจกรรมตลอดทั้งปี</b></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="1" style="padding-top:10px;">
                                <h4>กิจกรรมการศึกษาประจำเดือน <?php echo month_num(date("m")); ?></h4>
                                <table class="table table-hove table-striped table-hover table-bordered" id="activity_cal">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" rowspan="2">ที่</th>
                                            <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                            <th class="no-sort" rowspan="2">กิจกรรม</th>
                                            <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                            <th class="no-sort" rowspan="2">สถานที่</th>
                                            <th class="no-sort" colspan="3">สถานะ</th>
                                            <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                                <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                            <?php endif; ?>
                                            <th rowspan="2">&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th class="no-sort">No Action</th>
                                            <th class="no-sort">In Action</th>
                                            <th class="no-sort">Success</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $row = 1; ?>
                                        <?php foreach ($rsAct as $r): ?>
                                            <?php // if ($r['username'] != 'admin'): ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                <!--td><?php // echo $r['tb_activity_plan_type'];       ?></td-->                                              
                                                <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                                <td><?php echo $r['tb_activity_plan_place']; ?></td>
                                                <?php
                                                if ($r['tb_activity_plan_status'] === 'A') {
                                                    echo '<td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>';
                                                } elseif ($r['tb_activity_plan_status'] === 'N') {
                                                    echo '<td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>
                                    <td></td>';
                                                } elseif ($r['tb_activity_plan_status'] === 'S') {
                                                    echo '<td></td>
                                    <td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    ';
                                                }
                                                ?>
            <!--                                            <td><?php // echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน";       ?></td>-->
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                </td>
                                            </tr>
                                            <?php // endif; ?>
                                            <?php $row++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="3" style="padding-top:10px;">
                                <h4>กิจกรรมการศึกษาตลอดทั้งปี</h4>
                                <table class="table table-hove table-striped table-hover table-bordered" id="activity_cal2">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" rowspan="2">ที่</th>
                                            <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                            <th class="no-sort" rowspan="2">กิจกรรม</th>
                                            <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                            <th class="no-sort" rowspan="2">สถานที่</th>
                                            <th class="no-sort" colspan="3">สถานะ</th>
                                            <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                                <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                            <?php endif; ?>
                                            <th  class="no-sort" rowspan="2">&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th class="no-sort">No Action</th>
                                            <th class="no-sort">In Action</th>
                                            <th class="no-sort">Success</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $row = 1; ?>
                                        <?php foreach ($rsActY as $r): ?>
                                            <?php // if ($r['username'] != 'admin'): ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                <!--td><?php // echo $r['tb_activity_plan_type'];       ?></td-->                                              
                                                <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                                <td><?php echo $r['tb_activity_plan_place']; ?></td>
                                                <?php
                                                if ($r['tb_activity_plan_status'] === 'A') {
                                                    echo '<td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>';
                                                } elseif ($r['tb_activity_plan_status'] === 'N') {
                                                    echo '<td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>
                                    <td></td>';
                                                } elseif ($r['tb_activity_plan_status'] === 'S') {
                                                    echo '<td></td>
                                    <td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    ';
                                                }
                                                ?>
                                                <!--<td><?php // echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน";       ?></td>-->
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                </td>
                                            </tr>
                                            <?php // endif; ?>
                                            <?php $row++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- หนังสือส่ง -->
                <div class="panel">
                    <div class="panel-heading">หนังสือส่ง</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id='outbox-table'>
                                <thead>
                                    <tr>
                                        <th style="width:40px;">ที่</th>
                                        <th class="no-sort">วันที่ส่ง</th>
                                        <th class="no-sort">เลขที่หนังสือ</th>
                                        <th class="no-sort">ผู้รับ</th>
                                        <th class="no-sort">เรื่อง</th>
                                        <th class="no-sort">ชั้นความเร็ว</th>
                                        <th class="no-sort">หนังสือ</th>
                                        <th class="no-sort">Status</th>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <th style="width:10%;" class="no-sort"></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $row = 1; ?>
                                    <?php foreach ($outbox as $r): ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo $row; ?></td>
                                            <td><?php echo shortdate($r['outbox_date']); ?></td>
                                            <td><?php echo $r['outbox_send_no']; ?></td>
                                            <td><?php echo $r['outbox_send_to']; ?></td>
                                            <td><?php echo $r['outbox_topic']; ?></td>
                                            <td style="text-align:center;"><?php echo $r['outbox_level']; ?></td>
                                            <td style="text-align:center;">
                                                <?php if (file_exists("upload/" . $r['outbox_file']) && !empty($r['outbox_file'])): ?>
                                                    <a href="<?php echo base_url() . 'upload/' . $r['outbox_file']; ?>" target="_blank">ดาวน์โหลด</a>
                                                <?php endif; ?>
                                            </td>
                                            <td>

                                            </td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i></button>
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i></button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $row++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">หนังสือรับ</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id="inbox-table">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">ที่</th>
                                        <th class="no-sort">เลขที่หนังสือ</th>
                                        <th class="no-sort">เรื่อง</th>
                                        <th class="no-sort">ชั้นความเร็ว</th>
                                        <th class="no-sort">ส่งมาจาก</th>
                                        <th class="no-sort">วันที่ส่ง</th>
                                        <th class="no-sort">หนังสือ</th>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <th style="width:10%;" class="no-sort"></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $row = 1; ?>
                                    <?php foreach ($inbox as $r): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row; ?></td>
                                            <td><?php echo $r['outbox_send_no']; ?></td>
                                            <td><?php echo $r['outbox_topic']; ?></td>
                                            <td><?php echo $r['outbox_level']; ?></td>
                                            <td><?php echo $r['outbox_department']; ?></td>
                                            <td><?php echo shortdate($r['outbox_date']); ?></td>
                                            <td>
                                                <?php if (file_exists("upload/" . $r['outbox_file']) && !empty($r['outbox_file'])): ?>
                                                    <a href="<?php echo base_url() . "upload/" . $r['outbox_file']; ?>" target="_blank">ดาวน์โหลด</a>
                                                <?php endif; ?>
                                            </td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $row++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 500,
        locale: "th",
        selectable: true,
        eventClick: function (event) {
            if (event.id !== null) {

                $.ajax({
                    url: "<?php echo site_url('Vichakarn/activity_plan_edit'); ?>",
                    method: "post",
                    data: {id: event.id},
                    dataType: "json",
                    success: function (data) {

                        $("#id").val(data.id);
                        $('#inActivityPlanSubject').val(data.tb_activity_plan_subject);
                        $('#inActivityPlanPlace').val(data.tb_activity_plan_place);
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
            }
        },
        dayClick: function (date) {

            $('#insert-modal').modal();
            $("#inActivityPlanStartDate").val(date.format());
            $("#id").val('');
            $('#inActivityPlanSubject').val('');
            $("#inActivityPlanDetail").val('');
            $("#inActivityPlanEndDate").val('');
            $("#inActivityPlanType").val('');

        },
        events: [
<?php foreach ($rsActY as $r): ?>
                {
                    id: '<?php echo $r['id']; ?>',
                    title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . $r['tb_activity_plan_end_date'] . "'"; ?>

                },
<?php endforeach; ?>

        ]

    });


    $('#activity_cal').DataTable({
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


    $('#activity_cal2').DataTable({
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
    var status = "<?php //echo $this->session->userdata("status");                        ?>";
    $("div#activity_cal_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#activity_cal_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
//
    $("div#activity_cal2_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#activity_cal2_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



    $("#activity_cal").on("click", ".btn-edit", function () {
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

    // delete data;
    $("#activity_cal").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Vichakarn/activity_plan_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $("#activity_cal2").on("click", ".btn-edit", function () {
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

    // delete data;
    $("#activity_cal2").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Vichakarn/activity_plan_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // inbox
    $('#inbox-table').DataTable({
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
    // outbox
    $('#outbox-table').DataTable({
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
    $("div#outbox-table_length.dataTables_length").append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-send'><i class='icon-file-alt'></i> ส่งหนังสือ</a>");
    $('.sorting_asc').removeClass('sorting_asc');
    $("div.panel-heading").css('background-color', '#FFA726').css('color', '#FFFFFF');
    $("div.panel-body").css('border', '1px solid #ffa726');
    //
    // Send document;
    $(".btn-send").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("ส่งหนังสือ");
        $("#edoc-send-modal").modal("show");
    });
    // marquee
    $(function () {
        $('.simple-marquee-container').SimpleMarquee({
            duration: 70000,
            hover: false
        });
    });
    // Break news;
    $(function () {
        var timer = !1;
        _Ticker = $("#T1").newsTicker();
        _Ticker.on("mouseenter", function () {
            var __self = this;
            timer = setTimeout(function () {
                __self.pauseTicker();
            }, 200);
        });
        _Ticker.on("mouseleave", function () {
            clearTimeout(timer);
            if (!timer)
                return !1;
            this.startTicker();
        });
    });
</script>
<?php $this->load->view("edoc/edoc_send_modal"); ?>
<?php $this->load->view('public_relations/modals/public_detail_modal'); ?>
