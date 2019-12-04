<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ข้อมูลใบประกอบวิชาชีพ ]</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>
        <li>ข้อมูลใบประกอบวิชาชีพ</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:45px;">ที่</th>
                        <th class="no-sort">เลขประจำตัว</th>
                        <th class="no-sort">ประเภท</th>
                        <th class="no-sort">เลขที่ใบประกอบวิชาชีพ</th>
                        <th class="no-sort">วัน/เดือน/ปี เริ่มต้น</th>
                        <th class="no-sort">วัน/เดือน/ปี สิ้นสุด</th>
                        <th class="no-sort">ใบประกอบวิชาชีพ</th>
                        <th class="no-sort">หมายเหตุ</th>
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
                            <td><?php echo $r['hr10_id']; ?></td>
                            <td><?php echo $r['hr10_type']; ?></td>
                            <td><?php echo $r['hr10_no']; ?></td>
                            <td><?php echo $r['hr10_begin_day']; ?> <?php echo month_num($r['hr10_begin_month']); ?><?php echo nbs(2); ?><?php echo $r['hr10_begin_year']; ?></td>
                            <td><?php echo $r['hr10_end_day']; ?> <?php echo month_num($r['hr10_end_month']); ?><?php echo nbs(2); ?><?php echo $r['hr10_end_year']; ?></td>
                            <td style="text-align:center;">
                                <?php if(file_exists('upload/'.$r['hr10_image']) && !empty($r['hr10_image'])):?>
                                <a href="<?php echo base_url().'upload/'.$r['hr10_image'] ?>" rel="lytebox"><?php echo img(array('src'=> base_url().'upload/'.$r['hr10_image'],'style'=>'width:66px;height:38px;','class'=>'img-thumbnail')); ?></a>
                                <?php endif;?>
                            </td>
                            <td><?php echo $r['hr10_comment']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
<!--        <div class="row">
            <div class="col-md-8" style="padding-top:8px;">
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><?php echo img("images/footer_logo.png"); ?><?php echo nbs(); ?><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>-->
    </div>
</div>
<!---------------------------------------------------------------------------->
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-10/' . $human['id']); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
   
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");

    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลใบประกอบวิชาชีพ');
        $('#hr-10-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-10'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr10Id').val(data.hr10_id);
                $('#inHr10Type').val(data.hr10_type);
                $('#inHr10No').val(data.hr10_no);
                $('#inHr10BeginDay').val(data.hr10_begin_day);
                $('#inHr10BeginMonth').val(data.hr10_begin_month);
                $('#inHr10BeginYear').val(data.hr10_begin_year);
                $('#inHr10EndDay').val(data.hr10_end_day);
                $('#inHr10EndMonth').val(data.hr10_end_month);
                $('#inHr10EndYear').val(data.hr10_end_year);
                $('#inHr10Comment').val(data.hr10_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลใบประกอบวิชาชีพ');
                $('#hr-10-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-10'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_10_modal'); ?>