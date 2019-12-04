<div class="container" style="padding-top:20px;">
    <div class="container" style="margin-bottom:30px;">
        <center>
            <?php echo img(array("src" => base_url() . "images/01.png", "style" => "width:130px;height:125px;")); ?><?php echo nbs(5); ?>
            <?php echo img(array("src" => base_url() . "images/02.png", "style" => "width:130px;height:125px;")); ?><?php echo nbs(5); ?>
            <?php if (!empty($logo)): ?>
                <?php echo img(array("src" => base_url() . "upload/" . $logo['org_logo'], "style" => "width:130px;height:125px;")); ?>
            <?php else: ?>
                <?php echo img(array("src" => base_url() . "images/no-logo.png", "style" => "width:130px;height:125px;")); ?>
            <?php endif; ?>
        </center>
    </div>
    <div class="row">
        <div class="login-box col-md-6 col-md-offset-3" style="padding-top:20px;padding-bottom:40px;">
            <?php echo form_open("#", array("class" => "form-horizontal", "id" => "login-form", "style" => "margin-top:30px;padding-top:30px;")); ?>
            <div class="form-group col-md-10">
                <div class="row">
                    <?php echo form_label("Username", "", array("class" => "control-label col-md-3")); ?>
                    <div class="col-md-9">
                        <?php echo form_input(array("type" => "text", "class" => "form-control", "name" => "inUsername", "id" => "inUsername")); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <?php echo form_label("Password", "", array("class" => "control-label col-md-3")); ?>
                    <div class="col-md-9">
                        <?php echo form_input(array("type" => "password", "class" => "form-control", "name" => "inPassword", "id" => "inPassword")); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <?php echo form_label(nbs(), "", array("class" => "control-label col-md-3")); ?>
                    <div class="col-md-9">
                        <?php echo form_submit(array("name" => "btnSubmit", "class" => "btn btn-success", "value" => "เข้าระบบ")); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <?php echo form_label(nbs(), "", array("class" => "control-label col-md-3")); ?>
                    <div class="col-md-9">
                        <?php echo $this->session->flashdata("message"); ?>
                    </div>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $("#login-form").on("submit", function (e) {
        e.preventDefault();
        var u = $("#inUsername").val();
        var p = $("#inPassword").val();
        if (u == "" || p == "") {
            alert("ต้องกรอก Username และ Password ให้ถูกต้อง");
            $("#inUsername").val("");
            $("#inPassword").val("");
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('setting/do_login'); ?>',
            method: 'post',
            data: {username: u, password: p},
            success: function (data) {
              //  location.href = "<?php echo site_url(); ?>";
            }
        });
    });
</script>


