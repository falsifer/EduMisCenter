<!-- Modal -->
<div id="cr-std-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div  style="padding:30px;height: 80% !important;overflow: auto;" >
                <div class="row" id="std-register-course-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function RegisteredDelete(e) {
        $.ajax({
            url: "<?php echo site_url('Course_register/registered_delete'); ?>",
            method: "post",
            data: {id: e.id},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Course_register/cr_std_modal'); ?>",
                    method: "post",
                    data: {id: stdid},
                    success: function (data) {
                        $("#std-register-course-body").html(data);
                    }
                });
            }
        });

    }
</script>