<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">ข่าวประชาสัมพันธ์</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>ข่าวประชาสัมพันธ์</li>
        </ul>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th class="no-sort"></th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:13%;border-right: none;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td>
                        <legend><?php echo $r['pr_topic']; ?> (<?php echo $r['pr_date']; ?>)</legend>
                        <p>
                            <?php echo $r['pr_detail']; ?>
                        </p>
                        <br/>
                        <p>
                            <?php if (file_exists('upload/' . $r['pr_image_1']) && !empty($r['pr_image_1'])): ?>
                                <?php echo anchor(base_url() . 'upload/' . $r['pr_image_1'], img(array('src' => base_url() . 'upload/' . $r['pr_image_1'], 'style' => 'width:110px;height:90px;')), array('rel' => 'lytebox')); ?>
                            <?php endif; ?>
                            <?php if (file_exists('upload/' . $r['pr_image_2']) && !empty($r['pr_image_2'])): ?>
                                <?php echo anchor(base_url() . 'upload/' . $r['pr_image_2'], img(array('src' => base_url() . 'upload/' . $r['pr_image_2'], 'style' => 'width:110px;height:90px;')), array('rel' => 'lytebox')); ?>
                            <?php endif; ?>
                            <?php if (file_exists('upload/' . $r['pr_image_3']) && !empty($r['pr_image_3'])): ?>
                                <?php echo anchor(base_url() . 'upload/' . $r['pr_image_3'], img(array('src' => base_url() . 'upload/' . $r['pr_image_3'], 'style' => 'width:110px;height:90px;')), array('rel' => 'lytebox')); ?>
                            <?php endif; ?>
                            <?php if (file_exists('upload/' . $r['pr_image_4']) && !empty($r['pr_image_4'])): ?>
                                <?php echo anchor(base_url() . 'upload/' . $r['pr_image_4'], img(array('src' => base_url() . 'upload/' . $r['pr_image_4'], 'style' => 'width:110px;height:90px;')), array('rel' => 'lytebox')); ?>
                            <?php endif; ?>
                        </p>
                        </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-footer" style="padding-top: 0px;">
            <div class="row">
                <div class="col-md-8" style="padding-top:8px;padding-right:8px;font-size:15px;color:#666;">
                    <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
                </div>
                <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                    <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
                </div>
            </div>
        </div>
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // สร้างปุ่ม
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;");
</script>
<!---------------------------------------------------------------------------->