<!-- Modal -->

<div id="project-kpi-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post" class="form-horizontal">
                    <div class="row" style="padding-top:30px;padding-bottom:30px;">
                        <div class="col-md-12 form-group">
                            <label class="control-label col-md-2">ลำดับ</label>
                            <div class="col-md-2">
                                <input type="text" name="inProcessSeq" id="inProcessSeq" class="form-control" required autofocus/>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label col-md-2">กิจกรรม</label>
                            <div class="col-md-10">
                                <input type="text" name="inProcess"  id="inProcess" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label col-md-2">เริ่ม</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="inProcessStart" id="inProcessStart" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                            <label class="control-label col-md-2">สิ้นสุด</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="inProcessEnd" id="inProcessEnd" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label col-md-2">ผู้รับผิดชอบ</label>
                            <div class="col-md-10">
                                <input type="hidden" name="inResponsible" id="inResponsible" class="form-control autocomplete" required />
                                <section>
                                    <input class="magicsearch" style="height: 40px !important;" name="inResponsibleTmp" id="inResponsibleTmp" placeholder="ค้นหาชื่อ สามารถใส่ได้หลายชื่อ...">
                                </section>

                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <center>

                                <button type="submit" class="btn btn-success">บันทึก</button>

                            </center>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    var tmpGL = "";
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $('#inResponsible').val(tmpGL);
        $.ajax({
            url: "<?php echo site_url('EducationPlan/project_plan_timeline_add'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
                alert("บันทึกเรียบร้อย...");
            }
        });
    });



    // Autocomplete จากการดึงข้อมูลจาก DB 
    $.ajax({
        url: "<?php echo site_url('EducationPlan/project_plan_responsible'); ?>",
        success: function (data) {
            var dataSource = data;
            $('#inResponsibleTmp').magicsearch({
                dataSource: dataSource,
                fields: ['hr_thai_symbol', 'hr_thai_name', 'hr_thai_lastname'],
                id: 'id',
                format: '%hr_thai_symbol% %hr_thai_name%  %hr_thai_lastname%',
                multiple: true,
                multiField: 'hr_thai_name',
                multiStyle: {
                    space: 5,
                    width: 80
                },
                success: function ($input, data) {
                    tmpGL = tmpGL + data.hr_thai_symbol + ' ' + data.hr_thai_name + ' ' + data.hr_thai_lastname + ',';
                    return true;
                },
                afterDelete: function afterDelete($input, data) {
                    var tmp = data.hr_thai_symbol + ' ' + data.hr_thai_name + ' ' + data.hr_thai_lastname + ',';
                    tmpGL = tmpGL.replace(tmp, "");
                    return true;
                }
            });

        }
    });



</script>