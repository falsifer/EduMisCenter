<table class="table table-hover table-striped table-bordered display" id="example3">
                                        <thead>
                                            <tr>
                                                <th class="no-sort" rowspan="2" style="text-align: center;" >ที่</th>
                                                <th class="no-sort" rowspan="2" style="text-align: center;" >ประเด็น</th>
                                                <th class="no-sort" style="text-align: center;"  <?php
                                                if ($inSupervisionTitleType === "ระดับคุณภาพ") {
                                                    echo ' colspan="5"';
                                                } else {
                                                    echo ' colspan="2"';
                                                }
                                                ?>><?php echo $inSupervisionTitleType ?></th>
                                                <th class="no-sort" rowspan="2" style="text-align: center;" >บันทึกข้อความ</th>
                                            </tr>
                                            <tr>
                                                <?php if ($inSupervisionTitleType === "ระดับคุณภาพ") { ?>
                                                    <th style="text-align: center;" >1</th>
                                                    <th style="text-align: center;" >2</th>
                                                    <th style="text-align: center;" >3</th>
                                                    <th style="text-align: center;" >4</th>
                                                    <th style="text-align: center;" >5</th>
                                                <?php } else { ?>
                                                    <th style="text-align: center;" >มี/ปฏิบัติ</th>
                                                    <th style="text-align: center;" >ไม่มี/ไม่ปฏิบัติ</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $row = 1; ?>
                                            <?php if($subtitle!=null)foreach ($subtitle as $r): ?>
                                                <?php // if ($r['username'] != 'admin'):  ?>
                                                <tr>
                                                    <td style="text-align:center;"><?php echo $row; ?></td>
                                                    <td style="width:200px;"><?php echo $r['tb_supervision_sub_title_detail'] /* === null ? '<button type="button" class="btn btn-save btn-default" id="' . $r['id'] . '"><i class="icon-plus icon-large"></i> เพิ่มหัวข้อ</button>' : $r['tb_supervision_issue_detail'] */; ?></td>                                         
                                                    <?php if ($inSupervisionTitleType === "ระดับคุณภาพ") { ?>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="1" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="2" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="3" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="4" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="5" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                    <?php } else { ?>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="1" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                        <td style="text-align: center;" ><input type="radio" name="inSupervisionRating<?php echo $r['id']; ?>"  value="2" id="inSupervisionRating<?php echo $r['id']; ?>" ></td>
                                                    <?php } ?>
                                                    <td style="text-align: center;">
                                                        <textarea name="inSupervisionComment<?php echo $r['id']; ?>" id="inSupervisionComment<?php echo $r['id']; ?>" rows="2" cols="40"></textarea>
                                                    </td>
                                        <input type="hidden" name="inSubtitleId[]" id="inSubtitleId[]" value="<?php echo $r['id']; ?>">
                                                </tr>
                                                <?php // endif; ?>
                                                <?php $row++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>