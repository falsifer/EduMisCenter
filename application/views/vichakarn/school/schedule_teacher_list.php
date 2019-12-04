
<div style="padding: 30px;">
  <input type="hidden" name="cid" id="cid" value="<?php echo $id; ?>" />
    <div class="row">
        <div class="col-md-12">

            <div class="box" style="margin:0px;width:100%;margin-top:20px;padding-bottom:10px;">
                <legend class="legend-heading" style="padding:10px;">รายชื่อครูทั้งหมด</legend>
                <div class="box-body">
                    <table class="table table-hover table-striped table-bordered display" id="teacher1">
                        <thead>
                            <tr>
                                <th class="no-sort">ที่</th>
                                <th class="no-sort">ชื่อ-นามสกุล</th>
                                <th class="no-sort">สาขา/วิชาเอก</th>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <th style="width:13%;" class="no-sort">เลือก</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = 1;
                            $name = "";
         
                            ?>
                            <?php foreach ($teacher as $r): ?>
                                <?php
                           
                            
                                    $tmp = $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname'];
//                                    if ($name != $tmp) {
                                        $name = $tmp;
                                        $edRs = $this->My_model->get_where_order('tb_human_resources_15',array('hr_id'=>$r['id']),'');
                                        $ed = "";
                                        foreach($edRs as $rr){
                                            if($rr['edu_level']!="" && $rr['edu_branch']!=""){
                                            $ed .= $rr['edu_level'] . '/' . $rr['edu_branch'].", ";
                                            }
                                        }
                                        ?>
                            <tr>
                                            <td><?php echo $row; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td style="<?php echo (trim($sbj) == trim($ed))?  'color:#397D02;font-weight:bold;' :  '';  ?>" ><?php echo $ed; ?></td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                   
                                                    <input type="checkbox" <?php if(in_array(array('hrid'=>$r['hrid']),$teacher_d)) echo 'checked'; ?> name ="hr[]" id="hr[]" value="<?php echo $r['hrid'];?>" />
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php
                                        $row++;
//                                    }else {
                                        ?>
<!--                                        <tr>
                                            <td colspan="2">&nbsp;</td>

                                            <td><?php echo $r['edu_level'] . '/' . $r['edu_branch']; ?></td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    &nbsp;
                                                </td>
                                            <?php endif; ?>
                                            <td style="display:none;">&nbsp;</td>
                                        </tr>-->
                                        <?php
                                    //}
                                    
                                
                                ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        
            </div>
        </div>
</div>
        <script>

            $('#teacher1').DataTable({
                "responsive": true,
                "stateSave": true,
                "bSort": false,
                "ordering": false,
                "pageLength": 100,
                columnDefs: [{
                        orderable: false,
                        targets: "no-sort"
                    }],
                "language": {
                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "zeroRecords": "## ไม่มีข้อมูล ##",
                    "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "sSearch": "ระบุคำค้น",
                    "sPaginationType": "full_numbers"
                },
            });
//
//            $('#teacher2').DataTable({
//                "responsive": true,
//                "stateSave": true,
//                "bSort": false,
//                "ordering": false,
//                columnDefs: [{
//                        orderable: false,
//                        targets: "no-sort"
//                    }],
//                "language": {
//                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                    "zeroRecords": "## ไม่มีข้อมูล ##",
//                    "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                    "infoEmpty": "",
//                    "infoFiltered": "",
//                    "sSearch": "ระบุคำค้น",
//                    "sPaginationType": "full_numbers"
//                },
//            });
            $('.sorting_asc').removeClass('sorting_asc');
            //
            var status = "<?php //echo $this->session->userdata("status");                       ?>";
            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "inherit");
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "auto");
            });

        </script>