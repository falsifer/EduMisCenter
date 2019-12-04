<div class="box">
    <div class="box-heading">โครงสร้างหลักสูตรแกนกลาง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php //if ($this->session->userdata('status') !== 'ผู้ดูแลระบบ'): ?>
        <li><?php echo anchor(site_url('development-course'), " สารสนเทศหลักสูตรการสอน"); ?></li>
        <?php //endif; ?>
        <li>โครงสร้างหลักสูตรแกนกลาง</li>
    </ul>
    <div class="box-body">
        <div class="panel-body">
            <!--            <div class="databox">
                            <div class="row" style="margin:auto;">
                                <div class="col-md-6">
            <?php $this->load->view('layout/my_school_filter', $data); ?>
            
                                </div>
                            </div>
                        </div>-->

            <div class="table-responsive"  >

                <table class="table table-hover table-striped table-bordered display" id="curriculumTab">
                    <thead>
                        <tr>
                            <th  class="no-sort" style="width:20%;">กลุ่มสาระ</th>
                            <th class="no-sort">&nbsp;</th>
                            <th class="no-sort">สาระการเรียนรู้</th>

                            <?php //if ($this->session->userdata("status") == "ผู้ดูแลระบบ"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                            <?php //endif; ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $group = '' ?>
                        <?php foreach ($rs as $r) : ?>
                            <?php if ($group !== $r['tb_group_learningcol_name']) {
                                ?>
                                <tr>
                                    <td>กลุ่มสาระ<?php echo $r['tb_group_learningcol_name']; ?></td>

                                    <?php
                                    $group = $r['tb_group_learningcol_name'];
                                } else {
                                    ?>
                                    <td>&nbsp;</td>
                                <?php } ?>
                                <td style="text-align:center;">สาระที่ <?php echo thaidigit($r['tb_group_learning_item_seq']); ?></td>
                                <!--<td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></button></td>-->
                                <td>
                                    <?php
                                    echo $r['tb_group_learning_item_content'];

                                    $std = $this->My_model->get_where_order('tb_standard_learning', array('tb_group_learning_item_id' => $r['itm_id']), 'tb_group_learning_item_id ASC');
                                    foreach ($std as $itm) {
                                        ?>

                                        <div style="padding-left:20px;">
                                            <?php echo 'มาตรฐาน ' . $itm['tb_standard_learning_code'] . " " . $itm['tb_standard_learning_content'] . nbs(4); ?>
                                            <a class="btn-std-edit" id="<?php echo $itm['id']; ?>"> แก้ไข</a> |
                                            <a class="btn-std-delete" id="<?php echo $itm['id']; ?>"> ลบ</a>
                                            <div style="padding:10px 20px;">

                                                <?php
                                                $kpi = $this->My_model->get_where_order('tb_kpi_standard_learning', array('tb_standard_learning_id' => $itm['id']), 'tb_kpi_standard_learning_level,tb_kpi_standard_learning_seq ASC');
                                                $group = "";
                                                if (count($kpi) > 0) {
                                                    ?>
                                                    <table class="table table-hover table-striped table-bordered display" >
                                                        <thead>
                                                        <th>ชั้น</th>
                                                        <th>ตัวชี้วัด</th>
                                                        <th>&nbsp;</th>
                                                        </thead>
                                                        <?php
                                                        foreach ($kpi as $k) {
                                                            if ($group != $k['tb_kpi_standard_learning_level']) {
                                                                $group = $k['tb_kpi_standard_learning_level'];
                                                                ?>

                                                                <tr>
                                                                    <td><?php echo $k['tb_kpi_standard_learning_level']; ?></td>
                                                                    <td><?php echo thaidigit($k['tb_kpi_standard_learning_seq']) . '.' . nbs(2) . $k['tb_kpi_standard_learning_content']; ?></td>
                                                                    <td>
                                                                        <i class="btn btn-kpi-edit icon-edit icon-large" id="<?php echo $k['id']; ?>" title="แก้ไข"></i> |
                                                                        <i class="btn btn-kpi-delete icon-trash icon-large" id="<?php echo $k['id']; ?>" title="ลบ"></i>
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                    <td><?php echo thaidigit($k['tb_kpi_standard_learning_seq']) . '.' . nbs(2) . $k['tb_kpi_standard_learning_content']; ?></td>
                                                                    <td>
                                                                        <i class="btn btn-kpi-edit icon-edit icon-large" id="<?php echo $k['id']; ?>" title="แก้ไข"></i> |
                                                                        <i class="btn btn-kpi-delete icon-trash icon-large" id="<?php echo $k['id']; ?>" title="ลบ"></i>
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php //if ($this->session->userdata('status') == 'ผู้ดูแลระบบ'): ?>
                                <td>

                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['itm_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['itm_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>

                                </td>
                                <?php //endif;  ?>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>                      
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $('#curriculumTab').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');
    //
    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    //if (status == "ผู้ดูแลระบบ") {
    $("div#curriculumTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert1'><i class='icon-plus icon-large'></i> เพิ่มสาระการเรียนรู้</button>");
    $("div#curriculumTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert2'><i class='icon-plus icon-large'></i> เพิ่มมาตรฐาน</button>");
    $("div#curriculumTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert3'><i class='icon-plus icon-large'></i> เพิ่มตัวชี้วัด</button>");
    //}

    $(".btn-insert1").on("click", function () {
        $("#dc-insert-modal").modal("show");
    });
    $(".btn-insert2").on("click", function () {
        $("#dc-std-insert-modal").modal("show");
    });
    $(".btn-insert3").on("click", function () {
        $("#dc-kpi-insert-modal").modal("show");
    });

    $(".btn-std-edit").on("click", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Develop_courses/dc_std_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#std_id").val(data.std_id);
                $("#inStdTbGroupLearningId").val(data.tb_group_learning_id);
                $("#inStdTbGroupLearningId").change();

                $("#inTbStandardLearningCode").val(data.tb_standard_learning_code);
                $("#inTbStandardLearningContent").val(data.tb_standard_learning_content);
                setTimeout(function () {
                    $("#inTbGroupLearningItemId").val(data.tb_group_learning_item_id);
                }, 300);


                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดมาตรฐานการเรียนรู้");
                $("#dc-std-insert-modal").modal("show");
            }
        });
    });
    $(".btn-std-delete").on("click", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Develop_courses/dc_std_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    );
    
    
    $(".btn-kpi-edit").on("click", function () {
    
        var uid = $(this).attr('id');
        alert(uid);
        $.ajax({
            url: "<?php echo site_url('Develop_courses/dc_kpi_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#kpi_id").val(data.kpi_id);
                $("#inTbKpiGroupLearningId").val(data.tb_group_learning_id);
                $("#inTbKpiGroupLearningId").change();
                $("#inTbKpiStandardLearningLevel").val(data.tb_kpi_standard_learning_level);
                $("#inTbKpiStandardLearningSeq").val(data.tb_kpi_standard_learning_seq);
                $("#inTbKpiStandardLearningContent").val(data.tb_kpi_standard_learning_content);
                setTimeout(function () {
                    $("#inTbKpiGroupLearningItemId").val(data.tb_group_learning_item_id);
                    $("#inTbKpiGroupLearningItemId").change();
                    setTimeout(function () {
                        $("#inTbKpiStandardLearningId").val(data.tb_standard_learning_id);
                    }, 300);
                }, 300);


                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดตัวชี้วัด");
                $("#dc-kpi-insert-modal").modal("show");
            }
        });
    });
    $(".btn-kpi-delete").on("click", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Develop_courses/dc_kpi_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    );


    // detail
    $("#curriculumTab").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('bd-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียด");
                $("#bd-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#curriculumTab").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Develop_courses/dc_gl_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#itm_id").val(data.id);
                $("#inTbGroupLearningId").val(data.tb_group_learning_id);
                $("#inTbGroupLearningItemSeq").val(data.tb_group_learning_item_seq);
                $("#inTbGroupLearningItemContent").val(data.tb_group_learning_item_content);



                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดสาระการเรียนรู้");
                $("#dc-insert-modal").modal("show");
            }
        });
    }
    );


    $("#curriculumTab").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Develop_courses/dc_gl_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    );


</script>
<?php $this->load->view("develop_courses/modals/dc_insert_gl"); ?>
<?php $this->load->view("develop_courses/modals/dc_insert_std"); ?>
<?php $this->load->view("develop_courses/modals/dc_insert_kpi"); ?>