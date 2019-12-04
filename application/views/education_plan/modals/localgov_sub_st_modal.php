<!-- Modal -->
<div id="localgov-sub-st-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" class="form-horizontal" style="padding-top:30px;padding-bottom:30px;">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label col-md-3">ชื่อยุทธศาตร์ย่อย</label>
                            <div class="col-md-9">
                                <input type="text" name="inLocagovSubSt" id="inLocalgovSubSt" class="form-control" autofocus required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#inProvinceSt").on("change", function () {
        var uid = $("#inProvinceSt").val();
        if (uid != "") {
            $.ajax({
                url: "<?php echo site_url('get-localgov-dropdown'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    $("#inLocalgovSt").html(data);
                }
            });
        }
    });
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-localgov-sub-strategies'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>