<div class="box">
    <div class="box-heading">ระบบแนะแนว</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบแนะแนว</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="sorting">ชื่อ-นามสกุล</th>
                            <th class="sorting">ระดับชั้น</th>
                            <th class="no-sort">การทำงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['std_titlename']; ?><?php echo $r['std_firstname']; ?> <?php echo $r['std_lastname']; ?></button></td>
                                <!-- <td style="text-align: center;"><?php echo $r['tb_std_before_register_class']; ?> ปีที่ <?php echo $r['tb_std_before_register_lev']; ?></td> -->

                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <td style="text-align:center;">

                                    </td>
                                    <td style="text-align:center;">
                                        <?php if ($r['tb_student_base_id'] == ""): ?>
                                            <button type="button" class="btn btn-info btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> บันทึกการแนะแนว</button>
                                        <?php endif; ?>

                                        <?php if ($r['tb_student_base_id'] != ""): ?>
                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-search icon-large"></i> ดูผลการบันทึก</button>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("guidance/gd_modal"); ?>

<script>

    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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



    $("#example").on("click", ".btn-edit", function () {

        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('Guidance/gd_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#aid").val(data.id);
                $("#chid").val(data.chid);
                $strname = data.std_titlename + data.std_firstname + " " + data.std_lastname;
                $strhealth = data.std_disabled;
                if ($strhealth == "") {
                    $strhealth = "ร่างกายปกติ";
                }

                $("#inStdname").val($strname);
                $("#inStdHealth").val($strhealth);
                $("#inText").val(data.tb_guidance_result_description);

                //------------------------------------------------//
                $("h3.modal-title").text("บันทึกผลการแนะแนว");
                $("#gd-modal").modal("show");
            }
        });
    }
    );
</script>
