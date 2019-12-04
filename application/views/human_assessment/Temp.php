 <!--
                <?php $line = 1; ?>
                <?php foreach ($assessment_group as $group): ?>
                    <table class="table table-hover table-striped table-bordered display" style="width:100%;">
                        <thead>
                            <tr style="background:#e1f5fe;">
                                <th style="width:45px;"></th>
                                <th class="no-sort">รายการประเมิน</th>
                                <th class="no-sort">คะแนนเต็ม</th>
                                <th class="no-sort">คะแนนที่ได้</th>
                                <th class="no-sort" style="width:13%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $line; ?></td>
                                <td><?php echo $group['assessment_group_name']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $topic = $this->My_model->get_where_order('tb_human_assessment_topic', array('group_id' => $group['id']), 'id asc'); ?>
                            <?php if (!empty($topic)): ?>
                                <?php $row = 1; ?>
                                <?php foreach ($topic as $r): ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $r['assessment_topic_name']; ?></td>
                                        <td><?php echo $r['assessment_topic_score']; ?></td>
                                        <?php if($r['assessment_score']!=0):?>
                                        <td>Yes</td>
                                        <?php else:?>
                                        <td>No</td>
                                        <?php endif;?>
                                    </tr>

                                    <!--
                                        <tr>
                                            <td></td>
                                            <td><?php echo nbs(5); ?><?php echo $line . '.' . $row ?> <?php echo $t['assessment_topic_name']; ?></td>
                                            <td style="text-align:center;"><?php echo $t['assessment_topic_score']; ?> <?php echo $line . '' . $row; ?></td>
                                    <form method="post" id="insert-form"> 
                                    <?php $rs = $this->My_model->get_where_row('tb_human_assessment_activities', array('assessment_topic_id' => $t['id'])); ?>
                                    <?php if (!empty($rs)): ?>
                                                    <td style="width:120px;"><input type="number" name="inAssessmentScore<?php echo $line . '' . $row; ?>" id="inAssessmentScore<?php echo $line . '' . $row; ?>"  class="form-control" value="<?php echo $rs['assessment_score']; ?>"/></td>
                                    <?php else: ?>
                                                    <td style="width:120px;"><input type="number" name="inAssessmentScore<?php echo $line . '' . $row; ?>" id="inAssessmentScore<?php echo $line . '' . $row; ?>"  class="form-control" required/></td>
                                    <?php endif; ?>
                                        <td><button type="submit" class="btn btn-primary"><i class="icon-save"></i> บันทึก</button></td>
                                        <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="append_name" value="<?php echo $line . '' . $row; ?>" />
                                        <input type="hidden" name="assessment_topic_id" value="<?php echo $t['id']; ?>" />
                                    </form>
                                    </tr>
                                    -->
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php $line++; ?>
                <?php endforeach; ?>