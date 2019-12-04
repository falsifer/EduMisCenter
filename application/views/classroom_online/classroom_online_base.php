<div class="box">
    <div class="box-heading">ห้องเรียนออนไลน์-หน้าแรก</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ห้องเรียนออนไลน์-หน้าแรก</li>
    </ul>
    <div class="box-body" >
        <!--<div class="container">-->
        <div class='row'>
            <div class='col-md-12'>
                <div class='col-md-6'>
                    <legend>ข่าวสาร</legend>
                </div>
                <div class='col-md-6'>
                    <legend>ห้องเรียนของฉัน</legend>
                    <table class="table table-striped table-bordered"  id="ClassOnlineTable">
                        <thead>
                            <tr>
                                <th style="width:10%;text-align: center;">ที่</th>
                                <th style="width:50%;text-align: center;">ชื่อห้องเรียน</th>
                                <!--<th style="width:20%;text-align: center;">วันที่สร้าง</th>-->
                                <th style="width:20%;text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($row as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_classroom_online_name']; ?></td>
                                    <!--<td style="text-align: center;"><?php echo datethaifull($r['tb_classroom_online_createdate']); ?></td>-->
                                    <td style="text-align: center;">
                                        <!--<button type='button' class='btn btn-warning' onclick='EditThis(<?php echo $r['id'] ?>)'><i class='icon-pencil icon-large'></i> แก้ไข</button>-->
                                        &nbsp;
                                        <a href="<?php echo site_url('edutech-classroom-online-room?class_room_id=' . $r['id']); ?>" class="btn btn-info" id="<?php echo $r['id']; ?>"><i class='glyphicon glyphicon-log-in'></i> เข้าสู่ห้องเรียน</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--</div>-->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
 <?php $this->load->view('classroom_online/classroom_online_base_modal'); ?>
<script>
    
    function go(){
        $('#classroom-online-base-modal').modal('show');
    }
    
    
<?php
$tabName = "ClassOnlineTable";

$text = "ห้องเรียนออนไลน์";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary',
    'fn' => 'go();'
);
array_push($btExArr, $bt);

load_datatable($tabName, $btExArr, $title, $colStr);
?>
    $('#ClassOnlineTable').DataTable({
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
        },
    });
</script>