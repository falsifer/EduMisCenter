
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="box">
    <div class="box-heading">  ระบบงานพัสดุ
        <!--<button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>-->
<!--        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> ค้นหาเรื่องเดิมที่ทำไว้ </button>-->

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>อายุการใช้งานและอัตราค่าเสื่อม</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th>ที่</th>
                            <th class="no-sort">ประเภทครุภัณฑ์</th>
                            <th class="no-sort">อายุการใช้งาน(ปี)</th>
                            <th class="no-sort">อัตราค่าเสื่อมราคาต่อปี</th>
                            <th style="width:20%;" class="no-sort">
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>                    
                        <?php foreach ($depre as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['name_cat']; ?></td>
                                <td style="text-align:right;"><?php echo $r['tb_parcel_depreciate_age']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($r['tb_parcel_depreciate_value']); ?></td>
                                <td style="text-align:center;">
                                    <div class="btn-group">
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['did']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['did']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                    </div>
                                </td>                
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>

    function go(link) {
        location.href = link;
    }


<?php
$tabName = "example";

$text = "ระบบงานพัสดุ : อายุการใช้งานและอัตราค่าเสื่อมครุภัณฑ์";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary',
    'fn' => '$(\'#insert-form\').trigger(\'reset\');$(\'#depre-modal\').modal(\'show\');'
);
array_push($btExArr, $bt);


load_datatable($tabName, $btExArr, $title, $colStr);
?>
$('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('parcel/Articles/edit_depreciation'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inParcelCategory').val(data.tb_parcel_category_id);
                $('#inDepreciateAge').val(data.tb_parcel_depreciate_age);
                $('#inDepreciateValue').val(data.tb_parcel_depreciate_value);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลอายุการใช้งานและอัตราค่าเสื่อม');
                $('#depre-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('parcel/Articles/delete_depreciation'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('parcel/modals/depreciation_modal'); ?>
