<div class="panel panel-primary">
    <div class="panel-heading">ประเภทสถานประกอบการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ประเภทสถานประกอบการ</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <form method="post" id="company-type-form" class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-8">
                        <label class="control-label col-md-2">ประเภทสถานประกอบการ</label>
                        <div class="col-md-4">
                            <input type="text" name="inCompanyType" id="inCompanyType" class="form-control" autofocus required/>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ประเภทสถานประกอบการ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;border-right: none;" class="no-sort"></th>
                            <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

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
    //
    $('#company-form').on('submit', function (e) {
        alert('click here');
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vocational/modals/company_modal'); ?>