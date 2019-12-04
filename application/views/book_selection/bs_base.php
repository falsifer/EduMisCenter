<div class="box">
    <div class="box-heading">งานคัดเลือกหนังสือแบบเรียน
        <!--<button type='button' class='btn btn-primary btn-insert' style="float:right;"><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>-->
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานคัดเลือกหนังสือแบบเรียน</li>
    </ul>
    <div class="box-body">
        <!--<div class="table-responsive">-->
            <table class="table table-striped table-bordered"  id="datatable-buttons">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อหนังสือ</th>
                        <th class="no-sort">รายวิชา</th>
                        <th class="no-sort">ชั้น</th>
                        <th class="no-sort">ผู้จัดพิมพ์</th>
                        <th class="no-sort">ราคา(บาท)</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" ): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['bs_name']; ?></button></td>
                            <td><?php echo $r['bs_subj']; ?></td>
                            <td><?php echo $r['bs_class']; ?></td>
                            <td><?php echo $r['bs_publisher']; ?></td>
                            <td style="text-align:right"><?php echo number_format($r['bs_price']); ?></td>

                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
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
        <!--</div>-->
    </div>

    <div class="box-footer" style="padding-top: 0px;">
<!--        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>-->
    </div>
</div>

 

<script>
    <?php
        $tabName = "datatable-buttons";
        
        $text = "งานคัดเลือกหนังสือแบบเรียน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5";
        $btExArr = array();
        
        $bt = array(
            'name'=>'add_bs',
            'title'=>'เพิ่มข้อมูล',
            'icon'=>'icon-plus',
            'class'=>'btn btn-primary btn-insert',
            'fn'=>''
        );
        array_push($btExArr,$bt);
    
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>

//    $('#datatable').DataTable({
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

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('bs-insert-view'); ?>";
    });

    // detail
    $("#datatable-buttons").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('bs-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดหนังสือแบบเรียน");
                $("#pr-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#datatable-buttons").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('bs-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inBsName").val(data.bs_name);
                $("#inBsSubj").val(data.bs_subj);
                $("#inBsSara").val(data.bs_sara);
                $("#inBsClass").val(data.bs_class);
                $("#inBsPublisher").val(data.bs_publisher);
                $("#inBsWriter").val(data.bs_writer);
                $("#inBsYear").val(data.bs_year);
                $("#inBsPrice").val(data.bs_price);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดหนังสือแบบเรียน");
                $("#pr-edit-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#datatable-buttons').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('bs-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("book_selection/bs_edit_modal"); ?>
<?php $this->load->view("book_selection/bs_detail_modal"); ?>