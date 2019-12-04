<div class="box">
    <div class="box-heading">งานเยี่ยมบ้านนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('hr-homeroom', "งานครูประจำชั้น"); ?></li>
        <li>งานเยี่ยมบ้านนักเรียน</li>
    </ul>
    <div class="box-body">
        <div class="row" id="MyMap">
            <?php echo $map['html']; ?>
        </div>
        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชั้น</th>
                        <th class="no-sort">เลขที่</th>
                        <th class="no-sort">ชื่อนักเรียน</th>                       
                        <!--<th class="no-sort">วันที่ออกเยี่ยม</th>-->
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rsT as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $r['std_number']; ?></td>
                            <td><?php echo $r['std_classname']; ?></td>
                            <td><?php echo $r['std_code']; ?></td>
                            <!--<td><button class="btn btn-link btn-detail" id=""><?php echo $r['std_fullname']; ?></button></td>-->
                            <td><?php echo $r['std_fullname']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-success btn-insert" id="<?php echo $r['StdId']; ?>"><i class="glyphicon glyphicon-editglyphicon glyphicon-edit"></i> บันทึกเยี่ยมบ้าน</button>
    <!--                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r->id; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>-->
                                <!--<button type="button" class="btn btn-danger btn-delete" id="<?php echo $r->id; ?>"><i class="icon-trash icon-large"></i> ลบ</button>-->
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php echo $map['js']; ?>
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

    $(".btn-insert").on("click", function () {
        var uid = $(this).attr("id");
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
    });

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
    
     function get_GEO(lat,long){
//        alert(lat+","+long);
        $('#inNewLat').val(lat);
        $('#inNewLong').val(long);
        $("#vh-insert-geo-modal h3.modal-title").text($("#vh-insert-geo-modal h3.modal-title").text()+" "+lat+","+long);
        $('#vh-insert-geo-modal').modal("show");
    }
</script>
<?php $this->load->view("visit_home/vh_edit_modal"); ?>
<?php $this->load->view("visit_home/vh_insert_modal"); ?>
<?php $this->load->view("visit_home/vh_std_modal"); ?>