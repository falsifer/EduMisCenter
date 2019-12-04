<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>บริหารงานทั่วไป</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน</li>
    </ul>

    <!-- Left side -->

    <div class="box-body">

        <div class="row">

            <div class="col-md-7">
                <div class="box-heading">
                    <i class="icon-bar-chart icon-large"></i> สรุปผล 
<!--                    <button class='btn btn-report btn-primary ' style="float: right;margin-right: 3px;" data-toggle='modal' data-target='#supervision-report-modal'><i class='icon-print icon-large'></i> ปถ.01-09</button>
                    <button class='btn btn-report btn-primary ' style="float: right;margin-right: 3px;" data-toggle='modal' data-target='#supervision-report-modal'><i class='icon-print icon-large'></i> ปพ.01-02</button>-->

                </div>

                <div class="databox">
                    <div class="tab-pane" id="2" style="padding-top:10px;">
                        <div class="col-md-12">
                            <legend class="legend-heading" style="padding:10px;">น้ำหนักของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                            <div id="top_x_div_std"  class="databox"></div>
                        </div>
                        <div class="col-md-12">
                            <legend class="legend-heading" style="padding:10px;">ส่วนสูงของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                            <div id="top_x_div_std_w"  class="databox"></div>
                        </div>
                        <div class="col-md-12">
                            <legend class="legend-heading" style="padding:10px;">การมาเรียนของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                            <div class="col-md-12">
                                <div id="top_x_div_icare_std"  class="databox"></div>
                            </div>
                            <div id="top_x_div_icare_std_absent"  class="databox"></div>
                        </div>
                        <div class="col-md-12">
                            <legend class="legend-heading" style="padding:10px;">สรุปข้อมูลและสถิติงานดูแลช่วยเหลือนักเรียน<?php echo $this->session->userdata('department'); ?></legend>

                            <div class="col-md-12">
                                <div id="top_x_div_icare_ln"  class="databox"></div> 
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div_icare_hl"  class="databox"></div> 
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div_icare_fm"  class="databox"></div> 
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div_icare_ot"  class="databox"></div> 
                            </div>
                        </div>
                    </div>  
                </div>
                <!--                         <div id="top_x_div"  class="databox">-->

            </div>
            <!-- Right side -->
            <div class="col-md-5">
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-light-blue btn-submenu" onclick="javascript:location.href = '<?php echo site_url('adm-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกคะแนนความประพฤติ</button>
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-blue btn-submenu" onclick="javascript:location.href = '<?php echo site_url('sdq-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>แบบประเมิน SDQ</button>
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-dark-pink btn-submenu" onclick="javascript:location.href = '<?php echo site_url('vh-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกการเยี่ยมบ้านของนักเรียน</button>
<!--                        <button type="button" style="margin-bottom:5px;"  class="btn btn-green btn-submenu" onclick="javascript:location.href = '<?php echo site_url('activity-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกกิจกรรมการป้องกันและแก้ไข</button>
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-orange btn-submenu" onclick="javascript:location.href = '<?php echo site_url('help-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกการช่วยเหลือและส่งต่อ</button>
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-dark-red btn-submenu" onclick="javascript:location.href = '<?php echo site_url('report-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>รายงานสรุปผลการคัดกรองนักเรียน</button>-->
                    </div>
                </div>
                <!--            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('classroom-check-in'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกเข้าห้องเรียน</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('student-kpi'); ?>';"><i class="icon-edit icon-large"></i> บันทึกคะแนนรายตัวชี้วัด(ปถ.05)</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-charactor'); ?>';"><i class="icon-edit icon-large"></i> ประเมินความก้าวหน้าการพัฒนาคุณลักษณะอันพึงประสงค์(ปถ.04)</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-rw-analysis'); ?>';"><i class="icon-edit icon-large"></i> ประเมินการอ่านคิดวิเคราะห์และเขียน(ปถ.02)</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-capacity'); ?>';"><i class="icon-edit icon-large"></i> บันทึกสมรรถณะ</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px;text-align:center;">
                                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                                    <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-onet'); ?>';"><i class="icon-edit icon-large"></i> NT O-NET</button>
                                </div>
                            </div>-->
            </div>
        </div>


    </div>
</div>
<div class="box-footer" style="padding-top: 0px;">
    <div class="row">
        <div class="col-md-8">
            <?php echo img("images/mis_logo.png"); ?>
        </div>
        <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
            <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
        </div>
    </div>
</div>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts/loader.js"></script>
<script type="text/javascript">
                            google.charts.load("current", {packages: ['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["กลุ่มสาระ", "จำนวนวิชา", {role: "style"}],

<?php
foreach ($course as $r):
    if ($r['tb_group_learningcol_name'] != null) {
        echo '["' . $r['tb_group_learningcol_name'] . '",' . $r['sbj'];
        if ($r['sbj'] > 5) {
            echo ',"color:orange" ],';
        } elseif ($r['sbj'] > 10) {
            echo ',"color:green" ],';
        } else {
            echo ',"color:red" ],';
        }
    }
endforeach;
?>
//                                    ["Copper", 8.94, "#b87333"],
//                                    ["Silver", 10.49, "silver"],
//                                    ["Gold", 19.30, "gold"],
//                                    ["Platinum", 21.45, "color: #e5e4e2"]
                                ]);

                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                    {calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation"},
                                    2]);

                                var options = {
                                    title: "จำนวนวิชาในกลุ่มสาระการเรียนรู้",
                                    width: 600,
                                    height: 400,
                                    bar: {groupWidth: "95%"},
                                    legend: {position: "none"},
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div"));
                                chart.draw(view, options);
                            }
</script>

<script>



    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
        },
    });





    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                                 ?>";
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-report btn-primary ' data-toggle='modal' data-target='#supervision-report-modal'><i class='icon-print icon-large'></i> พิมพ์แบบ ปถ.05</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });






</script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts/loader.js"></script>
<script type="text/javascript">

    google.charts.load("current", {packages: ['gauge'], callback: drawChartStd});
    google.charts.load("current", {packages: ['gauge'], callback: drawChartStdAbsent});
    google.charts.load("current", {packages: ['gauge'], callback: drawChartStdWeight});
    google.charts.load("current", {packages: ['corechart'], callback: drawChartiCareStd});
    google.charts.load("current", {packages: ['corechart'], callback: drawChartiCareLn});
    google.charts.load("current", {packages: ['corechart'], callback: drawChartiCareHl});
    google.charts.load("current", {packages: ['corechart'], callback: drawChartiCareFm});
    google.charts.load("current", {packages: ['corechart'], callback: drawChartiCareOt});
    //clearChart();

    function drawChartStd() {

        var data = google.visualization.arrayToDataTable([
            ["น้ำหนักของนักเรียน", "จำนวน"],

            ["ต่ำกว่าเกณฑ์มาตรฐาน", 3],
            ["ตามเกณฑ์มาตรฐาน", 80],
            ["สูงกว่าเกณฑ์มาตรฐาน", 3],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "น้ำหนักของนักเรียน",
            redFrom: 0, redTo: 5,
            yellowFrom: 6, yellowTo: 10,
            minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById("top_x_div_std"));
        chart.draw(view, options);
    }
    function drawChartStdWeight() {

        var data = google.visualization.arrayToDataTable([
            ["ส่วนสูงของนักเรียน", "จำนวน"],

            ["ต่ำกว่าเกณฑ์มาตรฐาน", 5],
            ["ตามเกณฑ์มาตรฐาน", 80],
            ["สูงกว่าเกณฑ์มาตรฐาน", 1],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "ส่วนสูงของนักเรียน",
            redFrom: 0, redTo: 5,
            yellowFrom: 6, yellowTo: 10,
            minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById("top_x_div_std_w"));
        chart.draw(view, options);
    }
    function drawChartiCareStd() {

        var data = google.visualization.arrayToDataTable([
            ["ระดับชั้น", "ชาย", "หญิง"],

            ["ประถมศึกษา 1", 10, 15],
            ["ประถมศึกษา 2", 12, 13],
            ["ประถมศึกษา 3", 11, 14],
            ["ประถมศึกษา 4", 15, 10],
            ["ประถมศึกษา 5", 12, 13],
            ["ประถมศึกษา 6", 11, 14],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "จำนวนนักเรียนแยกชายหญิง",
            isStacked: true
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div_icare_std"));
        chart.draw(view, options);
    }
    function drawChartiCareLn() {

        var data = google.visualization.arrayToDataTable([
            ["ตัวชี้วัด", "กลุ่มปกติ", "กลุ่มเสี่ยง", "กลุ่มมีปัญหา"],

            ["ผลการเรียน", 80, 5, 1],
            ["ติด ร,0,มส,มผ", 80, 5, 1],
            ["ไม่เข้าเรียนวิชาใดวิชาหนึ่ง", 80, 5, 1],
            ["ความสามาถในการอ่านเขียน", 80, 5, 1],
            ["การขาดเรียน", 80, 5, 1],
            ["การมาโรงเรียนสาย", 80, 5, 1],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การคัดกรองนักเรียนด้านการเรียน",
            seriesType: 'line',
            series: {0: {type: 'bars', color: 'green'}, 1: {color: 'orange'},
                2: {color: 'red'}, }
//            isStacked:true
        };
        var chart = new google.visualization.ComboChart(document.getElementById("top_x_div_icare_ln"));
        chart.draw(view, options);
    }
    function drawChartiCareHl() {

        var data = google.visualization.arrayToDataTable([
            ["ตัวชี้วัด", "กลุ่มปกติ", "กลุ่มเสี่ยง", "กลุ่มมีปัญหา"],

            ["ความแข็งแรงของร่างกาย", 80, 3, 2],
            ["มีความพิการ", 85, 0, 0],
            ["สภาพจิตใตและอารมณ์", 78, 6, 1],
            ["EQ", 78, 5, 2],
            ["SDQ", 78, 4, 3],
            ["บุคลิกและสัมพันธภาพ", 74, 8, 3],
            ["สมาธิและพฤติกรรม", 69, 10, 6],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การคัดกรองนักเรียนด้านสุขภาพร่างกาย",
            seriesType: 'line',
            series: {0: {type: 'bars', color: 'green'}, 1: {color: 'orange'},
                2: {color: 'red'}, }
//            isStacked:true
        };
        var chart = new google.visualization.ComboChart(document.getElementById("top_x_div_icare_hl"));
        chart.draw(view, options);
    }
    function drawChartiCareFm() {

        var data = google.visualization.arrayToDataTable([
            ["ตัวชี้วัด", "กลุ่มปกติ", "กลุ่มเสี่ยง", "กลุ่มมีปัญหา"],

            ["รายได้ของครอบครัว", 84, 1, 0],
            ["เงินรับประทานอาหารกลางวัน", 84, 1, 0],
            ["อุปกรณ์การศึกษา", 79, 5, 2],
            ["ความสัมพันธ์ของครอบครัว", 77, 8, 0],
            ["สภาพที่อยู่อาศัย", 75, 8, 2],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การคัดกรองนักเรียนด้านครอบครัว",
            seriesType: 'line',
            series: {0: {type: 'bars', color: 'green'}, 1: {color: 'orange'},
                2: {color: 'red'}, }
//            isStacked:true
        };
        var chart = new google.visualization.ComboChart(document.getElementById("top_x_div_icare_fm"));
        chart.draw(view, options);
    }
    function drawChartiCareOt() {
        var data = google.visualization.arrayToDataTable([
            ["ตัวชี้วัด", "กลุ่มปกติ", "กลุ่มเสี่ยง", "กลุ่มมีปัญหา"],

            ["สารเสพติด", 85, 0, 0],
            ["เพศสัมพันธ์", 84, 1, 0],
            ["ติดเกม", 55, 20, 10],
            ["การพนัน", 80, 0, 0],
            ["ลักขโมย", 78, 1, 1],
            ["ทะเลาะวิวาท", 65, 4, 3],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การคัดกรองนักเรียนด้านปัจจัยอื่น",
            seriesType: 'line',
            series: {0: {type: 'bars', color: 'green'}, 1: {color: 'orange'},
                2: {color: 'red'}, }
//            isStacked:true
        };
        var chart = new google.visualization.ComboChart(document.getElementById("top_x_div_icare_ot"));
        chart.draw(view, options);
    }
    function drawChartStdAbsent() {

        var data = google.visualization.arrayToDataTable([
            ["การมาเรียน", "จำนวน"],
            ["มา", 80],
            ["ขาด", 2],
            ["ลา", 1],
            ["มาสาย", 2],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การมาเรียนของนักเรียน",
            redFrom: 0, redTo: 5,
            yellowFrom: 6, yellowTo: 10,
            minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById("top_x_div_icare_std_absent"));
        chart.draw(view, options);
    }

    function drawChartEmAbsent() {

        var data = google.visualization.arrayToDataTable([
            ["การมาทำงานของบุคลากร", "จำนวน"],
            ["มา", 25],
            ["ลากิจ", 1],
            ["ลาป่วย", 1],
            ["ขาด", 0],
            ["ไปราชการ", 2],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "การมาทำงานของบุคลากร",
            is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById("top_x_div_em_absent"));
        chart.draw(view, options);
    }
    function drawChartEmGroup() {

        var data = google.visualization.arrayToDataTable([
            ["ประเภท", "จำนวน"],

            ["ฝ่ายบริหาร", 2],
            ["ข้าราชการครู", 25],
            ["ครูอัตราจ้าง", 3],
            ["พนักงานราชการ", 1],
            ["ลูกจ้างประจำ", 4],
            ["ลูกจ้างชั่วคราว", 1],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "จำนวนบุคลากรแยกตามประเภท",
            is3D: true,
            pieSliceText: 'label',
            slices: {1: {offset: 0.2},
                5: {offset: 0.2},
            },
            //isStacked: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById("top_x_div_em_group"));
        chart.draw(view, options);
    }
    function drawChartBudget() {

        var data = google.visualization.arrayToDataTable([
            ["รายการการใช้งบ", "จำนวน"],
            ["งบประมาณที่ใช้ไป", 9223100],
            ["งบประมาณคงเหลือ", 13777300],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "รายงานสรุปการใช้งบประมาณคงเหลือ",
            is3D: true,
            pieSliceText: 'label',
            slices: {1: {offset: 0.2},
                5: {offset: 0.2},
            },
            //isStacked: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById("top_x_div_budget"));
        chart.draw(view, options);
    }
    function drawChartBudgetQ() {

        var data = google.visualization.arrayToDataTable([
            ["ไตรมาส", "งบประมาณทั้งหมด", "งบประมาณที่ใช้ไป", {role: 'annotation'}],
            ["ไตรมาส 1", 3665177, 3665100, '100%'],
            ["ไตรมาส 2", 2600220, 2578000, '99%'],
            ["ไตรมาส 3", 2007238, 1587000, '79%'],
            ["ไตรมาส 4", 5350045, 1543000, '29%'],
        ]);

        var view = new google.visualization.DataView(data);

        var options = {
            title: "รายงานการใช้งบสรุปตามไตรมาส",
            legend: {position: 'bottom', }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div_budget_q"));
        chart.draw(view, options);
    }
//drawChartBudget
</script>