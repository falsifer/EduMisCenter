<!-- Modal -->
<div id="depre-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
<!--            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">อายุการใช้งานและอัตราค่าเสื่อม</h3>
            </div>-->
             <?php 
            $data['MyHeadTitle']='อายุการใช้งานและอัตราค่าเสื่อม';
            $this->load->view('layout/my_school_modal_header', $data); ?>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ประเภทครุภัณฑ์</label>
                            <select class="form-control" name="inParcelCategory" id="inParcelCategory" required>
                                <option>---เลือก---</option>
                                <?php
                                foreach($name_cat as $r){
                                    echo "<option value='".$r['id']."'>".$r['name_cat']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">อายุการใช้งาน(ปี)</label>
                            <input type="number" name="inDepreciateAge" id="inDepreciateAge" class="form-control" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">อัตราค่าเสื่อมราคาต่อปี</label>
                            <input type="number" name="inDepreciateValue" id="inDepreciateValue" class="form-control" required />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
<!--            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>-->
        </div>
    </div>
</div>
<script>
   
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('parcel/Articles/insert_depreciation'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>