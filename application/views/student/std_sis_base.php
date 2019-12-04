<div class="box">
    <div class="box-heading">ฐานข้อมูลทะเบียนนักเรียน
    <!--<button type="button" class="btn btn-success btn-sis-insert-modal" style="float: right"><i class="icon-plus icon-large"></i> เพิ่มข้อมูล</button>-->
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>นำเข้าข้อมูลนักเรียนจาก SIS</li>
    </ul>
    <div class="box-body">
        <?php
        $data['class'] = 'Y';
        $data['room'] = 'Y';
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>
        <!--<center> <button class="btn btn-link btn-detail" data-toggle="collapse" data-target="#StudentListBody">ข้อมูลนักเรียน</button></center>-->
        <div class="row">
            <div class="col-md-12 collapse in" id="StudentListBody">

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("student/std_sis_import_modal"); ?>
<?php //$this->load->view("student/std_edit_modal"); ?>
<?php //$this->load->view("student/std_detail_modal"); ?>
<?php $this->load->view("student/std_sis_insert_modal"); ?>
<script>


    var RmId = "";
    var ClsId = "";
    var EdYear = "";

    function MyEdTest(e) {
        ClsId = e.value;
        $('#inStdClassM').val(ClsId);
        //MyStdFilter();

    }

    function MyEdYearTest(e) {
        EdYear = e.value;
        $('#inEdYear').val(EdYear);
    }
    
    function MyRoomOnChange(e){
        RmId = e.value;
        $('#inStdClassRoomM').val(RmId);
        MyStdFilter();
    }

    function Myreload() {
        
        <?php
        $tabName = "example";
        
        $text = "นำเข้าข้อมูลนักเรียนจาก SIS";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3";
        $btExArr = array();
        
        $bt = array(
            'name'=>'import_excel',
            'title'=>'นำเข้าข้อมูลจากไฟล์ Excel (.xls)',
            'icon'=>'icon-file icon-large',
            'class'=>'btn btn-success btn-excel',
            'fn'=>''
        );
        array_push($btExArr,$bt);
        
        $bt = array(
            'name'=>'export_excel',
            'title'=>'รูปแบบไฟล์ Excel (.xls)',
            'icon'=>'icon-download-alt icon-large',
            'class'=>'btn btn-success btn-excel-export',
            'fn'=>'ExportTemp(this);'
        );
        array_push($btExArr,$bt);
    
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
        
//        $('#example').DataTable({
//            buttons: ['copy', 'excel'], //, 'colvis'
//            "pageLength": 50,
//            "responsive": true,
//            "stateSave": true,
//            "bSort": false,
//            "ordering": true,
//            columnDefs: [{
//                    orderable: false,
//                    targets: "no-sort"
//                }],
//            "language": {
//                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                "zeroRecords": "## ไม่มีข้อมูล ##",
//                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                "infoEmpty": "",
//                "infoFiltered": "",
//                "sSearch": "ระบุคำค้น",
//                "sPaginationType": "full_numbers"
//            }
//        }).buttons().container()
//                .appendTo('#example_wrapper .col-md-6:eq(0)');
//        $('.sorting_asc').removeClass('sorting_asc');

        
//        $("div#example_length.dataTables_length").append("<br><button type=\"button\" class=\"btn btn-success btn-excel\"><i class=\"icon-file icon-large\"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>");
//        $("div#example_length.dataTables_length").append("&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> รูปแบบไฟล์ Excel (.xls)</button>");

    }

    function MyStdFilter() {
        
        $.ajax({
            url: '<?php echo site_url('SISImport/get_std_base_list'); ?>',
            method: 'post',
            data: {cid: ClsId, edyear: EdYear,rid : RmId},
            success: function (data) {
                if (data != "") {
                    $("#StudentListBody").html(data);
                    Myreload();
                }

            }
        });
    }



    $(".btn-insert").on("click", function () {

    });

    function ExportTemp(e) {
        e.preventDefault;
        var tmp = "tb_student_base";
        $.ajax({
            url: '<?php echo site_url('SISImport/ExportTemplateFull'); ?>',
            method: 'post',
            data: {'tableName': tmp},
            success: function (data) {
                window.open('<?php echo site_url('SISImport/ExportTemplateFull'); ?>', '_blank');
            }
        });
    }

    $("#StudentListBody").on('click', '.btn-excel', function (e) {
        e.preventDefault();
        $("#sis-import-modal").modal("show");
    });
    
    $(".btn-sis-insert-modal").on("click", function () {
        $("#std-sis-insert-modal").modal("show");
    });
    
    function delStd(id) {
         var uid = id;
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('SISImport/delete_std'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    MyStdFilter();
                   // location.reload();
                }
            });
        }
    }
    
    $('#StudentListBody').on('click', '.btn-delete-all', function (e) {
        e.preventDefault();

        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('SISImport/delete_all_std'); ?>',
                method: 'post',
                data: {rid: $('#MyRoom').val()},
                success: function (data) {
                    MyStdFilter();
                   // location.reload();
                }
            });
        }
    });
</script>
