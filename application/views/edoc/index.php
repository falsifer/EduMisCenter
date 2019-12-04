<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">งานรับ-ส่งหนังสือ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>งานรับ-ส่ง หนังสือ</li>
        </ul>
        <div class="panel-body">

            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary btn-inbox"><i class="icon-inbox icon-large"></i> หนังสือเข้า</button>
                    <button type="button" class="btn btn-primary btn-outbox"><i class="icon-inbox icon-large"></i> หนังสือออก</button>
                </div>
            </div>
            <div class="row">
                <?php $this->load->view("edoc/inbox") ?>
            </div>

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
    //
    $(".btn-inbox").on("click", function () {
        location.href = "<?php echo site_url('go-to-inbox'); ?>";
    });
</script>
<?php $this->load->view("edoc/edoc_modal"); ?>