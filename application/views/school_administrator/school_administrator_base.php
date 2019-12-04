<div class="box">
    <div class="box-heading">ระบบงานปกครอง/กิจการนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบงานปกครอง/คะแนนความประพฤติ</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <?php // echo $dept; ?>
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="TopicTable">
                    <thead>
                        <tr style="background-color: #eeeeee;">
                            <th style="width:5%;text-align: center;">ที่</th>
                            <th style="width:35%;text-align: center;">ชื่อหัวข้อ</th>
                            <th style="width:10%;text-align: center;">ประเภท</th>
                            <th style="width:10%;text-align: center;">คะแนน</th>
                            <!--<th style="width:10%;text-align: center;">ผู้บันทึก</th>-->
                            <th style="width:10%;text-align: center;"></th>  
                            <th style="width:20%;text-align: center;"></th>                                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $admintopiclist; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view("layout/my_school_footer") ?>
</div>
<?php $this->load->view("school_administrator/adm_topic_insert_modal"); ?>
<script>
    $('#TopicTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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
    $("div#TopicTable_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อคะแนนความประพฤติ</button>");

    $(".btn-insert").on("click", function () {
        $('#topic-form')[0].reset();
        $("#adm-topic-insert-modal").modal("show");
    });

    $(".btn-edit").on("click", function () {

        var uid = $(this).attr('id');
//        alert(uid);
        $.ajax({
            url: "<?php echo site_url('School_administrator/adm_topic_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
//                alert(data.tb_administrator_topic_content);
                $("#inAdmTopicId").val(data.id);
                $("#inAdmContent").val(data.tb_administrator_topic_content);
                $("#inAdmType").val(data.tb_administrator_topic_type);
                $("#inAdmScore").val(data.tb_administrator_topic_maxscore);
                //
                $("#adm-topic-insert-modal").modal("show");
            }
        });
    });

    $(".btn-delete").on("click", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('School_administrator/adm_topic_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



</script>