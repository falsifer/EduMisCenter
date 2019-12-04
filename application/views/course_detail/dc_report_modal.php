<!-- Modal -->
<div id="dc-report-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="dc-report-form" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12" >
                                <textarea class="editor" id="dc-report-panel"></textarea>
                              
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 1123,
        width: 850,
       // elements: "dc-report-panel",
        plugins: "print",
        toolbar: "print",
        content_style: "table {border:1px solid #000;border-spacing: 0;border-collapse: collapse;padding:3px;}"
    });
</script>