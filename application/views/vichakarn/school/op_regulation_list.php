
<div class="box">
    <div class="box-heading">ระเบียบและแนวปฏิบัติ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระเบียบและแนวปฏิบัติเกี่ยวกับงานต่างๆ ของสถานศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ฝ่าย</th>
                        <th class="no-sort">หัวข้อ</th>

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
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_ed_op_regulation_title']; ?></button></td>
                        </tr>

                        <?php $row++; ?>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("vichakarn/modals/ed_op_regulation_modal"); ?>
<script>

    $("#room-insert-form").on("click", ".btn-clear", function () {
        $("#room-insert-form")[0].reset();
        CKEDITOR.instances.inEdOpRegulationContent.setData('');
    });

    $("#example").on("click", ".btn-detail", function (e) {
        e.preventDefault();
        var uid = $(this).attr('id');

        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/op_regulation_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
//                alert(data);
                $("h4.modal-title").text("ระเบียบและแนวปฏิบัติ : "+data.tb_ed_op_regulation_title);
                $("#opContent").html(data.tb_ed_op_regulation_content);
                $("#ed-op-modal").modal("show");
            }

        });
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
        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/op_regulation_add'); ?>",
            method: "post",
            data: {id: uid, inEdOpRegulationContent: data, inEdOpRegulationTitle: title},
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



</script>


