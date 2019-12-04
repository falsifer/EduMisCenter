<div class="panel panel-primary">
    <div class="panel-heading">การส่งเสริมและยกย่องเชิดชูเกียรติ/รางวัลเกียรติยศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ส่งเสริมยกย่องฯ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วันที่ประกาศ</th>
                        <th class="no-sort">เรื่องที่ยกย่องฯ</th>
                        <th class="no-sort">ผู้ได้รับการยกย่องฯ</th>
                        <th class="no-sort">ผู้ยกย่อง/เชิดชูเกียรติ</th>
                        <th class="no-sort">เอกสาร</th>
                        <th class="no-sort">ภาพ 1</th>
                        <th class="no-sort">ภาพ 2</th>
                        <th class="no-sort">ภาพ 3</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                            <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo shortdate($r['give_up_date']); ?></td>
                            <td><?php echo $r['give_up_topic']; ?></td>
                            <td><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></td>
                            <td><?php echo $r['give_up_office']; ?></td>
                            <td>
                                <?php if (file_exists('upload/' . $r['give_up_document']) && !empty($r['give_up_document'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['give_up_document'], 'เอกสาร', array('rel' => 'lytebox')); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (file_exists('upload/' . $r['give_up_image1']) && !empty($r['give_up_image1'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['give_up_image1'], 'เอกสาร', array('rel' => 'lytebox')); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (file_exists('upload/' . $r['give_up_image2']) && !empty($r['give_up_image2'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['give_up_image3'], 'เอกสาร', array('rel' => 'lytebox')); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (file_exists('upload/' . $r['give_up_image3']) && !empty($r['give_up_image3'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['give_up_image3'], 'เอกสาร', array('rel' => 'lytebox')); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $r['give_up_comment'];?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                                <td>&nbsp;</td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "example";
        $text = "การส่งเสริมและยกย่องเชิดชูเกียรติ/รางวัลเกียรติยศ";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//    $('#example').DataTable({
//        buttons: ['copy', 'excel'],
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
//    }).buttons().container()
//            .appendTo('#example_wrapper .col-md-6:eq(0)');
//    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
     $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");

    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลผู้ได้รับการยกย่องเชิดชูเกียรติ');
        $('#hr-give-up-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-give-up'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inGiveUpDate').val(data.give_up_date);
                $('#inHrId').val(data.hr_id);
                $('#inGiveUpOffice').val(data.give_up_office);
                $('#inGiveUpTopic').val(data.give_up_topic);
                $('#inGiveUpComment').val(data.give_up_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลยกย่องเชิดชูเกียรติ');
                $('#hr-give-up-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url(''); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {

                }
            });
        }
    });
    //
    $('#example').on('click','.btn-delete',function(){
    var uid=$(this).attr('id');
    var status=confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
    if(status){
        $.ajax({
            url:'<?php echo site_url('delete-human-resources-give-up');?>',
            method:'post',
            data:{id:uid},
            success:function(data){
                location.reload();
            }
        });
    }
    });
</script>
<?php $this->load->view('hr_give_up/modals/give_up_modal'); ?>