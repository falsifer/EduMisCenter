
<div class="col-md-12"  style="padding: 4px;">
    <?php if ($this->session->userdata('status') == ''): ?>
        <div class="row">
            <!-- left side -->
            <div class="col-md-9 hidden-sm hidden-xs">
                <div class="well">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!--                         Indicators 
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                </ol>-->

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox" style="background:transparent;width:100%; height: 300px !important;">

                            <?php
                            $row = 1;
                            foreach ($advertising as $c):
                                ?>
                                <?php if (file_exists('upload/' . $c['pr_image_1']) && !empty($c['pr_image_1'])) : ?>
                                    <div class="item <?php echo ($row == 1) ? 'active' : ''; ?>">
                                        <img src="<?php echo base_url() . 'upload/' . $c['pr_image_1']; ?>" alt="<?php echo $c['pr_topic']; ?>">
                                    </div>
                                <?php endif; ?>
                                <?php
                                $row++;
                            endforeach;
                            ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>     
                </div>

                <!-- เผยแพร่ข้อมูลข่าวสาร -->
                <div class="row" style="margin-top:20px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">ข่าวประชาสัมพันธ์</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hove" id="PR">
                                    <?php foreach ($advertising as $ads) : ?>
                                        <tr>
                                            <?php
                                            $outp = '';
                                            if (file_exists('upload/' . $ads['pr_image_1']) && !empty($ads['pr_image_1'])) {
                                                $outp = img(array('src' => base_url() . 'upload/' . $ads['pr_image_1'], 'style' => 'width:262px;', 'class' => 'img-thumbnail')) . nbs(3);
                                            }
                                            ?>
                                            <td><?php echo $outp; ?></td>
                                            <td>
                                                <span style="font-weight: bold;"><?php echo $ads['pr_topic']; ?></span><?php echo nbs(3); ?><?php echo substr($ads['pr_detail'], 30) . '...'; ?>
                                                <button class="btn btn-link btn-detail" id="<?php echo $ads['id']; ?>">อ่านเพิ่มเติม</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- End of col-md-9 -->


            <!-- Right side -->
            <div class="col-md-3">

                <div class="panel panel-primary">
                    <div class="panel-heading"><< เข้าระบบ >></div>
                    <div class="panel-body">
                        <form method="post" id="login-form"  enctype="multipart/form-data">
                            <label class="control-label">Username</label>
                            <input type="text" name="inUsername" id="inUsername" class="form-control" />
                            <label class="control-label">Password</label>
                            <input type="password" name="inPassword" id="inPassword" class="form-control" />
                            <br/>

                            <button type="submit" class="btn btn-success">เข้าระบบ</button>
                            <!--  <button type="button" class="btn btn-info btn_register">ลงทะเบียน</button> -->

                        </form>
                    </div>
                </div>
                <?php
                $schoolArray = $this->My_model->get_all_order("tb_school", "id asc");

                $output = "";
                foreach ($schoolArray as $r) {
                    $output .= "<option value='{$r['id']}'>{$r['id']}</option>";
                }
                ?>
                <div class="panel panel-primary">
                    <div class="panel-heading"><< สมัครเรียน >></div>
                    <div class="panel-body">

                        <label class="control-label">เลือกโรงเรียน</label>
                        <select class='form-control' id='inSchoolId'>
                            <?php echo $output ?>
                        </select>
                        <br/>
                        <center><button type="button" class="btn btn-success" onclick='GoEnRollWithSchoolId()'><i class='glyphicon glyphicon-pencil'></i> กรอกแบบฟอร์ม</button></center> 
                        <!--  <button type="button" class="btn btn-info btn_register">ลงทะเบียน</button> -->
                        <script>
                            function GoEnRollWithSchoolId() {
                                 location.href = '<?php echo site_url('enroll-register-form'); ?>?room_id=' + $('#inSchoolId').val();
                                 
//                                $.ajax({
//                                    url: "<?php echo site_url('enroll-register-form'); ?>",
//                                    method: "POST",
//                                    data: {school_id: $('#inSchoolId').val()},
//                                    success: function (data) {
////                                        alert("Me !");
//                                    }
//                                });
                            }
                        </script>
                    </div>
                </div>
                <!--                <div class="panel" style="height:150px;margin-top:10px;">
                                    <div class="panel-body">
                                        <i class="icon-group icon-3x"></i>
                                        <span class="pull-right" style="font-size:2.7em;font-weight:bold;">18</span><?php echo br(2); ?>
                                        <small class="pull-right" style="text-align:right;font-size:1.2em;">นักเรียนทุน</small>
                                        <br/>
                                        <span class="pull-left"><a href="#">ข้อมูลเพิ่มเติม...</a></span>
                                    </div>
                                </div>
                
                                <div class="panel" style="height:150px;margin-top:10px;">
                                    <div class="panel-body">
                                        <i class="icon-cogs icon-3x"></i>
                                        <span class="pull-right" style="font-size:2.8em;font-weight:bold;">25</span><br/><br/>
                                        <small class="pull-right" style="text-align:right;font-size:1.2em;">                        
                                            <br/>
                                        </small>
                                        <br/>
                                        <span class="pull-left"><a href="#">ข้อมูลเพิ่มเติม...</a></span>
                                    </div>
                                </div>
                
                                <div class="panel" style="height:150px;margin-top:10px;">
                                    <div class="panel-body">
                                        <i class="icon-pencil icon-3x"></i>
                                        <span class="pull-right" style="font-size:2.8em;font-weight:bold;">
                <?php
                echo $this->Chairatto_model->count_all_hr();
                ?>
                                        </span><br/><br/>
                                        <small class="pull-right" style="text-align:right;font-size:1.2em;">ครู</small>
                                        <br/>
                                        <span class="pull-left"><a href="#">ข้อมูลเพิ่มเติม...</a></span>
                                    </div>
                                </div>
                
                                <div class="panel" style="height:150px;margin-top:10px;">
                                    <div class="panel-body">
                                        <i class="icon-group icon-3x"></i>
                                        <span class="pull-right" style="font-size:2.8em;font-weight:bold;">
                <?php
                echo $this->Chairatto_model->count_all_std();
                ?>
                                        </span><br/><br/>
                                        <small class="pull-right" style="text-align:right;font-size:1.2em;">นักเรียน</small>
                                        <br/>
                                        <span class="pull-left"><a href="#">ข้อมูลเพิ่มเติม...</a></span>
                                    </div>
                                </div>
                
                                <div class="panel panel-primary" style="min-height:150px;margin-top:10px;">
                                    <div class="panel-heading">ดาวน์โหลดข้อมูล</div>
                                    <div class="panel-body" >
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <tr>
                                                    <td><a href="#">คู่มือโปรแกรม eSchool 4.0 (2018)</a></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">แนะนำวิธีการแนะแนวให้ได้ผล</a></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">สอนอย่างไรให้สนุก</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>-->

            </div><!-- End of col-md-3 -->
        </div>




    <?php else: ?>
        <?php if ($this->session->userdata('status') == 'ผู้ดูแลระบบ'): ?>
            <!-- กรณีเป็นผู้ดูแลระบบให้ไปที่หน้า Administrator -->
            <?php if ($this->session->userdata("department") == "กองการศึกษา"): ?>
                <!-- กรณีเป็นเจ้าหน้าที่ของกองการศึกษา -->
                <?php $this->load->view('setting/admin_page'); ?>
            <?php else: ?>
                <!-- กรณีเป็นเจ้าหน้าที่ของโรงเรียน -->
                <?php $this->load->view('admin_school/admin_school_base'); ?>
            <?php endif; ?>

        <?php elseif ($this->session->userdata('status') == 'ผู้บริหาร'): ?>
            <?php $this->load->view('manager_zone'); ?>

        <?php else: ?>
            <?php if ($this->session->userdata("department") == "กองการศึกษา"): ?>
                <!-- กรณีเป็นเจ้าหน้าที่ของกองการศึกษา -->
                <?php $this->load->view('education_zone'); ?>
            <?php else: ?>
                <!-- กรณีเป็นเจ้าหน้าที่ของโรงเรียน -->
                <?php $this->load->view('school_zone'); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php $this->load->view("public_relations/modals/public_detail_modal"); ?>
<?php $this->load->view("setting/modals/register_modal"); ?>
<script>
    $('.carousel').carousel({
        interval: 5000
    });
    //
    $('#login-form').on('submit', function (e) {
        e.preventDefault();
        var username = $('#inUsername').val();
        var password = $('#inPassword').val();
        if (username == '' || password == '') {
            alert('Username และ Password จะมีค่าว่างไม่ได้');
            return false;
        }
        $.ajax({
            url: '<?php echo site_url('login'); ?>',
            method: 'post',
            data: $('#login-form').serialize(),
            success: function (data) {
                location.href = "<?php echo site_url(); ?>";
            }
        });
    });


// detail
    $("#PR").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('pr-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {

                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดการประชาสัมพันธ์");
                $("#public-detail-modal").modal("show");
            }
        });
    });


    $('.btn_register').on("click", function () {

        $("#register-modal").modal("show");
    });

</script>
