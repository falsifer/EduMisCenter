<div class="box">
    <div class="box-heading"> <?php echo nbs(); ?> กำหนดแผนยุทธศาสตร์<?php echo $this->session->userdata('department'); ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url().'/education-planing', "รายละเอียดโครงการพัฒนา"); ?></li>
        <li>กำหนดแผนยุทธศาสตร์<?php echo $this->session->userdata('department'); ?></li>
    </ul>
      <div class="box-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <div class="row">
                <form method="post" id="insert-form" class="col-md-9 form-horizontal">
                    <div class="col-md-4 form-group">
                        <label class="control-label col-md-6">ยุทธศาสตร์ที่</label>
                        <div class="col-md-6">
                            <input type="text" name="inSchoolStNo" id="inSchoolStNo" class="form-control" autofocus required />
                        </div>
                    </div>
                    <div class="col-md-7 form-group">
                        <label class="control-label col-md-3">ชื่อยุทธศาสตร์</label>
                        <div class="col-md-8">
                            <input type="text" name="inSchoolStName" id="inSchoolStName" class="form-control" required/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-alrge"></i> บันทึก</button>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <hr/>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>

                        <th class="no-sort">ยุทธศาสตร์ที่</th>
                        <th class="no-sort">ชื่อยุทธศาสตร์</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
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
                                $rst = $this->My_model->get_where_order("tb_school_strategies",array('tb_school_strategic_id'=>$r['id']), "school_strategies_no asc"); 
                                foreach ($rst as $itm){
                                ?>
                                    <div class="row col-md-12">
                                    กลยุทธ์ที่ <?php echo $itm['school_strategies_no'].nbs(2).$itm['school_strategies_name'].nbs(4)?>
                                    <a class="btn-st-edit" id="<?php echo $itm['id']; ?>"> แก้ไข</a> |
                                    <a class="btn-st-delete" id="<?php echo $itm['id']; ?>"> ลบ</a>
                                    </div>
                                   <?php
                                }
                                   ?>
                                </div>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-info btn-strategy" alt='ยุทธศาสตร์ที่ <?php echo $r['school_strategic_no'].' '.$r['school_strategic_name'] ?>' id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> เพิ่มกลยุทธ์</button>
                                    <hr>
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    
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
                $("#inProvinceStrategicNo").val(data.strategies_no);
                $("#inProvinceStrategicName").val(data.strategies_name);
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-province-strategies'); ?>",
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
    
</script>

<?php $this->load->view("project_plan/modals/school_strategies_modal");