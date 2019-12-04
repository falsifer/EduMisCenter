<div id="supervision-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แบบฟอร์มการนิเทศ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="supervision-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">งาน</label>
                                    <select name="inDivision3" id="inDivision3" class="form-control" disabled>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($division as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_division_name']; ?></option>
                                        <?php endforeach; ?>                                    
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">หัวข้อการนิเทศ</label>
                                    <select name="inSupervisionTitleDetail2" id="inSupervisionTitleDetail2" class="form-control" disabled>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($title as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_supervision_title_detail']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            
                            <div class='row'>
                                <label class="control-label">ผู้รับการนิเทศ</label>
                            </div>
                            <div class='row'>
                                <div class="col-md-6 form-group">
                                <select name="inDepartment" id="inDepartment" class="form-control">
                                    <option value="">---เลือกหน่วยงาน---</option>
                                    <?php foreach ($school as $sc): ?>
                                        <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <select name="member" id="member" class="form-control">
                                    <option value="">---เลือกผู้รับการนิเทศ---</option>
           
                                </select>
                                </div>
                            </div>
                            <input type="hidden" name="inSupervisionTitleType" id="inSupervisionTitleType" />


                            <div class='row'>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered display" id="tab01">

                                    </table>
                                </div>
                            </div>


                            <div class="row">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                            </div>
                            <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="inSupervissionTitleId" id="inSupervissionTitleId" />

                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $("#supervision-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_rating_add'); ?>",
            method: "post",
            data: $("#supervision-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#supervision-modal').modal('hide');
            }

        });
    });

    // delete data;
    $("#example3").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Supervision/supervision_rating_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    $('#insert-subtitle-modal').modal('show');
                }
            });
        }
    });

    // edit data;


    $("#example3").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_rating_edit'); ?>",
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



    $('#inDepartment').change(function(){
        var school = $('#inDepartment').val();
        if(school!=''){
            $.ajax({
                url: "<?php echo site_url('Supervision/member'); ?>",
            method: "post",
            data: {school: school},
            success: function (data) {
                
                $('#member').html(data);
            }
            });
        }
    });

</script>