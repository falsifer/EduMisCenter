<div class="box">
    <!--    <div class="box-heading"></div>-->
    <!--    <ul class="breadcrumb" style="margin-bottom: 0px;">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        </ul>-->
    <div class="box-body" >
        <div style='margin-top:50px;'>
            
        </div>
        <?php
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>
        <div id='StudentSelfScoreBody' style='margin-top:50px;'>

        </div>


    </div>    
    <?php // $this->load->view('layout/my_school_footer'); ?>
</div>
<script>

    var Term = "";
    var EdYear = "";
    function MyTermOnChange(e) {
        Term = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
        MyStdFilter();
    }

    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('Student_self/get_student_self_score_by_filter'); ?>',
            method: 'post',
            data: {term: Term, edyear: EdYear},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#StudentSelfScoreBody").html(data);

            }

        });
    }
</script>