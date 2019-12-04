<div class="panel panel-primary">
    <div class="panel-heading">การส่งเสริม สนับสนุนกำกับดูแล ติดตามและประเมินผลคุณภาพทางการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การส่งเสริม สนับสนุน</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th class="no-sort">วันที่ดำเนินการ</th>
                        <th class="no-sort">กลุ่มข้อมูลกิจกรรม</th>
                        <th class="no-sort">ระยะเวลา</th>
                        <th class="no-sort">หน่วยงานเป้าหมาย</th>
                        <th class="no-sort">หัวหน้าชุดดำเนินการ</th>
                        <th style="width:20%;" class="no-sort">
                            <button class='col-md-12 btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>                    
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo datethai($r['ev_date']); ?></td>
                            <td><?php echo $r['evaluation_category']; ?> / <?php echo $r['evaluation_activities']; ?></td>
                            <td style="text-align:center;"><?php echo $r['ev_days']; ?></td>
                            <td><?php echo $r['sc_thai_name']; ?></td>
                            <td><?php echo $r['ev_leader']; ?></td>
                            <td style="text-align:center;">
                                
                                    <button type="button" class="col-md-12 btn btn-info" data-toggle="dropdown">
                                        <i class="icon-cogs icon-large"></i> ดำเนินการ <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                        <li><a href="<?php echo site_url('education-evaluation-progress/' . $r['ev_id']); ?>"><i class="icon-list-ol icon-large"></i> ขั้นตอนการดำเนินงาน</a></li>
                                        <li><a href="<?php echo site_url('education-evaluation-payment/' . $r['ev_id']); ?>"><i class="icon-money icon-large"></i> ค่าใช้จ่ายในการดำเนินงาน</a></li>
                                        <li><a href="<?php echo site_url('education-evaluation-documents/' . $r['ev_id']); ?>"><i class="icon-picture icon-large"></i> ภาพประกอบ</a></li>
                                    </ul>
                                                            
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <div class="btn-group">
                                    <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['ev_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['ev_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </div>
                                </td>
                            <?php endif; ?>                    
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    
    function go(link){
        location.href = link;
    }
   
    
    <?php
        $tabName = "example";
        
        $text = "การส่งเสริม สนับสนุนกำกับดูแล ติดตามและประเมินผลคุณภาพทางการศึกษา";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5";
        $btExArr = array();
        
        $bt = array(
            'name'=>'add_topic',
            'title'=>'กำหนดกลุ่มงานหลัก',
            'icon'=>'icon-list',
            'class'=>'btn btn-primary',
            'fn'=>'go("'.site_url('education-evaluation-category').'");'
        );
        array_push($btExArr,$bt);
        
        $bt = array(
            'name'=>'add_topic_report',
            'title'=>'กำหนดรายการงาน',
            'icon'=>'icon-list',
            'class'=>'btn btn-primary',
            'fn'=>'go("'.site_url('education-evaluation-activities').'");'
        );
        array_push($btExArr,$bt);
    
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
    
    

    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลงานส่งเสริม-สนับสนุนฯ");
        $("#evaluation-modal").modal("show");
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-evaluation-data'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.ev_id);
                $('#inEvDate').val(data.ev_date);
                $('#inActivitiesId').val(data.activities_id);
                $('#inEvDay').val(data.ev_days);
                $('#inSchoolId').val(data.school_id);
                $('#inOfficeLeader').val(data.ev_leader);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลงานส่งเสริม-สนับสนุนฯ');
                $("#evaluation-modal").modal("show");

            }
        });
    });
    // delete data;
    $('#example').on("click", '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-education-evaluation-data'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("education_evaluation/modals/evaluation_modal"); ?>
<?php $this->load->view("education_evaluation/modals/info_modal"); ?>