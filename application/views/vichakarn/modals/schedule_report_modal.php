<div id="schedule-report-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:80%">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">พิมพ์ตารางสอน</h4>
            </div>
            <div class="modal-body" style="padding:20px 40px;">
 
                <textarea class='editor'  name='inSchedule' id="inSchedule">
                    
                </textarea>
            </div>
        </div>

    </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 1123,
        width: 850,
        elements: "inSchedule",
        plugins: "print",
        toolbar: "print"
    });
</script>