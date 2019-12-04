<!-- Modal -->
<div id="my-loading" class="modal fade" role="dialog" style=" top: 30%; margin:auto;" >
    <div class="modal-dialog " role="document" style="width:17%;">
        <div class="modal-content">
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="loader">
                            <span class="pull-center">
                                <font color="blue" style="margin-top: 50px;">
                                กำลังโหลดข้อมูล ... 
                                </font>
                                <?php echo img(array('src' => base_url() . 'images/system/loading.gif', 'style' => 'width:50px;')); ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function MyStartLoading() {
        $("#my-loading").modal("show");
    }
    function MyEndLoading() {
        $("#my-loading").modal("hide");
    }
</script>