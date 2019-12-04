<div class="panel panel-primary">
    <div class="panel-heading">งานส่งเสริม-สนับสนุนฯ :: ขั้นตอนการดำเนินงาน
        
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('education-evaluation'), "งานส่งเสริม-สนับสนุนฯ"); ?></li>
        <li>ขั้นตอนการดำเนินงาน</li>
    </ul>
    <div class="panel-body">
        <div class="row col-md-12">
            <table class="table table-hover table-striped table-bordered display" id="evPTab">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">การดำเนินงาน</th>
                        <th class="no-sort">ผู้ดำเนินงาน</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <th style="width:18%;" class="no-sort">
                            <button class='col-md-12 btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo datethai($r['progress_date']); ?></td>
                            <td><?php echo $r['progress_detail']; ?></td>
                            <td><?php echo $r['progress_person']; ?></td>
                            <td><?php echo $r['progress_comment']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="col-md-6 col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="col-md-6 col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>

                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    
    <?php
        $tabName = "evPTab";
        $text = "งานส่งเสริม-สนับสนุนฯ :: ขั้นตอนการดำเนินงาน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
  /*  $('#evPTab').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
    $('.sorting_asc').removeClass('sorting_asc');
*/
      $('#evPTab').on('click', '.btn-insert', function () {

        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลการดำเนินงาน');
        $('#ev-progress-modal').modal('show');
    });
    // edit data;
    $('#evPTab').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-evaluation-progress'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inProgressDate').val(data.progress_date);
                $('#inProgressDetail').val(data.progress_detail);
                $('#inProgressPerson').val(data.progress_person);
                $('#inProgressComment').val(data.progress_comment);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลการดำเนินงานการส่งเสริม-สนับสนุน');
                $('#ev-progress-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#evPTab').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-education-evaluation-progress'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('education_evaluation/modals/ev_progress_modal'); ?>