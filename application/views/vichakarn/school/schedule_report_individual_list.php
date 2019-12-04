<div class="box">
    <div class="box-heading">งานการสอน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ตารางสอน</li>
    </ul>

    <div class="box-body">
        <div class="row databox">
            <div class="row databox" id="schID">
                <form method="post" id="room-insert-form">
                    <div class="row">
                        <?php
                        $data['term'] = 'Y';
                        ?>
                        <?php $this->load->view('layout/my_school_filter', $data); ?>
                    </div>
                    <div class="row col-md-12" style="text-align: center;">
                        <h3>ตารางสอน</h3>
                        <h3><?php echo $this->session->userdata('name'); ?></h3>
                        <h4><?php echo $this->session->userdata('department'); ?>(<?php echo $this->session->userdata('hr_id'); ?>)</h4>
                        <h4 id="yearly_term"></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="margin-top:40px;">
                                <center>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered display" id="scheduleTab">
                                            <thead>
                                                <tr>

                                                    <th class="no-sort" style="text-align: center;">วัน</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่</th>
                                                    <th class="no-sort" style="text-align: center;">เวลา</th>
                                                    <th class="no-sort" style="text-align: center;">ระดับชั้น</th>
                                                    <th class="no-sort" style="text-align: center;">สถานที่</th>
                                                    <th class="no-sort" style="text-align: center;">วิชา</th>
                                                    <th class="no-sort" style="text-align: center;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td style="text-align: center;">&nbsp;</td>
                                                    <td style="text-align: center;" id="mon1"></td>
                                                    <td style="text-align: center;" id="mon2"></td>
                                                    <td style="text-align: center;" id="mon3"></td>
                                                    <td style="text-align: center;" id="mon4"></td>
                                                    <td style="text-align: center;" id="mon5"></td>
                                                    <td style="text-align: center;" id="mon6"></td>
                                                </tr>


                                            </tbody>
                                        </table>


                                    </div>
                                    <center>
                                        <button type='button' class='btn btn-default btn-print'>
                                            <i class='icon-print icon-large'></i> 
                                            พิมพ์ตารางสอน</button>
                                    </center>
                                </center>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

        </form>
    </div>
    <?php $this->load->view('layout/my_school_footer');?>
</div>






<?php $this->load->view("vichakarn/modals/schedule_report_modal"); ?>

<script>

    $('.btn-print').on("click", function () {
        var yearly = $('#MyEdYear').val();
        var lev = $("#MyClass :selected").text();
        var rid = $("#MyRoom :selected").val();
        var term = $("#MyTerm :selected").val();

        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_section_report_print'); ?>",
            method: "post",
            data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
            success: function (data) {
                tinyMCE.get('inSchedule').setContent(data);
                $('#schedule-report-modal').modal('show');
            }
        });

    });

    function MyTermOnChange(e) {

        var yearly = $('#MyEdYear').val();
        var term = $("#MyTerm :selected").val();
        $('#yearly_term').html('ปีการศึกษา ' + yearly + ' ภาคเรียนที่ ' + term);
        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_section_by_user_individual'); ?>",
            method: "post",
            data: {yearly: yearly, eterm: term},
            success: function (data) {

                $('#scheduleTab').html(data);
                $('#scheduleTab').DataTable({
                    "scrollX": true,
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

            }
        });
    }




    $('#scheduleTab').on("click", ".btn-success", function () {

        var id = $(this).attr('id');
        var yearly = $(this).attr('year');
        location.href = '<?php echo site_url('pp5'); ?>?sc_id=' + id + '&EdYear=' + yearly;
    });

</script>