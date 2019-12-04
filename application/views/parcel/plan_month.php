
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>

                        </div>
                        <h4 class="page-title">ทำแผนการจัดซื้อจัดจ้างประจำปี</h4>
                    </div>
                </div>


                <font style="font-weight: bold;">เลือกรายเดือน</font><br><br>
                <div class="row">
				
                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/1"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg1.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/2"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg2.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/3"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg3.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/4"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg4.png" width="40px"></a></div>
                            
                        </div>
                    </div>
					 <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/5"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg5.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/6"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg6.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/7"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg7.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/8"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg8.png" width="40px"></a></div>
                            
                        </div>
                    </div>
					 <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/9"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg9.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/10"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg10.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/11"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg11.png" width="40px"></a></div>
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                        <div class="card-box tilebox-one">
                            <div align="center"><a href="<?php echo site_url(); ?>/plan_month/12"><img src="<?php echo base_url(); ?>assets/images/Circle-icons-calendar_svg12.png" width="40px"></a></div>
                            
                        </div>
                    </div>
                </div>
                <!-- end row -->
               


                <div class="row">
                    <div class="col-sm-12">
					
                        <div class="card-box table-responsive">
						<font style="font-weight: bold;">แสดงผลรายเดือน   <?php      $id=$get_id;
						                                                        if($id == 1){
																					echo 'มกราคม';
																				} if($id == 2){
																					echo 'กุมภาพันธ์';
																				} if($id == 3){
																					echo 'มีนาคม';
																				} if($id == 4){
																					echo 'เมษายน';
																				} if($id == 5){
																					echo 'พฤษภาคม';
																				} if($id == 6){
																					echo 'มิถุนายน';
																				} if($id == 7){
																					echo 'กรกฎาคม';
																				} if($id == 8){
																					echo 'สิงหาคม';
																				} if($id == 9){
																					echo 'กันยายน';
																				} if($id == 10){
																					echo 'ตุลาคม';
																				} if($id == 11){
																					echo 'พฤศจิกายน';
																				} if($id == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?>  สัปดาห์ที่ 1</font><br><br>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
										<th>หน่วยงาน / บุคคลผู้ใช้พัสดุ</th>
										<th>เดือน</th>
										<th>สัปดาห์ที่</th>
										
										<th>พัสดุที่จะขออนุมัติ หรือจ้าง</th>
										<th>จำนวน</th>
										<th>รายการ</th>
										<th>ยอดขอจัดซื้อ / จ้าง (บาท)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
															                
																			$counter = 0;
																			$sum = 0;
																			$sql = "SELECT * from  tb_parcel_plan where month_plan = '$id' and week_plan = '1'";
                                                                            $query = $this->db->query($sql);
                        													$q = $query->result_array();
																			$i=1;
																			foreach ($q as $key => $row) {
																			$counter++;
																			$tbl_order_pro_id=$row['id'];
																			
                                                                            ?>
								    <tr>
                                        <td><?php echo $counter; ?></td>
										<td><?php echo $row['depar_plan']; ?></td>
                                        <td><?php if($row['month_plan'] == 1){
																					echo 'มกราคม';
																				} if($row['month_plan'] == 2){
																					echo 'กุมภาพันธ์';
																				} if($row['month_plan'] == 3){
																					echo 'มีนาคม';
																				} if($row['month_plan'] == 4){
																					echo 'เมษายน';
																				} if($row['month_plan'] == 5){
																					echo 'พฤษภาคม';
																				} if($row['month_plan'] == 6){
																					echo 'มิถุนายน';
																				} if($row['month_plan'] == 7){
																					echo 'กรกฎาคม';
																				} if($row['month_plan'] == 8){
																					echo 'สิงหาคม';
																				} if($row['month_plan'] == 9){
																					echo 'กันยายน';
																				} if($row['month_plan'] == 10){
																					echo 'ตุลาคม';
																				} if($row['month_plan'] == 11){
																					echo 'พฤศจิกายน';
																				} if($row['month_plan'] == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?></td>
										<td><?php echo $row['week_plan']; ?></td>
										<td><?php echo $row['approval_plan']; ?></td>
                                        <td><?php echo $row['number_plan']; ?></td>
										<td><?php echo $row['list_plan']; ?></td>
										<td><?php echo $row['total_plan']; ?></td>
                                        <td>
										<a href="#editModal<?php echo $tbl_order_pro_id; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
																	&nbsp; / &nbsp;
										<a href="<?php echo base_url(); ?>index.php/delete_plan/<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>							
										
										</td>
                                    </tr>
                                   <?php  
								   $sum += (int)$row['total_plan']; //แสดงผลแต่ละบรรทัด
								   $i++;} ?>  
                                    <tr>
									<td  colspan="7" align="center"><font style="font-weight: bold;">ยอดที่ขออนุมัติในแต่ละสัปดาห์</font></td>
									<td colspan="2"><font style="font-weight: bold;"><?php echo $sum; ?></font></td>
								   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                
               <div class="row">
                    <div class="col-sm-12">
					
                        <div class="card-box table-responsive">
						<font style="font-weight: bold;">แสดงผลรายเดือน   <?php      $id=$get_id;
						                                                        if($id == 1){
																					echo 'มกราคม';
																				} if($id == 2){
																					echo 'กุมภาพันธ์';
																				} if($id == 3){
																					echo 'มีนาคม';
																				} if($id == 4){
																					echo 'เมษายน';
																				} if($id == 5){
																					echo 'พฤษภาคม';
																				} if($id == 6){
																					echo 'มิถุนายน';
																				} if($id == 7){
																					echo 'กรกฎาคม';
																				} if($id == 8){
																					echo 'สิงหาคม';
																				} if($id == 9){
																					echo 'กันยายน';
																				} if($id == 10){
																					echo 'ตุลาคม';
																				} if($id == 11){
																					echo 'พฤศจิกายน';
																				} if($id == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?>  สัปดาห์ที่ 2</font><br><br>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
										<th>หน่วยงาน / บุคคลผู้ใช้พัสดุ</th>
										<th>เดือน</th>
										<th>สัปดาห์ที่</th>
										
										<th>พัสดุที่จะขออนุมัติ หรือจ้าง</th>
										<th>จำนวน</th>
										<th>รายการ</th>
										<th>ยอดขอจัดซื้อ / จ้าง (บาท)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
															                
																			$counter = 0;
																			$sum = 0;

																			$sql = "SELECT * from  tb_parcel_plan where month_plan = '$id' and week_plan = '2'";
                                                                            $query = $this->db->query($sql);
                        													$q = $query->result_array();
																			$i=1;
                                                                            foreach ($q as $key => $row) {
																			$counter++;
																			$tbl_order_pro_id=$row['id'];
																			
                                                                            ?>
								    <tr>
                                        <td><?php echo $counter; ?></td>
										<td><?php echo $row['depar_plan']; ?></td>
                                        <td><?php if($row['month_plan'] == 1){
																					echo 'มกราคม';
																				} if($row['month_plan'] == 2){
																					echo 'กุมภาพันธ์';
																				} if($row['month_plan'] == 3){
																					echo 'มีนาคม';
																				} if($row['month_plan'] == 4){
																					echo 'เมษายน';
																				} if($row['month_plan'] == 5){
																					echo 'พฤษภาคม';
																				} if($row['month_plan'] == 6){
																					echo 'มิถุนายน';
																				} if($row['month_plan'] == 7){
																					echo 'กรกฎาคม';
																				} if($row['month_plan'] == 8){
																					echo 'สิงหาคม';
																				} if($row['month_plan'] == 9){
																					echo 'กันยายน';
																				} if($row['month_plan'] == 10){
																					echo 'ตุลาคม';
																				} if($row['month_plan'] == 11){
																					echo 'พฤศจิกายน';
																				} if($row['month_plan'] == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?></td>
										<td><?php echo $row['week_plan']; ?></td>
										<td><?php echo $row['approval_plan']; ?></td>
                                        <td><?php echo $row['number_plan']; ?></td>
										<td><?php echo $row['list_plan']; ?></td>
										<td><?php echo $row['total_plan']; ?></td>
                                        <td>
										<a href="#editModal<?php echo $tbl_order_pro_id; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
																	&nbsp; / &nbsp;
										<a href="<?php echo base_url(); ?>index.php/delete_plan/<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>							
										
										</td>
                                    </tr>
                                   <?php  
								   $sum += (int)$row['total_plan']; //แสดงผลแต่ละบรรทัด
								   $i++;} ?>  
                                    <tr>
									<td  colspan="7" align="center"><font style="font-weight: bold;">ยอดที่ขออนุมัติในแต่ละสัปดาห์</font></td>
									<td colspan="2"><font style="font-weight: bold;"><?php echo $sum; ?></font></td>
								   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
 
                <div class="row">
                    <div class="col-sm-12">
					
                        <div class="card-box table-responsive">
						<font style="font-weight: bold;">แสดงผลรายเดือน   <?php      $id=$get_id;
						                                                        if($id == 1){
																					echo 'มกราคม';
																				} if($id == 2){
																					echo 'กุมภาพันธ์';
																				} if($id == 3){
																					echo 'มีนาคม';
																				} if($id == 4){
																					echo 'เมษายน';
																				} if($id == 5){
																					echo 'พฤษภาคม';
																				} if($id == 6){
																					echo 'มิถุนายน';
																				} if($id == 7){
																					echo 'กรกฎาคม';
																				} if($id == 8){
																					echo 'สิงหาคม';
																				} if($id == 9){
																					echo 'กันยายน';
																				} if($id == 10){
																					echo 'ตุลาคม';
																				} if($id == 11){
																					echo 'พฤศจิกายน';
																				} if($id == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?>  สัปดาห์ที่ 3</font><br><br>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
										<th>หน่วยงาน / บุคคลผู้ใช้พัสดุ</th>
										<th>เดือน</th>
										<th>สัปดาห์ที่</th>
										
										<th>พัสดุที่จะขออนุมัติ หรือจ้าง</th>
										<th>จำนวน</th>
										<th>รายการ</th>
										<th>ยอดขอจัดซื้อ / จ้าง (บาท)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
															                
																			$counter = 0;
																			$sum = 0;
																			$sql = "SELECT * from  tb_parcel_plan where month_plan = '$id' and week_plan = '3'";
                                                                            $query = $this->db->query($sql);
                        													$q = $query->result_array();
																			$i=1;
                                                                           foreach ($q as $key => $row) {
																			$counter++;
																			$tbl_order_pro_id=$row['id'];
																			
                                                                            ?>
								    <tr>
                                        <td><?php echo $counter; ?></td>
										<td><?php echo $row['depar_plan']; ?></td>
                                        <td><?php if($row['month_plan'] == 1){
																					echo 'มกราคม';
																				} if($row['month_plan'] == 2){
																					echo 'กุมภาพันธ์';
																				} if($row['month_plan'] == 3){
																					echo 'มีนาคม';
																				} if($row['month_plan'] == 4){
																					echo 'เมษายน';
																				} if($row['month_plan'] == 5){
																					echo 'พฤษภาคม';
																				} if($row['month_plan'] == 6){
																					echo 'มิถุนายน';
																				} if($row['month_plan'] == 7){
																					echo 'กรกฎาคม';
																				} if($row['month_plan'] == 8){
																					echo 'สิงหาคม';
																				} if($row['month_plan'] == 9){
																					echo 'กันยายน';
																				} if($row['month_plan'] == 10){
																					echo 'ตุลาคม';
																				} if($row['month_plan'] == 11){
																					echo 'พฤศจิกายน';
																				} if($row['month_plan'] == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?></td>
										<td><?php echo $row['week_plan']; ?></td>
										<td><?php echo $row['approval_plan']; ?></td>
                                        <td><?php echo $row['number_plan']; ?></td>
										<td><?php echo $row['list_plan']; ?></td>
										<td><?php echo $row['total_plan']; ?></td>
                                        <td>
										<a href="#editModal<?php echo $tbl_order_pro_id; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
																	&nbsp; / &nbsp;
										<a href="<?php echo base_url(); ?>index.php/delete_plan/<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>							
										
										</td>
                                    </tr>
                                   <?php  
								   $sum += (int)$row['total_plan']; //แสดงผลแต่ละบรรทัด
								   $i++;} ?>  
                                    <tr>
									<td  colspan="7" align="center"><font style="font-weight: bold;">ยอดที่ขออนุมัติในแต่ละสัปดาห์</font></td>
									<td colspan="2"><font style="font-weight: bold;"><?php echo $sum; ?></font></td>
								   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
			    
				
				<div class="row">
                    <div class="col-sm-12">
					
                        <div class="card-box table-responsive">
						<font style="font-weight: bold;">แสดงผลรายเดือน   <?php      $id=$get_id;
						                                                        if($id == 1){
																					echo 'มกราคม';
																				} if($id == 2){
																					echo 'กุมภาพันธ์';
																				} if($id == 3){
																					echo 'มีนาคม';
																				} if($id == 4){
																					echo 'เมษายน';
																				} if($id == 5){
																					echo 'พฤษภาคม';
																				} if($id == 6){
																					echo 'มิถุนายน';
																				} if($id == 7){
																					echo 'กรกฎาคม';
																				} if($id == 8){
																					echo 'สิงหาคม';
																				} if($id == 9){
																					echo 'กันยายน';
																				} if($id == 10){
																					echo 'ตุลาคม';
																				} if($id == 11){
																					echo 'พฤศจิกายน';
																				} if($id == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?>  สัปดาห์ที่ 4</font><br><br>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
										<th>หน่วยงาน / บุคคลผู้ใช้พัสดุ</th>
										<th>เดือน</th>
										<th>สัปดาห์ที่</th>
										
										<th>พัสดุที่จะขออนุมัติ หรือจ้าง</th>
										<th>จำนวน</th>
										<th>รายการ</th>
										<th>ยอดขอจัดซื้อ / จ้าง (บาท)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
															                
																			$counter = 0;
																			$sum = 0;
																			$sql = "SELECT * from  tb_parcel_plan where month_plan = '$id' and week_plan = '4'";
                                                                            $query = $this->db->query($sql);
                        													$q = $query->result_array();
																			$i=1;
                                                                            foreach ($q as $key => $row) {
																			$counter++;
																			$tbl_order_pro_id=$row['id'];
																			
                                                                            ?>
								    <tr>
                                        <td><?php echo $counter; ?></td>
										<td><?php echo $row['depar_plan']; ?></td>
                                        <td><?php if($row['month_plan'] == 1){
																					echo 'มกราคม';
																				} if($row['month_plan'] == 2){
																					echo 'กุมภาพันธ์';
																				} if($row['month_plan'] == 3){
																					echo 'มีนาคม';
																				} if($row['month_plan'] == 4){
																					echo 'เมษายน';
																				} if($row['month_plan'] == 5){
																					echo 'พฤษภาคม';
																				} if($row['month_plan'] == 6){
																					echo 'มิถุนายน';
																				} if($row['month_plan'] == 7){
																					echo 'กรกฎาคม';
																				} if($row['month_plan'] == 8){
																					echo 'สิงหาคม';
																				} if($row['month_plan'] == 9){
																					echo 'กันยายน';
																				} if($row['month_plan'] == 10){
																					echo 'ตุลาคม';
																				} if($row['month_plan'] == 11){
																					echo 'พฤศจิกายน';
																				} if($row['month_plan'] == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?></td>
										<td><?php echo $row['week_plan']; ?></td>
										<td><?php echo $row['approval_plan']; ?></td>
                                        <td><?php echo $row['number_plan']; ?></td>
										<td><?php echo $row['list_plan']; ?></td>
										<td><?php echo $row['total_plan']; ?></td>
                                        <td>
										<a href="#editModal<?php echo $tbl_order_pro_id; ?>" data-sfid='"<?php echo $tbl_order_pro_id;?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
																	&nbsp; / &nbsp;
										<a href="<?php echo base_url(); ?>index.php/delete_plan/<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>							
										
										</td>
                                    </tr>
                                   <?php  
								   $sum += (int)$row['total_plan']; //แสดงผลแต่ละบรรทัด
								   $i++;} ?>  
                                    <tr>
									<td  colspan="7" align="center"><font style="font-weight: bold;">ยอดที่ขออนุมัติในแต่ละสัปดาห์</font></td>
									<td colspan="2"><font style="font-weight: bold;"><?php echo $sum; ?></font></td>
								   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                2018 © ระบบงานพัสดุ.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->
                                         

            </div> <!-- container -->
			
			<!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มทำแผนการจัดซื้อจัดจ้าง</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เดือน</label>
                                                                            <select class="form-control" name="month_plan">
																				<option value="<?php echo $id;?>"> <?php      $id=$get_id;
						                                                        if($id == 1){
																					echo 'มกราคม';
																				} if($id == 2){
																					echo 'กุมภาพันธ์';
																				} if($id == 3){
																					echo 'มีนาคม';
																				} if($id == 4){
																					echo 'เมษายน';
																				} if($id == 5){
																					echo 'พฤษภาคม';
																				} if($id == 6){
																					echo 'มิถุนายน';
																				} if($id == 7){
																					echo 'กรกฎาคม';
																				} if($id == 8){
																					echo 'สิงหาคม';
																				} if($id == 9){
																					echo 'กันยายน';
																				} if($id == 10){
																					echo 'ตุลาคม';
																				} if($id == 11){
																					echo 'พฤศจิกายน';
																				} if($id == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?></option>
																				
																				
																			</select>
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">หน่วยงาน / บุคคลผู้ใช้พัสดุ</label>
                                                     
                                                                          <select class="form-control" name="depar_plan">
																			 <?php
                                                                            $sql88 = "SELECT * from tb_parcel_department";
                                                                            $query88 = $this->db->query($sql88);
                        													$q = $query88->result_array();
                                                                            foreach ($q as $key => $row88) {

                                                                            ?>
																				<option value="<?php echo $row88['name_de']; ?>"><?php echo $row88['name_de']; ?></option>
																				<?php  } ?>
																			</select>
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">สัปดาห์ที่</label>
                                                                            <select class="form-control" name="week_plan">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																			</select>
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">พัสดุที่จะขออนุมัติ หรือจ้าง</label>
                                                     
                                                     <select class="form-control" name="approval_plan">
																			 <?php
                                                                            $sql99 = "SELECT * from tb_parcel_category";
                                                                            $qq = $this->db->query($sql99);
                        													$q = $qq->result_array();
                                                                            foreach ($q as $key => $row99) {

                                                                            ?>
																				<option value="<?php echo $row99['name_cat']; ?>"><?php echo $row99['name_cat']; ?></option>
																				<?php  } ?>
																			</select>
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">จำนวน</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="number_plan" placeholder="จำนวน">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">รายการ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="list_plan" value="รายการ">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ยอดขอจัดซื้อ / จ้าง (บาท)</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="total_plan" placeholder="ยอดขอจัดซื้อ">
                                            
                                                 </fieldset>
										    </div>
											
										 </div>
										 
										
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <button name="save" type="submit" class="btn btn-primary waves-effect waves-light">นำรายการเข้าแผน</button>
                                        </div>
                                    </div><!-- /.modal-content -->
							    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
							
							
							
							<!-- sample modal content -->
							<?php
															                
																			$counter = 0;
																			$sql = "SELECT * from  tb_parcel_plan  where month_plan = '$id'";
                                                                            $query = $this->db->query($sql);
                        													$q = $query->result_array();
                                                                           
																			$i=1;
																			 foreach ($q as $key => $row) {
																			$counter++;
																			$tbl_order_pro_id=$row['id'];
																			
                                                                            ?>
                            <div class="modal fade" id="editModal<?php echo $tbl_order_pro_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		                            <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id;?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มทำแผนการจัดซื้อจัดจ้าง</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เดือน</label>
                                                                            <select class="form-control" name="month_plan">
																			    <option value="<?php echo $row['month_plan']; ?>">
																				<?php if($row['month_plan'] == 1){
																					echo 'มกราคม';
																				} if($row['month_plan'] == 2){
																					echo 'กุมภาพันธ์';
																				} if($row['month_plan'] == 3){
																					echo 'มีนาคม';
																				} if($row['month_plan'] == 4){
																					echo 'เมษายน';
																				} if($row['month_plan'] == 5){
																					echo 'พฤษภาคม';
																				} if($row['month_plan'] == 6){
																					echo 'มิถุนายน';
																				} if($row['month_plan'] == 7){
																					echo 'กรกฎาคม';
																				} if($row['month_plan'] == 8){
																					echo 'สิงหาคม';
																				} if($row['month_plan'] == 9){
																					echo 'กันยายน';
																				} if($row['month_plan'] == 10){
																					echo 'ตุลาคม';
																				} if($row['month_plan'] == 11){
																					echo 'พฤศจิกายน';
																				} if($row['month_plan'] == 12){
																					echo 'ธันวาคม';
																				} 			
 																				  
																				
																				?>
																				</option>
																				<option value="1">มกราคม</option>
																				<option value="2">กุมภาพันธ์</option>
																				<option value="3">มีนาคม</option>
																				<option value="4">เมษายน</option>
																				<option value="5">พฤษภาคม</option>
																				<option value="6">มิถุนายน</option>
																				<option value="7">กรกฎาคม</option>
																				<option value="8">สิงหาคม</option>
																				<option value="9">กันยายน</option>
																				<option value="10">ตุลาคม</option>
																				<option value="11">พฤศจิกายน</option>
																				<option value="12">ธันวาคม</option>
																			</select>
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">หน่วยงาน / บุคคลผู้ใช้พัสดุ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="depar_plan" value="<?php echo $row['depar_plan']; ?>">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">สัปดาห์ที่</label>
                                                                            <select class="form-control" name="week_plan">
																			    <option value="<?php echo $row['week_plan']; ?>"><?php echo $row['week_plan']; ?></option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																			</select>
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">พัสดุที่จะขออนุมัติ หรือจ้าง</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="approval_plan" value="<?php echo $row['approval_plan']; ?>">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">จำนวน</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="number_plan" value="<?php echo $row['number_plan']; ?>">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">รายการ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="list_plan" value="<?php echo $row['list_plan']; ?>">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ยอดขอจัดซื้อ / จ้าง (บาท)</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="total_plan" value="<?php echo $row['total_plan']; ?>">
                                            
                                                 </fieldset>
										    </div>
											
										 </div>
										 
										
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
											<button name="change" type="submit" class="btn btn-warning waves-effect waves-light">แก้ไขรายการเข้าแผน</button>
                                            
                                        </div>
                                    </div><!-- /.modal-content -->
							    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                             <?php  $i++;} ?> 
<?php

if (isset($_POST['save'])){
   $result37="select * from tb_parcel";
   $q=$this->db->query($result37);
   $user37 = $q->row_array();
   $year_parcel37=$user37['year_parcel'];
   $month_plan=$_POST['month_plan'];
   $depar_plan=$_POST['depar_plan'];
   $week_plan=$_POST['week_plan'];
   $approval_plan=$_POST['approval_plan'];
   $number_plan=$_POST['number_plan'];
   $list_plan=$_POST['list_plan'];
   $total_plan=$_POST['total_plan'];
   $this->db->query("insert into tb_parcel_plan (month_plan,depar_plan,week_plan,approval_plan,number_plan,list_plan,total_plan,year_parcel) value ('$month_plan','$depar_plan','$week_plan','$approval_plan','$number_plan','$list_plan','$total_plan','$year_parcel37')");
   $url = base_url().'index.php/plan_month/'.$get_id;
   header("Location: $url");

exit;

}
?> 
<!-- /.modal สิ้นสุดกรอกปีการศึกษา -->
<?php

if (isset($_POST['change'])){
   $get_idd=$_POST['get_id'];
   $month_plan=$_POST['month_plan'];
   $depar_plan=$_POST['depar_plan'];
   $week_plan=$_POST['week_plan'];
   $approval_plan=$_POST['approval_plan'];
   $number_plan=$_POST['number_plan'];
   $list_plan=$_POST['list_plan'];
   $total_plan=$_POST['total_plan'];



$this->db->query("update tb_parcel_plan set month_plan='$month_plan',
       depar_plan='$depar_plan',week_plan='$week_plan',approval_plan='$approval_plan',
       number_plan='$number_plan',list_plan='$list_plan',total_plan='$total_plan'
       where id='$get_idd'");
      $url = base_url().'index.php/plan_month/'.$get_id;
   header("Location: $url");
}
?>

                         

            



        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
       <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>

<!-- Required datatable js -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
		<script>
function confirmationDelete(anchor)
{
   var conf = confirm('คุณแน่ใจหรือว่าต้องการลบข้อมูลนี้?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>

    </body>
</html>