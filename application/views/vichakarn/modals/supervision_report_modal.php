<div id="supervision-report-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">รายงานสรุปผลการนิเทศ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="supervision-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">งาน</label>
                                    <select name="inDivision4" id="inDivision4" class="form-control">
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($division as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_division_name']; ?></option>
                                        <?php endforeach; ?>                                    
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">หัวข้อการนิเทศ</label>
                                    <select name="inSupervisionTitleDetail4" id="inSupervisionTitleDetail4" class="form-control">
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($title as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_supervision_title_detail']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>

                            <div class='row'>
                                <label class="control-label">ผู้รับการนิเทศ</label>
                            </div>
                            <div class='row'>
                                <div class="col-md-6 form-group">
                                    <select name="inDepartment4" id="inDepartment4" class="form-control">
                                        <option value="">---เลือกหน่วยงาน---</option>
                                        <?php foreach ($school as $sc): ?>
                                            <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <select name="member4" id="member4" class="form-control">
                                        <option value="">---เลือกผู้รับการนิเทศ---</option>

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="inSupervisionTitleType" id="inSupervisionTitleType" />

                            <div class="row">
                                <div id='supervision_chart' class="databox"></div>
                            </div>


                            <div class="row">
                                <center><button type="submit" class="btn btn-default"><i class="icon-print icon-large"></i> พิมพ์รายงาน</button></center>
                            </div>

                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="inSupervissionTitleId" id="inSupervissionTitleId" />

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


<!-- Load Google chart api -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages: ['bar']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
      var data = google.visualization.arrayToDataTable([
          [{type: 'string', label: 'หัวข้อการนิเทศ'}, {type: 'number', label: "ผลการประเมิน"}, {"role":"style"}],

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