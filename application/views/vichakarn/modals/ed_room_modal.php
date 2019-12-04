<div id="ed-room-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">พิมพ์รายงาน</h4>
            </div>

            <div class="modal-body">
                <div class="row col-md-12" style="text-align: center;padding: 20px 10px 10px;font-weight: bold;">
                    <div class='header header-top'>ฐานข้อมูลห้องเรียน <?php echo $this->session->userdata("department"); ?></div>
                    <HR>
                </div>

                <div class="row">
                    <div class="databox">
                        <form method="post" id="room-insert-form">


                            <div class="row">
                                <?php
                                $data['class'] = 'Y';
                                ?>
                                <?php $this->load->view('layout/my_school_filter', $data); ?>
                            </div>

                            <div class="col-md-4">
                                <div id="top_x_div"  class="databox"></div>
                            </div>
                            <div class="col-md-8">
                                <div id="top_x_div2"  class="databox"></div>
                            </div>
                            <div class="table-responsive" style="margin-top:10px;">
                                <table class="table table-hover table-striped table-bordered display" id="example">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">ที่</th>
                                            <th class="no-sort">ห้อง</th>
                                            <th class="no-sort">จำนวนนักเรียน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = 1;
                                        $year = '2222';
                                        ?>
                                        <?php foreach ($roomRS as $r): ?>

                                            <?php if ($year != $r['tb_ed_school_register_class_edyear']): ?>
                                                <tr>
                                                    <td colspan="_">ปีการศึกษา    <?php
                                                        echo $r['tb_ed_school_register_class_edyear'];
                                                        $year = $r['tb_ed_school_register_class_edyear'];
                                                        ?></td>
                                                    <td style="display: none;">&nbsp;</td>
                                                    <td style="display: none;">&nbsp;</td>
                                                </tr>

                                            <?php endif; ?>

                                            <tr>
                                                <td style="text-align: center;"><?php echo $row; ?></td>
                                                <td><?php echo $r['tb_ed_school_class_name'] . ' ' . $r['tb_ed_school_class_level'] . '/' . $r['tb_classroom_room']; ?></td>
                                                <td><?php echo $r['tb_classroom_student_amount']; ?></td>
                                            </tr>

                                            <?php $row++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="margin-top:20px;">
                                <center><button type="submit" class="btn btn-success"><i class="icon-print icon-large"></i> พิมพ์</button>
                                </center>
                            </div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $("#supervision-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_rating_add'); ?>",
            method: "post",
            data: $("#supervision-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');

                $('#supervision-report-modal').modal('hide');
            }

        });
    });

    // delete data;
    $("#example3").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Supervision/supervision_rating_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    $('#insert-subtitle-modal').modal('show');
                }
            });
        }
    });

    // edit data;


    $("#example3").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_rating_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $("#inSupervisionSubTitleDetail").val(data.tb_supervision_sub_title_detail);
                $("#inSupervisionSubTitleDetail").focus();
                $("#inSupervisionSubTitleDetail").select();
                //$('#insert-subtitle-modal').modal('show');

            }
        });
    });



    $('#inDepartment').change(function () {
        var school = $('#inDepartment').val();
        if (school != '') {
            $.ajax({
                url: "<?php echo site_url('Supervision/member'); ?>",
                method: "post",
                data: {school: school},
                success: function (data) {

                    $('#member').html(data);
                }
            });
        }
    });

</script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawAnotherChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["ระดับชั้น", "จำนวนนักเรียน", {role: "style"}],

<?php
foreach ($room as $r):
    if ($r['tb_classroom_class'] != null) {
        echo '["' . $r['tb_classroom_class'] . '",' . $r['tb_classroom_student_amount'];
        if ($r['tb_classroom_student_amount'] > 5) {
            echo ',"color:orange" ],';
        } elseif ($r['sbj'] > 10) {
            echo ',"color:green" ],';
        } else {
            echo ',"color:red" ],';
        }
    }
endforeach;
?>
        ]);

        var view = new google.visualization.DataView(data);

        var result = google.visualization.data.group(
                view,
                [0],
                [{'column': 1, 'aggregation': google.visualization.data.sum, 'type': 'number'}]
                );
        var options = {
            title: "จำนวนนักเรียน",
            width: 350,
            height: 400,
        };
        var chart = new google.visualization.PieChart(document.getElementById("top_x_div"));
        chart.draw(result, options);
    }


    function drawAnotherChart() {
        var data = google.visualization.arrayToDataTable([
            ["ระดับชั้น", "จำนวนห้อง", {role: "style"}],

<?php
foreach ($room as $r):
    if ($r['tb_classroom_class'] != null) {
        echo '["' . $r['tb_classroom_class'] . ' ' . $r['tb_classroom_level'] . '",' . $r['tb_classroom_student_amount'];
        if ($r['tb_classroom_student_amount'] > 5) {
            echo ',"color:orange" ],';
        } elseif ($r['sbj'] > 10) {
            echo ',"color:green" ],';
        } else {
            echo ',"color:red" ],';
        }
    }
endforeach;
?>
        ]);

        var view = new google.visualization.DataView(data);

        var result = google.visualization.data.group(
                view,
                [0],
                [{'column': 1, 'aggregation': google.visualization.data.count, 'type': 'number'}]
                );

        var options = {
            title: "จำนวนห้องแต่ละระดับชั้น",
            width: 600,
            height: 400,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div2"));
        chart.draw(result, options);
    }
</script>

