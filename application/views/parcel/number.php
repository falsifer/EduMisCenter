<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">

<!--<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> เพิ่มกำหนดเลขที่จัดซื้อจัดจ้าง </button>-->

                </div>
                <h4 class="page-title">กำหนดเลขที่จัดซื้อจัดจ้าง</h4>
                <div class="row col-sm-12">
                <span style="padding:20px 10px;color:red">กรณี เริ่มใช้โปรแกรม ต้นปีงบประมาณใหม่ </span>
                <span style="padding:20px;">ให้ป้อนทุกช่องเป็น 0 ทั้งหมด</span>
                <span style="padding:20px;color:red">กรณี เริ่มใช้โปรแกรม กลางปีงบประมาณ </span>
                <span style="padding:20px;">ให้ตั้งเลขที่ เป็น เลขสุดท้าย ที่ได้ออกเอกสารไป</span>
                </div>
            </div>
        </div>








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
                            <?php
                            $counter = 0;
                            $i = 1;
                            foreach ($number as $row) {
                                $counter++;
                                $tbl_order_pro_id = $row['id'];
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['order_num']; ?></td>
                                    <td><?php echo $row['employ_num']; ?></td>
                                    <td><?php echo $row['receipt_order']; ?></td>
                                    <td><?php echo $row['receipt_employ']; ?></td>
                                    <td><?php echo $row['bill_num']; ?></td>
                                    <td>
                                        <a href="#editModal<?php echo $i; ?>" data-sfid='"<?php echo $tbl_order_pro_id; ?>"' data-toggle="modal" class="text-inverse pr-10" title="Edit"  >แก้ไข</a>
                                        <!--&nbsp; / &nbsp;-->
                                        <!--<a href="<?php echo site_url('parcel/number/delete'); ?>?id=<?php echo $tbl_order_pro_id; ?>"  title="Delete" onclick='javascript:confirmationDelete($(this));return false;'>ลบ</a>-->                           

                                    </td>
                                </tr>
                                <?php $i++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->                 

    </div>  container 



    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <?php
            $attributes = array('class' => 'form-horizontal');
            echo form_open_multipart('parcel/number/procress', $attributes);
            ?>   
            ?>

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
                                <input type="text" class="form-control" id="exampleInputEmail1" name="order_num" placeholder="ใบสั่งซื้อ">

                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">เลขที่ใบสั่งจ้าง</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="employ_num" placeholder="ใบสั่งจ้าง">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">เลขที่ใบตรวจรับซื้อ</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="receipt_order" placeholder="ใบตรวจรับซื้อ">

                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">เลขที่ใบตรวจรับจ้าง</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="receipt_employ" placeholder="ใบตรวจรับจ้าง">

                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label for="exampleInputEmail1">เลขที่ใบเบิก</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="bill_num" placeholder="ใบเบิก">

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



    <?php
    $counter = 0;
    $i = 1;
    foreach ($number as $row) {
        $counter++;
        $tbl_order_pro_id = $row['id'];
        ?>
        <!-- sample modal content -->
        <div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg">
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open_multipart('parcel/number/procress', $attributes);
                ?>   
                ?>
                <input type="hidden" name="get_id" class="get_id" value="<?php echo $tbl_order_pro_id; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">เพิ่มกำหนดเลขที่จัดซื้อจัดจ้าง</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="border-bottom:solid 1px #efefef;margin-bottom: 10px;">
                            <div class="col-md-6">
                                <h5 style="padding-left:10px;color:red">กรณี เริ่มใช้โปรแกรม ต้นปีงบประมาณใหม่ </h5>
                                <h6 style="padding-left:20px;">ให้ป้อนทุกช่องเป็น 0 ทั้งหมด</h6>
                            </div>
                            <div class="col-md-6">
                                <h5 style="padding-left:10px;color:red">กรณี เริ่มใช้โปรแกรม กลางปีงบประมาณ </h5>
                                <h6 style="padding-left:20px;">ให้ตั้งเลขที่ เป็น เลขสุดท้าย ที่ได้ออกเอกสารไป</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบสั่งซื้อ</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="order_num" value="<?php echo $row['order_num']; ?>">

                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบสั่งจ้าง</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="employ_num" value="<?php echo $row['employ_num']; ?>">

                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบตรวจรับซื้อ</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="receipt_order" value="<?php echo $row['receipt_order']; ?>">

                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบตรวจรับจ้าง</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="receipt_employ" value="<?php echo $row['receipt_employ']; ?>">

                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบเบิก</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="bill_num" value="<?php echo $row['bill_num']; ?>">

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
    }
    ?>



</div> <!-- End wrapper -->