<div class="box">
    <div class="box-heading">อ่าน เขียน คิดวิเคราะห์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-evaluation', "สารสนเทศงานวัดผลและประเมินผล"); ?></li>
        <li>อ่าน เขียน คิดวิเคราะห์</li>
    </ul>

    <div class="box-body">
        <div class="row"> 
            <div class="col-md-3 tab-menu-active"><i class='icon-edit'></i> แบบบันทึกการประเมิน</div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-rw-analysis'), "<i class=\"icon-cog\"></i> มาตรฐานและตัวชี้วัด"); ?></div>
        </div>
        <div class="row databox" style="border-bottom: solid 6px #efefef;">
            <div class="row" style="text-align:center;">
                <h3>แบบบันทึกการประเมินการอ่าน คิดวิเคราะห์ และการเขียน</h3>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        ปีการศึกษา 
                        <select>
                            <option>2560</option>
                        </select>
                        <?php echo nbs(4); ?>
                        เทอม 
                        <select>
                            <option>1</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col-md-12">

                        ระดับชั้น 
                        <select>
                            <option>ประถมศึกษาปีที่ 1/1</option>
                        </select>
                        <?php echo nbs(4); ?>
                        วิชา 
                        <select>
                            <option>ค1101</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row databox">
            <?php $this->load->view('ed_rw_analysis/ed_rw_analysis_form_view'); ?>
            <center>
                <button type='button' class='btn btn-default btn-insert1'>
                    <i class='icon-print icon-large'></i> 
                    พิมพ์บันทึกการประเมินการอ่าน คิดวิเคราะห์และเขียน (ปถ.๐๒)</button>
            </center>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

//    $('#example2').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": false,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
//        "language": {
//            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//            "zeroRecords": "## ไม่มีข้อมูล ##",
//            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//            "infoEmpty": "",
//            "infoFiltered": "",
//            "sSearch": "ระบุคำค้น",
//            "sPaginationType": "full_numbers"
//        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
//
//    // append insert button
//    var status = "<?php echo $this->session->userdata('status'); ?>";
//    var res = "<?php echo $this->session->userdata('responsible'); ?>";




</script>
