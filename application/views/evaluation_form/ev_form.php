<div class="box">
    <div class="box-heading">แบบประเมิน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ev-base', "รายชื่อผู้รับการประเมิน"); ?></li>
        <li>แบบประเมิน</li>
    </ul>
    <div class="box-body">
        <form method="post" id="insert-form">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">หัวข้อการประเมิน</th>
                            <th class="no-sort">ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['ev_basename']; ?></button></td>
                                <td>
                                    <label class="Checkbox"><input type="radio" name="optradio<?php echo $row; ?>"  checked><?php echo $r['ev_subname1']; ?></label>
                                    <label class="Checkbox"><input type="radio" name="optradio<?php echo $row; ?>" ><?php echo $r['ev_subname2']; ?></label>
                                    <label class="Checkbox"><input type="radio" name="optradio<?php echo $row; ?>" ><?php echo $r['ev_subname3']; ?></label>
                                    <label class="Checkbox"><input type="radio" name="optradio<?php echo $row; ?>" ><?php echo $r['ev_subname4']; ?></label>
                                    <label class="Checkbox"><input type="radio" name="optradio<?php echo $row; ?>" ><?php echo $r['ev_subname5']; ?></label>                                
                                </td>                            
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
            </div>
        </form>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        alert($('input.optradio1').name);
//    $.ajax({        if ($('input.optradio1').is(':checked')) {
//    alert("asdasdasd");
//    }; });
    });
</script>
