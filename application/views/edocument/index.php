
<div class="panel panel-primary">
    <div class="panel-heading">งานรับ-ส่งหนังสือ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานรับ-ส่ง หนังสือ</li>
    </ul>
    <div class="panel-body">
        <div class="panel-body">

            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#exTab1" data-toggle="tab"><i class="icon-inbox icon-large"></i> หนังสือเข้า</a></li>
                        <li><a href="#exTab2" data-toggle="tab"><i class="glyphicon glyphicon-send"></i> หนังสือออก</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="exTab1">
                    <div class='databox'>
                        <div class="row">
                            <div class="head">ลงทะเบียนหนังสือรับ</div>
                        </div>

                        <div class="panel-body">
                            <form id="Manual-insert-form" enctype="multipart/form-data">
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เลขที่ลงรับ</span>
                                        <input type="text" name="inEdocRCNo" id="inEdocRCNo" class="form-control" value="<?php echo isset($edoc_rc_no) ? $edoc_rc_no : ''; ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เลขที่เอกสาร</span>
                                        <input type="text" name="inEdocNo" id="inEdocNo" class="form-control" required autofocus/>

                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">ลงวันที่</span>
                                        <input type="text" autocomplete="off" name="inEdocDate" id="inEdocDate" class="form-control datepicker" placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">ประเภท</span>
                                        <select name="inEdocType" id='inEdocType'class="form-control" required>                                         
                                            <option value="บันทึกข้อความ">บันทึกข้อความ</option>
                                            <option value="หนังสือราชการภายนอก">หนังสือราชการภายนอก</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">การติดตาม</span>
                                        <select name="inEdocTackingType" id='inEdocTackingType'class="form-control" required>
                                            <?php
                                            $etype = $this->My_model->get_all('tb_e_document_tracking_type');
                                            foreach ($etype as $r):
                                                ?>
                                                <option value="<?php echo $r['edoc_tracking_type']; ?>"><?php echo $r['edoc_tracking_type']; ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">จาก</span>
                                        <input type="text" name="inEdocFrom" id="inEdocFrom" class="form-control" required/>

                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เรียน</span>
                                        <input type="text" name="inEdocTo" id="inEdocTo" class="form-control" required/>

                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เรื่อง</span>
                                        <input type="text" name="inEdocTopic" id="inEdocTopic" class="form-control" required/>

                                    </div>
                                </div>
                                <!--                                    <div class="col-md-6" style="margin-bottom:10px;">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">ปฏิบัติการ</span>
                                                                            <input type="text" name="inEdocResponsible" id="inEdocResponsible" class="form-control" required/>
                                
                                                                        </div>
                                                                    </div>-->
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เอกสารแนบ</span>
                                        <input type="file" name="inEdocFile" id="inEdocFile" class="filestyle" />
                                    </div>
                                    <span style="color:red;font-size: 0.75em">* ไฟล์รูปภาพ jpg, png หรือไฟล์ pdf ขนาดไม่เกิน 2MB</span>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <button class="btn btn-success form-control" ><i class="icon-save"></i> บันทึก</button>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                            <script>
                                $("#Manual-insert-form").on("submit", function (e) {
                                    e.preventDefault();
                                    //

                                    $.ajax({
                                        url: "<?php echo site_url('Edocument/edocument_manual'); ?>",
                                        method: "post",
                                        data: new FormData(this),
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        success: function (data) {
                                            $("#Manual-insert-form")[0].reset();
                                            location.reload();
                                        }
                                    });
                                });

                            </script>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="inBoxTab">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่รับ</th>
                                    <th class="no-sort">รายละเอียด</th>
                                    <th class="no-sort">เอกสารแนบ</th>
                                    <!--<th class="no-sort">การดำเนินการ</th>-->
                                    <th class="no-sort">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($edoc_inbox as $r): ?>
                                    <tr id="inbox<?php echo $r['id']; ?>">
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่รับเข้า :</span>   <?php echo $r['edoc_rc_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ประเภท :</span>   <?php echo $r['edoc_type'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">การติดตาม :</span>   <?php echo $r['edoc_tracking_type'] ?>
                                            </div>
                                            <!--                                                <div class="col-md-12">
                                                                                                <span style="font-weight:bold">ปฏิบัติ :</span>   <?php echo $r['edoc_responsible'] ?>
                                                                                            </div>-->
                                            <div class="col-md-12">

                                                <span style="font-weight:bold">วันที่รับ :</span>   <?php
                                                if (isset($r['edoc_rc_date'])) {
                                                    echo shortdate($r['edoc_rc_date']);
                                                }
                                                ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่หนังสือ :</span>   <?php echo $r['edoc_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ลงวันที่ :</span>   <?php echo shortdate($r['edoc_date']) ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">จาก :</span>   <?php echo $r['edoc_from'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรียน :</span>   <?php echo $r['edoc_to'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรื่อง :</span>   <?php echo $r['edoc_topic'] ?>
                                            </div>

                                        </td>
                                        <td style="text-align:center;">

                                            <?php
                                            if ($r['edoc_status'] == "หนังสือใหม่") {
                                                if (file_exists("upload/" . $r['edoc_file']) && !empty($r['edoc_file'])):
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>upload/<?php echo $r['edoc_file']; ?>" target="_blank">
                                                        <img src="<?php echo base_url(); ?>images/data-folder.png" />
                                                    </a>
                                                    <?php
                                                else:
                                                    echo img('images/gray-folder.png');
                                                endif;

                                                //echo "<span style='color:red'><i class='icon-folder-close' title='" . $r['edoc_status'] . "'></i></span>";
                                            }
                                            ?>
                                        </td>

                                                <!--<td style="text-align:center;"><button type="button" class="btn btn-primary btn-forward" id="<?php echo $r['id'] ?>" tracking="<?php echo $r['edoc_tracking_type'] ?>" permission="<?php echo $r['edoc_psermission'] ?>"><i class="icon-inbox"></i> แทงเรื่อง</button></td>-->

                                        <td style="text-align:center;">
                                            <button type="button" class="btn btn-warning" onclick="editEdoc(<?php echo $r['id'] ?>)"><i class="icon-pencil"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-danger" onclick="delEdoc(<?php echo $r['id'] ?>)" <i class="icon-trash"></i> ลบ</button>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade in " id="exTab2">

                    <form id="Send-insert-form" enctype="multipart/form-data"> 
                        <div class='databox'>
                            <div class="row">
                                <div class="head">งานส่งหนังสือออก</div>
                            </div>

                            <div class="panel-body">
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เลขที่ส่งออก</span>
                                        <input type="text" name="outEdocSendNo" id="outEdocSendNo" value="<?php echo $edoc_send_no; ?>" class="form-control" required/>

                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เลขที่เอกสาร</span>
                                        <input type="text" name="outEdocNo" id="outEdocNo" class="form-control" required autofocus/>

                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">ลงวันที่</span>
                                        <input type="text"  autocomplete="off"name="outEdocDate" id="outEdocDate" class="form-control datepicker" placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">ประเภท</span>
                                        <select name="outEdocType" id='outEdocType'class="form-control" required>                                         
                                            <option value="บันทึกข้อความ">บันทึกข้อความ</option>
                                            <option value="หนังสือราชการภายนอก">หนังสือราชการภายนอก</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เรียน</span>
                                        <input type="text" name="inEdocTo" id="inEdocTo" class="form-control" required/>

                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เรื่อง</span>
                                        <input type="text" name="inEdocTopic" id="inEdocTopic" class="form-control" required/>

                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">เอกสารแนบ</span>
                                        <input type="file" name="outEdocFile" id="outEdocFile" class="filestyle" />
                                    <span style="color:red;font-size: 0.75em">* ไฟล์รูปภาพ jpg, png หรือไฟล์ pdf ขนาดไม่เกิน 2MB</span>
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="box">
                                        <legend class="legend-heading" style="padding:10px;"><i class="icon-user icon-large"></i> รายชื่อผู้รับหนังสือ </legend>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-4" style="margin-bottom:10px;">
                                                    <ul class="list-group">
                                                        <li class="list-group-item active"><input type="checkbox" name="selectManager" id="selectManager" value="กองการศึกษา" />  สำนักการ/กองการศึกษา</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-8" style="margin-bottom:10px;">
                                                    <ul class="list-group">
                                                        <li class="list-group-item active"><input type="checkbox" id="selectSchool" />  โรงเรียนในสังกัด</li>
                                                        <?php
                                                        foreach ($school as $r):
                                                            ?>
                                                            <li class="list-group-item"><input type="checkbox" name="school[]" id="school[]" value='<?php echo $r['sc_thai_name'] ?>'/> <?php echo $r['sc_thai_name'] ?></li>
                                                            <!--<input type="text" value="<?php echo $r['sc_thai_name'] ?>" id=''/>-->
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </ul>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12" style="margin:10px 0px;">
                                            <button type='submit' class="btn btn-success form-control"><i class="glyphicon glyphicon-send"></i> บันทึกส่งออก</button>
                                        </div>
                                    </div>


                                </div>



                            </div>

                        </div>


                    </form>
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered display" id="outBoxTab">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่ส่ง</th>
                                    <th class="no-sort">รายละเอียด</th>
                                    <th class="no-sort">เอกสารแนบ</th>
                                    <th class="no-sort">ส่งถึง</th>
                                    <!--<th class="no-sort">สถานะ</th>-->

                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($edoc_outbox as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่ส่งออก :</span>   <?php echo $r['edoc_send_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ประเภท :</span>   <?php echo $r['edoc_type'] ?>
                                            </div>
                                            <!--                                                            <div class="col-md-12">
                                                                                                            <span style="font-weight:bold">การติดตาม :</span>   <?php echo $r['edoc_tracking_type'] ?>
                                                                                                        </div>-->
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่หนังสือ :</span>   <?php echo $r['edoc_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ลงวันที่ :</span>   <?php echo shortdate($r['edoc_date']) ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรียน :</span>   <?php echo $r['edoc_to'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรื่อง :</span>   <?php echo $r['edoc_topic'] ?>
                                            </div>

                                        </td>
                                        <td style="text-align:center;">

                                            <?php
                                            if ($r['edoc_status'] == "หนังสือใหม่") {
                                                if (file_exists("upload/" . $r['edoc_file']) && !empty($r['edoc_file'])):
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>upload/<?php echo $r['edoc_file']; ?>" target="_blank">
                                                        <img src="<?php echo base_url(); ?>images/data-folder.png" />
                                                    </a>
                                                    <?php
                                                else:
                                                    echo img('images/gray-folder.png');
                                                endif;

                                                //echo "<span style='color:red'><i class='icon-folder-close' title='" . $r['edoc_status'] . "'></i></span>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align:center;"><?php echo $r['edoc_to_department']; ?></td>

                                                            <!--<td style="text-align:center;"><button type="button" class="btn btn-primary" id="<?php echo $r['id'] ?>"><i class="icon-inbox"></i> ตรวจสอบ</button></td>-->

                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $("#Send-insert-form").on("submit", function (e) {
                        e.preventDefault();
                        //

                        $.ajax({
                            url: "<?php echo site_url('Edocument/edocument_send_online'); ?>",
                            method: "post",
                            data: new FormData(this),
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                $("#Manual-insert-form")[0].reset();
                                location.reload();
                            }
                        });
                    });

                </script>
            </div>

        </div>


    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
<?php
$tabName = "inBoxTab";
$title = "งานรับ-ส่ง หนังสือ :: หนังสือเข้า";
$colStr = "0,1,2";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>
//        $('#inBoxTab').DataTable({
//            "responsive": true,
//            "stateSave": true,
//            "bSort": false,
//            "ordering": true,
//            columnDefs: [{
//                    orderable: false,
//                    targets: "no-sort"
//                }],
//            "language": {
//                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                "zeroRecords": "## ไม่มีข้อมูล ##",
//                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                "infoEmpty": "",
//                "infoFiltered": "",
//                "sSearch": "ระบุคำค้น",
//                "sPaginationType": "full_numbers"
//            }
//        });

<?php
$tabName = "outBoxTab";
$title = "งานรับ-ส่ง หนังสือ :: หนังสือออก";
$colStr = "0,1,2";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>

//        $('#outBoxTab').DataTable({
//            "responsive": true,
//            "stateSave": true,
//            "bSort": false,
//            "ordering": true,
//            columnDefs: [{
//                    orderable: false,
//                    targets: "no-sort"
//                }],
//            "language": {
//                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                "zeroRecords": "## ไม่มีข้อมูล ##",
//                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                "infoEmpty": "",
//                "infoFiltered": "",
//                "sSearch": "ระบุคำค้น",
//                "sPaginationType": "full_numbers"
//            }
//        });
//        $('.sorting_asc').removeClass('sorting_asc');
    //
    $(".btn-inbox").on("click", function () {
        location.href = "<?php echo site_url('go-to-inbox'); ?>";
    });

    $('#inBoxTab').on("click", ".btn-forward", function (e) {
        var eid = $(this).attr('id');
        var permission = $(this).attr('permission');
        var tracking = $(this).attr('tracking');
        var tmp = $('#inbox' + eid).find('td:last-child').remove();
        $('#inboxView').html($('#inbox' + eid).html());
        $('#inPermission').val(permission);
        $('#inTracking').val(tracking);
        $('#edoc-forward-modal').modal('show');
        $('#inbox' + eid).append(tmp);
    });


    $('#selectSchool').change(function () {
        var checked_status = this.checked;
        $("input[name='school[]']").each(function () {
            this.checked = checked_status;
        });
    });
    
    
    function editEdoc(id){
        var uid = id;
        $.ajax({
                url: '<?php echo site_url('Edocument/edit_inbox'); ?>',
                method: 'post',
                data: {id: uid},
                dataType: 'json',
                success: function (data) {
                    $('#id').val(data.id);
                    $('#inEdocRCNo').val(data.edoc_rc_no);
                    $('#inEdocNo').val(data.edoc_no);
                    $('#inEdocDate').val(data.edoc_date);
                    $('#inEdocType').val(data.edoc_type);
                    $('#inEdocTackingType').val(data.edoc_tracking_type);
                    $('#inEdocFrom').val(data.edoc_from);
                    $('#inEdocTo').val(data.edoc_to);
                    $('#inEdocTopic').val(data.edoc_topic);
                    $('#inEdocFile').val(data.edoc_file);

                }
            });
    }
    
    function delEdoc(id){
        var uid =id;
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Edocument/delete_inbox'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

</script>
<?php $this->load->view("edocument/edoc_forward_modal"); ?>