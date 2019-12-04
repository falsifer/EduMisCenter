<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>ระบบงานวัดผลและประเมินผล</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานวัดผลและประเมินผล</li>
    </ul>

    <!-- Left side -->

    <div class="box-body">

        <div class="row">

            <div class="col-md-7">
                <div class="box-heading">
                    <i class="icon-bar-chart icon-large"></i> สรุปผลการเรียน 
                    <button class='btn btn-report btn-primary ' style="float: right;margin-right: 3px;" data-toggle='modal' data-target='#exam-report-modal'><i class='icon-print icon-large'></i> ปถ.01-09</button>
                    <button class='btn btn-report btn-primary ' style="float: right;margin-right: 3px;" data-toggle='modal' data-target='#exam-report-modal1'><i class='icon-print icon-large'></i> ปพ.01-02</button>
                    
                </div>

                <div class="databox">
                    <form method="post" id="room-insert-form">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">ปีการศึกษา</label><span class="star">&#42;</span>
                                <select name="inClassroomLevel" id="inClassroomLevel" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="<?php echo date('Y') + 543; ?>"><?php echo date('Y') + 543; ?></option>
                                    <option value="<?php echo date('Y') + 543 - 1; ?>"><?php echo date('Y') + 543 - 1; ?></option>
                                    <option value="<?php echo date('Y') + 543 - 2; ?>"><?php echo date('Y') + 543 - 2; ?></option>
                                    <option value="<?php echo date('Y') + 543 - 3 ?>"><?php echo date('Y') + 543 - 3 ?></option>
                                    <option value="<?php echo date('Y') + 543 - 4 ?>"><?php echo date('Y') + 543 - 4 ?></option>
                                    <option value="<?php echo date('Y') + 543 - 5 ?>"><?php echo date('Y') + 543 - 5 ?></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">ชั้น</label><span class="star">&#42;</span>
                                <select name="inClassroomLevel" id="inClassroomLevel" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="1">ประถมศึกษาปีที่ 1</option>
                                    <option value="2">ประถมศึกษาปีที่ 2</option>
                                    <option value="3">ประถมศึกษาปีที่ 3</option>
                                    <option value="4">ประถมศึกษาปีที่ 4</option>
                                    <option value="5">ประถมศึกษาปีที่ 5</option>
                                    <option value="6">ประถมศึกษาปีที่ 6</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">วิชา</label><span class="star">&#42;</span>
                                <select name="inClassroomRoom" id="inClassroomRoom" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="1">ภาษาไทย</option>
                                    <option value="2">คณิตศาสตร์</option>
                                    <option value="3">สังคมศึกษา</option>
                                    <option value="4">ศิลปะ</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" />
                    </form>
<!--                </div>
                <div id="top_x_div"  class="databox">-->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort" rowspan="3" style="text-align: center">จำนวนนักเรียนทั้งหมด</th>
                                    <th class="no-sort" colspan="8" style="text-align: center">สรุปผลการเรียน</th>
                                </tr>
                                <tr>
                                    <th class="no-sort" colspan="8" style="text-align: center">จำนวนนักเรียนที่ได้ระดับผลการเรียน</th>
                                </tr>
                                <tr>
                                    <th class="no-sort" style="text-align: center">๔</th>
                                    <th class="no-sort" style="text-align: center">๓.๕</th>
                                    <th class="no-sort" style="text-align: center">๓</th>
                                    <th class="no-sort" style="text-align: center">๒.๕</th>
                                    <th class="no-sort" style="text-align: center">๒</th>
                                    <th class="no-sort" style="text-align: center">๑.๕</th>
                                    <th class="no-sort" style="text-align: center">๑</th>
                                    <th class="no-sort" style="text-align: center">๐</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Right side -->
            <div class="col-md-5">
<!--                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('remedial-exam'); ?>';"><i class="icon-wrench icon-large pull-left"></i>สอบซ่อม</button>
                    </div>
                </div>-->
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('class-management'); ?>';"><i class="icon-list-alt icon-large pull-left"></i>เลื่อนชั้น</button>
                    </div>
                </div>
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu"><i class="icon-list-alt icon-large pull-left"></i>เทียบโอน</button>
                    </div>
                </div>
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('std-absent-record-base'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกหน้าเสาธง</button>
                    </div>
                </div>
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" ><i class="icon-edit icon-large pull-left"></i>บันทึกเข้าห้องเรียน</button>
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

<?php $this->load->view("vichakarn/modals/exam_report_modal"); ?>


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
    var status = "<?php //echo $this->session->userdata("status");                               ?>";
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-report btn-primary ' data-toggle='modal' data-target='#supervision-report-modal'><i class='icon-print icon-large'></i> พิมพ์แบบ ปถ.05</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });




 

</script>