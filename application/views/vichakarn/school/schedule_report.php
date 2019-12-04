<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('ed-activity-planing'), " การวางแผนงานวิชาการ"); ?></li>-->
        <li>ตารางสอน</li>
    </ul>

    <div class="box-body">
        <div class="row"> 
            <div class="col-md-3 tab-menu-active"><i class='icon-print'></i> ตารางสอนรายชั้น</div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-section'), "<i class=\"icon-time\"></i> ข้อมูลพื้นฐานคาบเรียน"); ?></div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-course-teacher'), "<i class=\"icon-user\"></i> ข้อมูลครูผู้สอน"); ?></div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule'), "<i class='icon-calendar'></i> จัดตารางสอน"); ?></div>            
            
            <!--<div class="col-md-2 tab-menu"><?php // echo anchor(site_url('ed-course-teacher-temp'), "<i class=\"icon-group\"></i> บันทึกการสอนแทน"); ?></div>-->  
        </div>
        <div class="row databox">
            <!--<div class="row">--> 
                <!--<div class="col-md-6 tab-menu-active"><i class='icon-calendar'></i> ตารางสอนรายชั้น</div>-->
                <!--<div class="col-md-6 tab-menu"><?php echo anchor(site_url('ed-schedule-report-individual'), "<i class='icon-calendar'></i> ตารางสอนรายผู้สอน"); ?></div>-->
                <!--<div class="col-md-2 tab-menu"><?php echo anchor(site_url('ed-schedule'), "<i class='icon-calendar'></i> ตารางสอนรวม"); ?></div>-->
            <!--</div>-->
            <div class="row databox">

                <form method="post" id="room-insert-form">
                    <div class="row">
                        <?php
                        $data['class'] = 'Y';
                        $data['term'] = 'Y';
                        $data['room'] = 'Y';
                        ?>
                        <?php $this->load->view('layout/my_school_filter', $data); ?>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="row" style="margin-top:40px;">
                                <center>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered display" id="scheduleTab">
<!--                                            <thead>
                                                <tr>

                                                    <th class="no-sort" style="text-align: center;">วัน</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 1</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 2</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 3</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 4</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 5</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่ 6</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td style="text-align: center;">จ.</td>
                                                    <td style="text-align: center;" id="mon1"></td>
                                                    <td style="text-align: center;" id="mon2"></td>
                                                    <td style="text-align: center;" id="mon3"></td>
                                                    <td style="text-align: center;" id="mon4"></td>
                                                    <td style="text-align: center;" id="mon5"></td>
                                                    <td style="text-align: center;" id="mon6"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">อ.</td>
                                                    <td style="text-align: center;" id="tue1"></td>
                                                    <td style="text-align: center;" id="tue2"></td>
                                                    <td style="text-align: center;" id="teu3"></td>
                                                    <td style="text-align: center;" id="tue4"></td>
                                                    <td style="text-align: center;" id="tue5"></td>
                                                    <td style="text-align: center;" id="tue6"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">พ.</td>
                                                    <td style="text-align: center;" id="wed1"></td>
                                                    <td style="text-align: center;" id="wed2"></td>
                                                    <td style="text-align: center;" id="wed3"></td>
                                                    <td style="text-align: center;" id="wed4"></td>
                                                    <td style="text-align: center;" id="wed5"></td>
                                                    <td style="text-align: center;" id="wed6"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">พฤ.</td>
                                                    <td style="text-align: center;" id="thu1"></td>
                                                    <td style="text-align: center;" id="thu2"></td>
                                                    <td style="text-align: center;" id="thu3"></td>
                                                    <td style="text-align: center;" id="thu4"></td>
                                                    <td style="text-align: center;" id="thu5"></td>
                                                    <td style="text-align: center;" id="thu6"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;">ศ.</td>
                                                    <td style="text-align: center;" id="fri1"></td>
                                                    <td style="text-align: center;" id="fri2"></td>
                                                    <td style="text-align: center;" id="fri3"></td>
                                                    <td style="text-align: center;" id="fri4"></td>
                                                    <td style="text-align: center;" id="fri5"></td>
                                                    <td style="text-align: center;" id="fri6"></td>
                                                </tr>

                                            </tbody>-->
                                        </table>


                                    </div>
<!--                                    <center>
                                        <button type='button' class='btn btn-default btn-print'>
                                            <i class='icon-print icon-large'></i> 
                                            พิมพ์ตารางสอน</button>
                                    </center>-->
                                </center>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

        </form>
    </div>
</div>


</div>
<?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("vichakarn/modals/schedule_report_modal"); ?>

<script>

    $('.btn-print').on("click", function () {
        var yearly = $('#MyEdYear').val();
        var lev = $("#MyClass :selected").text();
        var rid = $("#MyRoom :selected").val();
        var term = $("#MyTerm :selected").val();

        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_section_report_print'); ?>",
            method: "post",
            data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
            success: function (data) {
                tinyMCE.get('inSchedule').setContent(data);
                $('#schedule-report-modal').modal('show');
            }
        });

    });

    function MyRoomOnChange(e) {

        var yearly = $('#MyEdYear').val();
        var lev = $("#MyClass :selected").text();
        var rid = $("#MyRoom :selected").val();
        var term = $("#MyTerm :selected").val();

        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_section_report'); ?>",
            method: "post",
            data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
            success: function (data) {

                $('#scheduleTab').html(data);
            }
        });

    }

</script>