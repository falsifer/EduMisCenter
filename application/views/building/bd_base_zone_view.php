<div class="box">
    <div class="box-heading">ทะเบียนอาคาร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ทะเบียนอาคาร</li>
    </ul>
    <div class="box-body">
        <!--<div class="table-responsive">-->
        <div class='row'>
            <div class='col-md-12' style='margin-top:20px;'>
                <select name="inSchoolList" id="inSchoolList" class="my-select" onchange='SchoolListOnChange(this)'>
                    <?php echo $school_list; ?>
                </select>
            </div>
            <div class='col-md-12' style='margin-top:20px;'>
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:5%;">ที่</th>
                            <th style="width:10%;">ประเภท</th>
                            <th style="width:20%;">รายละเอียด</th>
                            <th style="width:10%;">จำนวนห้อง</th>
                            <th style="width:10%;">ราคา/มูลค่า(บาท)</th>
                            <th style="width:10%;">ปีที่ได้รับ</th>
                            <th style="width:15%;">สภาพ</th>
                            <th style="width:20%;">โรงเรียน</th>
                        </tr>
                    </thead>
                    <tbody id='BdTBody'>
                        <?php echo $tbody; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!--</div>-->
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>
<script>
    <?php
        $tabName = "example";
        $text = "ทะเบียนอาคาร";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7";
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

    function SchoolListOnChange(e) {
        $.ajax({
            url: "<?php echo site_url('Zone_monitor/bd_base_zone_view_by_school_id'); ?>",
            method: "POST",
            data: {id: e.value},
            success: function (data) {
                $("#BdTBody").html(data);
            }
        });
    }


    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('bd-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียด");
                $("#bd-detail-modal").modal("show");
            }
        });
    });
</script>
<?php $this->load->view("building/bd_edit_modal"); ?>
<?php $this->load->view("building/bd_detail_modal"); ?>