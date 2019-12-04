<div id="exam-report-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">รายงานสรุปแบบ ปถ.01-ปถ.09</h4>
            </div>
            <div class="modal-body" style="padding:0px 40px;">
 
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-01'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> ใบรับรองผลการเรียน(ปถ.๐๑)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-02'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบบันทึกการประเมินการอ่านคิดวิเคราะห์และเชียน(ปถ.๐๒)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-03'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบบัญชีเรียกชื่อนักเรียน(ปถ.๐๓)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-04'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบประเมินผลคุณลักษณะอันพึงประสงค์(ปถ.๐๔)</div>
                        </div>
                    </div>
                    
                   
                    
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;padding: 10px;" class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-05'); ?>';"><i class="icon-list-alt icon-large"></i> แบบบันทึกผลการพัฒนาคุณภาพผู้เรียนรายวิชา(ปถ.๐๕)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-06'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบรายงานผลการพัฒนาคุณภาพผู้เรียนรายบุคคล(ปถ.๐๖)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-07'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบบันทึกผลพัฒนาคุณภาพผู้เรียนระดับชั้นเรียน(ปถ.๐๗)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-08'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบระเบียนสะสม(ปถ.๐๘)</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px;margin-bottom: 8px;text-align:center;">
                        <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                            <div style="margin-bottom:5px;"  class=" btn-exam" onclick="javascript:location.href = '<?php echo site_url('report-exam-09'); ?>';"><i class="icon-list-alt icon-large pull-left"></i> แบบรายงานผลการพัฒนาการเรียนรู้ตามมาตรฐานและตัวชี้วัด(ปถ.๐๙)</div>
                        </div>
                    </div>
             
            </div>
        </div>

    </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $("#supervision-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('Exam/supervision_rating_add'); ?>",
            method: "post",
            data: $("#supervision-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');

                $('#exam-report-modal').modal('hide');
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


<!-- Load Google chart api -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [{type: 'string', label: 'หัวข้อการนิเทศ'}, {type: 'number', label: "ผลการประเมิน"}, {"role": "style"}],

<?php
foreach ($supervision as $r):
    if ($r['rating'] != null) {
        echo '["' . $r['tb_supervision_title_detail'] . '",' . $r['rating'] . ',"color:red" ],';
    }
endforeach;
?>

        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2]);

        var options = {'title': 'How Much Pizza I Ate Last Night',
            'width': 400,
            'height': 300};
        var chart = new google.charts.Bar(document.getElementById('supervision_chart'));

        chart.draw(view, options);


    }

</script>