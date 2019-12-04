<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">งานรับ-ส่งหนังสือ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>หนังสือรับ</li>
        </ul>
        <div class="panel-body">
            <div class="panel-body">
                <div class="tab-content">

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="inBoxTab">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">เลขที่รับ</th>
                                    <th class="no-sort">รายละเอียด</th>
                                    <th class="no-sort">เปิดเพื่ออ่าน</th>
                                    <!--<th class="no-sort">การดำเนินการ</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($edoc_inbox as $r): ?>
                                    <tr id="inbox<?php echo $r['id']; ?>">
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่รับเข้า :</span>   <?php echo $r['edoc_rc_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ประเภท :</span>   <?php echo $r['edoc_type'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">การติดตาม :</span>   <?php echo $r['edoc_tracking_type'] ?>
                                            </div>
<!--                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ปฏิบัติ :</span>   <?php echo $r['edoc_responsible'] ?>
                                            </div>-->
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">วันที่รับ :</span>   <?php echo isset($r['edoc_rc_date']) ? shortdate($r['edoc_rc_date']) : ''; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เลขที่หนังสือ :</span>   <?php echo $r['edoc_no'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">ลงวันที่ :</span>   <?php echo isset($r['edoc_date']) ? shortdate($r['edoc_date']) : ''; ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">จาก :</span>   <?php echo $r['edoc_from'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรียน :</span>   <?php echo $r['edoc_to'] ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-weight:bold">เรื่อง :</span>   <?php echo $r['edoc_topic'] ?>
                                            </div>

                                        </td>
                                        <td style="text-align:center;">

                                            <?php
                                            if ($r['edoc_status'] == "หนังสือใหม่") {
                                                if (file_exists("upload/" . $r['edoc_file']) && !empty($r['edoc_file'])):
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>upload/<?php echo $r['edoc_file']; ?>" target="_blank">
                                                        <img src="<?php echo base_url(); ?>images/data-folder.png" />
                                                    </a>
                                                    <?php
                                                else:
                                                    echo img('images/gray-folder.png');
                                                endif;

                                                //echo "<span style='color:red'><i class='icon-folder-close' title='" . $r['edoc_status'] . "'></i></span>";
                                            }
                                            ?>
                                        </td>

                                            <!--<td style="text-align:center;"><button type="button" class="btn btn-primary btn-open" id="<?php echo $r['id'] ?>" tracking="<?php echo $r['edoc_tracking_type'] ?>" permission="<?php echo $r['edoc_psermission'] ?>"><i class="icon-inbox"></i> บันทึก</button></td>-->
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>



                    <?php $this->load->view('layout/my_school_footer'); ?>
                </div>


            </div>

            <script>
<?php
$tabName = "inBoxTab";
$title = "งานรับ-ส่ง หนังสือ :: หนังสือเข้า";
$colStr = "0,1,2";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>
                /* $('#inBoxTab').DataTable({
                 "responsive": true,
                 "stateSave": true,
                 "bSort": false,
                 "ordering": false,
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
                 });*/



            </script>
