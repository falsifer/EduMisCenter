<!-- Modal -->
<div id="adm-topic-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php
            $data['MyHeadTitle'] = 'การจัดการหัวข้อคะแนนความประพฤติ';
            $this->load->view('layout/my_school_modal_header', $data);
            ?> 
            <div class="modal-body" style="padding:30px;">

                <form method="post" id="topic-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อหัวข้อ</label>
                            <input type="text" name="inAdmContent" id="inAdmContent" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ประเภท</label>
                            <select name="inAdmType" id="inAdmType" class="form-control"   required="" >
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="Plus">เพิ่มคะแนน</option>
                                <option value="Minus">ลดคะแนน</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">คะแนน</label>
                            <input type="text" name="inAdmScore" id="inAdmScore" class="form-control"   required=""/>
                        </div>              
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-success btn-insert" style='margin-top:25px;' onclick='InsertAdmTopic()'><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>
                    </div>
                    <input type="hidden" name="inAdmTopicId" id="inAdmTopicId" class="form-control"   />
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    function InsertAdmTopic() {
        $.ajax({
            url: "<?php echo site_url('School_administrator/adm_topic_insert'); ?>",
            method: "post",
            data: {id: $('#inAdmTopicId').val(), topicname: $('#inAdmContent').val(), topictype: $('#inAdmType').val(), topicscore: $('#inAdmScore').val()},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                location.reload();
//                $("#topic-form")[0].reset();
            }
        });
    }

</script>