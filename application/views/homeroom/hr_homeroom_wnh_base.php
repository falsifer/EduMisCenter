<div class="box">
    <div class="box-heading">การบันทึกน้ำหนักส่วนสูง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('hr-homeroom'), "งานครูประจำชั้น"); ?></li>
        <li>การบันทึกน้ำหนักส่วนสูง</li>
    </ul>
    <div class="box-body"> 

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class='table table-hover table-bordered display' id='StudentTable'>
                    <thead>
                        <tr>
                            <th style='width: 10%;text-align: center;'>เลขที่</th>
                            <th style='width: 15%;text-align: center;'>รหัสนักเรียน</th>
                            <th style='width: 40%;text-align: center;'>ชื่อ-นามสกุล</th>
                            <th style='width: 10%;text-align: center;'>น้ำหนัก</th>
                            <th style='width: 10%;text-align: center;'>ส่วนสูง</th>
                            <!--<th style='width: 10%;text-align: center;'>ดัชนีมวลกาย</th>-->
                            <th style='width: 15%;text-align: center;'></th>
                        </tr>
                    </thead>
                    <tbody id='StudentTBody'>
                        <?php echo $Student; ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" id='inRoomId' value="<?php echo $this->input->get("room_id") ?>"/>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('homeroom/hr_homeroom_wnh_modal'); ?>

<script>
    function HrHomeRoomWNH(e) {
        $.ajax({
            url: '<?php echo site_url('Homeroom/student_wnh_show'); ?>',
            method: 'post',
            data: {id: e.id},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('WnHBody');
                MyEndLoading();
                $("#WnHBody").html(data);
                $('#hr-homeroom-wnh-modal').modal('show');
            }
        });
    }
    
    <?php
        $tabName = "StudentTable";
        
        $text = "การบันทึกน้ำหนักส่วนสูง";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4";
        $btExArr = array();
  
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>

//    $('#StudentTable').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": false,
//        "paging": true,
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
    
    
    $('#hr-homeroom-wnh-modal').on('hide.bs.modal', function () {
        location.reload();
    });
    
</script> 