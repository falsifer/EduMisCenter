<div class="panel panel-primary">
    <div class="panel-heading">ระบบรายงานการประกันคุณภาพในสถานศึกษา
        <button class="btn btn-primary btn-kpi-plan" style="float:right;"><i class="icon-plus"></i> จัดการแผนการประกันคุณภาพ</button>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($stdRs as $stdr) {
                    ?>
                    <h3>มาตรฐานที่ <?php echo $stdr['tb_qa_standard_number'] . ' ' . $stdr['tb_qa_standard_detail']; ?></h3>


                    <table class="table table-hover table-striped table-bordered display" id="example<?php echo $stdr['id']; ?>">
                        <thead>
                            <tr>
                                <th style="width:40px;" class="no-sort">ที่</th>
                                <!--<th class="no-sort">โรงเรียน</th>-->
                                <th class="no-sort">ประเด็นการพิจารณา</th>
                                <th class="no-sort">ค่าเป้าหมายที่สถานศึกษากำหนด</th>
                                <th class="no-sort">ผลลัพท์ที่สถานศึกษาได้</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = 1;
                            $rs = $this->My_model->get_where_order('tb_qa_standard_detail', array('tb_qa_standard_id' => $stdr['id']), 'tb_qa_standard_detail_number');
                            ?>
                            <?php
                            foreach ($rs as $scr) {
                                ?>
                                <tr style="font-weight:bold;">
                                    <td><?php echo $row; ?></td>
                                    <td><?php echo $scr['tb_qa_standard_detail']; ?></td>
                                    <td style="text-align: center">
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <?php
                                $this->db->select("*,a.id as qaId");
                                $this->db->from('tb_qa_plan_kpi a');
                                $this->db->join('tb_qa_plan b', 'a.tb_qa_plan_id=b.id');
                                $this->db->where(array('tb_qa_plan_department' => $this->session->userdata('department')));
                                $this->db->where(array('tb_qa_standard_detail_id' => $scr['id'], 'tb_qa_plan_year' => get_edyear()));
                                $this->db->order_by('tb_qa_plan_kpi_activity');
                                $query = $this->db->get();
                                if (isset($query)) {
                                    $rest = $query->result_array();
                                }
                                foreach ($rest as $rs2) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><?php echo $rs2['tb_qa_plan_kpi_activity']; ?></td>
                                        <td style="text-align: center">
                                            <?php if (isset($rs2['id'])) { ?>
                                                <?php echo ($rs2['tb_qa_plan_kpi_score_type'] == "ร้อยละ") ? $rs2['tb_qa_plan_kpi_score_type'] . " " : ''; ?>
                                                <?php echo $rs2['tb_qa_plan_kpi_target']; ?>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        if (isset($rs2['tb_qa_plan_kpi_score'])) {
                                            echo "<td style=\"text-align:center;\"><input type=\"number\" name=\"inTbQAPlanKPIScore" . $rs2['qaId'] . "\"  id=\"" . $rs2['qaId'] . "\" onfocus=\"MyCursorNow(this)\"  onkeyup=\"InsertScore(this)\" class=\"form-control\" autofocus/ value=\"" . $rs2['tb_qa_plan_kpi_score'] . "\" style=\"color:blue;\"></td>";
                                        } else {
                                            echo "<td style=\"text-align:center;\"><input type=\"number\" name=\"inTbQAPlanKPIScore" . $rs2['qaId'] . "\"  id=\"" . $rs2['qaId'] . "\" onfocus=\"MyCursorNow(this)\" onkeyup=\"InsertScore(this)\" class=\"form-control\" autofocus/></td>";
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                $row++;
                            }
                            ?>
                    </table>



                    <?php
                }
                ?>

            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<!---------------------------------------------------------------------------->
<script>

<?php
foreach ($stdRs as $stdr) {
    ?>
        $('#example<?php echo $stdr['id']; ?>').DataTable({
            "responsive": true,
            "stateSave": true,
            "bSort": false,
            "ordering": false,
            "pageLength": 50,
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
            }
        });
    <?php
}
?>
//    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
//    $(function () {
//        $('[data-toggle="tooltip"]').tooltip();
//    });
    // สร้างปุ่ม
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;");


    $('.btn-kpi-plan').on("click", function () {
        $('#qa-plan-modal').modal('show');
    });


    $('#qa-plan-modal').bind('hide', function () {
        location.reload();
    });


    function InsertScore(e) {
        var MyInput = e.id;
        var score = e.value;

        if (score == "") {
            score = 0;
        }

        $.ajax({
            url: "<?php echo site_url('QA/insert_score'); ?>",
            method: "POST",
            data: {qaId: MyInput, score: score},
            success: function (data) {
//                location.reload();
            }
        });

    }


</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vichakarn/modals/qa_modal'); ?>