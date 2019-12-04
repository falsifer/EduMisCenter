 <!--
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed" id="example">
                <thead>
                    <tr>
                        <th class="no-sort" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">วันที่ส่ง</th>
                        <th class="no-sort" colspan="2">หน่วยงาน</th>
                        <th class="no-sort" rowspan="2">เลขที่หนังสือ</th>
                        <th class="no-sort" rowspan="2">ลงวันที่</th>
                        <th class="no-sort" colspan="4">ชั้นความเร็ว</th>
                        <th class="no-sort" rowspan="2">เรื่อง</th>
                        <th class="no-sort" rowspan="2">หนังสือ</th>
                        <th class="no-sort" rowspan="2">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                            <th class="no-sort" rowspan="2" style="width:6%"></th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="no-sort">รับจาก</th>
                        <th class="no-sort">ส่งถึง</th>
                        <th class="no-sort" style="width:6%;">ด่วนที่สุด</th>
                        <th class="no-sort" style="width:6%;">ด่วนมาก</th>
                        <th class="no-sort" style="width:6%;">ด่วน</th>
                        <th class="no-sort" style="width:6%;">ปกติ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo shortdate($r['edoc_send']) ?> <?php echo substr($r['edoc_send'], -8); ?></td>

                            <!-- เริ่มรับจาก -->
                            <td>
                                <?php if ($r['edoc_from'] == $this->session->userdata('department')): ?>
                                    <?php echo ""; ?>
                                <?php else: ?>
                                    <?php echo $r['edoc_from']; ?>
                                <?php endif; ?>
                            </td>
                            <!-- จบรับจาก -->

                            <!-- เริ่มส่งถึง -->
                            <?php if ($this->session->userdata("department") == $r['edoc_to']): ?>
                                <td></td>
                            <?php else: ?>
                                <td><?php echo $r['edoc_to'] != "" ? $r['edoc_to'] : "" ?></td>
                            <?php endif; ?>
                            <!-- จบส่งถึง -->

                            <td><?php echo $r['edoc_no'] ?></td>
                            <td><?php echo shortdate($r['edoc_date']) ?></td>
                            <!-- ชั้นความเร็ว -->
                            <?php if ($r['edoc_level'] == "ด่วนที่สุด"): ?>
                                <td style="text-align:center;"><?php echo img("images/checked.png"); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['edoc_level'] == "ด่วนมาก"): ?>
                                <td></td>
                                <td style="text-align:center;"><?php echo img("images/checked.png"); ?></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['edoc_level'] == "ด่วน"): ?>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img("images/checked.png"); ?></td>
                                <td></td>
                            <?php else: ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img("images/checked.png"); ?></td>
                            <?php endif; ?>
                            <!-- จบชั้นความเร็ว -->
                            <td><?php echo $r['edoc_topic'] ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists("upload/" . $r['edoc_file']) && !empty($r['edoc_file'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['edoc_file'], "ดาวน์โหลด", array("target" => "_blank", 'class' => 'btn btn-link')); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $r['edoc_comment']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                <td style="text-align:center;">
                                    <?php if ($r['edoc_to'] != $this->session->userdata('department')): ?>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>" style="width:100%;"><i class="icon-trash icon-large"></i> ลบ</button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-danger btn-delete" disabled  id="<?php echo $r['id']; ?>" style="width:100%;"><i class="icon-trash icon-large"></i> ลบ</button>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>