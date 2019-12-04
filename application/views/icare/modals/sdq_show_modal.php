<div id="sdq-show-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1080px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกคะแนนแบบประเมิน SDQ</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="text-align: center; width:5%;" class="no-sort">ที่</th>
                            <th style="text-align: center; width:50%;" class="no-sort">พฤติกรรมประเมิน</th>

                            <th style="text-align: center; width:8%;" class="no-sort">ไม่จริง</th>
                            <th style="text-align: center; width:8%;" class="no-sort">อาจจะจริง</th>
                            <th style="text-align: center; width:8%;" class="no-sort">จริง</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $row = 1; ?>
                        <?php foreach ($sdq_topic as $r) : ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td style=""><?php echo $r['tb_icare_sdq_topic']; ?></td>

                                <td style="text-align: center;">
                                    <input type="radio" checked="" name="iii<?php echo $r['id']; ?>">
                                </td>

                                <td style="text-align: center;">
                                    <input type="radio"  name="iii<?php echo $r['id']; ?>">
                                </td>

                                <td style="text-align: center;">
                                    <input type="radio"  name="iii<?php echo $r['id']; ?>">
                                </td>

                            </tr>
                            <?php $row++;
                        endforeach; ?>

                    </tbody>
                </table> 
            
                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>




</script>
