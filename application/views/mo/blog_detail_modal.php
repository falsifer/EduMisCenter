<!-- Modal -->
<div id="blog-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'BlogDetail';
            $this->load->view('layout/my_school_print', $data);
            ?> 
            <style>
                .modal-body{
                    height: 500px;
                    overflow-y: auto;
                }
            </style>
            <div class="modal-body" style="padding:30px;" >
                <div id="BlogDetail" >


                </div> 

            </div>
        </div>
    </div>
</div>
<script>
    function LikeThisBlog(e) {
        $.ajax({
            url: "<?php echo site_url('Media_online/like_this_blog'); ?>",
            method: "POST",
            data: {id: $('#BlogId').val()},
            success: function (data) {
                $.ajax({url: "<?php echo site_url('Media_online/blog_detail'); ?>", method: "POST", data: {id: blogid}, success: function (data) {
                        $("#blog-detail-modal").modal("show");
                        $("#BlogDetail").html(data);
                    }});
            }
        });
    }
    function PinThisBlog(e) {
        $.ajax({
            url: "<?php echo site_url('Media_online/pin_this_blog'); ?>",
            method: "POST",
            data: {id: $('#BlogId').val()},
            success: function (data) {
                $.ajax({url: "<?php echo site_url('Media_online/blog_detail'); ?>", method: "POST", data: {id: blogid}, success: function (data) {
                        $("#blog-detail-modal").modal("show");
                        $("#BlogDetail").html(data);
                    }});
            }
        });
    }
</script>