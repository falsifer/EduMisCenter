<div id="sdq-print-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">พิมพ์แบบประเมินเปล่า</h4>
            </div>
            <div class="modal-body">
                <center>
                    <textarea class='editor'  name='inExam01' id="inSDQ">
 <div style="width:90%;margin: 60px auto;">
                    <center><div style="margin: 30px 0px;line-height: 35px;font-size: 20px;font-weight: bold;">แบบประเมินตนเอง (SDQ)</div></center>
                    <div style="margin: 30px 0px;line-height: 35px;font-size: 14px;"><?php echo nbs(10); ?>ชื่อ-สกุล นักเรียนที่รับการประเมิน (นาย/นางสาว)............................................................ 
                        ชั้น.................. เลขที่...............วัน/เดือน/ปี เกิด..............................
                                <?php echo nbs(3); ?>เพศ<?php echo nbs(2); ?><button class="btn btn-default"></button>  <b>ชาย </b><?php nbs(5); ?><button class="btn btn-default"></button> <b> หญิง</b>
                    </div>
            
                <br><label class="control-label"><u>คำชี้แจง</U> ให้ทำเครื่องหมาย / ในช่องท้ายหัวข้อให้ครบทุกข้อ กรุณาตอบให้ตรงกับความเป็นจริงที่เกิดขึ้นในช่วง 6 เดือน</label></br>
                <div style="width:90%;margin: auto;">
                    <table cellpadding="4" cellspacing="0" border="1">
                        <thead>
                            <tr>
                                <th style="text-align: center; width:3%;" class="no-sort">ที่</th>
                                <th style="text-align: center; width:30%;" class="no-sort">พฤติกรรมประเมิน</th>

                                <th style="text-align: center; width:4%;" class="no-sort">ไม่จริง</th>
                                <th style="text-align: center; width:4%;" class="no-sort">อาจจะจริง</th>
                                <th style="text-align: center; width:4%;" class="no-sort">จริง</th>
                            </tr>
                        </thead>
                        <tbody >
                                        <?php $row = 1; ?>
                                        <?php foreach ($sdq_topic as $r) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row; ?></td>
                                            <td style=""><?php echo $r['tb_icare_sdq_topic']; ?></td>

                                            <td style="text-align: center;">
                                                    <?php echo $row['']; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                    <?php echo $row['']; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                    <?php echo $row['']; ?>
                                            </td>

                                        </tr>
                                            <?php
                                            $row++;
                                        endforeach;
                                        ?>

                        </tbody>
                    </table> 
                    <div style="margin: 30px 0px;line-height: 35px;width:100%;font-size: 14px;">
                        <div style="font-weight: bold;">คุณมีความเห็นหรือความกังวลอื่นอีกหรือไม่</div>
                    <div>........................................................................................................................................................................................................................................................................</div>
                    <div style="width:35%;float:left;text-align: center">คะแนนด้านที่ 1</div><div style="float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    <div style="clear: both;height: 3px;"></div>
                    <div style="width:35%;float:left;text-align: center">คะแนนด้านที่ 2</div><div style="float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    <div style="clear: both;height: 3px;"></div>
                    <div style="width:35%;float:left;text-align: center">คะแนนด้านที่ 3</div><div style="float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    <div style="clear: both;height: 3px;"></div>
                    <div style="width:35%;float:left;text-align: center">คะแนนด้านที่ 4</div><div style="float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    <div style="clear: both;height: 3px;"></div>
                    <div style="margin-top: 20px;width:35%;float:left;text-align: center">รวมคะแนนทั้ง 4 ด้าน</div><div style="margin-top: 20px; float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    <div style="clear: both;height: 3px;"></div>
                    <hr>
                    <div style="width:35%;float:left;text-align: center">คะแนนความสัมพันธภาพทางสังคม </div><div style="float:left;"><?php echo nbs(3); ?><input type="text" style="height: 30px;width:60px" /> คะแนน<?php echo nbs(3) ?>แปลผล..............................</div>
                    </div>
                </div>
                    </textarea>
                </center>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
       </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 1123,
        width: 850,
        elements: "inSDQ",
        plugins: "print",
        toolbar: "print"
    });
</script>