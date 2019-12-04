<!-- Modal -->
<div id="articles-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php
            $data['MyHeadTitle'] = 'บันทึกชื่อประเภทครุภัณฑ์';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>
            <div class="modal-body">
                <div class="row">
                    <form method="post" id="insert-form">
                        <div class="col-md-12" style="padding:10px;">
                            <div class="col-md-2">
                                <label class="control-label">ชื่อประเภทครุภัณฑ์</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="inNameCat" id="inNameCat" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                            </div>

                            <input type="hidden" name="id" id="id" />

                        </div>
                    </form>
                    <div class="col-md-12">

                        <table class="table table-hover table-striped table-bordered display" id="catTab">
                            <thead>
                                <tr>
                                    <th>ที่</th>
                                    <th class="no-sort">ชื่อประเภทครุภัณฑ์</th>
                                    <th style="width:18%;" class="no-sort">
                                        &nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($name_cat as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['name_cat']; ?></td>
                                        <td style="text-align:center;">
                                            <div class="btn-group">
                                                <button type="button" class="col-md-6 col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                <button type="button" class="col-md-6 col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                            </div>  
                                        </td>

                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
<?php
$tabName = "catTab";
$text = "ประเภทครุภัณฑ์";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>
        $('#insert-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo site_url('parcel/Articles/insert_category'); ?>',
                method: 'post',
                data: $('#insert-form').serialize(),
                success: function (data) {
                    $('#insert-form')[0].reset();
                    location.reload();
                }
            });
        });

        $('#catTab').on('click', '.btn-edit', function (e) {
            var uid = $(this).attr('id');
            $.ajax({
                url: '<?php echo site_url('parcel/Articles/edit_category'); ?>',
                method: 'post',
                data: {id: uid},
                dataType: 'json',
                success: function (data) {
                    $('#id').val(data.id);
                    $('#inNameCat').val(data.name_cat);
                }
            });
        });
        $('#catTab').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('parcel/Articles/delete_category'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    </script>