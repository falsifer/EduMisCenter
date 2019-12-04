<div class="box">
    <div class="box-heading">งานทะเบียนอิเล็กทรอนิกส์
        <?php $Parameter = $this->input->get("sc_id"); ?>       

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-evaluation', "งานวัดผลและประเมินผล"); ?></li>
        <li>งานทะเบียนอิเล็กทรอนิกส์</li>
    </ul>
    <style>        
        .trrow { cursor: pointer; };
    </style>

    <div class="box-body">

        <div class='row' style='padding:10px;'>
            <div style='width:30%;float: left;'>
                <div class="btn-group" style='float: right;'>
                    <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle" style="width: 270px;height: 50px;float: right;margin-right:5px;margin-bottom: 5px;">
                        <i class="glyphicon glyphicon-education " style="font-size:1.2em;"></i> เอกสารนักเรียนรายบุคคล <span class="caret"></span>                                    
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                        <li><legend>เอกสารนักเรียนรายบุคคล</legend></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP1'><i class="icon-file icon-large"></i> ปพ.๑ (ระเบียนแสดงผลการเรียน)</a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP2'><i class="icon-file icon-large"></i> <s> ปพ.๒ (หลักฐานแสดงวุฒิการศึกษา)</s></a></li>
                        
                        <li><a class='trrow' onclick='SelectType(this)' id='PP4'><i class="icon-file icon-large"></i> ปพ.๔/ปถ.๐๔ (แบบบันทึกการประเมินคุณลักษณะอันพึงประสงค์)</a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP6'><i class="icon-file icon-large"></i> ปพ.๖/ปถ.๐๖ (แบบรายงานผลการพัฒนาคุณภาพผู้เรียนรายบุคคล)</a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP7'><i class="icon-file icon-large"></i> ปพ.๗/ปถ.๐๑  (ใบรับรองผลการศึกษา)</a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP8'><i class="icon-book icon-large"></i> <s>ปพ.๘/ปถ.๐๘ (แบบระเบียนสะสม)</s></a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PP9'><i class="icon-book icon-large"></i> <s>ปพ.๙ (สมุดบันทึกผลการเรียน)</s></a></li>
                        <!--<li><a class='trrow' onclick='SelectType(this)' id='PT1'><i class="icon-file icon-large"></i> <s>ปถ.๐๑(ใบรับรองผลการเรียน)</s></a></li>-->
                        <li><a class='trrow' onclick='SelectType(this)' id='PT2'><i class="icon-file icon-large"></i> ปถ.๐๒ (แบบบันทึกการประเมินการอ่านคิดวิเคราะห์และเขียน)</a></li>
                        <li><a class='trrow' onclick='SelectType(this)' id='PT9'><i class="icon-file icon-large"></i> <s>ปถ.๐๙ (แบบรายงานผลกาารพัฒนาการเรียนรู้ตามมาตรฐานและตัวชี้วัด)</s></a></li>
                        <li><legend>เอกสารที่ต้องกรอกข้อมูลเพิ่มก่อนพิมพ์</legend></li>
                        <li><a class='trrow' onclick='SelectType(this)'id='PP3'><i class="icon-file icon-large"></i> <s>ปพ.๓ (แบบรายงานผู้สำเร็จการศึกษา)</s></a></li>
                        <li><a class='trrow' onclick='SelectType(this)'id='PT7'><i class="icon-file icon-large"></i> <s>ปถ.๐๗ (แบบบันทึกผลพัฒนาคุณภาพผู้เรียนระดับชั้นเรียน)</s></a></li>

                    </ul>
                </div>
                <button type='button' data-toggle="collapse" data-target="#StudentList" class='btn btn-primary' style='width: 270px;height:50px;float: right;margin-right:5px;margin-bottom: 5px;'>
                    <i class="glyphicon glyphicon-education"></i> รายชื่อนักเรียน <span class="caret"></span>  
                </button>
            </div>
            <div style='width:65%;float: left;'>
                <?php
                $data['room'] = 'Y';
                $data['class'] = 'Y';
                $data['term'] = 'Y';
                $this->load->view('layout/my_school_filter', $data);
                ?>  
            </div>

        </div>
        <div class='row collapse' id='StudentList'>
            <div class='col-md-12'>
                <table class='table table-hover table-bordered' style='font-size: 0.9em;'id='StudentTable'>
                    <thead>
                        <tr style='background-color:whitesmoke;'>
                            <th style='text-align: center;width: 10%'>ที่</th>
                            <th style='text-align: center;width: 10%'>รหัสนักเรียน</th>
                            <th style='text-align: center;width: 40%'>ชื่อ-สกุล</th> 
                            <th style='text-align: center;width: 15%'>ชั้นปี</th>
                            <th style='text-align: center;width: 15%'>สถานะ</th>
                            <!--<th style='text-align: center;width: 15%'>ผลการเรียน</th>-->
                            <th style='text-align: center;width: 10%'>
                                <button type="button" class="btn btn-link" >
                                    <i class="glyphicon glyphicon-ok" style="font-size:1.3em;"></i>                                    
                                </button>                       
                            </th> 
                        </tr>
                    </thead>
                    <tbody id='StudentTbody'>


                    </tbody>
                </table>
                <script>
                    var c = 1;
                    function JustArrayThis(e) {

                        var id = e.id;
                        var OldStr = $('#StudentArray').val();

                        if (c > 1) {
                            $('#StudentArray').val(OldStr + "," + id);
                        } else {
                            $('#StudentArray').val(id);
                        }
                        c++;
                    }
                </script>
            </div>
        </div>

        <div class='row'>

            <div class='col-md-12'>
                <Legend id='HeadShow'></Legend>
                <div style="position:absolute;right:16" >
                    <?php
                    $data['AreaID'] = 'PrintArea';
                    $this->load->view('layout/my_school_print', $data);
                    ?>     
                </div>
                <script>
                    window.onload = function () {
                        $('#MySchoolAreaId').val("PrintArea");
                    }
                </script>

                <input type='hidden' id='StudentArray' value='' />
                <div id="PrintArea" style='border: solid 1px;'>
                    <!--                    <div style='width:850px;height: 1235px;padding: 10px;' >
                                            <p style='text-align:center;margin: 0px;'><span style='font-size:1em'>แบบบันทึกการพัฒนาคุณลักษณะอันพึงประสงค์</span><span class='pull-right'>ปถ.๐๔</span></p>                        
                                            <p style='text-align:center;margin: 0px;'>
                                                <span style='font-size:0.85em'>
                                                    ระดับชั้นประถมศึกษา ปีการศึกษา<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> 2562</span>
                                                    ถึง ปีการศึกษา <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>2562</span> 
                                                </span>
                                            </p>
                    
                                            <p style='text-align:center;margin: 0px;'>
                                                <span style='font-size:0.85em'>
                                                    ชื่อนักเรียน<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> นายชัยรัธโต้ อ่วมอารีย์</span>
                                                    ชั้น <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> ประถมศึกษาปีที่ 6</span>
                                                    โรงเรียน <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> วัดเขมาภิรตาราม</span>
                                                </span>
                                            </p>
                                            <hr/>
                                            <center>
                                                <table class="table table-bordered display" style="width:90%;" id="example">
                                                    <thead>
                                                        <tr style='height:50px;background: whitesmoke;'>                                    
                                                            <th class='no-sort' style='width:10%;text-align: center;'>คุณลักษณะอันพึงประสงค์</th>
                                                            <th class='no-sort' style='width:10%;text-align: center;' >ระดับคุณภาพ</th>
                                                            <th class='no-sort' style='width:65%;text-align: center;' colspan='12'>ความก้าวหน้าการพัฒนาคุณลักษณะอันพึงประสงค์</th>
                                                            <th class='no-sort' style='width:15%;text-align: center;' rowspan='3'>สรุประดับคุณภาพ</th>
                                                        </tr>
                                                        <tr style='height:50px;background: whitesmoke;'>                                    
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>ชั้นประถมศึกษาปีที่</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>1</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>2</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>3</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>4</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>5</th>
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>6</th>
                                                        </tr>
                                                        <tr style='height:50px;background: whitesmoke;'>                                    
                                                            <th class='no-sort' style='text-align: center;' colspan='2'>ภาคเรียนที่</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                                                            <th class='no-sort' style='text-align: center;' >1</th>
                                                            <th class='no-sort' style='text-align: center;' >2</th>
                    
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </center>
                                            <hr/>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    var RmId = "";
    var ClsId = "";
    var EdYear = "";
    var Term = "";
    function MyEdTest(e) {
        ClsId = e.value;
        MyStdFilter();
    }

    function MyRoomOnChange(e) {
        RmId = e.value;
        MyStdFilter();
    }

    function MyTermOnChange(e) {
        Term = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
        MyStdFilter();
    }


    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('School_registration/get_student_list_by_filter'); ?>',
            method: 'post',
            data: {rid: RmId, cid: ClsId, edyear: EdYear},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                if (data != "") {
                    $("#StudentTbody").html(data);
                }

            }
        });
    }

    $('#StudentTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
</script>
<script>

    var StudentCount = 0;
    function SelectType(e) {
        var StdId;

        var ID = e.id;
        var HeadShow = $('#' + ID).html();
        var MyUrl;
        switch (ID) {
            case "PP1":
                MyUrl = "get_std_pp1";
                break;
            case "PP2":
                MyUrl = "get_std_pp2";
                break;
            case "PP4":
                MyUrl = "get_std_pp4";
                break;
            case "PP6":
                MyUrl = "get_std_pp6";
                break;
            case "PP7":
                MyUrl = "get_std_pp7";
                break;
            case "PP8":
                MyUrl = "get_std_pp8";
                break;
            case "PP9":
                MyUrl = "get_std_pp9";
                break;
            case "PT1":
                MyUrl = "get_std_pt1";
                break;
            case "PT2":
                MyUrl = "get_std_pt2";
                break;
            case "PT9":
                MyUrl = "get_std_pt9";
                break;
        }
        $('#PrintArea').html("");
        $.ajax({
            url: "<?php echo site_url('School_registration/'); ?>" + MyUrl,
            method: "POST",
            data: {StdArray: StdId},
            success: function (data) {
                $('#PrintArea').html(data);
            }
        });

        $('#HeadShow').html(HeadShow + "<p class='pull-right'>นักเรียนจำนวน " + StudentCount + " คน</p>");
    }
</script>