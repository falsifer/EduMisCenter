<!-- Modal -->
<div id="send-message-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="send-message-form">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">วัน/เดือน/ปี ส่ง</label>
                            <div class="form-control-static form-control"><?php echo datethai(date("Y-m-d")) ?></div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="ui-widget">
                                <label class="control-label">ผู้รับ</label>
                                <input type="text" name="inMessageRecieve" id="inMessageRecieve" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">เรื่อง</label>
                            <input type="text" name="inMessageTopic" id="inMessageTopic" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" style="height:150px;" name="inMessageDetail" id="inMessageDetail"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="form-group col-md-6">
                            <label class="control-label">เอกสารแนบ (ถ้ามี)</label>
                            <input type="file" name="inMessageAttach" id="inMessageAttach" class="filestyle" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $(function () {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $("#inMessageRecieve").autocomplete({
            source: availableTags
        });
    });

</script>