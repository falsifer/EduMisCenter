<!-- Modal -->
<div id="hr-absent-record-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">บันทึกเวลามาเรียน
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="col-md-12" id="RecordBody">

                        </div>
                        <div class="row">
                            <input type="hidden" name="daynow" id="daynow" value="" />                       
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="background-color:#CEE3F6;">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
        </div>
    </div>
</div>
<script>

    function clearcheck(checkboxElem) {
        var str = checkboxElem.id;
        var sta = str.substring(0, 1);
        var res = str.substring(1, 12);

        var status = "C";
        var recordid = $('#inBid' + res).val();
        var note = $('#note' + res).val();

        switch (sta) {
            case "c":
                $('#a' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "C";
                break;
            case "a":
                $('#c' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "A";
                break;
            case "s":
                $('#a' + res).prop('checked', false);
                $('#c' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "S";
                break;
            case "e":
                $('#a' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#c' + res).prop('checked', false);
                status = "E";
                break;
        }

        var daynow = $('#daynow').val();

        $.ajax({

            url: "<?php echo site_url('Hr_absent_record/hr_absent_record_update'); ?>",
            method: "post",
            data: {status: status, note: note, bid: recordid},
            success: function (data) {
                //alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                $.ajax({
                    url: "<?php echo site_url('Hr_absent_record/hr_absent_record_edit'); ?>",
                    method: "post",
                    data: {daynow: daynow},
                    success: function (data) {
                        $('#RecordBody').html(data);
//                            $('#stdclass').val(stdclass);
//                            $('#stdlevel').val(stdlevel);
                        $('#daynow').val(daynow);
                        $('#std-absent-record-modal').modal('show');
                    }
                });

            }
        });

    }

//insert
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('Homeroom/std_absent_record_update'); ?>",
            method: "post",
            data: $("#insert-form").serialize(), //new FormData(this),
//            cache: false,
//            contentType: false,
//            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

</script>