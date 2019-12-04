<div class="box">
    <div class="box-heading">การจัดการวิชา(<?php echo $this->session->userdata('name') ?>)</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li>การจัดการวิชา</li>
    </ul>
    <div class="box-body">

        <?php
        $data['class'] = 'Y';
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            
                <table class="table table-hover table-bordered display" >
                    <thead>
                        <tr>
                            <th style="width:5%; text-align: center">ที่</th>
                            <th style="width:15%; text-align: center">กลุ่มสาระการเรียนรู้</th>
                            <th style="width:20%; text-align: center">วิชา/รหัสวิชา</th>
                            <th style="width:15%; text-align: center">ระดับชั้น</th>
                            <th style="width:8%; text-align: center">หน่วยกิต</th>
                            <th style="width:10%; text-align: center">ประเภทวิชา</th>
                            <th style="width:27%; text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody id='CourseBody'>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("dc/dc_result_modal"); ?>

<script>


//------ Set page Filter
    function MyTermOnChange(e) {
        FilterCourse(e);
    }

    function MyEdYearTest(e) {
        FilterCourse(e);
    }

    function MyClassOnChange(e) {
        FilterCourse(e);
    }


    function FilterCourse(e) {
        $.ajax({
            url: "<?php echo site_url('Teacher/course_by_filter'); ?>",
            method: "post",
            data: {id: $("#MyClass").val(), term: $("#MyTerm").val(), edyear: $("#MyEdYear").val()},
            success: function (data) {
                $('#CourseBody').html(data);
            }
        });
    }

//-------------------------------------

    $('.table').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "paging": false,
        "searching": false,
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

    function resultclick(e) {
        var uid = e.id;

        $.ajax({
            url: "<?php echo site_url('Dc/get_result'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $('#MySchoolAreaId').val("PrintThisResult");
                $("h3.modal-title").text("สรุปโครงสร้างรายวิชา");
                $('#ResultBody').html(data);
                $("#dc-result-modal").modal("show");
            }
        });
    }
    ;

    function SelectThisCourse(e) {
        location.href = '<?php echo site_url('course-management'); ?>?course_id=' + e.id;

    }
</script>