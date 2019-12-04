<div class="box">
    <div class="box-heading">สำมะโนนักเรียน - (<?php echo $this->session->userdata('department'); ?>)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>สำมะโนนักเรียน - (<?php echo $this->session->userdata('department'); ?>)</li>
    </ul>
    <div class="box-body">   
        <div class="row">


        </div>
        <hr/>
        <div class="row">
            <div class='col-md-12'>
                <div class='col-md-4' >
                    <label class="control-label">โรงเรียน</label>
                    <select name="Department" id="Department" class="form-control" onchange='MyStdFilter(this)'> 
                        <option value="">-----เลือกข้อมูล-----</option>
                        <?php foreach ($school as $s) { ?>
                            <option value="<?php echo $s['id']; ?>"><?php echo $s['sc_thai_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!--                <div class='col-md-8'>
                                    <div>
                <?php
                $data['class'] = 'Y';
                $data['room'] = 'Y';
                $this->load->view('layout/my_school_filter', $data);
                ?>   
                                    </div>                
                                    <div style='padding: 5px;' id='ClassBody'>
                                    </div>
                
                
                                </div>-->
                <div class='col-md-12' style='margin-top:20px;' id='StudentBody'>

                    <table class='table table-bordered table-hover' id='StudentTable'>
                        <thead>
                            <tr style='background: #eeeeee;'>
                                <th style='width: 5%;text-align: center;'>ที่</th>
                                <th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>
                                <th style='width: 20%;text-align: center;'>ชื่อ-นามสกุล</th>
                                <th style='width: 10%;text-align: center;'>อายุ</th>
                                <th style='width: 15%;text-align: center;'>ระดับชั้น</th>
                                <th style='width: 15%;text-align: center;'>โรงเรียน</th>
                                <th style='width: 10%;text-align: center;'>จำนวนเด็กที่มีในระบบ</th>
                                <th style='width: 10%;text-align: center;'>สถานะ</th>
                            </tr>
                        </thead> 
                        <tbody id='StudentBody'>
                        </tbody> 
                    </table> 

                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("student_census/student_census_detail_modal"); ?>
<script>
    
   
    
    function ReloadTable() {
        
         <?php
        $tabName = "StudentTable";
        $title = "รายชื่อนักเรียน สำมะโนนักเรียน";
        $colStr = "0,1,2,3,4,5,6,7";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//        $('#StudentTable').DataTable({
//            "responsive": true,
//            "stateSave": true,
//            "bSort": false,
//            "ordering": true,
//            "pagging": true,
//            columnDefs: [{
//                    orderable: false,                   
//                    targets: "no-sort"
//                }],
//            "language": {
//                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                "zeroRecords": "## ไม่มีข้อมูล ##",
//                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                "infoEmpty": "",
//                "infoFiltered": "",
//                "sSearch": "ระบุคำค้น",
//                "sPaginationType": "full_numbers"
//            }
//        });
    }


    function SelectThisStudent(e) {
        $.ajax({
            url: "<?php echo site_url('Student_census/student_census_detail'); ?>",
            method: "POST",
            data: {id: e.id},
            success: function (data) {
                $("#StudentDetailBody").html(data);
                $('#MySchoolAreaId').val("StudentDetail");
                $("h3.modal-title").text("ข้อมูลพื้นฐานของนักเรียน - " + e.id);
                $("#student-census-detail-modal").modal("show");
            }
        });
    }

    var RmId = "";
    var ClsId = "";
    var EdYear = "";

    function MyEdTest(e) {
        ClsId = e.value;
        MyStdFilter();
    }

    function MyRoomOnChange(e) {
        RmId = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
//        MyStdFilter();
    }

    function MyStdFilter(e) {
        $.ajax({
            url: '<?php echo site_url('Student_census/get_student_by_school_id'); ?>',
            method: 'post',
            data: {school_id: e.value},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                if (data) {
                    $("#StudentBody").html(data);
                    ReloadTable();
                }

            }
        });
    }
</script>
