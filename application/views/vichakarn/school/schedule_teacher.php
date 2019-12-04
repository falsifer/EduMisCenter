<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('ed-activity-planing'), " การวางแผนงานวิชาการ"); ?></li>-->
        <li>ตารางสอน</li>
    </ul>

    <div class="box-body">
        <div class="row" style="margin-bottom: 20px;"> 
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule-report'), "<i class=\"icon-print\"></i> ตารางสอนรายชั้น"); ?></div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-section'), "<i class=\"icon-time\"></i> ข้อมูลพื้นฐานคาบเรียน"); ?></div>
            <div class="col-md-3 tab-menu-active"><i class="icon-user"></i> ข้อมูลครูผู้สอน</div>
            
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule'), "<i class='icon-calendar'></i> จัดตารางสอน"); ?></div>
            
            <!--<div class="col-md-2 tab-menu"><?php echo anchor(site_url('ed-course-teacher-temp'), "<i class=\"icon-group\"></i> บันทึกการสอนแทน"); ?></div>-->
        </div>
        <div class="row">
            <?php
            $data['class'] = 'Y';
            $data['term'] = 'Y';
//            $data['room'] = 'N';
            ?>
            <?php $this->load->view('layout/my_school_filter', $data); ?>
        </div>
        <div class="table-responsive" id='teacherTBody'>
            <table class="table table-hover table-striped table-bordered display" id="teacher">
                <thead>
                    <tr>
                        <th class="no-sort">ระดับชั้น</th>
                        <th class="no-sort">รหัสวิชา</th>
                        <th class="no-sort">ชื่อวิชา</th>
                        <th class="no-sort">หน่วยกิต</th>
                        <!--<th class="no-sort">คาบ</th>-->
                        <th class="no-sort">ครูผู้สอน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody >
                    
                </tbody>
            </table>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("vichakarn/modals/ed_teacher_modal"); ?>
<script>


    

    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_schedule_section_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $("#inSectionEnd").val(data.tb_ed_section_end);
                $("#inSectionStart").val(data.tb_ed_section_start);
                $("#inSectionClassSub").val(data.tb_ed_section_class_sub);
                if (data.tb_ed_section_class === 'อนุบาล') {
                    $('input[name="inSectionClass"]')[0].checked = true;
                } else if (data.tb_ed_section_class === 'ประถมศึกษา') {
                    $('input[name="inSectionClass"]')[1].checked = true;
                } else if (data.tb_ed_section_class === 'มัธยมศึกษา') {
                    $('input[name="inSectionClass"]')[2].checked = true;
                } else {
                    $('input[name="inSectionClass"]')[3].checked = true;
                }

                $('#ed-teacher-modal').modal('show');

            }
        });
    });

    $("#section-insert-form").on("click", ".btn-clear", function () {
        $("#section-insert-form")[0].reset();
    });

    $("#section-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_schedule_section_add'); ?>",
            method: "post",
            data: $("#section-insert-form").serialize(),
            success: function (data) {
                $("#section-insert-form")[0].reset();
                location.href = "<?php echo site_url('ed-section/'); ?>";
            }

        });
    });
    function reloadTab(){
        $('#teacher').DataTable({
            "responsive": true,
            "stateSave": true,
            "bSort": false,
            "ordering": false,
            "pageLength": 50,
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
        var status = "<?php //echo $this->session->userdata("status");                          ?>";
//        $("div#teacher_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert-course' ><i class='icon-plus icon-large'></i> เพิ่มรายวิชาที่สอน</button>");
//        $("div#teacher_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-teacher-print-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css("overflow", "inherit");
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css("overflow", "auto");
        });
        
        $("#teacher").on("click", ".btn-insert", function () {
        var uid = $(this).attr('id');
        var sbj = $(this).attr('sbj');
        var code = $(this).attr('code');
        var txtHead = 'เพิ่มรายชื่อครูผู้สอนสำหรับวิชา ' + code + ' ' + sbj;


        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_teacher_list_by_course'); ?>",
            method: "post",
            data: {sbj: sbj, code: code, id: uid},
//            dataType: "json",
            success: function (data) {
                $("h4.modal-title").text(txtHead);
                $("#teacher-list").html(data);
                $('#ed-teacher-modal').modal('show');
            }
        });
    });
    }  

    $(".btn-insert-course").on("click", function () {
        location.href = "<?php echo site_url('insert-course/'); ?>";
    });

    function MyTermOnChange(e) {
        FilterCourse(e);

    }
    
    function MyClassOnChange(e) {
        FilterCourse(e);

    }
    
    function FilterCourse(e) {
        $.ajax({
            url: "<?php echo site_url('school/Schedule/get_course_by_term_edyear'); ?>",
            method: "post",
            data: {class:$("#MyClass").val(),term: $("#MyTerm").val(), edyear: $("#MyEdYear").val()},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $('#teacherTBody').html(data);
                reloadTab();
            }
        });
    }
</script>