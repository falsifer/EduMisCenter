<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
	<div class="container">

		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">

				<h4 class="page-title">กำหนดรายชื่อผู้เกี่ยวข้องกับการจัดซื้อจัดจ้าง</h4>
			</div>
		</div>

		<?php
		$pre_name36=$purchaser['pre_name'];
		$name_dircetor36=$purchaser['name_dircetor'];
		$name_de_dirce36=$purchaser['name_de_dirce'];
		$position_pur36=$purchaser['position_pur'];
		$name_author36=$purchaser['name_author'];
		$name_head_author36=$purchaser['name_head_author'];
		$name_head_parcel36=$purchaser['name_head_parcel'];
		$name_head_finance36=$purchaser['name_head_finance'];
		$code_parcel36=$purchaser['code_parcel'];
		$school36=$purchaser['school'];
		$affiliation36=$purchaser['affiliation'];
		$id36=$purchaser['id'];
		?>
		<?php if ($id36 == '') { ?>
			<div class="row">
				<div class="col-xs-12">
					<div class="card-box">
						<?php 
							$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'myform');
							echo form_open('purchaser/save1', $attributes);
							?>
							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ยศนำหน้าชื่อ (กรณี)</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="pre_name" placeholder="ยศนำหน้า">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อผู้อำนวยการโรงเรียน</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_dircetor" placeholder="ชื่อผู้อำนวย">

									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อรองผู้อำนวยการโรงเรียน</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_de_dirce" placeholder="ชื่อรองผู้อำนวยการ">

									</fieldset>
								</div>

							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1"></label>
										<div class="radio-list">
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="รักษาราชการแทน">
													<label for="radio_9">รักษาราชการแทน</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="รักษาในตำแหน่ง">
													<label for="radio_10">รักษาในตำแหน่ง</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="ปฏิบัติราชการแทน">
													<label for="radio_9">ปฏิบัติราชการแทน</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="ยกเลิก">
													<label for="radio_10">ยกเลิก</label>
												</span>
											</div>
										</div>

									</fieldset>
								</div>

							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อเจ้าหน้าที่</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_author" placeholder="ชื่อเจ้าหน้าที่">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อหัวหน้าเจ้าหน้าที่</label>
										<div class="input-group">

											<input type="text" class="form-control" id="exampleInputEmail1" name="name_head_author" placeholder="ชื่อหัวหน้า">
										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อหัวหน้าหน่วยพัสดุ (ผู้สั่งจ่ายพัสดุ)</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_head_parcel" placeholder="ชื่อหัวหน้าหน่วยพัสดุ">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อเจ้าหน้าที่การเงิน</label>
										<div class="input-group">
											<input type="text" class="form-control"  name="name_head_finance" placeholder="ชื่อเจ้าหน้าที่การเงิน">

										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">อักษรย่อ ที่ใช้นำหน้ารหัสครุภัณฑ์</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="code_parcel" placeholder="อักษรย่อ">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">เป็นโรงเรียน</label>
										<div class="input-group">
											<select class="form-control" name="school">

												<option value="ประถม/ขยายโอกาส">ประถม/ขยายโอกาส</option>
												<option value="โรงเรียนมัธยม">โรงเรียนมัธยม</option>
											</select> 

										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">หน่วยงานต้นสังกัด</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="affiliation" placeholder="กระทรวงศึกษาธิการ">

									</fieldset>
								</div>

							</div>





							<div class="modal-footer">

								<button name="save1" type="submit" class="btn btn-primary waves-effect waves-light">บันทึกผู้เกี่ยวข้อง</button>
								<button class="btn btn-secondary waves-effect" onClick="if(event.stopPropagation){event.stopPropagation();}event.cancelBubble=true;">ยกเลิก</button>
							</div>

						</form>
					</div>
				</div>
			</div>
			<!-- end row -->
		<?php }else{ ?>
			<div class="row">
				<div class="col-xs-12">
					<div class="card-box">
							<?php 
							$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'myform');
							echo form_open('purchaser/save2', $attributes);
							?>
							<input type="hidden" name="get_id" class="get_id" value="<?php echo $id36; ?>">
							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ยศนำหน้าชื่อ (กรณี)</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="pre_name" value="<?php echo $pre_name36;?>">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อผู้อำนวยการโรงเรียน</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_dircetor" value="<?php echo $name_dircetor36;?>">

									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อรองผู้อำนวยการโรงเรียน</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_de_dirce" value="<?php echo $name_de_dirce36;?>">

									</fieldset>
								</div>

							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1"></label>
										<div class="radio-list">
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="รักษาราชการแทน" <?php if($position_pur36 == 'รักษาราชการแทน') echo 'checked' ?>>
													<label for="radio_9">รักษาราชการแทน</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="รักษาในตำแหน่ง" <?php if($position_pur36 == 'รักษาในตำแหน่ง') echo 'checked' ?>>
													<label for="radio_10">รักษาในตำแหน่ง</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="ปฏิบัติราชการแทน" <?php if($position_pur36 == 'ปฏิบัติราชการแทน') echo 'checked' ?>>
													<label for="radio_9">ปฏิบัติราชการแทน</label>
												</span>
											</div>
											<div class="radio-inline pl-0">
												<span class="radio radio-info">	<input type="radio" name="position_pur" id="radio_9" value="ยกเลิก" <?php if($position_pur36 == 'ยกเลิก') echo 'checked' ?>>
													<label for="radio_10">ยกเลิก</label>
												</span>
											</div>
										</div>

									</fieldset>
								</div>

							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อเจ้าหน้าที่</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_author" value="<?php echo $name_author36;?>">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อหัวหน้าเจ้าหน้าที่</label>
										<div class="input-group">
											<input type="text" class="form-control" name="name_head_author" value="<?php echo $name_head_author36;?>">

										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อหัวหน้าหน่วยพัสดุ (ผู้สั่งจ่ายพัสดุ)</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="name_head_parcel" value="<?php echo $name_head_parcel36;?>">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">ชื่อเจ้าหน้าที่การเงิน</label>
										<div class="input-group">
											<input type="text" class="form-control" name="name_head_finance" value="<?php echo $name_head_finance36;?>">

										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">อักษรย่อ ที่ใช้นำหน้ารหัสครุภัณฑ์</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="code_parcel" value="<?php echo $code_parcel36;?>">

									</fieldset>
								</div>
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">เป็นโรงเรียน</label>
										<div class="input-group">
											<select class="form-control" name="school">
												<option value="<?php echo $school36;?>"><?php echo $school36;?></option>
												<option value="ประถม/ขยายโอกาส">ประถม/ขยายโอกาส</option>
												<option value="โรงเรียนมัธยม">โรงเรียนมัธยม</option>
											</select> 

										</div><!-- input-group -->

									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<fieldset class="form-group">
										<label for="exampleInputEmail1">หน่วยงานต้นสังกัด</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="affiliation" value="<?php echo $affiliation36;?>">

									</fieldset>
								</div>

							</div>
							<div class="modal-footer">

								<button name="save2" type="submit" class="btn btn-warning waves-effect waves-light">แก้ไขผู้เกี่ยวข้อง</button>
								<button class="btn btn-secondary waves-effect" onClick="if(event.stopPropagation){event.stopPropagation();}event.cancelBubble=true;">ยกเลิก</button>
							</div>

						</form>
					</div>
				</div>
			</div>
			<!-- end row -->

		<?php }; ?>
	</div> <!-- container -->
        </div> <!-- End wrapper -->