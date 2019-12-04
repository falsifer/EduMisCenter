<!------------------------------------------------------------------------------
|  Title
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose
| Author	นายบัณฑิต ไชยดี
| Create Date
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">รายละเอียดการจัดทำแผนกรอบอัตรากำลัง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('human-planing'); ?>">ข้อมูลการวางแผนอัตรากำลัง</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="col-md-12">
            <!-- left side -->
            <h3 style="margin-bottom:20px;">
                กรอบอัตรากำลัง 3 ปี (<?php echo $plan['begin_year']; ?> - <?php echo $plan['end_year']; ?>)
            </h3>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                    <thead>
                    <th class="no-sort" style="width:45px;">ที่</th>
                    <th class="no-sort" style="width:10%;">พ.ศ.</th>
                    <th class="no-sort" style="width:10%;">ตำแหน่ง</th>
                    <th class="no-sort" style="width:8%;">ระดับ</th>
                    <th class="no-sort" style="width:8%;">กรอบ<br/>อัตรากำลังเดิม</th>
                    <th class="no-sort" style="width:8%;">ปรับเพิ่ม</th>
                    <th class="no-sort" style="width:8%;">ปรับลด</th>
                    <th class="no-sort" style="width:8%;">รวมเป็น</th>
                    <th class="no-sort">หมายเหตุ</th>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <th class="no-sort" style="width:12%;"></th>
                    <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td style="text-align:center;"><?php echo $r['plan_year']; ?></td>
                                <td><?php echo $r['rank_name']; ?></td>
                                <td style="text-align:center;"><?php echo $r['level']; ?></td>
                                <td style="text-align:center;"><?php echo $r['old_hr']; ?></td>
                                <td style="text-align:center;"><?php echo $r['increase'] != 0 ? $r['increase'] : ''; ?></td>
                                <td style="text-align:center;"><?php echo $r['decrease'] != 0 ? $r['decrease'] : ''; ?></td>
                                <td style="text-align:center;"><?php echo $r['result'] != 0 ? $r['result'] : ''; ?></td>
                                <td><?php echo $r['comment']; ?></td>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['hr_id']; ?>" data-toggle="tooltip" title="แก้ไขหมายเลข <?php echo $r['hr_id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['hr_id']; ?>" data-toggle="tooltip" title="ลบหมายเลข <?php echo $r['hr_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                    </td>
                                <?php endif; ?>
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
<!---------------------------------------------------------------------------->
<script>
    //
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-plan-detail/' . $this->uri->segment(2)); ?>' target='_blank' class='btn btn-primary btn-print'><i class='icon-print icon-large'></i> สั่งพิมพ์</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลกรอบอัตรากำลัง 3 ปี');
        $('#insert-hr-plan-detail').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-plan-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.hr_id);
                $('#inRankId').val(data.rank_id);
                $('#inPlanYear').val(data.plan_year);
                $("#inLevel").val(data.level);
                $('#inOldHr').val(data.old_hr);
                $('#inIncrease').val(data.increase);
                $('#inDecrease').val(data.decrease);
                $('#inComment').val(data.comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูล');
                $('#insert-hr-plan-detail').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-plan-detail'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('human_planing/modals/insert_hr_plan_detail'); ?>
<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChart);
    //
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable([
            ['Year','Amount'],
            <?php 
            ?>
        ]);
        // Set chart options
        var options = {
            'title': 'How Much Pizza I Ate Last Night',
            'legend': 'left'
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>




