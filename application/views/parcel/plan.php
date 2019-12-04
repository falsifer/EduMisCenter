
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!--<div class="box">
    <div class="box-heading">  ระบบงานพัสดุ
        <button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>ทำแผนการจัดซื้อจัดจ้างประจำปี</li>
    </ul>
    <div class="box-body">-->

                <div class="wrapper">
                    <div class="container">

         <!--Page-Title--> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
        
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#my-plan-modal"><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>
        
                                </div>
                                <h4 class="page-title">ทำแผนการจัดซื้อจัดจ้างประจำปี</h4>
                            </div>
                        </div>



        <!-- sample modal content -->
        <!--<div id="my-plan-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-plan-modalLabel" aria-hidden="true">-->
        <!-- Modal -->
        <div id="my-plan-modal" class="modal fade" role="dialog">   
            <div class="modal-dialog modal-lg">
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open_multipart('parcel/plan/process', $attributes);
                ?>   

                <!--<form class="form-horizontal" method="post" enctype="multipart/form-data">-->

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="my-plan-modalLabel">เพิ่มทำแผนการจัดซื้อจัดจ้าง</h4>
                    </div>
                    <div class="modal-body" style="padding: 20px;">

                        <div class="row" style="padding: 5px;">
                            <div class="col-md-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">เดือน</label>
                                <select class="form-control" name="inMonthPlan" id="inMonthPlan">
                                    <option value="1">มกราคม</option>
                                    <option value="2">กุมภาพันธ์</option>
                                    <option value="3">มีนาคม</option>
                                    <option value="4">เมษายน</option>
                                    <option value="5">พฤษภาคม</option>
                                    <option value="6">มิถุนายน</option>
                                    <option value="7">กรกฎาคม</option>
                                    <option value="8">สิงหาคม</option>
                                    <option value="9">กันยายน</option>
                                    <option value="10">ตุลาคม</option>
                                    <option value="11">พฤศจิกายน</option>
                                    <option value="12">ธันวาคม</option>
                                </select>

                                <!--</fieldset>-->
                            </div>
                            <div class="col-md-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">หน่วยงาน / บุคคลผู้ใช้พัสดุ</label>
                                <!--<input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="หน่วยงานหรือบุคคล">-->
                                <section>
                                    <input class="magicsearch" name="inDeparPlan" id="inDeparPlan" style="width : 250px; height: 40px !important;" placeholder="...">
                                </section>
                                <!--</fieldset>-->
                            </div>
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-sm-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">สัปดาห์ที่</label>
                                <select class="form-control" name="inWeekPlan" id="inWeekPlan">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>

                                <!--</fieldset>-->
                            </div>
                            <div class="col-sm-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">พัสดุที่จะขออนุมัติ หรือจ้าง</label>
                                <!--<input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="พัสดุที่จะขออนุมัติ">-->
                                <section>
                                    <input class="magicsearch" name="inApprovalPlan" id="inApprovalPlan" style="width : 250px; height: 40px !important;" placeholder="...">
                                </section>
                                <!--</fieldset>-->
                            </div>
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-sm-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">จำนวน</label>
                                <input type="text" class="form-control" id="inNumberPlan" name="inNumberPlan" placeholder="จำนวน">

                                <!--</fieldset>-->
                            </div>
                            <div class="col-sm-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">รายการ</label>
                                <input type="text" class="form-control" value="รายการ" id="inListPlan" name="inListPlan" placeholder="รายการ">

                                <!--</fieldset>-->
                            </div>
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-sm-6">
                                <!--<fieldset class="form-group">-->
                                <label for="exampleInputEmail1">ยอดขอจัดซื้อ / จ้าง (บาท)</label>
                                <input type="text" class="form-control" id="inTotalPlan" name="inTotalPlan" placeholder="ยอดขอจัดซื้อ">

                                <!--</fieldset>-->
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="get_id" name="get_id" />    
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button name="save" type="submit" class="btn btn-primary waves-effect waves-light">นำรายการเข้าแผน</button>
                    </div>
                </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="no-sort">ลำดับ</th>
                                <th class="no-sort">หน่วยงาน</th>
                                <th>เดือน</th>
                                <th class="no-sort">สัปดาห์ที่</th>

                                <th class="no-sort">พัสดุที่จะขออนุมัติหรือจ้าง</th>
                                <th class="no-sort">จำนวน</th>
                                <th class="no-sort">รายการ</th>
                                <th class="no-sort">ยอดขอจัดซื้อ/จ้าง (บาท)</th>
                                <th class="no-sort">ยอดที่ขออนุมัติในแต่ละสัปดาห์</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = $this->db->query("SELECT * from tb_parcel_plan order by month_plan,week_plan");
                            $result = $q->result_array();
                            $row = 1;
                            $week = "";
                            $month = "";
                            foreach ($result as $r) {
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $row; ?></td>
                                    <td><?php echo $r['depar_plan']; ?></td>
                                    <td><?php echo month_num($r['month_plan']); ?></td>
                                    <td style="text-align: center"><?php echo $r['week_plan']; ?></td>
                                    <td><?php echo $r['approval_plan']; ?></td>
                                    <td style="text-align: center"><?php echo $r['number_plan']; ?></td>
                                    <td style="text-align: right"><?php echo $r['list_plan']; ?></td>
                                    <td style="text-align: right"><?php echo number_format($r['total_plan']); ?></td>
                                    <?php
                                    if ($week != $r['week_plan'] || $month != $r['month_plan']) {
                                        $week = $r['week_plan'];
                                        $month = $r['month_plan'];
                                        $q = $this->db->query("SELECT count(*) as amt,sum(total_plan) as total FROM tb_parcel_plan  
WHERE month_plan =" . $r['month_plan'] . " AND week_plan = " . $r['week_plan'] . " GROUP BY month_plan,week_plan");
                                        $chk = $q->row_array();
                                        ?>
                                        <td style="text-align: right;vertical-align: bottom;font-weight: bold " rowspan="<?php echo $chk['amt']; ?>"><?php echo number_format($chk['total']); ?></td>
                                    <?php } else {
                                        ?>
                                        <td style="text-align: right;display: none;">&nbsp;</td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <i id='<?php echo $r['id']; ?>' class="icon-edit btn bt-edit" title="แก้ไข"  ></i>
                                        <i id='<?php echo $r['id']; ?>' class="icon-trash btn bt-delete" title="ลบ"  ></i>
                                    </td>
                                </tr>
                                <?php
                                $row++;
                            }
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                    </div>
                </div>
<!--    </div>
</div>-->

<!-- end row -->
<?php $this->db->select("name_mat,id")->from('tb_parcel_product'); ?>
<?php $approval_plan = $this->db->get()->result_array(); ?>

<?php $this->db->select("tb_division_name,id")->from('tb_division'); ?>
<?php $divi = $this->db->get()->result_array(); ?>

<script>

    // แก้ไขข้อมูลเป้าประสงค์

    $(".bt-insert").on("click", function () {

        $("#my-plan-modal").modal("show");
    });

    $(".bt-delete").on("click", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Plan/delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    alert('ลบข้อมูลสำเร็จ');
                    window.location.href = '<?php echo base_url('index.php/plan'); ?>';
                }
            });
        }
    });
    $(".bt-edit").on("click", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('parcel/Plan/edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#get_id").val(data.id);
                $("#inTotalPlan").val(data.total_plan);
                $('#inMonthPlan').val(data.month_plan);
                $('#inWeekPlan').val(data.week_plan);
                $('#inDeparPlan').val(data.depar_plan);
                $('#inApprovalPlan').val(data.approval_plan);
                $('#inNumberPlan').val(data.number_plan);
                $('#inListPlan').val(data.list_plan);

                $("h4.modal-title").text("ปรับปรุงข้อมูลแผนการจัดซื้อจัดจ้าง");
                $("#my-plan-modal").modal("show");
            }
        });
    });



//    $(function () {
    var dataSource = <?php echo json_encode($approval_plan); ?>;

    $('#inApprovalPlan').magicsearch({
        dataSource: dataSource,
        fields: ['name_mat'],
        id: 'id',
        format: '%name_mat%',
        isClear: false,
        success: function ($input, data) {
            return true;
        }
    });


    var dataSource2 = <?php echo json_encode($divi); ?>;

    $('#inDeparPlan').magicsearch({
        dataSource: dataSource2,
        fields: ['tb_division_name'],
        id: 'id',
        format: '%tb_division_name%',
        isClear: false,
        success: function ($input, data) {
            return true;
        }
    });
//    });//
//    $(document).ready(function () {
//        var table = $('#datatable-buttons').DataTable({
//            lengthChange: false,
//            buttons: ['copy', 'excel', 'pdf', 'colvis']
//        });
//
//        table.buttons().container()
//                .appendTo('#datatable-buttons_wrapper .col-sm-6:eq(0)');
//    });

//    $('#datatable-buttons').DataTable({
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
//        },
//        buttons: [
//        'excel'
//    ]
//        
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
</script>