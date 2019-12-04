
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มผู้ขายที่ซื้อบ่อย </button>

                        </div>
                        <h4 class="page-title">บันทึกชื่อผู้ขายที่ซื้อบ่อย</h4>
                    </div>
                </div>


                
<!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มผู้ขายที่ซื้อบ่อย</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ประเภท</label>
                                                     <select class="form-control" name="status_pay_order">
																				<option value="นิติบุคคล">นิติบุคคล</option>
																				<option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
																			</select>
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ชื่อผู้ขาย / ผู้รับจ้าง</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="ชื่อผู้ขาย">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ที่อยู่</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ที่อยู่">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">อำเภอ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="อำเภอ">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">จังหวัด</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="จังหวัด">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">โทรศัพท์</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="โทรศัพท์">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขประจำตัวผู้เสียภาษี</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="เลขผู้เสียภาษี">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่เงินฝากธนาคาร</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="เลขที่เงินฝาก">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ชื่อบัญชี</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ชื่อบัญชี">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ธนาคาร</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="ธนาคาร">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ผู้จัดการ / ผู้มีอำนาจลงนาม</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ผู้มีอำนาจลงนาม">
                                            
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

               


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
										<th>ชื่อผู้ขาย</th>
										<th>ที่อยู่</th>
										<th>เลขประจำตัวผู้เสียภาษี</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								    <tr>
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
