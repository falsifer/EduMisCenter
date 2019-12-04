
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มกำหนดเลขที่จัดซื้อจัดจ้าง </button>

                        </div>
                        <h4 class="page-title">กำหนดเลขที่จัดซื้อจัดจ้าง</h4>
                    </div>
                </div>


                
<!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
								<form class="form-horizontal" method="post" enctype="multipart/form-data">
		  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มกำหนดเลขที่จัดซื้อจัดจ้าง</h4>
                                        </div>
                                        <div class="modal-body">
										    
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่ใบสั่งซื้อ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="ใบสั่งซื้อ">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่ใบสั่งจ้าง</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" placeholder="ใบสั่งจ้าง">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่ใบตรวจรับซื้อ</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ใบตรวจรับซื้อ">
                                            
                                                 </fieldset>
										    </div>
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่ใบตรวจรับจ้าง</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="ใบตรวจรับจ้าง">
                                            
                                                 </fieldset>
										    </div>
										 </div>
										 <div class="row">
											<div class="col-sm-6">
                                                <fieldset class="form-group">
                                                 <label for="exampleInputEmail1">เลขที่ใบเบิก</label>
                                                     <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="ใบเบิก">
                                            
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
										<th>เลขที่ใบสั่งซื้อ</th>
										<th>เลขที่ใบสั่งจ้าง</th>
										<th>เลขที่ใบตรวจรับซื้อ</th>
										<th>เลขที่ใบตรวจรับจ้าง</th>
										<th>เลขที่ใบเบิก</th>
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