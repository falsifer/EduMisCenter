<?php
if ($this->session->userdata("department") != "กองการศึกษา") {
    $this->load->view('layout/right_menu');
}
?>

</div> <!-- container-fouid-->
<div style="clear:both;height:150px;"></div>
<div class="footer hidden-sm hidden-xs">
    <div class="col-md-4">
        <p>eSchool Version 4.0 (2018)</p>
    </div>
    <div class="col-md-8">
        <!-- show user detail -->
        <?php if ($this->session->userdata('status') != ''): ?>
            <span class='pull-right' style="font-size:0.8em !important;">
                <?php echo img('images/user.png'); ?> 
                <?php if ($this->session->userdata("status") != "ผู้ดูแลระบบ"): ?>
                    <?php echo $this->session->userdata('name'); ?>/mID:<?php echo $this->session->userdata('member_id'); ?>/<?php echo $this->session->userdata('status'); ?> / สังกัด<?php echo $this->session->userdata('department'); ?>/<?php echo $this->session->userdata('localgov'); ?>
                <?php else: ?>
                    <?php echo $this->session->userdata('name'); ?> -> <?php echo $this->session->userdata('status'); ?> อยู่ในระบบ
                <?php endif; ?>
                <button class="btn btn-danger btn-sm btn-turnoff"><i class="icon-power-off"></i></button>
            </span>
        <?php endif; ?>
    </div>
</div>
</div>
<?php $this->load->view('layout/my_loading'); ?>
</body>
</html>
<script>
    $(".btn-turnoff").click(function () {
        var status = confirm('ต้องการออกจากระบบจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Setting/logout'); ?>',
                method: "post",
                data: {state: status},
                success: function (data) {

                    location.href = "<?php echo site_url(); ?>";
                }
            });
        }
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });


        $('#search_menu').keyup(function () {

            // Search text
            var text = $(this).val();

            // Hide all content class element
            $('.leftmenu').hide();

            // Search and show
            $('.leftmenu:contains("' + text + '")').show();

        });
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss').on('click', function () {
                alert('111');
                $('#sidebar').removeClass('active');
                $('.side-overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.side-overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
        
        function closeMenu(){
            $('#sidebar').removeClass('active');
                $('.side-overlay').removeClass('active');
        }
        
        
    </script>