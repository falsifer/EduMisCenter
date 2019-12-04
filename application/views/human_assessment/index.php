
<!------------------------------------------------------------------------------
|  Title        Human assessment
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       การประเมินผลครูและบุคลากรทางการศึกษา
| Author	นายบัณฑิต ไชยดี
| Create Date   6-01-2019
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">การประเมินผลการปฏิบัติงานครูและบุคลากรทางการศึกษา</div>
    <ul class="breadcrumb" style="margin-bottom:0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลการประเมินฯ</li>
    </ul>
    <div class="panel-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tb1" aria-controls="home" role="tab" data-toggle="tab">ผู้บริหาร</a></li>
                <!--<li role="presentation"><a href="#tb2" aria-controls="profile" role="tab" data-toggle="tab">ครูผู้สอน</a></li>-->
                <li role="presentation"><a href="#tb3" aria-controls="messages" role="tab" data-toggle="tab">ศึกษานิเทศ</a></li>
                <li role="presentation"><a href="#tb4" aria-controls="settings" role="tab" data-toggle="tab">บุคลากรทางการศึกษา</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding-top:10px;">
                <div role="tabpanel" class="tab-pane active" id="tb1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example_i" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่บัตรประชาชน</th>
                                    <th class="no-sort">รูปภาพ</th>
                                    <th class="no-sort">คำนำหน้า</th>
                                    <th class="no-sort">ชื่อ</th>
                                    <th class="no-sort">นามสกุล</th>
                                    <th class="no-sort">ตำแหน่ง</th>
                                    <th class="no-sort">ระดับ</th>
                                    <th class="no-sort">สังกัด</th>
                                    <th class="no-sort">สถานะการประเมิน</th>
                                    <th class="no-sort">พิมพ์แบบประเมิน</th>
                                    <th style="width:8%;border-right: none;" class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($management as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['hr_id_card']; ?></td>
                                        <td style="text-align:center;">
                                            <?php if (file_exists(hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']) && !empty($r['hr_image'])): ?>
                                                <img src="<?php echo base_url() . hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']; ?>" style="width:60px;height:65px;border:1px solid #666;" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $r['hr_thai_symbol']; ?></td>
                                        <td><?php echo $r['hr_thai_name']; ?></td>
                                        <td><?php echo $r['hr_thai_lastname']; ?></td>
                                        <td><?php echo $r['hr_rank']; ?></td>
                                        <td>
                                        </td>
                                        <td><?php echo $r['hr_department']; ?></td>
                                        <td>
                                            <!-- สถานะการประเมิน -->
                                            <?php $chk_status = $this->HumanAssessment_model->chk_status($r['id']); ?>
                                            <?php echo $chk_status; ?>
                                        </td>
                                        <td style="text-align:center;"><?php echo anchor("print-human-assessment-activities-form/" . $r['id'], img('images/printer.png'), array('target' => "_blank")); ?></td>
                                        <td style="text-align:center;border-right:none;">
                                            <a href="<?php echo site_url('human-assessment-activities/' . $r['id']); ?>" class="btn btn-primary btn-part-1">การประเมิน</a>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
<!--                <div role="tabpanel" class="tab-pane" id="tb2">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example_ii" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่บัตรประชาชน</th>
                                    <th class="no-sort">รูปภาพ</th>
                                    <th class="no-sort">คำนำหน้า</th>
                                    <th class="no-sort">ชื่อ</th>
                                    <th class="no-sort">นามสกุล</th>
                                    <th class="no-sort">ตำแหน่ง</th>
                                    <th class="no-sort">ระดับ</th>
                                    <th class="no-sort">สังกัด</th>
                                    <th class="no-sort">สถานะการประเมิน</th>
                                    <th class="no-sort">พิมพ์แบบประเมิน</th>
                                    <th style="width:8%;border-right: none;" class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($teacher as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['hr_id_card']; ?></td>
                                        <td style="text-align:center;">
                                            <?php if (file_exists(hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']) && !empty($r['hr_image'])): ?>
                                                <img src="<?php echo base_url() . hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']; ?>" style="width:60px;height:65px;border:1px solid #666;" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $r['hr_thai_symbol']; ?></td>
                                        <td><?php echo $r['hr_thai_name']; ?></td>
                                        <td><?php echo $r['hr_thai_lastname']; ?></td>
                                        <td><?php echo $r['hr_rank']; ?></td>
                                        <td></td>
                                        <td><?php echo $r['hr_department']; ?></td>
                                        <td>
                                             สถานะการประเมิน 
                                            <?php $chk_status = $this->HumanAssessment_model->chk_status($r['id']); ?>
                                            <?php echo $chk_status; ?>
                                        </td>
                                        <td style="text-align:center;"><?php echo anchor("print-human-assessment-activities-form/" . $r['id'], img('images/printer.png'), array('target' => "_blank")); ?></td>
                                        <td style="text-align:center;border-right:none;">
                                            <a href="<?php echo site_url('human-assessment-activities/' . $r['id']); ?>" class="btn btn-primary btn-part-2">การประเมิน</a>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>-->
                <div role="tabpanel" class="tab-pane" id="tb3">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example_iii" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่บัตรประชาชน</th>
                                    <th class="no-sort">รูปภาพ</th>
                                    <th class="no-sort">คำนำหน้า</th>
                                    <th class="no-sort">ชื่อ</th>
                                    <th class="no-sort">นามสกุล</th>
                                    <th class="no-sort">ตำแหน่ง</th>
                                    <th class="no-sort">ระดับ</th>
                                    <th class="no-sort">สังกัด</th>
                                    <th class="no-sort">สถานะการประเมิน</th>
                                    <th class="no-sort">พิมพ์แบบประเมิน</th>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <th style="width:8%;border-right: none;" class="no-sort"></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($supervision as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['hr_id_card']; ?></td>
                                        <td style="text-align:center;">
                                            <?php if (file_exists(hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']) && !empty($r['hr_image'])): ?>
                                                <img src="<?php echo base_url() . hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']; ?>" style="width:60px;height:65px;border:1px solid #666;" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $r['hr_thai_symbol']; ?></td>
                                        <td><?php echo $r['hr_thai_name']; ?></td>
                                        <td><?php echo $r['hr_thai_lastname']; ?></td>
                                        <td><?php echo $r['hr_rank']; ?></td>
                                        <td></td>
                                        <td><?php echo $r['hr_department']; ?></td>
                                        <td>
                                            <!-- สถานะการประเมิน -->
                                            <?php $chk_status = $this->HumanAssessment_model->chk_status($r['id']); ?>
                                            <?php echo $chk_status; ?>
                                        </td>
                                        <td style="text-align:center;"><?php echo anchor("print-human-assessment-activities-form/" . $r['id'], img('images/printer.png'), array('target' => "_blank")); ?></td>
                                        <td style="text-align:center;border-right:none;">
                                            <a href="<?php echo site_url('human-assessment-activities/' . $r['id']); ?>" class="btn btn-primary btn-part-3">การประเมิน</a>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>                     
                </div>
                <div role="tabpanel" class="tab-pane" id="tb4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example_iv" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่บัตรประชาชน</th>
                                    <th class="no-sort">รูปภาพ</th>
                                    <th class="no-sort">คำนำหน้า</th>
                                    <th class="no-sort">ชื่อ</th>
                                    <th class="no-sort">นามสกุล</th>
                                    <th class="no-sort">ตำแหน่ง</th>
                                    <th class="no-sort">ระดับ</th>
                                    <th class="no-sort">สังกัด</th>
                                    <th class="no-sort">สถานะการประเมิน</th>
                                    <th class="no-sort">พิมพ์แบบประเมิน</th>
                                    <th style="width:8%;border-right: none;" class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($employee as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['hr_id_card']; ?></td>
                                        <td style="text-align:center;">
                                            <?php if (file_exists(hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']) && !empty($r['hr_image'])): ?>
                                                <img src="<?php echo base_url() . hr_path($r['id'], $this->session->userdata('sch_id')) . $r['hr_image']; ?>" style="width:60px;height:65px;border:1px solid #666;" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $r['hr_thai_symbol']; ?></td>
                                        <td><?php echo $r['hr_thai_name']; ?></td>
                                        <td><?php echo $r['hr_thai_lastname']; ?></td>
                                        <td><?php echo $r['hr_rank']; ?></td>
                                        <td></td>
                                        <td><?php echo $r['hr_office']; ?></td>
                                        <td>
                                            <!-- สถานะการประเมิน -->
                                            <?php $chk_status = $this->HumanAssessment_model->chk_status($r['id']); ?>
                                            <?php echo $chk_status; ?>
                                        </td>
                                        <td style="text-align:center;"><?php echo anchor("print-human-assessment-activities-form/" . $r['id'], img('images/printer.png'), array('target' => "_blank")); ?></td>
                                        <td style="text-align:center;border-right:none;">
                                            <a href="<?php echo site_url('human-assessment-activities/' . $r['id']); ?>" class="btn btn-primary btn-part-4">การประเมิน</a>
                                        </td>
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

    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "example_i";
        $text = "การประเมินผลการปฏิบัติงานครูและบุคลากรทางการศึกษา(ผู้บริหาร)";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
        <?php
        $tabName = "example_ii";
        $text = "การประเมินผลการปฏิบัติงานครูและบุคลากรทางการศึกษา";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
        <?php
        $tabName = "example_iii";
        $text = "การประเมินผลการปฏิบัติงานครูและบุคลากรทางการศึกษา(ศึกษานิเทศ)";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
        <?php
        $tabName = "example_iv";
        $text = "การประเมินผลการปฏิบัติงานครูและบุคลากรทางการศึกษา(บุคลากรทางการศึกษา)";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//    $('#example_i').DataTable({
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
//    $('#example_ii').DataTable({
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
//    $('#example_iii').DataTable({
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
//    $('#example_iv').DataTable({
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
//    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('');
        $('#hr-08-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url(''); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);

                //
                $('h3.modal-title').text('');
                $('#-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url(''); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {

                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->