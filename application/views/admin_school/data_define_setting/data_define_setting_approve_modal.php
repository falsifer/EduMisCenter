<!-- Modal -->
<div id="data-define-setting-approve-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row" id="ApproveBody">

                    <div class="col-md-5 col-md-offset-1">
                        <table class="table table-hover table-striped table-bordered display" id="PositionTable">                        
                            <thead>
                                <tr>
                                    <th style="width:10%; text-align: center"class="no-sort">ที่</th>
                                    <th style="width:30%; text-align: center"class="no-sort">เลขที่ตำแหน่ง</th>
                                    <th style="width:40%; text-align: center"class="no-sort">ชื่อตำแหน่ง</th>
                                    <th style="width:20%; text-align: center"class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="PositionBody">
                                <?php $i = 1; ?>
                                <?php foreach ($rs as $r): ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                        <td style="text-align: center;"><?php echo $r['data_group']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['data_name']; ?></td>

                                        <td style="text-align: center;">  
                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" onclick="EditModal(this)"><i class="icon-pencil icon-large"></i> แก้ไข</button>                                                                                                                                                                                                                                     
                                            <button type="button" class="btn btn-primary btn-approve" id="<?php echo $r['id']; ?>" onclick="ApproveModal(this)"><i class="icon-check icon-large"></i> กำหนดการอนุมัติ</button>                                                                                                                                                                                                                                     
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table> 
                    </div>

                    <div class="col-md-6">
                        <table class="table table-hover table-striped table-bordered display" id="example">                        
                            <thead>
                                <tr>
                                    <th style="width:10%; text-align: center"class="no-sort">ที่</th>
                                    <th style="width:20%; text-align: center"class="no-sort">เลขที่ตำแหน่ง</th>
                                    <th style="width:20%; text-align: center"class="no-sort">ชื่อตำแหน่ง</th>
                                    <th style="width:50%; text-align: center"class="no-sort">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody id="PositionBody">
                                <?php $i = 1; ?>
                                <?php foreach ($rs as $r): ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                        <td style="text-align: center;"><?php echo $r['data_group']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['data_name']; ?></td>

                                        <td style="text-align: center;">  
                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" onclick="EditModal(this)"><i class="icon-pencil icon-large"></i> แก้ไข</button>                                                                                                                                                                                                                                     
                                            <button type="button" class="btn btn-primary btn-approve" id="<?php echo $r['id']; ?>" onclick="ApproveModal(this)"><i class="icon-check icon-large"></i> กำหนดการอนุมัติ</button>                                                                                                                                                                                                                                     
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('Admin_school/hr_position_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

    function SelectThis(e) {
//        alert(e.id);
        $.ajax({
            url: "<?php echo site_url('Admin_school/data_define_setting_approve_insert_pos'); ?>",
            method: "POST",
            data: {PositionId: e.id, DefineId: $('#inDataDefineId').val()},
            success: function (data) {

                $.ajax({url: "<?php echo site_url('Admin_school/data_define_setting_approve'); ?>", method: "POST", data: {id: DataDefineID}, success: function (data) {
                        $('#ApproveBody').html(data);
                    }});
            }
        });
    }
</script>