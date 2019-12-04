<div class="box">
    <div class="box-heading">แบบประเมิน SDQ (ครูประเมินนักเรียน)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('hr-homeroom'), "งานครูประจำชั้น"); ?></li>
        <li>แบบประเมิน SDQ (ครูประเมินนักเรียน)</li>
    </ul>
    <div class="box-body"> 
        <?php
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>
        <div class="row">
            <div class="col-md-12">
                <table class='table table-hover table-bordered display' id='StudentTable'>
                    <thead>
                        <tr>
                            <th style='width: 10%;text-align: center;'>เลขที่</th>
                            <th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>
                            <th style='width: 40%;text-align: center;'>ชื่อ-นามสกุล</th>
                            <!--<th style='width: 10%;text-align: center;'>ผลการประเมิน</th>-->
                            <th style='text-align: center;'><i class='icon-edit'></i> บันทึกประเมิน / <i class='icon-print'></i> รายงานการประเมิน</th>
                        </tr>
                    </thead>
                    <tbody id='StudentTBody'>

                    </tbody>
                </table>
            </div>
            <input type="hidden" id='inRoomId' value="<?php echo $this->input->get("room_id") ?>"/>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('homeroom/hr_homeroom_sdq_modal'); ?>

<script>
    function HrHomeRoomSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: Term, edyear: EdYear,Assessor:"Teacher"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
                $('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }
    
    function StudentSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: $('#MyTerm').val(), edyear: EdYear,Assessor:"Student"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
//                $('#hr-homeroom-sdq-std-modal').modal('show');
$('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }
    
    function ParentSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: $('#MyTerm').val(), edyear: EdYear,Assessor:"Parent"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
                $('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }
</script>

<script>
    var EdYear = "";
    var Term = "";

    function MyTermOnChange(e) {
        Term = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
//        MyStdFilter();
    }



    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('Icare/student_list_by_filter'); ?>',
            method: 'post',
            data: {term: Term, edyear: EdYear, roomid: $('#inRoomId').val()},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#StudentTBody").html(data);
            }
        });
    }


    $('#StudentTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "paging": true,
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
</script> 