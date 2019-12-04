
<!------------------------------------------------------------------------------
|  Title        Assessment activities
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       ข้อมูลการประเมินผลการปฏิบัติงาน
| Author	นายบัณฑิต ไชยดี
| Create Date   January 6, 2019
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">รายละเอียดการประเมินผลการปฏิบัติงานของ <?php echo $hr['hr_thai_symbol'] ?><?php echo $hr['hr_thai_name']; ?><?php echo nbs(2); ?><?php echo $hr['hr_thai_lastname']; ?></div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><?php echo anchor('human-assessment', 'ข้อมูลบุคลากรที่จะประเมิน'); ?></li>
            <li>ข้อมูลการประเมิน</li>

            <!--<span class="pull-right" style="margin-right:15px;"><?php echo img('images/printer.png'); ?><?php echo nbs(2); ?><a href="<?php echo site_url('print-human-assessment-activities/' . $hr['id']); ?>" target="_blank">พิมพ์ข้อมูลนี้</a></span>-->
           </ul>
        <div class="panel-body">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <legend>
                        <?php echo $hr['hr_thai_symbol'] ?><?php echo $hr['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $hr['hr_thai_lastname']; ?>
                       
                        </legend>
                         
        
                    </div>
                </div>
                <!--                <div class="row" style="margin-top:15px;">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;font-weight:bold;">ตำแหน่ง</div>
                                            <div class="col-md-9" style="border-bottom:1px dashed #ccc;"><?php echo $hr['hr_rank']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;font-weight: bold;">ระดับ</div>
                                            <div class="col-md-9" style="border-bottom:1px dashed #ccc;"><?php echo $hr['hr_level'] != '' ? $hr['hr_level'] : '&nbsp;'; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4" style="text-align: center;font-weight: bold;">อัตราเงินเดือน</div>
                                            <div class="col-md-8" style="border-bottom:1px dashed #ccc;"><?php echo $hr['salary'] != 0 ? number_format($hr['salary'], 0, '.', ',') : '&nbsp;'; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;font-weight: bold;">สังกัด</div>
                                            <div class="col-md-9" style="border-bottom:1px dashed #ccc;"><?php echo $hr['hr_office']; ?></div>
                                        </div>
                                    </div>
                                </div>-->
            </div>

            <div class="row" style="padding:20px;">
                <a href="<?php echo site_url('print-human-assessment-activities/' . $hr['id']); ?>" target="_blank"><button class="btn btn-primary" style="float:right"><i class="icon-print icon-large"></i> สั่งพิมพ์</button></a>
            </div>
            <div class="table-responsive">
                
                <?php $line = 1; ?>
                <?php foreach ($assessment_group as $group): ?>
                    <table class="table table-hover table-bordered table-condensed" style="font-size:1em;">
                        <thead>
                            <tr style="background:#f4f4f4;">
                                <th style="width:55px;text-align: center"></th>
                                <th style="text-align: center">รายการประเมิน</th>
                                <th style="width:20%;text-align: center">คะแนนเต็ม</th>
                                <th style="width:15%;text-align: center">คะแนนที่ได้</th>
                                <th style="width:25%;text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;"><?php echo $line; ?></td>
                                <td style="font-size:1.2em;"><?php echo $group['assessment_group_name']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $topic = $this->My_model->get_where_order('tb_human_assessment_topic', array('group_id' => $group['id']), 'id asc'); ?>
                            <?php $row = 1; ?>
                            <?php foreach ($topic as $r): ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo nbs(5); ?><?php echo $line . '.' . $row; ?> <?php echo $r['assessment_topic_name']; ?></td>
                                    <td style="text-align:center;"><?php echo $r['assessment_topic_score']; ?></td>
                                    <!-- form operation -->
                                    <?php $assessment = $this->My_model->get_where_row('tb_human_assessment_activities', array('assessment_topic_id' => $r['id'], 'hr_id' => $this->uri->segment(2))); ?>
                                    <?php if (!empty($assessment)): ?>
                                        <!-- แก้ไขข้อมูล -->
                                        <?php echo form_open('insert-human-assessment-activities', array('method' => 'post', 'id' => 'assessment-form')); ?>
                                        <td style="width:180px;">
                                            <input type="number" name="inAssessmentScore<?php echo $line . '' . $row; ?>" id="inAssessmentScore<?php echo $line . '' . $row; ?>" class="form-control" value="<?php echo $assessment['assessment_score']; ?>" />
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="submit" class="col-md-6 btn btn-warning"><i class="icon-pencil"></i> แก้ไข</button>
                                                <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $assessment['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                            </div>
                                        </td>
                                <input type="hidden" name="append_name" value="<?php echo $line . '' . $row; ?>" />
                                <input type="hidden" name="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                                <input type="hidden" name="assessment_topic_id" value="<?php echo $r['id']; ?>" />
                                <input type="hidden" name="current_page" value="<?php echo current_url(); ?>" />
                                <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                <input type="hidden" name="id" value="<?php echo $assessment['id']; ?>" />
                                <?php echo form_close(); ?>


                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <!-- บันทึกข้อมูล-->
                                    <?php echo form_open('insert-human-assessment-activities', array('method' => 'post', 'id' => 'assessment-form')); ?>
                                    <td style="width:180px;">
                                        <input type="number" name="inAssessmentScore<?php echo $line . '' . $row; ?>" id="inAssessmentScore<?php echo $line . '' . $row; ?>" class="form-control" />
                                    </td>
                                    <td><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></td>
                                    <input type="hidden" name="append_name" value="<?php echo $line . '' . $row; ?>" />
                                    <input type="hidden" name="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    <input type="hidden" name="assessment_topic_id" value="<?php echo $r['id']; ?>" />
                                    <input type="hidden" name="current_page" value="<?php echo current_url(); ?>" />
                                    <?php echo form_close(); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php $line++; ?>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <center><legend>รวมเป็นคะแนน<?php echo nbs(3); ?><?php echo $total_score['assessment_score']; ?> คะแนน</center></legend>
                </div>
            </div>


        </div>
        <?php
        $this->load->view('layout/my_school_footer');
        ?>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    $('.btn-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-assessment-activities'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>