<style>
    input[type=checkbox] {
        border: 0px;
        width: 100%;
        height: 2em;
    }
</style>
<div class="box">
    <div class="box-heading">เนื้อหาการสอน (<?php echo $this->session->userdata('name') ?>)

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li>เนื้อหาการสอน</li>
    </ul>
    <div class="box-body" >
        <?php
        $this->load->view('layout/my_school_logo');
        ?> 
        <div class="row">
            <div class="col-md-12">
                <table class='table table-bordered table-hover' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 10%;text-align: center;'>ที่</th>                              
                            <th style='width: 80%;text-align: center;'>เนื้อหาการสอน</th>
                            <th style='width: 10%;text-align: center;'>สถานะ</th>  
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <tr >
                            <td style='width: 5%;' colspan='3'>หน่วยการเรียนรู้ที่ 1</td>   
                        </tr>
                         <tr >
                            <td style='width: 5%;text-align: center;'>1</td>  
                            <td style='width: 5%;text-align: center;'>present simple</td>   
                            <td style='width: 5%;text-align: center;'><font color='green'><b>สอนแล้ว</b></font></td>   
                        </tr>
                         <tr >
                            <td style='width: 5%;text-align: center;'>2</td>  
                            <td style='width: 5%;text-align: center;'>some / any</td>   
                            <td style='width: 5%;text-align: center;'><font color='red'><b>ยังไม่ถูกสอน</b></font></td>   
                        </tr>
                         <tr >
                            <td style='width: 5%;text-align: center;'>3</td>  
                            <td style='width: 5%;text-align: center;'>coutable / uncountable</td>   
                            <td style='width: 5%;text-align: center;'><font color='red'><b>ยังไม่ถูกสอน</b></font></td>   
                        </tr>
                         <tr >
                            <td style='width: 5%;text-align: center;'>4</td>  
                            <td style='width: 5%;text-align: center;'>toomuch / too many</td>   
                            <td style='width: 5%;text-align: center;'><font color='red'><b>ยังไม่ถูกสอน</b></font></td>   
                        </tr>
                    </tbody> 
                </table> 
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>
    window.onload = function () {
        ReloadTable();
    };

    function ReloadTable() {

<?php
$tabName = "MyTable";
$title = $this->Echo_Text_Model->head_logo('การกำหนดชิ้นงาน/ภาระงาน', $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    }
</script>
<script>
    function AddCourseWork(e) {
//        alert(e.id)
        $.ajax({
            url: '<?php echo site_url('Teaching_task/get_teaching_task_course_work_by_unit_id'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
                $("#insert-form")[0].reset();
                $("h3.modal-title").text("กำหนดชิ้นงาน/ภาระงาน");

                $("#KpiForCourseWorkTbody").html(data);
                $("#UnitId").val(e.id);
                $("#teaching-task-course-work-modal").modal("show");
            }
        });

    }

    function DeleteThisCourseWork(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teaching_task/teaching_task_course_work_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

//    function AddKpiThisCourseWork(e) {
//        $("h3.modal-title").text("จัดการตัวชี้วัด");
//        $("#teaching-task-course-work-kpi-modal").modal("show");
//    }


</script>
