<div class="box">
    <div class="box-heading">การดูแลอาคารสถานที่และสภาพแวดล้อม</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การดูแลอาคารสถานที่และสภาพแวดล้อม</li>
    </ul>
    <div class="box-body">
        <!--<div class="table-responsive">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;">ที่</th>
                    <th class="no-sort">ประเภท</th>
                    <th class="no-sort">รายละเอียด</th>
                    <th class="no-sort">ภาพ 1</th>
                    <th class="no-sort">ภาพ 2</th>
                    <th class="no-sort">ภาพ 3</th>
                    <th class="no-sort">สภาพ</th>
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <th style="width:13%;" class="no-sort"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $row; ?></td>
                        <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['bd_type']; ?></button></td>
                        <td><?php echo $r['bd_detail']; ?></td>

                        <td style="text-align:center;">
                            <?php if (file_exists('upload/' . $r['bd_img1']) && !empty($r['bd_img1'])): ?>
                                <?php echo anchor(base_url() . "upload/" . $r['bd_img1'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:center;">
                            <?php if (file_exists('upload/' . $r['bd_img2']) && !empty($r['bd_img2'])): ?>
                                <?php echo anchor(base_url() . "upload/" . $r['bd_img2'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                            <?php endif; ?>

                        </td>
                        <td style="text-align:center;">
                            <?php if (file_exists('upload/' . $r['bd_img3']) && !empty($r['bd_img3'])): ?>
                                <?php echo anchor(base_url() . "upload/" . $r['bd_img3'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                            <?php endif; ?>

                        </td>


                        <td><?php echo $r['bd_status']; ?></td>
                        <td>
                            <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>
<script>
<?php
$tabName = "example";
$text = "งานอาคารสถานที่และสภาพแวดล้อม";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary btn-insert',
    'fn' => ''
);
array_push($btExArr, $bt);

load_datatable($tabName, $btExArr, $title, $colStr);
?>
//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
//        "language": {
//            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//            "zeroRecords": "## ไม่มีข้อมูล ##",
//            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//            "infoEmpty": "",
//            "infoFiltered": "",
//            "sSearch": "ระบุคำค้น",
//            "sPaginationType": "full_numbers"
//        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
    //
    // append insert button
//    var status = "<?php echo $this->session->userdata('status'); ?>";
//    var res = "<?php echo $this->session->userdata('responsible'); ?>";
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
//    }
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('bd-insert-view'); ?>";
    });
//   $(".btn-insert").on("click", function () {
//        alert('dd');
//        $("h3.modal-title").text("เพิ่มรายละเอียดการดูแลอาคารสถานที่และสภาพแวดล้อม");
//        $("#bd-edit-modal").modal("show");
//    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
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
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('bd-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inBdType").val(data.bd_type);
                $("#inBdDetail").val(data.bd_detail);
                $("#inBdCap").val(data.bd_cap);
                $("#inBdRoom").val(data.bd_room);
                $("#inBdValue").val(data.bd_value);
                $("#inBdYear").val(data.bd_year);
                $("#inBdStatus").val(data.bd_status);


                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียด");
                $("#bd-edit-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('bd-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("building/bd_edit_modal"); ?>
<?php $this->load->view("building/bd_detail_modal"); ?>