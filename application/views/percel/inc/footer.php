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








</div> <!-- End wrapper -->
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">กรอกปีงบประมาณ</h4>
                </div>
                <div class="modal-body">

                   <div class="row">
                       <div class="col-sm-12">
                        <fieldset class="form-group">
                         <label for="exampleInputEmail1">ปีงบประมาณ</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" name="name_mem" placeholder="เช่น 2561">

                     </fieldset>
                 </div>

             </div>






         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button name="save" type="submit" class="btn btn-primary waves-effect waves-light">บันทึก</button>
        </div>
    </div><!-- /.modal-content -->
</form>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- sample modal content -->
<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">เจ้าหน้าที่และหัวหน้าเจ้าหน้าที่</h4>
            </div>
            <div class="modal-body">
                <br>  
                <div class="row">
                   <div class="col-sm-12">

                     <a href="<?php echo base_url(''); ?>/index.php/purchaser"><button type="button" class="btn btn-block btn--md btn-success waves-effect waves-light active">ผู้เกี่ยวข้องจัดซื้อจัดจ้าง</button></a>
                     <br><br>
                     <a href="<?php echo base_url(''); ?>/index.php/committee"><button type="button" class="btn btn-block btn--md btn-info waves-effect waves-light active">กรรมการตรวจรับ</button></a>

                     <br>
                 </div>

             </div>






         </div>

     </div><!-- /.modal-content -->

 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- sample modal content -->
<div id="myModal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">การทำเรื่องจัดซื้อจัดจ้าง โดยวิธีเฉพาะเจาะจง</h4>
            </div>
            <div class="modal-body">
                <br>  
                <div class="row">
                   <div class="col-sm-12">

                     <a href="<?php echo base_url(''); ?>/index.php/approve_purchase"><button type="button" class="btn btn-block btn--md btn-primary waves-effect waves-light active">ทำเรื่องอนุมัติจัดซื้อ</button></a>
                     <br><br>
                     <a href="<?php echo base_url(''); ?>/index.php/approve_hire"><button type="button" class="btn btn-block btn--md btn-purple waves-effect waves-light active">ทำเรื่องอนุมัติจัดจ้าง</button></a>
                     <br><br>
                     <a href="<?php echo base_url(''); ?>/index.php/approve_del"><button type="button" class="btn btn-block btn--md btn-pink waves-effect waves-light active">ลบเรื่องที่ขออนุมัติปีงบประมาณที่ผ่านมา</button></a>

                     <br><br>
                 </div>

             </div>






         </div>

     </div><!-- /.modal-content -->

 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?php echo base_url(''); ?>/assets_parcel/js/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/js/tether.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?php echo base_url(''); ?>/assets_parcel/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/js/waves.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/plugins/switchery/switchery.min.js"></script>

<!--Morris Chart-->
<script src="<?php echo base_url(''); ?>/assets_parcel/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/plugins/raphael/raphael-min.js"></script>

<!-- Counter Up  -->
<script src="<?php echo base_url(''); ?>/assets_parcel/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/plugins/counterup/jquery.counterup.min.js"></script>

<!-- App js -->
<script src="<?php echo base_url(''); ?>/assets_parcel/js/jquery.core.js"></script>
<script src="<?php echo base_url(''); ?>/assets_parcel/js/jquery.app.js"></script>

<!-- Page specific js -->
<script src="<?php echo base_url(''); ?>/assets_parcel/pages/jquery.dashboard.js"></script>



        <!-- Required datatable js -->
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>/assets_parcel/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel','pdf', 'colvis' ]//'pdf', 'colvis'
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