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
                                <th class="no-sort">ประเด็นการพิจารณา</th>
                                <th class="no-sort">เครื่องมือ</th>
                                <th class="no-sort">ค่าเป้าหมายที่สถานศึกษากำหนด</th>
                                <th class="no-sort">ผลลัพท์ที่สถานศึกษาได้</th>
                                <th class="no-sort">ระดับคุณภาพ</th>
                                <th class="no-sort"></th>
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
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td style="text-align: center">
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
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
                                        <td>
                                            <?php
                                                
                                                $this->QA_model->get_tools_link_view($rs2['tb_qa_plan_kpi_tools'],$rs2['tb_qa_plan_kpi_tools_id'],$rs2['qaId']);
                                            ?>
                                            <?php //echo $rs2['tb_qa_plan_kpi_tools']; ?>
                                        </td>
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




                                            echo "<td style=\"text-align:center;\"><input type=\"number\" name=\"inTbQAPlanKPIScore" . $rs2['qaId'] . "\"  id=\"" . $rs2['qaId'] . "\" onfocus=\"MyCursorNow(this)\"  onkeyup=\"InsertScore(this," . $rs2['tb_qa_plan_kpi_target'] . ")\" class=\"form-control\" autofocus/ value=\"" . $rs2['tb_qa_plan_kpi_score'] . "\" style=\"color:blue;\"></td>";
                                            ?>
                                            <td>
                                                <select name="inQAPlanKPIRank<?php echo $rs2['qaId']; ?>" id="inQAPlanKPIRank<?php echo $rs2['qaId']; ?>" onchange="insertRank(this,<?php echo $rs2['qaId']; ?>)">

                                                    <?php
                                                    foreach ($qaRank as $rr) {
                                                        ?>
                                                        <option value="<?php echo $rr['tb_qa_rank_score_detail']; ?>" <?php echo ( $rr['tb_qa_rank_score_detail'] == $rs2['tb_qa_plan_kpi_rank']) ? 'selected' : ''; ?> ><?php echo $rr['tb_qa_rank_score_detail']; ?></option>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <?php
                                        } else {
                                            echo "<td style=\"text-align:center;\"><input type=\"number\" name=\"inTbQAPlanKPIScore" . $rs2['qaId'] . "\"  id=\"" . $rs2['qaId'] . "\" onfocus=\"MyCursorNow(this)\" onkeyup=\"InsertScore(this," . $rs2['tb_qa_plan_kpi_target'] . ")\" class=\"form-control\" autofocus/></td>";
                                            echo "<td>&nbsp;</td>";
                                        }
                                        ?>
                                        <td>
                                            &nbsp;
                                        </td>
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

    
    $('.btn-upload').on("click", function () {
        var uid = $(this).attr('id');
        var txt = $(this).attr('title');
        $('#inTbQAPlanKpiID').val(uid);
        $('#qa-tools-upload-modal h4.modal-title').text('นำเข้ารูปภาพ หรือเอกสารอ้างอิง : '+txt);
        $('#qa-tools-upload-modal').modal('show');
    });
    
    $('.btn-kpi-plan').on("click", function () {
        $('#qa-plan-modal').modal('show');
    });
    $('#qa-plan-modal').bind('hide', function () {
        location.reload();
    });
    function InsertScore(e, rank) {
        var MyInput = e.id;
        var score = e.value;
        var qarank = "";
        if (score < rank) {
            qarank = "กำลังพัฒนา";
        } else if (score == rank) {
            qarank = "ปานกลาง";
        } else if (score > rank) {
            qarank = "ดีเลิศ";
        }

        $('#inQAPlanKPIRank' + MyInput).val(qarank);

        if (score == "") {
            score = 0;
        }

        $.ajax({
            url: "<?php echo site_url('Qa/insert_score'); ?>",
            method: "POST",
            data: {qaId: MyInput, score: score, qaRank: qarank},
            success: function (data) {
                                location.reload();
            }
        });
    }

    function insertRank(e, id) {
        $.ajax({
            url: "<?php echo site_url('Qa/insert_rank'); ?>",
            method: "POST",
            data: {qaId: id, qaRank: e.value},
            success: function (data) {
//                location.reload();
            }
        });
    }


</script>
<!-------------------------------------------------upload---------------------------->
<?php $this->load->view('vichakarn/modals/qa_modal'); ?>
<?php $this->load->view('vichakarn/modals/qa_tools_upload_modal'); ?>