<div class="box">
    <div class="box-heading">รายงานสรุปผลการคัดกรองนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>
        <li>รายงานสรุปผลการคัดกรองนักเรียน</li>
    </ul>
    <div style="padding: 30px;">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">ระดับชั้น</label><?php echo nbs(4);?>
                <select name="inClassLevel" id="inClassLevel" style="width:300px;padding: 8px;">
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
            <table class="table table-hover table-striped table-bordered display" id="sdqTab">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อ-นามสกุล</th>
                        <th class="no-sort">ระดับชั้น</th>
                        <th class="no-sort">ด้านอารมณ์</th>
                        <th class="no-sort">ด้านความประพฤติ/เกเร</th>
                        <th class="no-sort">ด้านพฤติกรรมไม่อยู่นิ่ง/สมาธิสั้น</th>
                        <th class="no-sort">ด้านความสัมพันธ์กับเพื่อน</th>
                        <th class="no-sort">ด้านสัมพันธภาพทางสังคม</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

                        <tr>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: left;">เด็กชายสุรเชษฐ์ แสงทองดี</td>
                            <td style="text-align: center;">มัธยมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">กลุ่มมีปัญหา</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td style="text-align: center;">2</td>
                            <td style="text-align: left;">เด็กชายชัยรัธฐา อ่วมอารีย์</td>
                            <td style="text-align: center;">มัธยมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มมีปัญหา</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td style="text-align: center;">3</td>
                            <td style="text-align: left;">เด็กหญิงอมลวรรณ เกษรบัว</td>
                            <td style="text-align: center;">มัธยมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td style="text-align: center;">4</td>
                            <td style="text-align: left;">เด็กชายภูริทัต ชุนย่อน</td>
                            <td style="text-align: center;">มัธยมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มมีปัญหา</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td style="text-align: center;">5</td>
                            <td style="text-align: left;">เด็กชายประทีป ไศลมณี</td>
                            <td style="text-align: center;">มัธยมศึกษาปีที่ 1</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มปกติ</td>
                            <td style="text-align: center;">กลุ่มเสี่ยง</td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                </td>
                            <?php endif; ?>
                        </tr>
 
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<div class="col-md-12">
                           
                        </div>
<script>

    $('#sdqTab').DataTable({
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
        $("div#sdqTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-warning btn-print'><i class='icon-print icon-large'></i> พิมพ์รายงานสรุปผลการคัดกรองนักเรียน</button>");
    }

    $(".btn-insert").on("click", function () {
        $("#sdq-insert-modal").modal("show");
    });
    
     $(".btn-print").on("click", function () {
        $("#sdq-print-modal").modal("show");
    });
    
       $(".btn-show").on("click", function () {
        $("#sdq-show-modal").modal("show");
    });






</script>

<?php $this->load->view('icare/modals/sdq_base_modal'); ?>
<?php $this->load->view('icare/modals/sdq_show_modal'); ?>
<?php $this->load->view('icare/modals/sdq_print_modal'); ?>
<?php $this->load->view('icare/modals/correction_base_modal'); ?>