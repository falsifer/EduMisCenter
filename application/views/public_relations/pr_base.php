<div class="box">
    <div class="box-heading">งานประชาสัมพันธ์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานประชาสัมพันธ์</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วันที่ประชาสัมพันธ์</th>
                        <th class="no-sort" style="width:35%;">หัวข้อการประชาสัมพันธ์</th>
                        <th class="no-sort">ผู้ประชาสัมพันธ์</th>
                        <th style="width:13%;" class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><?php echo datethai($r['pr_date']); ?></td>                            
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['pr_topic']; ?></button></td>
                            <td><?php echo $r['pr_owner']; ?> ( <?php echo $r['pr_department']; ?> )</td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit btn-lg" id="<?php echo $r['id']; ?>" data-toggle="tooltip" title="แก้ไขข้อมูล" data-placement="top"><i class="icon-pencil icon-large"></i></button>
                                    <button type="button" class="btn btn-danger btn-delete btn-lg" id="<?php echo $r['id']; ?>" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"><i class="icon-trash icon-large"></i></button>
    
                                <a href="<?php echo site_url('print-pr-base-detail/' . $r['id']); ?>" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" title="พิมพ์ข้อมูล" target="_blank"><i class="icon-print icon-large"></i></a>
                            </td>
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
    <?php
        $tabName = "example";
        $text = "งานประชาสัมพันธ์";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3";
        $btExArr = array();
        
        $bt = array(
            'name'=>'add_pr',
            'title'=>'เพิ่มข้อมูล',
            'icon'=>'icon-plus',
            'class'=>'btn btn-primary  btn-insert',
            'fn'=>''
        );
        array_push($btExArr,$bt);
        
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>

//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        autoWidth: false,
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
////        "paging":         false,
////        "scrollY":        "300px",
////        "scrollX":        true,
////        "scrollCollapse": true,
////        "fixedColumns":   {
////            leftColumns: 2,
////            rightColumns: 1
////        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');

    // append insert button
//    var status = "<?php echo $this->session->userdata('status'); ?>";
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
//    }
    $(".btn-insert").on("click", function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลประชาสัมพันธ์งานการศึกษา");
        $("#public-relations-modal").modal("show");
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('pr-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดการประชาสัมพันธ์");
                $("#pr-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('pr-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inPrTopic").val(data.pr_topic);
                $("#inPrDetail").val(data.pr_detail);
                $("#inPrDate").val(data.pr_date);
                $("#inPrEndDate").val(data.pr_enddate);
                CKEDITOR.instances.inPrDetail.setData(data.pr_detail);
                
                if (data.pr_status === 'สาธารณะ') {
                    $('input[name="inPRStatus"]')[0].checked = true;
                } else {
                    $('input[name="inPRStatus"]')[1].checked = true;
                }
                
                
                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงข้อมูลประชาสัมพันธ์");
                $("#public-relations-modal").modal("show");
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
                url: '<?php echo site_url('pr-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    //
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: '<?php echo site_url('pr-base-detail'); ?>',
            method: 'post',
            data: {id: uid},
            success: function (data) {
                $("h3.modal-title").text("รายละเอียดข้อมูลประชาสัมพันธ์");
                $("#public-detail-modal").modal("show");
            }
        });
    });
    // data-toggle
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php $this->load->view("public_relations/modals/public_relations_modal"); ?>
<?php $this->load->view("public_relations/modals/public_detail_modal"); ?>