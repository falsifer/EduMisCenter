<div class="box">
    <div class="box-heading">งานเยี่ยมบ้านนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('hr-homeroom', "งานครูประจำชั้น"); ?></li>
        <li>งานเยี่ยมบ้านนักเรียน</li>
    </ul>
    <div class="box-body">
        <div class="row" >
            <div class='col-md-12'>
                <div class='col-md-12' style='margin-bottom:25px;'> 
                    <button class='btn btn-link btn-lg col-xs-6' style='border:1px black solid;' onclick='GoVhCalendar()'>ตารางการเยี่ยมบ้านนักเรียน</button>
                    <button class='btn btn-primary btn-lg col-xs-6' style='border:1px black solid;' onclick='GoVhView()'>บันทึกการเยี่ยมบ้านนักเรียน</button>
                    <!--<button class='btn btn-primary btn-lg col-xs-4' ><b>สถิติเกี่ยวกับการเยี่ยมบ้าน</b></button>-->
                </div>
                <script>
                    function GoVhCalendar() {
                        location.href = '<?php echo site_url('hr-homeroom-vh-calendar') . '?room_id=' . $this->input->get('room_id'); ?>';
                    }
                    function GoVhView() {
                        location.href = '<?php echo site_url('visit-home') . '?room_id=' . $this->input->get('room_id'); ?>';
                    }
                </script>
                <div class='col-md-12' id="MyMap"> 
                    <?php echo $map['html']; ?>
                </div>


                <div  class='col-md-12' style="margin-top: 20px;">
                    <!--<button type='button' class='btn btn-primary' onclick='testvggome()'>test ! </button>-->
                    <table class="table table-hover table-striped table-bordered display" style='width:100%;' id="example">
                        <thead>
                            <tr>
                                <th style='width:10%;'>เลขที่</th>
                                <th style='width:15%;'>รหัสนักเรียน</th>
                                <th style='width:50%;'>ชื่อนักเรียน</th>                       
                                <!--<th class="no-sort">วันที่ออกเยี่ยม</th>-->
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <th style="width:25%;" class="no-sort"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 1; 
                            if($rsT || isset($rsT[0])){
                            ?>
                            <?php foreach ($rsT as $r): ?>
                                <?php
                                $check = $this->My_model->get_where_row('tb_visit_home_calendar', array('tb_student_base_id' => $r['StdId']));
                                if (isset($check['id'])) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $r['std_number']; ?></td>
                                        <td><?php echo $r['std_code']; ?></td>
                                        <!--<td><button class="btn btn-link btn-detail" id=""><?php echo $r['std_fullname']; ?></button></td>-->
                                        <td><?php echo "<span class='pull-left' ><img   src='" . $r['std_profile_picture'] . "' style='width: 50px;margin-right:10px;'/>" . $r['std_fullname'] . "</span>"; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                            $checker = $this->My_model->get_where_row('tb_visit_home_result', array('tb_student_base_id' => $r['StdId']));
                                            if (isset($checker['id'])) {
                                                ?>
                                                <button type="button" class="btn btn-info" onclick='ShowDetailModal(this)' id="<?php echo $checker['id']; ?>"><i class="icon-search icon-large"></i> ดูรายงาน</button>
                                                <button type="button" class="btn btn-danger " onclick='DeleteThisVhResult(this)' id="<?php echo $checker['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>


                                            <?php } else { ?>
                                                <button type="button" class="btn btn-success " onclick='ShowInsertModal(this)' id="<?php echo $r['StdId']; ?>"><i class="glyphicon glyphicon-editglyphicon glyphicon-edit"></i> บันทึกเยี่ยมบ้าน</button>

                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php $row++; ?>
                            <?php endforeach; 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php echo $map['js']; ?>
<?php $this->load->view("homeroom/hr_homeroom_visit_home_insert_modal"); ?>
<?php $this->load->view("homeroom/hr_homeroom_visit_home_detail_modal"); ?>
<script>

    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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
    $('.sorting_asc').removeClass('sorting_asc');


    function pop(id) {
        var uid = id;
        $.ajax({
            url: "<?php echo site_url('Visit_home/vh_base_default'); ?>",
            method: "POST",
            data: {std_id: uid},
            dataType: "json",
            success: function (data) {
                $("#inStdId").val(uid);
                $("#inStdFullname").html(data.std_titlename + data.std_firstname + " " + data.std_lastname);
                $("#inAddNo").val(data.add_no);
                $("#inAddMoo").val(data.add_moo);
                $("#inAddTambol").val(data.add_tambol);
                $("#inAddAmphur").val(data.add_amphur);
                $("#inAddProvince").val(data.add_province);
                $("#inAddZipcode").val(data.add_zipcode);
                $("#inAddLat").val(data.add_lat);
                $("#inAddLong").val(data.add_long);
                $("#vh-insert-modal").modal("show");
            }
        });
    }

    function ShowInsertModal(e) {
//        var uid = $(this).attr("id");
//        alert(e.id);
        $.ajax({
            url: '<?php echo site_url('Homeroom/hr_homeroom_vh_get_std_by_id'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
                var obj = JSON.parse(data);
                $('#StdId').val(obj.StdId);
                $('#inVhStdTitleName').val(obj.inVhStdTitleName);
                $('#inVhStdFirstName').val(obj.inVhStdFirstName);
                $('#inVhStdLastName').val(obj.inVhStdLastName);
                $('#inVhStdClassName').val(obj.inVhStdClassName);
                $('#inVhStdIdCard').val(obj.inVhStdIdCard);
                $('#inVhStdNickName').val(obj.inVhStdNickName);
                $('#inVhStdCode').val(obj.inVhStdCode);
                $('#inVhPrTitleName').val(obj.inVhPrTitleName);
                $('#inVhPrFirstName').val(obj.inVhPrFirstName);
                $('#inVhPrLastName').val(obj.inVhPrLastName);
                $('#inVhPrRelation').val(obj.inVhPrRelation);
                $('#inVhPrCareer').val(obj.inVhPrCareer);
                $('#inVhPrCareerSalary').val(obj.inVhPrCareerSalary);
                $('#inVhPrIdcard').val(obj.inVhPrIdcard);
                document.getElementById("inVhStdPicture").src = obj.inVhStdPicture;

                $("#visit-home-modal").modal("show");
            }
        });
    }
    function DeleteThisVhResult(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Homeroom/hr_homeroom_vh_delete_cl'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }

    }

    function ShowDetailModal(e) {
        $.ajax({
            url: '<?php echo site_url('Homeroom/hr_homeroom_vh_show_detail'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
                $('#MyDetailBody').html(data);
                $("#hr-homeroom-visit-home-detail-modal").modal("show");
            }
        });
    }
    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('vh-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#francis").html(data);
                $("h3.modal-title").text("รายละเอียดการเยี่ยมบ้านนักเรียน");
                $("#vh-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('vh-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inStdName").val(data.std_name);
                $("#inStdNo").val(data.std_no);
                $("#inStdClass").val(data.std_class);
                $("#inTechName").val(data.tech_name);
                $("#inDateVisit").val(data.date_visit);
                $("#inAddvDetail").val(data.addv_detail);
                $("#inAddcName").val(data.addc_name);
                $("#inAddcDetail").val(data.addc_detail);

                $("#inFatherName").val(data.father_name);
                $("#inFatherCareer").val(data.father_career);
                $("#inFatherSalary").val(data.father_salary);
                $("#inMotherName").val(data.mother_name);
                $("#inMotherCareer").val(data.mother_career);
                $("#inMotherSalary").val(data.mother_salary);
                $("#inParentName").val(data.parent_name);
                $("#inParentCareer").val(data.parent_career);
                $("#inParentSalary").val(data.parent_salary);
                $("#inHomeStructure").val(data.home_structure);
                $("#inHomeRelation").val(data.home_relation);
                $("#inStdTask").val(data.std_task);
                $("#inParentTraining").val(data.parent_training);
                $("#inParentAssistance").val(data.parent_assistance);
                $("#inTechComment").val(data.tech_comment);
                $("#inHomeDistance").val(data.home_distance);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดการเยี่ยมบ้านนักเรียน");
                $("#vh-edit-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('vh-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });

    function get_GEO(lat, long) {
//        alert(lat+","+long);
        $('#inNewLat').val(lat);
        $('#inNewLong').val(long);
        $("#vh-insert-geo-modal h3.modal-title").text($("#vh-insert-geo-modal h3.modal-title").text() + " " + lat + "," + long);
        $('#vh-insert-geo-modal').modal("show");
    }
</script>
<?php $this->load->view("homeroom/visit_home/vh_edit_modal"); ?>
<?php $this->load->view("homeroom/visit_home/vh_insert_modal"); ?>
<?php $this->load->view("homeroom/visit_home/vh_std_modal"); ?>

<?php $this->load->view("homeroom/visit_home/visit_home_modal"); ?>