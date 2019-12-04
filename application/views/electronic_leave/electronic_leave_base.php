<div class="box" id='Asdasdasd'>
    <div class="box-heading">ระบบการลาออนไลน์
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบการลาออนไลน์</li>
    </ul>
    <style>

        .mycardcontent {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            margin: auto;
            text-align: left;
            font-family: arial;
            margin-top: 30px;
            padding: 10px;


        }
        .mycardcontent:hover {
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
        }

    </style>

    <div class="box-body"> 

        <div class="row">
            <div class="col-md-7">
                <legend>
                    สถิติการลาประจำปีงบประมาณ 2562
                </legend>
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead style="background:#eeeeee;">
                        <tr>
                            <th style='text-align: center;width:10%;'>
                                ที่
                            </th>
                            <th style='text-align: center;width:30%;'>
                                ประเภทการลา
                            </th>
                            <th style='text-align: center;width:20%;'>
                                ลาไปแล้ว
                            </th>
                            <th style='text-align: center;width:20%;'>
                                เหลือวันลา
                            </th>
                            <th style='text-align: center;width:20%;'>
                                รวมทั้งหมด
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--    <tr>
                            <td style='text-align: center;width:10%;'>1</td>
                            <td style='text-align: center;width:30%;'>ลาป่วย</td>
                            <td style='text-align: center;width:20%;'>2</td>
                            <td style='text-align: center;width:20%;'>3</td>
                            <td style='text-align: center;width:20%;'>5</td>
                            
                        </tr>
                        <tr>
                            <td style='text-align: center;width:10%;'>2</td>
                            <td style='text-align: center;width:30%;'>ลากิจส่วนตัว</td>
                            <td style='text-align: center;width:20%;'>4</td>
                            <td style='text-align: center;width:20%;'>2</td>
                            <td style='text-align: center;width:20%;'>6</td>
                            
                        </tr>
                        <tr>
                            <td style='text-align: center;width:10%;'>3</td>
                            <td style='text-align: center;width:30%;'>ลาคลอด</td>
                            <td style='text-align: center;width:20%;'>1</td>
                            <td style='text-align: center;width:20%;'>1</td>
                            <td style='text-align: center;width:20%;'>2</td>
                            
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-5" id="ElectronicLeaveBody">


                <div class="row" > 
                    <button type="button" class="btn btn-primary " style="width: 95%;height: 70px;margin:10px;" id='<?php echo $this->session->userdata('hr_id') ?>' onclick="RequestLeave(this)">
                        <i class="icon-user icon-large" style="font-size:1.8em;"> แจ้งขอลา</i>                                      
                    </button>
                </div>                            

                <div class="row" > 
                    <button type="button" class="btn btn-info " style="width: 95%;height: 70px;margin:10px;" onclick='MyELeaveList(this)'>
                        <i class="icon-file icon-large" style="font-size:1.8em;"> ใบลาของฉัน</i>                                      
                    </button>
                </div>                            


                <?php
//                        
                $this->db->select("*")->from("tb_hr_position a");
                $this->db->join("tb_hr_position_register b", "b.tb_hr_position_id = a.id");
                $this->db->join("tb_edoc_approver c", "c.tb_hr_position_id = a.id");
                $this->db->join("tb_data_define d", "d.id = c.tb_data_define_id");

                $this->db->where("a.tb_hr_position_department", $this->session->userdata('department'));
                $this->db->where("b.tb_hr_id", $this->session->userdata('hr_id'));
                $this->db->where("d.data_address", $this->session->userdata('data-define'));
                $MyQ = $this->db->get()->result_array();
                if (count($MyQ) > 0) {
                    ?>
                    <input type='hidden' id='Approver' value='<?php echo $MyQ[0]['tb_edoc_approver_sequence']; ?>'>
                    <div class="row" > 
                        <button type="button" data-toggle="collapse" data-target="#MyELeaveFilter" class="btn btn-success " style="width: 95%;height: 70px;margin:10px;">
                            <i class="icon-check icon-large" style="font-size:1.8em;"> อนุมัติลา</i>                                      
                        </button>
                    </div>  
                <?php } ?>


                <div class="row collapse" id="MyELeaveFilter" style="padding:50px;">
                    <div class="row">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success"><i class="icon-calendar icon-large"></i> ค้นหาใบลาตั้งแต่วันที่ </button>
                            </div>
                            <input type="date" name="inSearchStartDate" id="inSearchStartDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"  data-date-format="yyyy-mm-dd" placeholder="จากวันที่..." required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success"><i class="icon-calendar icon-large"></i> จนถึงวันที่ </button>
                            </div>
                            <input type="text" name="inSearchEndDate" id="inSearchEndDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"  data-date-format="yyyy-mm-dd" placeholder="จนถึงวันที่..." required/>
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-success" style="margin-top: 10px;" onclick="ApproveSearch(this)"><i class="icon-search icon-large"></i> ค้นหา </button>

                    </div>

                    <script>
                        function ApproveSearch(e) {
                            var Strdate = $('#inSearchStartDate').datepicker('getFormattedDate');
                            var Enddate = $('#inSearchEndDate').datepicker('getFormattedDate');
                            $.ajax({
                                url: "<?php echo site_url('Electronic_Leave/electronic_approve_body'); ?>",
                                method: "post",
                                data: {SDate: Strdate, EDate: Enddate},
                                success: function (data) {
                                    $('#MyELeaveBody').html(data);
                                }
                            });
                        }
                    </script>
                </div>
                <div class="row">
                    <div id="MyELeaveBody">

                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>

</div>
<?php $this->load->view('electronic_leave/electronic_leave_modal'); ?>
<?php $this->load->view('electronic_leave/electronic_leave_detail_modal'); ?>
<script>

    $('#example').DataTable({
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

    $('#StatTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "searching": false,
        "paging": false,
        "info": false,

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
    $('.sorting_asc').removeClass('sorting_asc');


</script>
<script>
    function MyELeaveList(e) {
        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_body'); ?>",
//            method: "post",
//            data: {id: e.id},
////            dataType: "json",
            success: function (data) {
                $('#MyELeaveBody').html(data);
            }
        });
    }

    function ELeaveDelete(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Electronic_Leave/electronic_leave_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

    function RequestLeave(e) {
        var MyAddress = "";
        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_request'); ?>",
            dataType: "json",
            success: function (data) {
                $('#inName').html(data.HRfullname);
                $('#inRank').html(data.hr_rank);

                MyAddress = "บ้านเลขที่ " + data.hr_address_no + "  หมู่ที่ " + data.hr_address_moo + "  ตำบล" + data.hr_address_tambon + "  อำเภอ" + data.hr_address_amphur + "  จังหวัด" + data.hr_address_province;
                $('#inAddress').val(MyAddress);

                $('#inPhone').val(data.hr_mobile);
                $('#inOther').val(data.hr_email);

                $('#electronic-leave-modal').modal('show');
            }
        });

    }
    var DetailId;
    function ELeaveDetail(e) {
        DetailId = e.id;
        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_detail'); ?>",
            method: "post",
            data: {id: DetailId},
//            dataType: "json",
            success: function (data) {
//                alert('asd');
                $('#ElectronicLeaveDetailBody').html(data);
                $('#MySchoolAreaId').val("ElectronicLeaveDetailBody");
//                $('#inTextPage').val(data);
                //------------------------------------------------//
                $('#electronic-leave-detail-modal').modal('show');
            }
        });


    }

</script>
