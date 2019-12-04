<div id="insert-subtitle-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ประเด็นการนิเทศ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="insert-subtitle-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">งาน</label>
                                    <select name="inDivision2" id="inDivision2" class="form-control" disabled>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($division as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_division_name']; ?></option>
                                        <?php endforeach; ?>                                    
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">หัวข้อการนิเทศ</label>
                                    <select name="inSupervisionTitleDetail1" id="inSupervisionTitleDetail1" class="form-control" disabled>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($title as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_supervision_title_detail']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group col-md-12">
                                    <label class="control-label">ประเด็นการนิเทศ</label><span class="star">&#42;</span>
                                    <input type="text" name="inSupervisionSubTitleDetail" id="inSupervisionSubTitleDetail" class="form-control" required autofocus />
                                </div>
                            </div>


                            <div class="row">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                            </div>
                            <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="inSupervissionTitleId1" id="inSupervissionTitleId1" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="example2">
                        <thead>
                            <tr>
                                <th class="no-sort">ที่</th>
                                <th class="no-sort">ประเด็น</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $('#insert-subtitle-modal').on('show.bs.modal', function () {
        var uid = $('#inSupervissionTitleId1').val();

        $.ajax({
            url: "<?php echo site_url('Supervision/get_title_view'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                
                    $('#example2').html(data);
                
            }

        });
    });
    $("#insert-subtitle-form").on("submit", function (e) {
        e.preventDefault();
        alert($('inSupervissionTitleId').val());
        //
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_subtitle_add'); ?>",
            method: "post",
            data: $("#insert-subtitle-form").serialize(),
            success: function (data) {
                $("#inSupervisionSubTitleDetail").val('');
                $("#id").val('');
                $('#insert-subtitle-modal').modal('show');
            }

        });
    });

    // delete data;
    $("#example2").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Supervision/supervision_subtitle_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    $('#insert-subtitle-modal').modal('show');
                }
            });
        }
    });

    // edit data;

    
    $("#example2").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_subtitle_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $("#inSupervisionSubTitleDetail").val(data.tb_supervision_sub_title_detail);
                $("#inSupervisionSubTitleDetail").focus();
                $("#inSupervisionSubTitleDetail").select();
        //$('#insert-subtitle-modal').modal('show');

            }
        });
    });





</script>