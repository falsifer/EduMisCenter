<!-- Modal -->
<div id="classroom-online-base-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <style>
                .modal-body{
                    min-height: 300px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }
            </style>

            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class='row'>
                        <div class="col-md-12">
                            <form method="post" id="insert-base-form" enctype="multipart/form-data">
                                <input type="hidden" value='<?php echo $classroom_online['id']; ?>' name="classroom_online_id" id="classroom_online_id" required />
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">วิชาที่สอน</label>
                                    <select name="inCourseDetail" id="inCourseDetail" class="form-control"  required>
                                        <option>---เลือก---</option>
                                        <?php
                                            $this->db->select('*,cd.id as cdid');
                                            $this->db->from('tb_course_detail cd');
                                            $this->db->join('tb_course c','c.id=cd.tb_course_id');
                                            $this->db->where(array('cd.tb_human_resources_01_id'=>$this->session->userdata('hr_id')));
                                            $this->db->order_by('tb_course_code');
                                            $query = $this->db->get();
                                            $rs = $query->result_array();
                                            
                                            foreach($rs as $r){
                                                
                                                echo "<option value='".$r['cdid']."'>".$r['tb_course_code']."</option>";
                                            }
                                        ?>
                                        
                                        
                                    </select>
                                </div>
                                <div class="col-md-8" style="margin-top: 10px">
                                    <label class="control-label">ชื่อห้องเรียน</label>
                                    <input type="text" name="inClassroomOnlineName" id="inClassroomOnlineName" class="form-control"  required />
                                </div>
                                
                                <div class="col-md-12" style="margin-top: 10px">
                                    <center>
                                        <button type="submit" class="btn btn-success" ><i class="icon-save icon-large"></i> บันทึกข้อมูล</button>
                                    </center>    
                                </div>
                                <input type="hidden" name="id" id="id" value="" class="form-control"/>
                            </form>
                        </div> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-base-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-base-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
