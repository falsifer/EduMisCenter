<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ประวัติการฝึกอบรม-ศึกษาดูงาน ]</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <li>ประวัติการฝึกอบรม-ศึกษาดูงาน</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive" style="margin-top:30px;">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:5%;">ที่</th>
                    <th style="width:25%;">ชื่อ-นามสกุล</th>
                    <th style="width:20%;">ตำแหน่ง</th>

                    <th style="width:10%;">จำนวนครั้ง</th>
                    <th style="width:10%;">จำนวนชั่วโมง</th>
                    <th style="width:30%;">สังกัด</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tbody ?>
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

    function SelectThisTr(e) {
        $.ajax({
            url: '<?php echo site_url('Zone_monitor/hr07_zone_view_modal'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
                $('#hr07ZoneBody').html(data);
                $('#hr-07-zone-view-modal').modal('show');
            }
        });
    }
</script>
<?php $this->load->view("human_resources/hr07_zone_view_modal"); ?>