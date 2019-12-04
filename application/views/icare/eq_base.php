<div class="box">
    <div class="box-heading">แบบประเมิน EQ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>แบบประเมิน EQ</li>
    </ul>
    <div style="padding: 30px;">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">ระดับชั้น</label><?php echo nbs(3);?>
                <select name="inClassLevel" id="inClassLevel" style="width:300px;padding: 10px;">
                    <option vale="ม.1">มัธยมศึกษาปีที่ 1</option>
                    <option vale="ม.2">มัธยมศึกษาปีที่ 2</option>
                    <option vale="ม.3">มัธยมศึกษาปีที่ 3</option>
                    <option vale="ม.4">มัธยมศึกษาปีที่ 4</option>
                    <option vale="ม.5">มัธยมศึกษาปีที่ 5</option>
                    <option vale="ม.6">มัธยมศึกษาปีที่ 6</option>
                    
                </select>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="eqTab">
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

                        <tr>
                            <td style="text-align: center;"></td>
                            <td style="text-align: left;"></td>
                            <td style="text-align: center;">ประถมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">100 คะแนน</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> บันทึกคะแนน</button>
                                </td>
                            <?php endif; ?>
                        </tr>
 
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

    $('#eqTab').DataTable({
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
        $("div#eqTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อพฤติกรรมประเมิน</button>");
        $("div#eqTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์แบบประเมินเปล่า</button>");
    }

    $(".btn-insert").on("click", function () {
        $("#eq-insert-modal").modal("show");
    });
    
     $(".btn-print").on("click", function () {
        $("#eq-print-modal").modal("show");
    });
    
       $(".btn-show").on("click", function () {
        $("#eq-show-modal").modal("show");
    });






</script>

<?php $this->load->view('icare/modals/eq_base_modal'); ?>
<?php $this->load->view('icare/modals/eq_print_modal'); ?>
<?php $this->load->view('icare/modals/eq_show_modal'); ?>
