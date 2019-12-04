<div class="box">
    <div class="box-heading">  ระบบงานพัสดุ
        <!--<button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>-->
<!--        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> ค้นหาเรื่องเดิมที่ทำไว้ </button>-->

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>บันทึกชื่อผู้ขายที่ซื้อบ่อย</li>
    </ul>
    <div class="box-body">








        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อผู้ขาย</th>
                                <th>ที่อยู่</th>
                                <th>เลขประจำตัวผู้เสียภาษี</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 0;
                            $i = 1;
                            foreach ($seller as $row) {
                                $counter++;
                                $tbl_order_pro_id = $row['id'];
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['name_seller']; ?></td>
                                    <td><?php echo $row['address_seller']; ?> <?php echo $row['amphur_seller']; ?> <?php echo $row['province_seller']; ?></td>
                                    <td><?php echo $row['id_card']; ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id; ?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >
                                                <button class="col-md-6 btn btn-warning"><i class="icon-pencil icon-lagre"></i> แก้ไข</button></a>

                                            <a href="<?php echo site_url('parcel/seller/delete'); ?>?id=<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>
                                                <button class="col-md-6 btn btn-danger"><i class="icon-trash icon-lagre"></i> ลบ</button></a>        
                                        </div>
                                    </td>

                                </tr>
    <?php $i++;
} ?> 

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container -->
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <?php
        $attributes = array('class' => 'form-horizontal');
        echo form_open_multipart('parcel/seller/procress', $attributes);
        ?>   
        ?>

        <div class="modal-content">
            <?php 
                $this->load->view('layout/my_school_modal_header'); 
            ?>
<!--            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">เพิ่มผู้ขายที่ซื้อบ่อย</h4>
            </div>-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-6">
                            <label for="exampleInputEmail1">ประเภท</label>
                            <select class="form-control" name="type_seller">
                                <option value="นิติบุคคล">นิติบุคคล</option>
                                <option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">ชื่อผู้ขาย / ผู้รับจ้าง</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_seller" placeholder="ชื่อผู้ขาย">

                        </fieldset>
                    </div>
              
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">ที่อยู่</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="address_seller" placeholder="ที่อยู่">

                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">อำเภอ</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="amphur_seller" placeholder="อำเภอ">

                        </fieldset>
                    </div>
              
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">จังหวัด</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="province_seller" placeholder="จังหวัด">

                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">โทรศัพท์</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="phone_seller" placeholder="โทรศัพท์">

                        </fieldset>
                    </div>
              
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">เลขประจำตัวผู้เสียภาษี</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="id_card" placeholder="เลขผู้เสียภาษี">

                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">เลขที่เงินฝากธนาคาร</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="bank_seller" placeholder="เลขที่เงินฝาก">

                        </fieldset>
                    </div>
              
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">ชื่อบัญชี</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_bank_seller" placeholder="ชื่อบัญชี">

                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">ธนาคาร</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="bank" placeholder="ธนาคาร">

                        </fieldset>
                    </div>
              
                    <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">ผู้จัดการ / ผู้มีอำนาจลงนาม</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_manager" placeholder="ผู้มีอำนาจลงนาม">

                        </fieldset>
                    </div>
                    
                </div>
                    <center> <button name="save" type="submit" class="btn btn-success waves-effect waves-light"><i class="icon-save"></i> บันทึก</button> </center>
            </div>

            </div>
<!--            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>-->
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php
$counter = 0;
$i = 1;
foreach ($seller as $row) {
    $counter++;
    $tbl_order_pro_id = $row['id'];
    ?>
    <!-- sample modal content -->
    <div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open_multipart('parcel/seller/procress', $attributes);
    ?>   
            ?>
            <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขผู้ขายที่ซื้อบ่อย</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ประเภท</label>
                                <select class="form-control" name="type_seller">
                                    <option value="<?php echo $row['type_seller']; ?>"><?php echo $row['type_seller']; ?></option>
                                    <option value="นิติบุคคล">นิติบุคคล</option>
                                    <option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
                                </select>

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ชื่อผู้ขาย / ผู้รับจ้าง</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name_seller" value="<?php echo $row['name_seller']; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ที่อยู่</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="address_seller" value="<?php echo $row['address_seller']; ?>">

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">อำเภอ</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="amphur_seller" value="<?php echo $row['amphur_seller']; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">จังหวัด</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="province_seller" value="<?php echo $row['province_seller']; ?>">

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">โทรศัพท์</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="phone_seller" value="<?php echo $row['phone_seller']; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">เลขประจำตัวผู้เสียภาษี</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="id_card" value="<?php echo $row['id_card']; ?>">

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">เลขที่เงินฝากธนาคาร</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="bank_seller" value="<?php echo $row['bank_seller']; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ชื่อบัญชี</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name_bank_seller" value="<?php echo $row['name_bank_seller']; ?>">

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ธนาคาร</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="bank" value="<?php echo $row['bank']; ?>">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                                <label for="exampleInputEmail1">ผู้จัดการ / ผู้มีอำนาจลงนาม</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name_manager" value="<?php echo $row['name_manager']; ?>">

                            </fieldset>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button name="change" type="submit" class="btn btn-warning waves-effect waves-light">Save Edit</button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php $i++;
} ?>
</div> <!-- End wrapper -->


<script>
    <?php
$tabName = "datatable";

$text = "ระบบงานพัสดุ : รายชื่อผู้ขายที่ซื้อบ่อย";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2";
$btExArr = array();
//$(\'#insert-form\').trigger(\'reset\');
//if ($id != null && $id != "") {
    $bt = array(
        'name' => 'add_topic',
        'title' => 'เพิ่มข้อมูล',
        'icon' => 'icon-plus',
        'class' => 'btn btn-primary',
        'fn' => '$(\'#myModal\').modal(\'show\');'
    );
    array_push($btExArr, $bt);
//}

load_datatable($tabName, $btExArr, $title, $colStr);
?>
</script>