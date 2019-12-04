
<div class="box">
    <div class="box-heading">การจัดทำระเบียบและแนวปฏิบัติ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การจัดทำระเบียบและแนวปฏิบัติเกี่ยวกับงานด้านต่างๆ ของสถานศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="databox">
            <form method="post" id="room-insert-form">
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">ฝ่าย</label><span class="star">&#42;</span>
                        <select name="inDivision" id="inDivision" class="form-control">
                            <option>---เลือกข้อมูล---</option>
                            <?php
                            foreach ($division as $r) {
                                echo "<option value='" . $r['id'] . "'>" . $r['tb_division_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label">หัวข้อ</label><span class="star">&#42;</span>
                        <input type="text" name="inEdOpRegulationTitle" id="inEdOpRegulationTitle" class="form-control" value="" required />
                    </div>

                    <div class="col-md-12">
                        <label class="control-label">เนื้อหา</label><span class="star">&#42;</span>
                        <!--<textarea class='editor' name='inEdOpRegulationContent' id="inEdOpRegulationContent">-->
                        <!--</textarea>-->
                        <textarea name="inEdOpRegulationContent" id="inEdOpRegulationContent" toolbar="Mytoolbar1">
                        </textarea>
                    </div>
                </div>


                <div class="row" style="margin-top:20px;">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button>
                    </center>
                </div>
                <input type="hidden" name="id" id="id" />
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ฝ่าย</th>
                        <th class="no-sort">หัวข้อ</th>
                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = 1;
                    ?>
                    <?php
                    foreach ($op as $r):
                        $div = $this->My_model->get_where_row('tb_division', array('id' => $r['tb_division_id']));
                        ?>

                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td style="text-align: center;"><?php echo isset($div['tb_division_name']) ? $div['tb_division_name'] : ''; ?></td>
                            <td><?php echo $r['tb_ed_op_regulation_title']; ?></td>
                            <td style="text-align: center;">
                                <button class="btn btn-warning btn-edit col-md-6" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                <button class="btn btn-danger btn-delete col-md-6"  id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                            </td>
                        </tr>

                        <?php $row++; ?>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>

    $("#room-insert-form").on("click", ".btn-clear", function () {
        $("#room-insert-form")[0].reset();
        CKEDITOR.instances.inEdOpRegulationContent.setData('');
    });

    $("#example").on("click", ".btn-delete", function (e) {
        e.preventDefault();
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');

        if (status) {
            //
            $.ajax({
                url: "<?php echo site_url('school/Vichakarn/op_regulation_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }

            });
        }
    });

    $("#example").on("click", ".btn-edit", function (e) {
        e.preventDefault();
        var uid = $(this).attr('id');

        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/op_regulation_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inDivision").val(data.tb_division_id);
                $("#inDivision").focus();
                $("#inEdOpRegulationTitle").val(data.tb_ed_op_regulation_title);
                CKEDITOR.instances.inEdOpRegulationContent.setData(data.tb_ed_op_regulation_content);
            }

        });
    });


    $("#room-insert-form").on("submit", function (e) {
        e.preventDefault();

        var data = CKEDITOR.instances.inEdOpRegulationContent.getData();
        var uid = $("#id").val();
        var title = $("#inEdOpRegulationTitle").val();
        var division = $("#inDivision").val();
        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/op_regulation_add'); ?>",
            method: "post",
            data: {id: uid, inEdOpRegulationContent: data, inEdOpRegulationTitle: title,inDivision:division},
            success: function (data) {
                $("#room-insert-form")[0].reset();
                location.href = "<?php echo site_url('operational-regulation'); ?>";
            }

        });
    });

    $('#example').DataTable({
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
        },
    });

    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                         ?>";
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-room-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });

// detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/op_regulation_view'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {

            }
        });
    });

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('inEdOpRegulationContent');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>