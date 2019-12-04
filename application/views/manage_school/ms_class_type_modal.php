<!-- Modal -->
<div id="ms-class-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form id="class-type-insert-form" method="post">
                    <div class="row">
                        <div class="col-md-12  form-group">

                            <?php
                            $this->load->view('layout/my_school_filter');
                            ?>
                            <div class="row" id="MyClassType">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var edyear = "xxxx";
    function MyEdYearTest(e) {
        edyear = e.value
        $.ajax({
            url: "<?php echo site_url('Manage_school/get_school_type'); ?>",
            method: "post",
            data: {id: SchoolId, edyear: edyear},
            success: function (data) {
                $('#MyClassType').html(data);
            }
        });
    }

    //----- เลือก
    $("#MyClassType").on("click", ".btn-class-uncheck", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Manage_school/class_check'); ?>",
            method: "post",
            data: {id: uid, schId: SchoolId, edyear: edyear},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Manage_school/get_school_type'); ?>",
                    method: "post",
                    data: {id: SchoolId, edyear: edyear},
                    success: function (data) {
                        $('#MyClassType').html(data);
                    }
                });
            }
        });
    });

    //----- ยกเลิกเลือก
    $("#MyClassType").on("click", ".btn-class-check", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Manage_school/class_uncheck'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Manage_school/get_school_type'); ?>",
                    method: "post",
                    data: {id: SchoolId, edyear: edyear},
                    success: function (data) {
                        $('#MyClassType').html(data);
                    }
                });
            }
        });
    });
</script>