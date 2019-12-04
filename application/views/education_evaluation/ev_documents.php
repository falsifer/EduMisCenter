
<div class="panel panel-primary">
    <div class="panel-heading">การส่งเสริม-สนับสนุน :: เอกสารหรือภาพประกอบ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('education-evaluation'); ?>">การส่งเสริม-สนับสนุนฯ</a></li>
        <li>ภาพประกอบ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort" style="width:15%;">วันที่บันทึกข้อมูล</th>
                        <th class="no-sort">ประเภท</th>
                        <th class="no-sort">เอกสารประกอบ</th>
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
                            <td><?php echo datethai($r['document_date']); ?></td>
                            <td><?php echo $r['document_type']; ?></td>
                            <td>
                                <?php if ($r['document_type'] == 'เอกสารประกอบ'): ?>
                                    <?php if (file_exists('upload/' . $r['document_file']) && !empty($r['document_file'])): ?>
                                        <?php echo anchor(base_url() . 'upload/' . $r['document_file'], 'เอกสาร', array('target' => '_blank')); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if (file_exists('upload/' . $r['document_file']) && !empty($r['document_file'])): ?>
                                        <?php echo anchor(base_url() . 'upload/' . $r['document_file'], img(array('src' => 'upload/' . $r['document_file'], 'style' => 'width:80px;height:60px;', 'class' => 'img-thumbnail')), array('rel' => 'lytebox')); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "example";
        $title = "การส่งเสริม-สนับสนุน :: เอกสารหรือภาพประกอบ";
        $colStr = "0,1,2,3";
        $btExArr = array();
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
    }
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $('.btn-insert').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลเอกสารประกอบงานส่งเสริม-สนับสนุน');
        $('#ev-documents-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-evaluation-documents'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inDocumentsDate').val(data.document_date);
                $('#inDocumentsType').val(data.document_type);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลเอกสารประกอบงานส่งเสริม-สนับสนุนฯ');
                $('#ev-documents-modal').modal('show');
            }
        });
    });
    // delete
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url:'<?php echo site_url('delete-education-evaluation-documents'); ?>',
                method:'post',
                data:{id:uid},
                success:function(data){
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('education_evaluation/modals/ev_documents_modal'); ?>