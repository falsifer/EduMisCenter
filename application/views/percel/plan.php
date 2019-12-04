
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
                                                                            <select class="form-control" name="status_pay_order">
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
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="หน่วยงานหรือบุคคล">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">สัปดาห์ที่</label>
                                                                            <select class="form-control" name="status_pay_order">
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
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="พัสดุที่จะขออนุมัติ">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">จำนวน</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="จำนวน">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">รายการ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="รายการ">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ยอดขอจัดซื้อ / จ้าง (บาท)</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ยอดขอจัดซื้อ">
                                            
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

               


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
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
										<th>ยอดที่ขออนุมัติในแต่ละสัปดาห์</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								    <tr>
                                        <td></td>
                                        <td></td>
										<td></td>
										<td></td>
										<td></td>
                                        <td></td>
										<td></td>
										<td></td>
										<td></td>
                                        <td>
										<a href="" data-sfid='' data-toggle="modal" title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
																	&nbsp; &nbsp;
										<a href="" class="text-inverse" title="Delete" data-toggle="tooltip" onclick='javascript:confirmationDelete($(this));return false;'><i class="fa fa-trash-o txt-danger"></i></a>
																	
										
										</td>
                                    </tr>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->