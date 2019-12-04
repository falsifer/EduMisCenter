
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="">
        <thead>
            <tr>
                <th style="width:45px;"  >ที่</th>
                <th class="no-sort" style="width:80px;">ปีการศึกษา</th>
                <th class="no-sort"  >ชื่อ-สกุลผู้นิเทศ</th>
                <th class="no-sort"  >กลุ่มเป้าหมาย</th>
                <th class="no-sort">แผนการนิเทศ</th>
                <th class="no-sort">บันทึกสังเกตการณ์สอน</th>
                <th class="no-sort">บันทึกการนิเทศ</th>
                <th class="no-sort">บันทึก/สรุปผล</th>
                <th class="no-sort"  >วัตถุประสงค์ของการนิเทศ</th>
                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                    <th style="width:13%;border-right: none;" class="no-sort"  ></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $row = 1; ?>

            <?php foreach ($rs as $r): ?>
                <tr>
                    <td style="text-align:center;"><?php echo $row; ?></td>
                    <td style="text-align:center;"><?php echo $r['loan_year']; ?></td>
                    <td><?php echo $r['supervision_name']; ?></td>
                    <td><?php echo $r['supervision_destination']; ?></td>
                    <td style="text-align:center;"><a href="<?php echo site_url('supervision-plan-detail/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a></td>
                    <td style="text-align:center;"><a href="<?php echo site_url('supervision-observ-information/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a></td>
                    <td style="text-align:center;"><a href="<?php echo site_url('supervision-destination-note/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a></td>
                    <td style="text-align:center;"><a href="<?php echo site_url('supervision-final/' . $r['id']); ?>"><?php echo img("images/folder.png"); ?></a></td>
                    <td>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <?php if (!empty($r['supervision_purpose' . $i])): ?>
                                <?php echo '- ' . $r['supervision_purpose' . $i]; ?><?php echo br(); ?>
                            <?php else: ?>
                                <?php echo ''; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </td>
                    <td style="text-align:center;border-right:none;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class='icon-cogs'></i> OPT<span class="caret"></span></button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                <li><a href="<?php echo site_url('supervision-plan-detail/' . $r['id']); ?>">แผนการนิเทศ</a></li>
                                <li><a href="<?php echo site_url('supervision-observ-information/' . $r['id']); ?>">แบบบันทึกการสังเกตการณ์สอน</a></li>
                                <li><a href="<?php echo site_url('supervision-destination-note/' . $r['id']); ?>">บันทึกการนิเทศ</a></li>
                                <li><a href="<?php echo site_url('supervision-final/' . $r['id']); ?>">บันทึก/สรุปผลการนิเทศ</a></li>
                            </ul>
                        </div>     
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> EDIT</button>
                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> DEL</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $row++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
