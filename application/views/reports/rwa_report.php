<div class="box">
    <div class="box-heading">รายงานอ่านคิดวิเคราะห์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('reports'), "<i class='icon-print icon-large'></i> รายงาน"); ?></li>
        <li>รายงานอ่านคิดวิเคราะห์</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <?php
            $data['class'] = 'Y';
            ?>
            <?php $this->load->view('layout/my_school_filter', $data); ?>
        </div>
        <div class="row" id="reportDiv">
            <div class="col-md-12" id="chartDiv">   
            </div>
            <div class="col-md-12" id="gridDiv">   
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

    var edYear = '<?php echo get_edyear(); ?>';
    $('#MyEdYear').val(edYear);
    $('#MyEdYear').change();




    function MyEdYearTest(e) {
        loadReport();
    }

    function MyClassOnChange(e) {

        loadReport();
    }

    function loadReport() {

        $.ajax({
            url: "<?php echo site_url('Report/rwa_reload'); ?>",
            method: "post",
            data: {edYear: $('#MyEdYear').val(), edClass: $('#MyClass').val(), dept: '<?php echo ($school != null && $school != "") ? $school : ""; ?>'},
            success: function (data) {
                $("#gridDiv").html(data);
                Myreload();
            }
        });
    }

    function Myreload() {
    
    
    <?php
        $tabName = "myTab";
        
        $text = "สรุปการประเมินการอ่าน คิดวิเคราะห์ และเขียน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4";
        $btExArr = array();
        
        $footer = "\"footerCallback\": function (row, data, start, end, display) {
                var api = this.api(), data;

                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                var monTotal = api
                        .column(1)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                var tueTotal = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                var wedTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                var thuTotal = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                var gtotal = monTotal+tueTotal+wedTotal+thuTotal
                $(api.column(0).footer()).html('รวม('+gtotal+' คน)');
                $(api.column(1).footer()).html(monTotal);
                $(api.column(2).footer()).html(tueTotal);
                $(api.column(3).footer()).html(wedTotal);
                $(api.column(4).footer()).html(thuTotal);
            }";
        
    
        load_datatable($tabName, $btExArr, $title, $colStr,$footer);
    
    ?>
//        $('#myTab').DataTable({
//
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
//            },
//            "footerCallback": function (row, data, start, end, display) {
//                var api = this.api(), data;
//
//                // converting to interger to find total
//                var intVal = function (i) {
//                    return typeof i === 'string' ?
//                            i.replace(/[\$,]/g, '') * 1 :
//                            typeof i === 'number' ?
//                            i : 0;
//                };
//
//                // computing column Total of the complete result 
//                var monTotal = api
//                        .column(1)
//                        .data()
//                        .reduce(function (a, b) {
//                            return intVal(a) + intVal(b);
//                        }, 0);
//
//                var tueTotal = api
//                        .column(2)
//                        .data()
//                        .reduce(function (a, b) {
//                            return intVal(a) + intVal(b);
//                        }, 0);
//
//                var wedTotal = api
//                        .column(3)
//                        .data()
//                        .reduce(function (a, b) {
//                            return intVal(a) + intVal(b);
//                        }, 0);
//
//                var thuTotal = api
//                        .column(4)
//                        .data()
//                        .reduce(function (a, b) {
//                            return intVal(a) + intVal(b);
//                        }, 0);
//
//                var gtotal = monTotal+tueTotal+wedTotal+thuTotal
//                $(api.column(0).footer()).html('รวม('+gtotal+' คน)');
//                $(api.column(1).footer()).html(monTotal);
//                $(api.column(2).footer()).html(tueTotal);
//                $(api.column(3).footer()).html(wedTotal);
//                $(api.column(4).footer()).html(thuTotal);
//            }
//        }).buttons().container()
//                .appendTo('#myTab_wrapper .col-md-6:eq(0)');
//        $('.sorting_asc').removeClass('sorting_asc');



    }
</script>

