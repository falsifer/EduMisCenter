<div class="box">
    <div class="box-heading">ผลงานดีเด่น/ความเป็นเลิศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ผลงานดีเด่น/ความเป็นเลิศ</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class='table table-bordered table-hover' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 5%;text-align: center;'>ที่</th>  
                            <th style='width: 20%;text-align: center;'>วันที่</th>
                            <th style='width: 15%;text-align: center;'>เรื่อง</th>                            
                            <th style='width: 20%;text-align: center;'>รายละเอียด</th>                            
                            <th style='width: 10%;text-align: center;'>ประเภท</th>
                            <th style='width: 10%;text-align: center;'>ระดับ</th>                            
                            <th style='width: 20%;text-align: center;'></th>
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <?php echo $Tbody; ?>
                    </tbody> 
                </table> 
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("excellence/excellence_insert_modal"); ?>
<?php $this->load->view("excellence/excellence_detail_modal"); ?>
<script>

    window.onload = function () {
        ReloadTable();
    };

    function ReloadTable() {

<?php
$tabName = "MyTable";
$title = $this->Echo_Text_Model->head_logo('ผลงานดีเด่น/ความเป็นเลิศ', $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
$btExArr = array();
$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary',
    'fn' => 'InsertThis()'
);
array_push($btExArr, $bt);
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    }
</script>

<script>

    $('#excellence-insert-modal').on('hide.bs.modal', function () {
        location.reload();
    });
    function InsertThis() {

        $("#insert-form")[0].reset();
        $("#excellence-insert-modal").modal("show");

    }

    function DetailThis(e) {
//        $('#MySchoolAreaId').val("MyExcellenceDetailBody");
        $.ajax({
            url: "<?php echo site_url('Excellence/excellence_detail'); ?>",
            method: "POST",
            data: {id: e.id},
            success: function (data) {
//                $("h3.modal-title").text(e.alt);
                $("#DetailModalBody").html(data);
                $("#excellence-detail-modal").modal("show");
            }
        });
    }

    function EditThis(e) {
        $.ajax({
            url: "<?php echo site_url('Excellence/excellence_edit'); ?>",
            method: "POST",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);

                $("#inExcellenceName").val(data.tb_school_excellence_name);
                $("#inExcellenceDetail").val(data.tb_school_excellence_detail);
                $("#inExcellenceType").val(data.tb_school_excellence_type);
                $("#inExcellenceLevel").val(data.tb_school_excellence_level);
                $("#inExcellenceStartDate").val(data.tb_school_excellence_startdate);
                $("#inExcellenceEndDate").val(data.tb_school_excellence_enddate);

                $("#excellence-insert-modal").modal("show");
            }
        });
    }


    function DeleteThis(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Excellence/excellence_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

</script>
