<div class="box">
    <div class="box-heading">คลังข้อสอบ (<?php echo $this->session->userdata("department") ?>)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>คลังข้อสอบ</li>
    </ul>
    <div class="box-body">
        <div class="col-md-12">

            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อแบบทดสอบ</th>
                        <th class="no-sort">ระดับชั้น</th>
                        <th class="no-sort">กลุ่มสาระการเรียนรู้</th>
                        <th class="no-sort">วิชา</th>
                        <th class="no-sort">จำนวนข้อ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th class="no-sort"></th>
                        <?php endif; ?>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1</td>
                        <td style="text-align:center;">แบบทดสอบก่อนเรียนวิชาคณิตศาสตร์</td>
                        <td style="text-align:center;">มัธยมศึกษาปีที่ 1</td>
                        <td style="text-align:center;">คณิตศาสตร์</td>
                        <td style="text-align:center;">คณิตศาสตร์</td>
                        <td style="text-align:center;">15</td>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id=""><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id=""><i class="icon-trash icon-large"></i> ลบ</button>
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
</script>

