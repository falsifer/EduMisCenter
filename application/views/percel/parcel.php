<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง
        <!--<button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>-->
        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> ทำแผนการจัดซื้อจัดจ้างประจำปี </button>

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>ระบบจัดซื้อจัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">
                 <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="no-sort">ลำดับ</th>
                                <th class="no-sort">หน่วยงาน</th>
                                <th>เดือน</th>
                                <th class="no-sort">สัปดาห์ที่</th>

                                <th class="no-sort">พัสดุที่จะขออนุมัติหรือจ้าง</th>
                                <th class="no-sort">จำนวน</th>
                                <th class="no-sort">รายการ</th>
                                <th class="no-sort">ยอดขอจัดซื้อ/จ้าง (บาท)</th>
                                <th class="no-sort">ยอดที่ขออนุมัติในแต่ละสัปดาห์</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = $this->db->query("SELECT * from tb_parcel_plan order by month_plan,week_plan");
                            $result = $q->result_array();
                            $row = 1;
                            $week = "";
                            $month = "";
                            foreach ($result as $r) {
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $row; ?></td>
                                    <td><?php echo $r['depar_plan']; ?></td>
                                    <td><?php echo month_num($r['month_plan']); ?></td>
                                    <td style="text-align: center"><?php echo $r['week_plan']; ?></td>
                                    <td><?php echo $r['approval_plan']; ?></td>
                                    <td style="text-align: center"><?php echo $r['number_plan']; ?></td>
                                    <td style="text-align: right"><?php echo $r['list_plan']; ?></td>
                                    <td style="text-align: right"><?php echo number_format($r['total_plan']); ?></td>
                                    <?php
                                    if ($week != $r['week_plan'] || $month != $r['month_plan']) {
                                        $week = $r['week_plan'];
                                        $month = $r['month_plan'];
                                        $q = $this->db->query("SELECT count(*) as amt,sum(total_plan) as total FROM tb_parcel_plan  
WHERE month_plan =" . $r['month_plan'] . " AND week_plan = " . $r['week_plan'] . " GROUP BY month_plan,week_plan");
                                        $chk = $q->row_array();
                                        ?>
                                        <td style="text-align: right;vertical-align: bottom;font-weight: bold " rowspan="<?php echo $chk['amt']; ?>"><?php echo number_format($chk['total']); ?></td>
                                    <?php } else {
                                        ?>
                                        <td style="text-align: right;display: none;">&nbsp;</td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <i id='<?php echo $r['id']; ?>' class="icon-edit btn bt-edit" title="แก้ไข"  ></i>
                                        <i id='<?php echo $r['id']; ?>' class="icon-trash btn bt-delete" title="ลบ"  ></i>
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
                 <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="no-sort">ลำดับ</th>
                                <th class="no-sort">โครงการ/กิจกรรม</th>
                                <th class="no-sort">งบประมาณรวม</th>
                                <th class="no-sort">ปีงบประมาณ พ.ศ.<?php echo $yearly['year_parcel'];?></th>
                                <th class="no-sort">งบที่ใช้ไปแล้ว</th>
                                <th class="no-sort">หน่วยงานที่รับผิดชอบ</th>
                                <th class="no-sort">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = 1;

                            foreach ($plan as $r) {
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $row; ?></td>
                                    <td><?php echo $r['project_name']; ?></td>
                                    <td><?php echo month_num($r['month_plan']); ?></td>
                                    <td style="text-align: center"><?php echo $r['week_plan']; ?></td>
                                    <td><?php echo $r['approval_plan']; ?></td>
                                    <td style="text-align: center"><?php echo $r['number_plan']; ?></td>
                                    <td style="text-align: right"><?php echo $r['list_plan']; ?></td>
                                    <td style="text-align: right"><?php echo number_format($r['total_plan']); ?></td>
                                    <?php
                                    if ($week != $r['week_plan'] || $month != $r['month_plan']) {
                                        $week = $r['week_plan'];
                                        $month = $r['month_plan'];
                                        $q = $this->db->query("SELECT count(*) as amt,sum(total_plan) as total FROM tb_parcel_plan  
WHERE month_plan =" . $r['month_plan'] . " AND week_plan = " . $r['week_plan'] . " GROUP BY month_plan,week_plan");
                                        $chk = $q->row_array();
                                        ?>
                                        <td style="text-align: right;vertical-align: bottom;font-weight: bold " rowspan="<?php echo $chk['amt']; ?>"><?php echo number_format($chk['total']); ?></td>
                                    <?php } else {
                                        ?>
                                        <td style="text-align: right;display: none;">&nbsp;</td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <i id='<?php echo $r['id']; ?>' class="icon-edit btn bt-edit" title="แก้ไข"  ></i>
                                        <i id='<?php echo $r['id']; ?>' class="icon-trash btn bt-delete" title="ลบ"  ></i>
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