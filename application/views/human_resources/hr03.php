<!--
/*
  | ----------------------------------------------------------------------------
  |  Title  HR03 
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ข้อมูลเกี่ยวกับครอบครัว
  | Author	นายบัณฑิต ไชยดี
  | Create Date November 8, 2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */
-->
<div class="panel panel-primary">
    <div class="panel-heading">บันทึกบุคลากร [ ข้อมูลครอบครัว ] <?php echo $human['hr_thai_symbol']; ?><?php echo $human['hr_thai_name']; ?>&nbsp;&nbsp;<?php echo $human['hr_thai_lastname']; ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>
        <li>ข้อมูลครอบครัว</li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="insert-form" class="databox">

                    <div class="col-md-2 form-group">
                        <label class="control-label">คำนำหน้าชื่อ</label><span class="star">&#42;</span>
                        <input type="text" name="inHr03TitleName" id="inHr03TitleName" class="form-control" required />
                    </div>
                    <div class="col-md-5 form-group">
                        <label class="control-label">ชื่อ (ภาษาไทย)</label><span class="star">&#42;</span>
                        <input type="text" name="inHr03Name" id="inHr03Name" class="form-control" required/>
                    </div>
                    <div class="col-md-5 form-group">
                        <label class="control-label">นามสกุล (ภาษาไทย)</label><span class="star">&#42;</span>
                        <input type="text" name="inHr03Lastname" id="inHr03Lastname" class="form-control" required/>
                    </div>

                    <!--                    <div class="col-md-6 form-group">
                                            <label class="control-label">วัน/เดือน/ปี เกิด</label>
                                            <div class="form-group">
                                                <select name="inHr03DayBirthday" id="inHr03DayBirthday" class="my-select">
                                                    <option value="">--วันที่--</option>
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                                                </select>
                    <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                                <select name="inHr03MonthBirthday" id="inHr03DayBirthday" class="my-select">
                                                    <option value="">--เดือน--</option>
                    <?php foreach ($arr as $key => $value): ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                    
                                                </select>
                                                <select name="inHr03YearBirthday" id="inHr03DayBirthday" class="my-select">
                                                    <option value="">--พ.ศ.--</option>
                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>-->


                    <div class="col-md-6 form-group">
                        <label class="control-label">ความสัมพันธ์</label>
                        <input type="text" name="inHr03Relation" id="inHr03Relation" class="form-control" placeholder="บิดา,มารดา,....."/>
                    </div>
                    <!--                    <div class="col-md-3 form-group">
                                            <label class="control-label">ระดับการศึกษา</label>
                                            <select name="inHr03Education" id="inHr03Education" class="form-control">
                                                <option value="">---ข้อมูล---</option>
                    <?php foreach ($education as $edu): ?>
                                                        <option value="<?php echo $edu['education']; ?>"><?php echo $edu['education']; ?></option>
                    <?php endforeach; ?>
                                            </select>
                                        </div>-->
                    <div class="col-md-3 form-group">
                        <label class="control-label">อาชีพ</label>
                        <input type="text" name="inHr03Career" id="inHr03Career" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">สถานะภาพ</label>
                        <input type="text" name="inHr03Status" id="inHr03Status" class="form-control" placeholder="โสด,แต่งงาน,...."/>
                    </div>

                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-add"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>

        </div>

        <!--<div class="table-responsive" style="margin-top:30px;">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;text-align: center;">ที่</th>
                    <th  class="no-sort">ชื่อ-นามสกุล</th>
                    <!--<th class="no-sort">วัน/เดือน/ปี เกิด</th>-->
                    <th class="no-sort">ความสัมพันธ์</th>
                    <!--<th class="no-sort">ระดับการศึกษา</th>-->
                    <th class="no-sort">สถานะภาพ</th>
                    <th class="no-sort">อาชีพ</th>
                    <?php if ($this->session->userdata("") == ""): ?>
                        <th style="width:20%;" class="no-sort"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row; ?></td>
                        <td><?php echo $r['hr03_titlename']; ?><?php echo $r['hr03_name']; ?> <?php echo $r['hr03_lastname']; ?></td>
                        <!--<td><?php echo $r['hr03_day_birthday']; ?> <?php echo month_num($r['hr03_month_birthday']); ?> <?php echo $r['hr03_year_birthday']; ?></td>-->
                        <td style="text-align: center;"><?php echo $r['hr03_relationship']; ?></td>
                        <!--<td><?php echo $r['hr03_education']; ?></td>-->
                        <td style="text-align: center;"><?php echo $r['hr03_status']; ?></td>
                        <td style="text-align: center;"><?php echo $r['hr03_career']; ?></td>
                        <td style="text-align:center;">
                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                        </td>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->  
    </div>
</div>
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-03/' . $human['id']); ?>' class='btn btn-default btn-print' target='_blank'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</a>");
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-human-resources-part-03'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย');
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    
    // update datate
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-03'); ?>',
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr03TitleName').val(data.hr03_titlename);
                $('#inHr03Name').val(data.hr03_name);
                $('#inHr03Lastname').val(data.hr03_lastname);
//                $('#inHr03DayBirthday').val(data.hr03_day_birthday);
//                $('#inHr03MonthBirthday').val(data.hr03_month_birthday);
//                $('#inHr03YearBirthday').val(data.hr03_year_birthday);
                $('#inHr03Relation').val(data.hr03_relationship);
//                $('#inHr03Education').val(data.hr03_education);
                $('#inHr03Career').val(data.hr03_career);
                $('#inHr03Status').val(data.hr03_status);
                //
//                $('.btn-add').html("<i class='icon-save icon-large'></i> แก้ไข").removeClass('btn btn-success').addClass('btn btn-primary');
            }
        });
    });
    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-03'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
