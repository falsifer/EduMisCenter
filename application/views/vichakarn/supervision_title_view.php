<table class="table table-hover table-striped table-bordered display" id="example2">
    <thead>
        <tr>
            <th class="no-sort">ที่</th>
            <th class="no-sort">ประเด็น</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $row = 1; ?>
        <?php foreach ($titleRS as $r): ?>
            <?php // if ($r['username'] != 'admin'): ?>
            <tr>
                <td style="text-align:center;"><?php echo $row; ?></td>
                <td><?php echo $r['tb_supervision_sub_title_detail'] /* === null ? '<button type="button" class="btn btn-save btn-default" id="' . $r['id'] . '"><i class="icon-plus icon-large"></i> เพิ่มหัวข้อ</button>' : $r['tb_supervision_issue_detail'] */; ?></td>                                         

                <td style="text-align: center;">
                    <button type="button" class="btn btn-default btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                    <button type="button" class="btn btn-default btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                </td>
            </tr>
            <?php // endif; ?>
            <?php $row++; ?>
        <?php endforeach; ?>
    </tbody>                          
</table>