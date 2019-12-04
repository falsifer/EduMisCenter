<div class="box">
    <div class="box-heading"> <?php echo nbs(); ?> กำหนดแผนยุทธศาสตร์<?php echo $this->session->userdata('department'); ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url() . '/project-plan', "แผนงาน"); ?></li>
        <li>กำหนดแผนยุทธศาสตร์<?php echo $this->session->userdata('department'); ?></li>
    </ul>
    <div class="box-body">

        <div class="row databox">
            <form method="post" id="insert-form">
                <div class="col-md-4">
                    <label class="col-md-6 control-label">ยุทธศาสตร์ที่</label>
                    <div class="col-md-6">
                        <input type="number" name="inSchoolStNo" id="inSchoolStNo" value="<?php echo count($rs) + 1; ?>" class="form-control" autofocus required />
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="control-label col-md-3">ชื่อยุทธศาสตร์</label>
                    <div class="col-md-8">
                        <input type="text" name="inSchoolStName" id="inSchoolStName" class="form-control" required/>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                    <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-alrge"></i> บันทึก</button>
                </center>
                </div>
                <input type="hidden" name="id" id="id" />
            </form>
        </div>



        <div class="row" style="margin-top:20px;">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>

                        <th class="no-sort">ยุทธศาสตร์ที่</th>
                        <th class="no-sort">ชื่อยุทธศาสตร์</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:18%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>

                            <td style="text-align:center;"><?php echo $r['school_strategic_no'] ?></td>
                            <td><?php echo $r['school_strategic_name'] ?>

                                <div class="col-md-12">
                                    <?php
                                    $rst = $this->My_model->get_where_order("tb_school_strategies", array('tb_school_strategic_id' => $r['id']), "school_strategies_no asc");
                                    $i = 1;
                                    foreach ($rst as $itm) {
                                        ?>
                                        <div class="row col-md-12">
                                            กลยุทธ์ที่ <?php echo $itm['school_strategies_no'] . "." . $i . nbs(2) . $itm['school_strategies_name'] . nbs(4) ?>
                                            <a class="btn btn-st-edit" style='color: orange' title='แก้ไข' id="<?php echo $itm['id']; ?>"><i class="icon-edit"></i></a>|
                                            <a class="btn btn-st-delete" style='color: red' title='ลบ' id="<?php echo $itm['id']; ?>"><i class="icon-trash"></i></a>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="col-md-12 btn btn-info btn-strategy" alt='ยุทธศาสตร์ที่ <?php echo $r['school_strategic_no'] . ' ' . $r['school_strategic_name'] ?>' id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> เพิ่มกลยุทธ์</button>
                                    <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "example";
        $title = "แผนยุทธศาสตร์ ". $this->session->userdata('department');
        $colStr = "0,1";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
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
//    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");

    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('EducationPlan/school_strategic_insert'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย...');
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('EducationPlan/school_strategic_edit'); ?>",
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $("#id").val(data.id);
                $("#inSchoolStNo").val(data.school_strategic_no);
                $("#inSchoolStName").val(data.school_strategic_name);
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('EducationPlan/school_strategic_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



    $('.btn-strategy').on("click", function () {
        $("h3.modal-title").text($(this).attr('alt'));
        $("#stid").val($(this).attr('id'));
        $("#st-modal").modal("show");
    });



    // edit data;
    $("#example").on("click", ".btn-st-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('EducationPlan/school_strategies_edit'); ?>",
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
//                alert(data.school_strategies_name);
                $("h3.modal-title").text($(this).attr('alt'));
                $("#stid").val(data.tb_school_strategic_id);
                $("#stsid").val(data.id);
                $("#inSchoolStsNo").val(data.school_strategies_no);
                $("#inSchoolStsName").val(data.school_strategies_name);
                $("#st-modal").modal("show");
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-st-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('EducationPlan/school_strategies_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



</script>

<?php
$this->load->view("project_plan/modals/school_strategies_modal");
