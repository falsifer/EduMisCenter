<div class="box">
    <div class="box-heading">อ่าน เขียน คิดวิเคราะห์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-evaluation', "สารสนเทศงานวัดผลและประเมินผล"); ?></li>
        <li>อ่าน เขียน คิดวิเคราะห์</li>
    </ul>
    <div class="box-body">
        <div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-rw-analysis-form'), "<i class='icon-edit'></i> แบบบันทึกการประเมิน"); ?></div>
            <div class="col-md-3 tab-menu-active"><i class="icon-cog"></i> มาตรฐานและตัวชี้วัด</div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">รายละเอียดอ่าน เขียน คิดวิเคราะห์</th>
                        
                        
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
                            <td><?php echo $r['tb_ed_rw_analysis_content']; ?></td>
                            
                            

                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
<!--                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>-->
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

<script>

    $('#example').DataTable({
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
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert1'><i class='icon-plus icon-large'></i> บันทึกหัวข้อข้อมูลอ่าน เขียน คิดวิเคราะห์</button>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert2'><i class='icon-plus icon-large'></i> บันทึกรายละเอียดข้อมูลอ่าน เขียน คิดวิเคราะห์</button>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert3'><i class='icon-plus icon-large'></i> บันทึกคะแนนข้อมูลอ่าน เขียน คิดวิเคราะห์</button>");
    }
    $(".btn-insert1").on("click", function () {
        location.href = "<?php echo site_url('ed-rw-analysis-insert-view'); ?>";
    });
    
    $(".btn-insert2").on("click", function () {
        location.href = "<?php echo site_url('ed-rw-analysis-insert-sub-view'); ?>";
    });
    
    $(".btn-insert3").on("click", function () {
        location.href = "<?php echo site_url('ed-rw-analysis-insert-score-view'); ?>";
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('er-base-detail'); ?>",
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
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('ed-rw-analysis-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inTbEdRwAnalysisContent").val(data.tb_ed_rw_analysis_content);
                
                
                

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดข้อมูลอ่าน เขียน คิดวิเคราะห์");
                $("#ed-rw-analysis-edit-modal").modal("show");
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
                url: '<?php echo site_url('er-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("ed_rw_analysis/ed_rw_analysis_edit_modal"); ?>
<?php $this->load->view("edu_research/er_detail_modal"); ?>