


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
