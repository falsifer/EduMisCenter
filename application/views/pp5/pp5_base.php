<div class="box">
    <div class="box-heading">แบบบันทึกคะแนนรายวิชา
        <?php echo $head; ?>
        <?php $Parameter = $this->input->get("sc_id"); ?>       

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "ตารางสอน"); ?></li>
        <li>แบบบันทึกคะแนนรายวิชา</li>
    </ul>

    <div class="box-body">
        <style>
            /*            .tableFixHead    {
                            overflow-y: auto; 
                            height: 100px; 
                            position: sticky;
                            top: 0;
                            left:5px;
                            background:whitesmoke;
                        }*/
            /*.tableFixHead th {   }*/

            /* Just common table stuff. Really. */
            /*            table  { border-collapse: collapse; width: 100%; }
                        th, td { padding: 8px 16px; }
                        th     {  }*/
        </style>



        <input type="hidden" id="CourseId" name="CourseId" value="" >
        <div class='row'>
            <div class='col-md-12'>
                <div class='row'style='margin-left: 20px;margin-right:20px;'>
                    <button type='button' class='btn btn-warning' style="float: left;font-size:1.0em;" id="<?php echo $Parameter; ?>" onclick="StdList(this)">
                        <i class="icon-user icon-large"></i> รายชื่อนักเรียน(สถานะ)
                    </button>
                    <button type='button' class='btn btn-info' style=" float: left;font-size:1.0em;" id="<?php echo $Parameter; ?>" onclick="KpiList(this)">
                        <i class="icon-asterisk icon-large"></i> คะแนนรายตัวชี้วัด
                    </button>
                    <button type='button' class='btn btn-success' style="float: left;font-size:1.0em;" id="<?php echo $Parameter; ?>" onclick="CharacterList(this)">
                        <i class="icon-user icon-large"></i> คะแนนคุณลักษณะ
                    </button>
                    <button type='button' class='btn btn-primary' style="float: left;font-size:1.0em;" id="<?php echo $Parameter; ?>" onclick="RWAList(this)">
                        <i class="icon-book icon-large"></i> คะแนนอ่านคิดวิเคราะห์
                    </button>
                    <?php
                    $sc_id = $this->input->get('sc_id');
                    $edyear = $this->input->get('EdYear');
                    $edterm = 1111;



                    $this->db->select("*")->from("tb_ed_schedule")->where('id', $sc_id);
                    $query = $this->db->get()->row_array();
                    if (count($query) > 0) {
                        $edterm = $query['tb_ed_schedule_term'];
                    }
                    ?>
                    <a href='<?php echo site_url('course-score-base') . "?sc_id=" . $sc_id . "&EdYear=" . $edyear . "&edterm=" . $edterm; ?>' class='btn btn-info' style="float: left;font-size:1.0em;">
                        <i class="icon-book icon-large"></i> การนำเข้าคะแนน
                    </a>
                   <!--  <button type='button' class='btn btn-warning' style="float: left;font-size:1.0em;" id="<?php echo $Parameter; ?>" onclick="ScheduleRecordList(this)">
                        <i class="icon-check icon-large"></i> เวลามาเรียน
                    </button>   --> 
                </div>
                <hr/>
                <div class='row'style='margin-left: 20px;margin-right:20px;'>
                    <div style='overflow:auto;' id="PP5Body">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('pp5/pp5_midterm_modal'); ?>
<?php $this->load->view('pp5/pp5_midterm_purpose_modal'); ?>
<?php $this->load->view('layout/my_loading'); ?>
<script>
//--- โหลด CourseId 
    window.onload = function () {
        var CourseId = "";
        $.ajax({
            url: "<?php echo site_url('PP5/get_CourseId_By_SchId'); ?>",
            method: "POST",
            data: {id: '<?php echo $this->input->get("sc_id"); ?>'},
            success: function (data) {
                $('#CourseId').val(data);
            }
        });
    };

    function Myreload() {
//         $('#PP5Table').DataTable({
// //            "scrollY": "300px",
// //            "scrollX": true,
// //            "scrollCollapse": true,
//             "searching": false,
//             "pagging": false,
//             "fixedColumns": {
//                 leftColumns: 2
//             },

//             columnDefs: [{
//                     orderable: false,
//                     targets: "no-sort"
//                 }]

//         });
    }


</script>

<script>
    function StdList(e) {
        $.ajax({
            url: "<?php echo site_url('PP5/get_StdList'); ?>",
            method: "POST",
            data: {id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>', sc_id: '<?php echo $Parameter ?>'},
            success: function (data) {
                $("#PP5Body").html(data);
                MyStdreload();
            }
        });
    }
</script>
<script>
    function ScheduleRecordList(e) {
        $.ajax({
            url: "<?php echo site_url('PP5/get_ScheduleRecordList'); ?>",
            method: "POST",
            data: {id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>'},
            success: function (data) {
                $("#PP5Body").html(data);
                MyStdreload();
            }
        });
    }
</script>
<script>
    function MyCharacterInsert(characterid, studentid, score) {

        $.ajax({
            url: "<?php echo site_url('PP5/insert_cha_score'); ?>",
            method: "POST",
            data: {courseid: $('#CourseId').val(), characterid: characterid, studentid: studentid, score: score},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('PP5/get_ChaList'); ?>",
                    method: "POST",
                    data: {sc_id: '<?php echo $Parameter ?>', id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>'},
                    success: function (data) {
                        $("#PP5Body").html(data);
                        MyChareload();
                    }
                });
            }
        });

//        alert(characterid + "," + studentid + "," + score);
    }

    function CharacterList(e) {
        $.ajax({
            url: "<?php echo site_url('PP5/get_ChaList'); ?>",
            method: "POST",
            data: {sc_id: '<?php echo $Parameter ?>', id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>'},
            success: function (data) {
                $("#PP5Body").html(data);
                MyChareload();
            }
        });
    }
</script>

<script>
    function MyRWAInsert(RWAid, studentid, score) {

        $.ajax({
            url: "<?php echo site_url('PP5/insert_RWA_score'); ?>",
            method: "POST",
            data: {courseid: $('#CourseId').val(), RWAid: RWAid, studentid: studentid, score: score},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('PP5/get_RWAList'); ?>",
                    method: "POST",
                    data: {sc_id: '<?php echo $Parameter ?>', id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>'},
                    success: function (data) {
                        $("#PP5Body").html(data);
                        MyRWAreload();
                    }
                });
            }
        });

//        alert(characterid + "," + studentid + "," + score);
    }

    function RWAList(e) {
        $.ajax({
            url: "<?php echo site_url('PP5/get_RWAList'); ?>",
            method: "POST",
            data: {sc_id: '<?php echo $Parameter ?>', id: $("#CourseId").val(), edyear: '<?php echo $this->input->get("EdYear"); ?>'},
            success: function (data) {
                $("#PP5Body").html(data);
                MyRWAreload();
            }
        });
    }
</script>

<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

</script>

<script>

    var MyId = 0;
    function KpiList(e) {
        if (e.id == MyId) {
            MyId = e.id;
        }

        $.ajax({
            url: "<?php echo site_url('PP5/get_KpiList'); ?>",
            method: "POST",
            data: {id: '<?php echo $this->input->get("sc_id"); ?>', edyear: '<?php echo $this->input->get("EdYear"); ?>'},
            success: function (data) {
                $("#PP5Body").html(data);
                Myreload();
                ArrTopic = $("#$MyH").val().split(",");
                ArrStd = $("#$MyV").val().split(",");
            }
        });
    }

    var MyKpiId = 0;
    function MidTermTopic(e) {
        MyKpiId = e.id;
        $("#pp5-midterm-insert-form")[0].reset();
        $("#pp5-midterm-modal").modal("show");
    }

    var MyPurposeId = 0;
    function MidTermTopicPurpose(e) {
        MyPurposeId = e.id;
//        alert(MyPurposeId);
        $("#pp5-midterm-purpose-insert-form")[0].reset();
        $("#pp5-midterm-purpose-modal").modal("show");
    }

    function MidTermTopicEdit(e) {
//        alert(e.id);
        $("#pp5-midterm-insert-form")[0].reset();
        $.ajax({
            url: "<?php echo site_url('PP5/get_MidTermTopicEdit'); ?>",
            method: "POST",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#inMidTermTopicId").val(data.id);
                $("#inTopicName").val(data.tb_midterm_topic_score_name);
                $("#inTopicScore").val(data.tb_midterm_topic_score_maxscore);
                $("#pp5-midterm-modal").modal("show");
            }
        });
    }

    var MyCursor = "";

    var ArrTopic = 0;
    var ArrStd = 0;

    var PosH = 0;
    var PosV = 0;

    function MyCursorNow(e) {
//        alert(e.keyCode);
        MyCursor = e.id;
        var res = MyCursor.split(",");
        var NowTopic = res[0];
        var NowStd = res[1];
    }

//    document.onkeydown = function (e) {
////        alert("asdasd");
//        ArrTopic = $("#MyH").val().split(",");
//        ArrStd = $("#MyV").val().split(",");
////        alert(ArrTopic[0]);
////        alert(PosH);
//        switch (e.keyCode) {
//            case 37:
//                if (PosH > 0) {
//                    PosH--;
//                }
//                break;
//            case 38:
//                if (PosV > 0) {
//                    PosV--;
//                }
//                break;
//            case 39:
//                PosH++;
//                break;
//            case 40:
//                PosV++;
//                break;
//        }
//
//        document.getElementById(ArrTopic[PosH] + "," + ArrStd[PosV]).select();
////        $("#abc12").focus();
//    };



    function InsertScore(e) {
//e.preventDefault();
        var MyInput = e.id;
        var res = MyInput.split(",");
        var TopicId = res[0];
        var StdId = res[1];
        var score = e.value;

//        alert(e.id);
        if (score == "") {
            score = 0;
        }

        $.ajax({
            url: "<?php echo site_url('PP5/insert_pp5_score'); ?>",
            method: "POST",
            data: {topicid: TopicId, stdid: StdId, score: score},
//            beforeSend: function () {
//                MyStartLoading();
//            },
            success: function (data) {
//                MyEndLoading();
            }
        });

    }


    //------ Delete right here
    function DelelteThisMidTermPurposeTopic(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teacher/delete_midterm_purpose_topic'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
//    
</script>

