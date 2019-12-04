<div id="qa-plan-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog"style="width:98%;">
        <div class="modal-content">
<!--            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกแผนการประกันคุณภาพในสถานศึกษา ประจำปีการศึกษา <?php echo get_edyear(); ?></h4>
            </div>-->
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body">
                <div class="row">
                    <form method="post" id="qa-plan-insert-form">
                        <div class="col-md-6  databox">

                            <div class=" col-md-12 " >

                                <label class="form-label">มาตรฐานประเด็นการพิจารณา</label> 
                                <select class="form-control" name="inQAStandardDetailId" id="inQAStandardDetailId">
                                    <option>---เลือกหัวข้อ---</option>
                                    <?php
                                    foreach ($stdRs as $stdr) {
                                        echo "<optgroup label='มาตรฐานที่ " . $stdr['tb_qa_standard_number'] . ' ' . $stdr['tb_qa_standard_detail'] . "'>";
                                        $row = 1;
                                        $rs = $this->My_model->get_where_order('tb_qa_standard_detail', array('tb_qa_standard_id' => $stdr['id']), 'tb_qa_standard_detail_number');

                                        foreach ($rs as $scr) {
                                            echo "<option value='" . $scr['id'] . "'>" . $scr['tb_qa_standard_detail'] . "</option>";
                                        }
                                        echo "</optgroup>";
                                    }
                                    ?>
                                </select>   
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">ประเด็นการพิจารณาตามแผน</label>
                                <textarea class="form-control" name="inQAPlanActivity" id="inQAPlanActivity"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3"><label class="form-label">เกณฑ์</label></div>
                                <div class="col-md-9">
                                    <input type="radio" name="inQAPlanTargetBase"  value="มากกว่า" id="rb1" checked>&nbsp;มากกว่า&nbsp;
                                    <input type="radio" name="inQAPlanTargetBase"  value="น้อยกว่า" id="rb2" >&nbsp;น้อยกว่า&nbsp;
<!--                                    <input type="radio" name="inQAPlanTargetBase"  value="ระหว่าง" id="rb3" >&nbsp;ระหว่าง&nbsp;
                                    <input type="text" name="inQAPlanTargetBaseValFrom" id="inQAPlanTargetBaseValFrom" />&nbsp;ถึง&nbsp;
                                    <input type="text" name="inQAPlanTargetBaseValTo" id="inQAPlanTargetBaseValTo" />-->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3"><label class="form-label">ประเภท</label></div>
                                <div class="col-md-9">
                                    <input type="radio" name="inQAPlanScoreType"  value="ร้อยละ" id="r1" checked>&nbsp;ร้อยละ&nbsp;
                                    <input type="radio" name="inQAPlanScoreType"  value="คะแนน" id="r2" >&nbsp;คะแนน&nbsp;
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">ค่าเป้าหมายที่สถานศึกษากำหนด</label>
                                <input class="form-control" type="text" name="inQAPlanTarget" id="inQAPlanTarget" />
                            </div>
                            
                            
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="hidden" name="id" id="id" />
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                </center>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <table class=" table-bordered" style="width:100%" id="toolsTab">
                                <thead>
                                    <tr>
                                        <th style="width:10%;" class="no-sort">เลือก</th>
                                        <th>เครื่องมือสารสนเทศ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($this->session->userdata('status')!="visitor_admin"){
                                    foreach ($misTools as $r) { ?>
                                        <tr>
                                            <td style="text-align:center">                                   
                                                <input type="checkbox"  name ="tools[]" id="tools[]" value="<?php echo $r['id']; ?>" />
                                            </td>
                                            <td style="padding-left:5px;"><?php echo $r['data_name']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    }
                                    ?>
                                        <tr>
                                            <td style="text-align:center">                                   
                                                <input type="checkbox"  name ="tools[]" id="tools[]" value="-1" />
                                            </td>
                                            <td style="padding-left:5px;">
                                                อื่นๆ <input type="text" name="inTools" id="inTools" class="form-control" placeholder="โปรดระบุ" />
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="col-md-12" style="margin-top:10px;">
                        <table class=" table-bordered"  style="width:100%" id="kpiTab">
                            <thead>
                                <tr>
                                    <th style="width:10%;" class="no-sort">ที่</th>
                                    <th style="width:40%;" class="no-sort">ประเด็นการพิจารณาตามแผน</th>
                                    <th class="no-sort">เกณฑ์</th>
                                    <th class="no-sort">ประเภท</th>
                                    <th class="no-sort">ค่าเป้าหมาย</th>
                                    <th class="no-sort">เครื่องมือ</th>
                                    <th style="width:10%;" class="no-sort">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 1;
                                ?>
                                <?php foreach ($stdPlan as $r) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['tb_qa_plan_kpi_activity']; ?></td>
                                        <td style="text-align: center;"><?php echo $r['tb_qa_plan_kpi_target_base']; ?></td>
                                        <td style="text-align: center;"><?php echo $r['tb_qa_plan_kpi_score_type']; ?></td>
                                        <td style="text-align: center;"><?php echo $r['tb_qa_plan_kpi_target']; ?></td>
                                        <td style="text-align: center;"><?php echo $r['tb_qa_plan_kpi_tools']; ?></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-warning btn-edit col-xs-6" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-danger btn-delete col-xs-6" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                        </td>
                                    </tr>

                                    <?php $row++; ?>
                                <?php } ?>
                            </tbody>
                        </table> 


                    </div>
                </div>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
    $('#kpiTab').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "pageLength": 25,
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

    $('#toolsTab').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "pageLength": 25,
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

    $("#qa-plan-insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('Qa/qa_plan_add'); ?>",
            method: "post",
            data: $("#qa-plan-insert-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();

            }

        });
    });

    // delete data;
    $("#kpiTab").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Qa/qa_plan_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });

    // edit data;btn-upload
    

    $("#kpiTab").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Qa/qa_plan_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $("#inQAStandardDetailId").val(data.tb_qa_standard_detail_id);
                $("#inQAPlanActivity").val(data.tb_qa_plan_kpi_activity);
                $("#inQAPlanTarget").val(data.tb_qa_plan_kpi_target);
                $("#inQAPlanScoreType").val(data.tb_qa_plan_kpi_score_type);

                if (data.tb_qa_plan_kpi_score_type === 'ร้อยละ') {
                    $('input[name="inQAPlanScoreType"]')[0].checked = true;
                } else {
                    $('input[name="inQAPlanScoreType"]')[1].checked = true;
                }

                if (data.tb_qa_plan_kpi_target_base === 'มากกว่า') {
                    $('input[name="inQAPlanTargetBase"]')[0].checked = true;
                } else {
                    $('input[name="inQAPlanTargetBase"]')[1].checked = true;
                }

                var tmp = data.tb_qa_plan_kpi_tools_id.split(",");
//
                tmp.forEach(toolsFunction);



                $("#inQAPlanTargetBase").val(data.tb_qa_plan_kpi_target_base);
                $('#qa-plan-modal').modal('show');

            }
        });
    });


    function toolsFunction(item, index) {
        var i;
        for (i = 0; i < $('input[name="tools[]"]').length; i++) {
            if (item===$('input[name="tools[]"]')[i].value) {
                $('input[name="tools[]"]')[i].checked = true;
            }
        }
    }



</script>


