<div class="box">
    <div class="box-heading">วัตถุประสงค์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url() . '/education-planing', "รายละเอียดโครงการพัฒนา"); ?></li>
        <li>วัตถุประสงค์</li>
    </ul>

    <div class="box-body">
        <div class="databox">
            <form method="post" id="purpose-insert-form">
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">เนื้อหา</label><span class="star">&#42;</span>
                        <textarea class='editor' name='inPurposeContent' id="inPurposeContent">
                            <?php echo $rs == null ? '' : $rs['tb_purpose_content']; ?>
                        </textarea>
                    </div>
                </div>


                <div class="row" style="margin-top:20px;">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        <!-- &nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button> -->
                    </center>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo $rs == null ? '' : $rs['id']; ?>"/>
            </form>
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("vichakarn/modals/ed_room_modal"); ?>

<script>


    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/room_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $("#inClassroomLevel").val(data.tb_classroom_level);
                $("#inClassroomRoom").val(data.tb_classroom_room);
                $("#inClassroomStudentAmount").val(data.tb_classroom_student_amount);
                $("#inClassroomYear").val(data.tb_classroom_year);

                if (data.tb_classroom_class === 'อนุบาล') {
                    $('input[name="inClassroomClass"]')[0].checked = true;
                } else if (data.tb_classroom_class === 'ประถมศึกษา') {
                    $('input[name="inClassroomClass"]')[1].checked = true;
                } else if (data.tb_classroom_class === 'มัธยมศึกษา') {
                    $('input[name="inClassroomClass"]')[2].checked = true;
                }

            }
        });
    });

    $("#purpose-insert-form").on("click", ".btn-clear", function () {
        $("#purpose-insert-form")[0].reset();
    });

    $("#purpose-insert-form").on("submit", function (e) {
        e.preventDefault();
        $('#inPurposeContent').html(tinymce.get('inPurposeContent').getContent());

        $.ajax({
            url: "<?php echo site_url('EducationPlan/purpose_add'); ?>",
            method: "post",
            data: $("#purpose-insert-form").serialize(),
            success: function (data) {
                $("#purpose-insert-form")[0].reset();
                location.href = "<?php echo site_url('purpose/'); ?>";
            }

        });
    });

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
        },
    });

    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                         ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-room-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });




    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200,
        elements: "inPurposeContent",
    });

</script>