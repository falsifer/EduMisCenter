<!-- Modal -->
<div id="teaching-task-course-work-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view("layout/my_school_modal_header"); ?>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">

                                <input type='hidden' id='inCourseDetailId' name='inCourseDetailId' value='<?php echo $this->input->get("course_detail_id") ?>'/>
                                <div style='margin-top:20px;' class="col-md-7 form-group">
                                    <label class="control-label">ชื่อ/เรื่อง</label>
                                    <input type="text" name="inCourseWorkName" id="inCourseWorkName" class="form-control" autofocus required/>
                                </div>
                                <div style='margin-top:20px;' class="col-md-3 form-group">
                                    <label class="control-label">ประเภท</label>
                                    <select class='form-control' name='inCourseWorkType' id='inCourseWorkType' required>
                                        <option value='ภาระงาน'>ภาระงาน</option>
                                        <option value='ชิ้นงาน'>ชิ้นงาน</option>
                                        <option value='ภาระงาน/ชิ้นงาน'>ภาระงาน/ชิ้นงาน</option>
                                        <option value='สอบ'>สอบ</option>
                                    </select>
                                    <!--<input type="text" name="inCourseWorkType" id="inCourseWorkType" class="form-control"  required/>-->
                                </div>
                                <div style='margin-top:20px;' class="col-md-2 form-group">
                                    <label class="control-label">คะแนนเต็ม</label>
                                    <input type="Number" name="inCourseWorkMaxscore" id="inCourseWorkMaxscore" class="form-control"  required/>
                                </div>

                                <div style='margin-top:20px;' class="col-md-12 form-group">
                                    <label class="control-label">คำอธิบายเพิ่มเติม</label>
                                    <textarea id="inCourseWorkDetail" name="inCourseWorkDetail" style="width:100%;height:100px;"></textarea>
                                </div>


                            </div>
                            <div class='col-md-4'>
                                <legend>ตัวชี้วัดที่ใช้วัดผล</legend>    
                                <table>
                                    <tr >
                                        <th style='width:25%'>

                                        </th>
                                        <th style='width:50%;font-size: 1.0em;'>
                                            ตัวชี้วัดที่ใช้
                                        </th>
                                        <th style='width:25%;font-size: 1.0em;'>
                                            คะแนนเต็ม
                                        </th>
                                    </tr>
                                    <tbody id='KpiForCourseWorkTbody'>
<!--                                        <tr >
                                            <td style='width:25%'>
                                                <input type='checkbox' id='inRadioTerm1' name='inRadioTerm' value='1' checked/>
                                            </td>
                                            <td style='width:50%;font-size: 1.5em;'>
                                                ท1.1 ป.1/1
                                            </td>
                                            <td style='width:25%;'>
                                                <input type='number' class='form-control' value=0>
                                            </td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                            <div style='margin-top:20px;' class="col-md-12 form-group" >
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                            <input type="hidden" name="UnitId" id="UnitId" />
                            <input type="hidden" name="id" id="id" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
//    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/teaching_task_course_work_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
//                alert(data)
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>