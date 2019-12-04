
<!------------------------------------------------------------------------------
|  Title        Carousel setting
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       กำหนดภาพสไลด์
| Author	นายบัณฑิต ไชยดี
| Create Date   07-01-2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">กำหนดภาพสไลด์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>กำหนดภาพสไลด์</li>
    </ul>
    <div class="panel-body">

        <div class="databox">
            <div class="row">
                <div class="col-md-8">
                    <?php echo form_open_multipart(current_url(), array('id' => "insert-form", 'class' => "form-horizontal")); ?>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="control-label col-md-3">เลือกภาพ</label>
                            <div class="col-md-8">
                                <input type="file" name="inCarouselName" id="inCarouselName" class="filestyle" />
                            </div>
                            <div class="formg-group col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ภาพสสไลด์</th>
                        <th style="width:15%;border-right: none;" class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td>
                                <?php if (file_exists('upload/carousel/' . $r['carousel_name']) && !empty($r['carousel_name'])): ?>
                                    <img src="<?php echo base_url() ?>upload/carousel/<?php echo $r['carousel_name']; ?>" style="width:150px;height:86px;" class="img-thumbnail" />
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // save image;
    $('#insert-form').on("submit", function (e) {
        e.preventDefault();
        var file = $('#inCarouselName').val();
        var ext = $('#inCarouselName').val().split('.').pop().toLowerCase();
        //
        if (file == '' || jQuery.inArray(ext, ['jpg', 'png']) == -1) {
            alert('ต้องเลือกภาพเพื่อทำสไลน์และชนิดจะต้องเป็น jpg หรือ png เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-carousel-setting'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete ;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url:'<?php echo site_url('delete-carousel-setting'); ?>',
                method:'post',
                data:{id:uid},
                success:function(data){
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->