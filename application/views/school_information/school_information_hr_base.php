<div class="box">
    <div class="box-heading">เครือข่ายข้อมูลสารสนเทศ(งานบุคลากร)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('school-information'), "เครือข่ายข้อมูลสารสนเทศ"); ?></li>
        <li>เครือข่ายข้อมูลสารสนเทศ(งานบุคลากร)</li>
    </ul>
    <style>        
        .trrow { cursor: pointer; };
    </style>
    <div class="box-body">
        <form method="post" id="insert-form" enctype="multipart/form-data">
            <input type='hidden' id='MyCase' name='MyCase' value='' />



            <div class='row'>

                <div class='col-md-5' >
                    <label class="control-label">โรงเรียน</label>

                    <select name="Department" id="Department" class="form-control">
                        <option value="<?php echo $this->session->userdata('department'); ?>"><?php echo $this->session->userdata('department'); ?></option>
                        <?php foreach ($school as $s) { ?>
                            <option value="<?php echo $s['sc_thai_name']; ?>"><?php echo $s['sc_thai_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class='col-md-7'>
                    <div class='row'>
                        <div class="btn-group" style='float: right;'>
                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle" style="width: 100%;height: 50px;float: right;margin-right:5px;margin-bottom: 5px;">
                                <i class="glyphicon glyphicon-filter " style="font-size:1.2em;"></i> การคัดกรองบุคลากรตามข้อมูลต่างๆ <span class="caret"></span>                                    
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">

                                <li><legend>คัดกรองเด็กตามข้อมูลส่วนตัวของนักเรียน</legend></li>
                                <li><a class='trrow' id='gender_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-user icon-large"></i> คัดกรองตามเพศของนักเรียน</a></li>
                                <li><a class='trrow' id='bloodtype_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-tint icon-large"></i> คัดกรองตามหมู่เลือดของนักเรียน</a></li>
                                <li><a class='trrow' id='nationality_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-flag icon-large"></i> คัดกรองตามสัญชาติของนักเรียน</a></li>
                                <li><a class='trrow' id='ethnicity_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-flag icon-large"></i> คัดกรองตามเชื้อชาติของนักเรียน</a></li>
                                <li><a class='trrow' id='religion_with_class_by_school' onclick='ThisOnClick(this)' ><i class="glyphicon glyphicon-grain"></i> คัดกรองตามศาสนาของนักเรียน</a></li>

                                <li><legend>คัดกรองเด็กตามข้อมูลที่อยู่นักเรียน</legend></li>
                                <li><a class='trrow' id='gender_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-road icon-large"></i> วิธีการเดินทางมาเรียนของนักเรียน</a></li>
                                <li><a class='trrow' id='bloodtype_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-home icon-large"></i> สภาพที่อยู่อาศัยของนักเรียน</a></li>
                                <li><a class='trrow' id='nationality_with_class_by_school' onclick='ThisOnClick(this)' ><i class="icon-home icon-large"></i> สภาพสังคมที่นักเรียนอยู่อาศัย</a></li>

                            </ul>
                        </div> 
                    </div>
                    
                    <div class='row' style='float: right;'>
                        <?php
                        $data['AreaID'] = 'SchoolInformationBody';
                        $this->load->view('layout/my_school_print', $data);
                        ?>  
                    </div>
                </div>

            </div>
        </form>
        <script>
            function MyEdYearTest(e) {
//                alert(e.value);
                var department = $('#Department').val();
                $.ajax({
                    url: '<?php echo site_url('School_information/get_class_list_by_edyear'); ?>',
                    method: 'post',
                    data: {edyear: e.value, department: department},
                    beforeSend: function () {
                        MyStartLoading();
                    },
                    success: function (data) {
                        MyEndLoading();
                        if (data) {
                            $("#ClassBody").html(data);
                        }
                    }
                });
            }

            function ThisOnClick(e) {
                $('#MyCase').val(e.id);
                if ($('#MyEdYear').val() != "") {
                    ThisSelectCase();
                }
            }
        </script>
        <script>

            function ThisSelectCase() {
                $.ajax({
                    url: '<?php echo site_url('School_information/select_case'); ?>',
                    method: "post",
                    data: $("#insert-form").serialize(),
                    beforeSend: function () {
                        MyStartLoading();
                    },
                    success: function (data) {
                        MyEndLoading();
                        if (data) {
                            $("#SchoolInformationDetail").html(data);
                            MySchoolChart();
                        }

                    }
                });
            }

        </script>


        <hr/>

        <div id='SchoolInformationBody'>

            <?php
            $this->load->view('layout/my_school_logo');
            ?> 

            <div id='SchoolInformationDetail' class='row' style='width:850px;height: 1023px;padding: 10px;'>


            </div>

        </div>


    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    window.onload = function () {
        $('#MySchoolAreaId').val("SchoolInformationBody");
    }
</script>



