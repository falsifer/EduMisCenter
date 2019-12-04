
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มชื่อหน่วยงานผู้เบิกใช้พัสดุ </button>

                        </div>
                        <h4 class="page-title">บันทึกชื่อหน่วยงานผู้เบิกใช้พัสดุ</h4>
                    </div>
                </div>


                
<!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มชื่อหน่วยงานผู้เบิกใช้พัสดุ</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ชื่อหน่วยงาน</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="หน่วยงาน">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">ชื่อหัวหน้างาน</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="หัวหน้างาน">
                                            
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
                                        <th>ชื่อหน่วยงาน</th>
										<th>ชื่อหัวหน้างาน</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <tr>
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
                
