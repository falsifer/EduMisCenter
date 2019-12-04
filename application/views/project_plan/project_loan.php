<div class="box">
    <div class="box-heading">  งบประมาณในการดำเนินการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="javascript:window.history.go(-1);">โครงการดำเนินการ</a></li>
        <li>งบประมาณในการดำเนินการ</li>
    </ul>
    <div class="box-body">
        <div class="databox">
            <form id="insert-form" method="post" class="form-horizontal">
                    <div class="row" style="padding-top:30px;padding-bottom:30px;">
                        <div class="col-md-12 form-group">
                            <label class="control-label col-md-2">รายการค่าใช้จ่าย</label>
                            <div class="col-md-12">
                                <div class="col-md-11">
                                    <div class="col-md-9">
                                        <input type="text" name="inProjectPlanItem" id="inProjectPlanItem" class="form-control" required autofocus/>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="inProjectPlanBudget" id="inProjectPlanBudget" class="form-control" required/>
                                        <span class="input-group-addon">บาท <i class="icon-money"></i></span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">รายการค่าใช้จ่าย</th>
                        <th class="no-sort">จำนวนเงิน (บาท)</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:15%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td style="text-align:left;"><?php echo $r['project_plan_item'] ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['project_plan_budget'], 2, '.', ',') ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
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
                <?php echo img("images/kmk_logo.png"); ?>
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
        $text = "งบประมาณในการดำเนินการ  โครงการ";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3";
        $btExArr = array();
        
//        $bt = array(
//            'name'=>'add_topic',
//            'title'=>'เพิ่มข้อมูล',
//            'icon'=>'icon-plus',
//            'class'=>'btn btn-primary btn-insert',
//            'fn'=>''
//        );
//        array_push($btExArr,$bt);
    
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
//    //
//    var status = "<?php echo $this->session->userdata("status"); ?>";
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
//    }
    //
//    $(".btn-insert").click(function () {
//        $("#insert-form").trigger("reset");
//        $("h3.modal-title").text("บันทึกงบประมาณในการดำเนินการ");
//        $("#project-loan-year-modal").modal("show");
//    });
    
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        var uid = $("#id").val();
        
        $.ajax({
            url: "<?php echo site_url('EducationPlan/project_plan_loan_add'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
                alert('บันทึกเรียบร้อย');
            }
        });
    });
    //
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('EducationPlan/project_plan_loan_edit'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inProjectPlanItem').val(data.project_plan_item);
                $('#inProjectPlanBudget').val(data.project_plan_budget);
//                $('h3.modal-title').text('ปรับปรุงข้อมูลงบประมาณ');
//                $('#project-loan-year-modal').modal('show');
            }
        });
    });
    // delete data;
    $('#example').on('click','.btn-delete',function(){
    var uid=$(this).attr('id');
    var status=confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
    if(status){
        $.ajax({
            url:'<?php echo site_url('EducationPlan/project_plan_loan_delete'); ?>',
            method:'post',
            data:{id:uid},
            success:function(data){
                location.reload();
            }
        });
    }
    });
</script>
