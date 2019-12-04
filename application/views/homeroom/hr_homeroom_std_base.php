<div class="box">
    <div class="box-heading">สำมะโนนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('hr-homeroom'), "งานครูประจำชั้น"); ?></li>
        <li>สำมะโนนักเรียน</li>
    </ul>
    <div class="box-body"> 

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class='table table-hover table-bordered display' id='StudentTable'>
                    <thead>
                        <tr>
                            <th style='width: 10%;text-align: center;' >เลขที่</th>
                            <th style='width: 15%;text-align: center;'>รหัสนักเรียน</th>
                            <th style='width: 40%;text-align: center;'>ชื่อ-นามสกุล</th>
                            <th style='width: 15%;text-align: center;'>ชื่อเล่น</th>
                            <th style='width: 20%;text-align: center;'></th>
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
<?php $this->load->view('homeroom/hr_homeroom_std_modal'); ?>

<script>

    function StdNumberChange(e) {
        $.ajax({
            url: '<?php echo site_url('Homeroom/change_std_number'); ?>',
            method: "post",
            data: {id: e.id, number: e.value},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                location.reload();
            }
        });

    }

    function EditThisStd(e) {
//        alert(e.id)
        $.ajax({
            url: '<?php echo site_url('Homeroom/get_student_by_id'); ?>',
            method: "post",
            data: {id: e.id},
            dataType: "json",
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
//                $('#MySchoolAreaId').val('WnHBody');
                MyEndLoading();
//                alert(data[0].std_profile_picture);
//                alert(data[0]);
                $("#inStdId").val(data[0].StdId);
                $("#inStdTitlename").val(data[0].std_titlename.trim());
                $("#inStdFirstname").val(data[0].std_firstname);
                $("#inStdLastname").val(data[0].std_lastname);
                $("#inStdNickname").val(data[0].std_nickname);
                $("#inStdIdcard").val(data[0].std_idcard);
                $("#inStdReligion").val(data[0].std_religion);
                $("#inStdEthnicity").val(data[0].std_ethnicity);
                $("#inStdNationality").val(data[0].std_nationality);
                $("#inStdCode").val(data[0].std_code);

                $("#inStdBirthday").val(data[0].std_birthday);

                $("#inStdBirthhospital").val(data[0].std_birth_hospital);
                $("#inStdBloodtype").val(data[0].std_bloodtype);

                document.getElementById("blah").src = data[0].std_profile_picture;

                $('#hr-homeroom-std-modal').modal('show');
            }
        });
    }
</script>

<script>
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