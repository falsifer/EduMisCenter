<div class="box">
    <div class="box-heading">บันทึกคะแนนความประพฤติ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>
        <li>บันทึกคะแนนความประพฤติ</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อ-นามสกุล</th>
                        <th class="no-sort">ระดับชั้น</th>
                        <th class="no-sort">คะแนนรวม</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td style="text-align: left;"><?php echo $r['std_titlename']; ?><?php echo $r['std_firstname']; ?> <?php echo $r['std_lastname']; ?></td>
                            <td style="text-align: center;">ประถมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">100 คะแนน</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-info btn-show" id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> บันทึกคะแนน</button>
                                </td>
                            <?php endif; ?>
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

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อ</button>");
    }

    $(".btn-insert").on("click", function () {
        $("#adm-topic-modal").modal("show");
    });


    // input score 
    $("#example").on("click", ".btn-show", function () {

        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('School_administrator/std_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#Stdid').val(data.id);
                $('#inStdname').val("ชื่อ : " + data.std_titlename + data.std_firstname + " " + data.std_lastname);
                $('#inStdCode').val("รหัสนักเรียน : " + data.std_code);
                $('#inStdClass').val("ระดับชั้น : ประถมศึกษาปีที่ 1");
            }
        });

        $.ajax({
            url: "<?php echo site_url('School_administrator/score_modal'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $("#adm-modal").modal("show");
                $('#inTbody').html(data);

            }
        });


    }
    );


</script>

<?php $this->load->view("school_administrator/adm_modal"); ?>
<?php $this->load->view("school_administrator/adm_topic_modal"); ?>