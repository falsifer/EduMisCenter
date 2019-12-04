<div class="box">
    <div class="box-heading">ครูประจำชั้น</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('ed-activity-planing'), " การวางแผนงานวิชาการ"); ?></li>-->
        <li>ครูประจำชั้น</li>
    </ul>
    <div class="box-body">
        <div class="databox">
            <form method="post" id="room-insert-form">
                <div class="row">
                    <?php
                    $data['class'] = 'Y';
                    $data['room'] = 'Y';
                    ?>
                    <?php $this->load->view('layout/my_school_filter', $data); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="taTab">
                        <thead>
                            <tr>
                                <th style="width:40px;">ที่</th>
                                <th class="no-sort">ชื่อ</th>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <th style="width:13%;" class="no-sort">คัดเลือก</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = 1;
                            ?>
                            <?php foreach ($hr as $r): ?>


                                <tr>
                                    <td style="text-align: center;"><?php echo $row; ?></td>
                                    <td><?php echo $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname']; ?></td>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <td style="text-align:center;">

                                            <label class="containerzz">
                                                <input type="checkbox" name ="hr[]" id="hr[]" value="<?php echo $r['id']; ?>" >
                                                <span class="checkmark"></span>
                                            </label>

                                            <!--<input type="checkbox" name ="hr[]" id="hr[]" value="<?php echo $r['id']; ?>" />-->
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <?php $row++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin-top:20px;">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button>
                    </center>
                </div>
                <input type="hidden" name="id" id="id" />
            </form>
        </div>

    </div>
   <?php $this->load->view('layout/my_school_footer'); ?>
</div>


<script>


    $("#room-insert-form").on("click", ".btn-clear", function () {
        $("#room-insert-form")[0].reset();
    });

    $("#room-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/ed_homeroom_add'); ?>",
            method: "post",
            data: $("#room-insert-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#ed-teacher-modal').modal('hide');
                location.href = "<?php echo site_url('ed-homeroom/'); ?>";
            }

        });
    });



    function MyRoomOnChange(e) {
        var MyR = $("#MyRoom").val();
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/homeroom_list'); ?>",
            method: "post",
            data: {MyR: MyR},
            success: function (data) {
                $('#taTab').html(data);

            }
        });
    }


</script>