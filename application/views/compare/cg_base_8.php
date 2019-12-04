<div class="box">
    <div class="box-heading">เทียบโอนผลการเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>เทียบโอนผลการเรียน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" ): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            

                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
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
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-success btn-excel'><i class='icon-file icon-large'></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>");
        
    }
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('bs-insert-view'); ?>";
    });

    
    //---- import ----//	

$(".btn-excel").on("click", function (e) {
        e.preventDefault();
        $("#bs-import-modal").modal("show");
    });
    
    

    
</script>

<?php $this->load->view("import/import_modal"); ?>
