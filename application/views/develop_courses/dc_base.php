<div class="box">
    <div class="box-heading">การพัฒนาหลักสูตรในสถานศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การพัฒนาหลักสูตรในสถานศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive"  >
                        
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th  class="no-sort" style="width:20%;">กลุ่มสาระ</th>
                        <th class="no-sort">&nbsp;</th>
                        <th class="no-sort">สาระการเรียนรู้</th>
                        
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                         
                    </tr>
                </thead>
                <tbody>
                    <?php $group='' ?>
                    <?php foreach ($rs as $r) : ?>
                    <?php if($group!==$r['tb_group_learningcol_name']){ 
                             
                            
                        ?>
                    <tr>
                        <td>กลุ่มสาระ<?php echo $r['tb_group_learningcol_name']; ?></td>
    
                    <?php 
                        $group = $r['tb_group_learningcol_name']; 
                    
                    }else{?>
                        <td>&nbsp;</td>
                    <?php } ?>
                            <td style="text-align:center;">สาระที่ <?php echo thaidigit($r['tb_group_learning_item_seq']); ?></td>
                            <!--<td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></button></td>-->
                            <td>
                                <?php echo $r['tb_group_learning_item_content']; ?>
                            </td>
                            <td>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
<!--                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>-->
                                <?php endif; ?>
                            </td>
                        </tr>
                        
                    <?php endforeach; ?>
                </tbody>
            </table>                      
        </div>
    </div>
    

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $('#example').DataTable({
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
    });
    $('.sorting_asc').removeClass('sorting_asc');
    //
    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert1'><i class='icon-plus icon-large'></i> เพิ่มสาระการเรียนรู้</button>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert2'><i class='icon-plus icon-large'></i> เพิ่มมาตรฐาน</button>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert3'><i class='icon-plus icon-large'></i> เพิ่มตัวชี้วัด</button>");
    }
    
    $(".btn-insert1").on("click", function () {
        location.href = "<?php echo site_url('dc-insert-gl'); ?>";
    });
    $(".btn-insert2").on("click", function () {
        location.href = "<?php echo site_url('dc-insert-std'); ?>";
    });
    $(".btn-insert3").on("click", function () {
        location.href = "<?php echo site_url('dc-insert-kpi'); ?>";
    });
    
    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('bd-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียด");
                $("#bd-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('bd-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inBdType").val(data.bd_type);
                $("#inBdDetail").val(data.bd_detail);
                $("#inBdCap").val(data.bd_cap);
                $("#inBdRoom").val(data.bd_room);
                $("#inBdValue").val(data.bd_value);
                $("#inBdYear").val(data.bd_year);
                $("#inBdStatus").val(data.bd_status);
                

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียด");
                $("#bd-edit-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('dc-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("building/bd_edit_modal"); ?>
<?php $this->load->view("building/bd_detail_modal"); ?>