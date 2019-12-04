<div class="box">
    <div class="box-heading">สื่อเทคโนโลยีเพื่อการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>

        <li>สื่อเทคโนโลยีเพื่อการศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="row">
                            <b>กรอกรายละเอียดสื่อ</b>
                            <br></br>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">ชื่อสื่อ</label>
                                <input type="text" name="inMdName" id="inMdName" class="form-control" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ประเภทของสื่อ</label>
                                <select name="inMdType" id="inMdType" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="LINK">ลิงค์ Youtube</option>
                                    <option value="PDF">เอกสารประกอบ(PDF)</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">ลิงค์สื่อ</label>
                                <input type="text" name="inMdLink" id="inMdLink" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="control-label">คำอธิบายของสื่อ</label>
                        <textarea id="inMdDes" name="inMdDes" style="width:100%;height:100px;"></textarea>
                    </div>
                    <br>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>

                </form>

                <div class="row">
                    <b>สื่อในระบบ</b>
                    <br></br>
                </div>
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;text-align: center">ที่</th>
                            <th class="sorting" style="text-align: center">ชื่อสื่อ</th>
                            <th class="sorting" style="text-align: center">คำอธิบายของสื่อ</th>
                            <th class="sorting" style="text-align: center">สื่อเทคโนโลยีเพื่อการศึกษา</th>
                            <th class="no-sort" style="text-align: center">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rbase as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>
                                <td><?php echo $r['tb_media_name']; ?></td>
                                <td><?php echo $r['tb_media_description']; ?></td>
                                <td style="text-align: center;">
                                    <object width="250" height="200" data="http://www.youtube.com/v/<?php echo substr($r['tb_media_link'], -11); ?>" type="application/x-shockwave-flash">
                                        <param name="src" value="http://www.youtube.com/v/<?php echo substr($r['tb_media_link'], -11); ?>" />
                                    </object>
                                </td>

                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>

                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("ep/ep_modal"); ?>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Media_online/ms_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    
    
    $('.btn-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Media_online/ms_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });

</script>

