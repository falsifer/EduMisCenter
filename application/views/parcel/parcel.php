<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>ระบบจัดซื้อจัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">
                <div class="row" id="MyHead">
                    <div class="col-md-12  form-group">

                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body">


                                    <div class="col-md-4 form-group">
                                        <?php
                                        $YearNow = date('Y') + 537;
                                        $bg = get_budget_year(date('Y') + 543);
                                        ?>
                                        <label class="control-label">ปีงบประมาณ</label>
                                        <select  name="MyBGYear" id="MyBGYear" class="form-control" onchange="onYearlyChange(this)">

                                            <?php for ($iY = 1; $iY < 12; $iY++) { ?>
                                                <?php $YearNow++; ?>
                                                <option value="<?php echo $YearNow ?>" <?php echo ($YearNow == $bg) ? 'selected' : '' ?>><?php echo $YearNow ?></option>                    
                                            <?php } ?>
                                        </select> 
                                    </div>


<!--                                    <div class="col-md-2 form-group">
                                        <label class="control-label">ฝ่าย</label>
                                        <select name="MyDivision" id="MyDivision" class="form-control" onchange="MyRoomOnChange(this)" >
                                            <option value="">---ทุกฝ่าย---</option> 
                                            <?php
                                            $divRS = $this->My_model->get_all('tb_division');
                                            foreach ($divRS as $r) {
                                                ?>
                                                <option value="<?php echo $r['tb_division_name']; ?>"><?php echo $r['tb_division_name']; ?></option> 
                                                <?php
                                            }
                                            ?>
                                        </select> 
                                    </div>-->


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="parcelID">
                                <thead>
                                    <tr>
                                        <th class="no-sort">ลำดับ</th>
                                        <th class="no-sort">โครงการ/กิจกรรม</th>
                                        <th class="no-sort">สถานะโอนจัดสรร</th>
                                        <th class="no-sort">งบ</th>
                                        <th class="no-sort">ใช้จ่ายจริง</th>
                                        <th class="no-sort">คงเหลือ</th>
                                        <th class="no-sort">ผู้รับผิดชอบ</th>
                                        <th class="no-sort">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="parcelBody">
                                    <?php
                                    $row = 1;

                                    foreach ($plan as $r) {
                                        ?>
                                        <tr>
                                            <?php
                                            $rsBG = $this->My_model->sum_where('tb_project_plan_budget', 'project_plan_budget', array('project_id' => $r['id']));
                                            $budget = $rsBG['project_plan_budget'];
                                            $rsBG2 = $this->My_model->get_where_row('tb_project_plan_budget', array('project_id' => $r['id']));
                             
                                            ?>
                                            <td style="text-align: center"><?php echo $row; ?></td>
                                            <td style="width:100px;"><?php echo $r['project_name']; ?></td>
                                            <?php
                                            if(isset($rsBG2['id'])){
                                            $rsBGD = $this->My_model->sum_where('tb_project_plan_budget_detail', 'tb_project_plan_budget_amt', array('tb_project_plan_budget_id' => $rsBG2['id']));
                                            $budgetD = $rsBGD['tb_project_plan_budget_amt'];
                                            
                                            ?>
                                            <td style="width:100px;"><?php echo ($budgetD==0)?"ยังไม่ได้โอน":"โอนแล้ว(". number_format($budgetD).")"; ?></td>
                                            <?php
                                            }else{
                                             ?>
                                            <td style="width:100px;"><?php echo ($budgetD==0)?"ยังไม่ได้โอน":"โอนแล้ว(". number_format($budgetD).")"; ?></td>
                                            <?php   
                                            }
                                            ?>
                                            <td style="text-align: right"><?php echo number_format($rsBG['project_plan_budget']); ?></td>
                                            <?php
                                            $purchase = 0;
                                            $this->load->model('Approve_purchase_model');
                                            $rsP = $this->Approve_purchase_model->get_purchase_by_project($r['project_name']);
                                            if (isset($rsP['purchase'])) {
                                                $purchase = $rsP['purchase'];
                                            }
                                            ?>
                                            <td style="text-align: right"><?php echo number_format($purchase); ?></td>
                                            <td style="text-align: right"><?php echo number_format($budget - $purchase); ?></td>
                                            <td><?php echo $r['responsible']; ?></td>
                                            <td style="text-align: center">
                                                <button class="btn btn-primary btn-purchase" project='<?php echo $r['project_name']; ?>' id='<?php echo $r['id']; ?>' >
                                                    <i class="icon-edit" title="แก้ไข"  ></i> ระบบจัดซื้อจัดจ้าง
                                                </button>
                                          
                                            </td>
                                        </tr>
                                        <?php
                                        $row++;
                                    }
                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <!-- end row -->


    </div>
</div>

<script>
    $('#parcelID').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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


    $('.btn-purchase').on("click", function (e) {
        var uid = $(this).attr('id');

        
        location.href = '<?php echo site_url('purchase-project-list');?>/'+uid;
        
        
    });
    
    function onYearlyChange(e){
        alert(e.value);
        $.ajax({
            url: '<?php echo site_url('Approve_purchase/get_list_data'); ?>',
            method: 'post',
            data: {bgyear: e.value},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#parcelBody").html(data);
            }
        });
    }
</script>