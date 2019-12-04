<!-- Modal -->
<div id="ev-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="insert-form">
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                        <div class="row">
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['hr_name']; ?></button></td>
                        </div>
                        <div class="row">
                            <td style="text-align:center;">
                                <label><input type="radio" name="optradio" checked id=""><?php echo $r['hr_name']; ?></label>
                            </td> 
                        </div>
                        <div class="row">
                            <td style="text-align:center;">
                                <label><input type="radio" name="optradio" checked>Option 1</label>
                            </td> 
                        </div>
                        <div class="row">
                            <td style="text-align:center;">
                                <label><input type="radio" name="optradio" checked>Option 1</label>
                            </td> 
                        </div>
                        <div class="row">
                            <td style="text-align:center;">
                                <label><input type="radio" name="optradio" checked>Option 1</label>
                            </td> 
                        </div>
                        <div class="row">
                            <td style="text-align:center;">
                                <label><input type="radio" name="optradio" checked>Option 1</label>
                            </td> 
                        </div>

                        <?php $row++; ?>
                    <?php endforeach; ?>
                    </tbody>

                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('setting/localgov_do_insert'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>