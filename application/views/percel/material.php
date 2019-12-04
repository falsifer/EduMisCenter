
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <h4 class="page-title">การตั้งรหัสและรายชื่อวัสดุ</h4>
                    </div>
                </div>


               <div class="row">
                    <div class="col-lg-12">

                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                           
                                            <div id="external-events" class="m-t-20">
                                                <ul class="nav nav-pills nav-stacked">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">วัสดุสำนักงาน</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">วัสดุยานพาหนะและขนส่ง</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">วัสดุการเกษตร</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">วัสดุก่อสร้าง</a>
                                        </li>
                                    </ul>


                                               
                                            </div>

                                            

                                        </div>
                                    </div>
                                </div> <!-- end col-->
                                <div class="col-md-9">
								
							<h4 class="m-t-0 header-title"><b>วัสดุสำนักงาน</b></h4>
                            <div class="btn-group pull-left m-t-15">
                                <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light w-md" data-toggle="modal" data-target="#myModal">เพิ่ม</button>
                            </div>
							<br><br><br>
                                    <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ชื่อวัสดุ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>001</td>
                                        <td>กบเหลาดินสอ</td>
                                        <td>แก้ไข / ลบ</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                                </div> <!-- end col -->
                            </div>  <!-- end row -->
                        </div>

                       

                        
                    </div>
                    <!-- end col-12 -->
                </div> <!-- end row -->
                <!-- end row -->

		<!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มตั้งรหัสและรายชื่อวัสดุ</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ลักษณะของวัสดุ</label>
                                                                            <div class="radio-list">
																				<div class="radio-inline pl-0">
																					<span class="radio radio-info">	<input type="radio" name="share_act" id="radio_9" value="สิ้นเปลือง">
																						<label for="radio_9">เป็นวัสดุที่ใช้สิ้นเปลือง</label>
																					</span>
																				</div>
																				
																				<div class="radio-inline pl-0">
																					<span class="radio radio-info">	<input type="radio" name="share_act" id="post-format-gallery2" value="ยาวนาน">
																						<label for="radio_10">เป็นวัสดุที่มีอายุการใช้งานยาวนาน</label>
																					</span>
																				</div>
																				
																			</div>


                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">รหัสวัสดุ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="รหัสวัสดุ">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ชื่อวัสดุ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ชื่อวัสดุ">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">หน่วยที่ใช้นับ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="หน่วย">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 
										
										 
										
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <button name="save" type="submit" class="btn btn-primary waves-effect waves-light">Save add</button>
                                        </div>
                                    </div><!-- /.modal-content -->
							    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
							
							
							

