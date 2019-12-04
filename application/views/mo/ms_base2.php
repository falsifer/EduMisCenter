<div class="box">
    <div class="box-heading">คลังสื่อการสอน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>คลังสื่อการสอน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">


                    <div class="col-md-6 form-group">
                        <label class="control-label">ชื่อสื่อ</label>
                        <input type="text" name="inMdName" id="inMdName" class="form-control" />
                    </div>
                    <!--                    <div class="col-md-3 form-group">
                                            <label class="control-label">ระดับชั้น</label>
                                            <select name="inMdClass" id="inMdClass" class="form-control" >
                                                <option value="">---เลือกข้อมูล---</option>
                    <?php
                    $output = "";
                    foreach ($rClass as $rC) {
                        $output .= "<option value='" . $rC['id'] . "'>" . $rC['tb_ed_school_class_name'] . "ปีที่ " . $rC['tb_ed_school_class_level'] . "</option>";
                    } echo $output;
                    ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">กลุ่มสาระ</label>
                                            <select name="inMdGrouplearning" id="inMdGrouplearning" class="form-control" >
                                                <option value="">---เลือกข้อมูล---</option>
                    <?php
                    $output = "";
                    foreach ($rClass as $rC) {
                        $output .= "<option value='" . $rC['id'] . "'>" . $rC['tb_ed_school_class_name'] . "ปีที่ " . $rC['tb_ed_school_class_level'] . "</option>";
                    } echo $output;
                    ?>
                                            </select>
                                        </div>-->

                    <div class="col-md-4 form-group">
                        <label class="control-label">ประเภทของสื่อ</label>
                        <select name="inMdType" id="inMdType" class="form-control" onchange='OnMediaChange(this)'>
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="LINK">ลิงค์ Youtube</option>
                            <option value="FILE">ไฟล์ (อัพโหลด)</option>
                        </select>
                    </div>

                    <div class="col-md-8 form-group" id='inMdLinkBody' style='display:none'> 
                        <label class="control-label">ลิงค์สื่อ</label>
                        <input type="text" name="inMdLink" id="inMdLink" class="form-control" placeholder='https://www.youtube.com/watch?v=GHBb25lzNVM'/>
                    </div>
                    <div class="col-md-8 form-group" id='inMdFileBody' style='display:none'>
                        <label class="control-label">ไฟล์อัพโหลด (รับไฟล์ทุกนามสกุล)</label>
                        <input type="file" name="inMdFile" id="inMdFile" class="filestyle" />
                    </div>


                    <div class="col-md-12 form-group" >
                        <label class="control-label">คำอธิบายของสื่อ</label>
                        <textarea id="inMdDes" name="inMdDes" style="width:100%;height:100px;"></textarea>  
                    </div>

                    <div class="col-md-12 form-group" style='margin-top:20px;'>
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>


                </form>

                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr >
                            <th style="width:40px;">ที่</th>

                            <th style="text-align:center;" class="no-sort">ชื่อของสื่อ</th>
                            <th style="text-align:center;" class="no-sort">คำอธิบาย</th>
                            <th style="text-align:center;" class="sorting">สื่อ</th>
                            <th style="text-align:center;" class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rbase as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row; ?></td>

                                <td style="text-align:left;">
                                    <?php echo $r['tb_media_name']; ?>
                                </td>
                                <td style="text-align:left;">
                                    <?php echo $r['tb_media_description']; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ($r['tb_media_type'] != 'FILE') { ?>
                                        <object width="125" height="100" data="http://www.youtube.com/v/<?php echo substr($r['tb_media_link'], -11); ?>" type="application/x-shockwave-flash">
                                            <param name="src" value="http://www.youtube.com/v/<?php echo substr($r['tb_media_link'], -11); ?>" />
                                        </object>
                                    <?php } else { ?>   
                                        <a href='<?php echo base_url() . 'upload/' . $r['tb_media_link'] ?>'>คลิกเพื่อดาวโหลด</a> 

                                    <?php } ?>
                                </td>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>" onclick='DeleteThisRow(this)' ><i class="icon-trash icon-large"></i> ลบ</button>
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
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });
    function DeleteThisRow(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Media_online/ms_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }

    }

    function OnMediaChange(e) {
//        alert(e.value)
        if (e.value == "LINK") {
            $("#inMdLinkBody").css("display", "block");
            $("#inMdFileBody").css("display", "none");
        } else {
            $("#inMdFileBody").css("display", "block");
            $("#inMdLinkBody").css("display", "none");
        }
    }

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

</script>

