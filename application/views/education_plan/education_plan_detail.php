<div class="panel panel-primary">
    <div class="panel-heading">บัญชีสรุปโครงการ-กิจกรรม</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('education-planing'); ?>">แผนพัฒนาการศึกษา</a></li>
        <li>บัญชีสรุปโครงการ-กิจกรรม</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">

            <?php $row = 1; ?>
            <?php foreach ($strategic as $st): ?>
                <div style="border:3px double #ddd;margin-bottom:10px;padding:15px;">
                    <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="width:25%;" rowspan="2">ยุทธศาสตร์-กลยุทธ์</th>
                                <?php $line = 0; ?>
                                <?php
                                for ($i = $strategies['begin_year']; $i <= $strategies['end_year']; $i++):
                                    ?>
                                    <th class="no-sort" colspan="2" >ปีงบประมาณ พ.ศ. <?php echo thaidigit($i) ?></th>
                                    <?php $line++; ?>
                                <?php endfor; ?>
                                <th class="no-sort">รวม <?php echo thaidigit($line) ?> ปี</th>

                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <th style="width:13%;border-right: none;" class="no-sort" rowspan="2"></th>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php for ($i = 1; $i <= $line; $i++): ?>
                                    <th class="no-sort">งบประมาณ<br/>(บาท)</th>
                                    <th class="no-sort">จำนวน<br/>โครงการ</th>
                                <?php endfor; ?>
                                <th class="no-sort">งบประมาณ<br/>(บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo thaidigit($row); ?>) <?php echo $st['strategic_define']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <!-- ดึงข้อมูลกลยุทธ์ -->
                                <?php $st_define = $this->My_model->get_where_order('tb_strategy_define', array('strategic_define_id' => $st['id']), 'id asc'); ?>
                                <?php foreach ($st_define as $stg): ?>
                                <tr>
                                    <td><?php echo nbs(5); ?><?php echo $stg['strategy_define'] ?></td>
                                    <!-- data operation -->
                                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                <form method="post" id="insert-form">
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                    <td><input type="text" name="" id=""  class="form-control"/></td>
                                </form>
                            <?php else: ?>

                            <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php $row++; ?>
            <?php endforeach; ?>

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
<!---------------------------------------------------------------------------->
<script>
    $('.display').DataTable({
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
    //
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button type=button' class='btn btn-default'><i class='icon-plus'></i> บันทึก</button>");
</script>
<!---------------------------------------------------------------------------->