<!-- Modal -->
<div id="vh-insert-geo-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">ปักหมุดเยี่ยมบ้านนักเรียน</h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">

                    <form method="post" id="vh-insert-geo-form" enctype="multipart/form-data">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <center>
                                        <table class="table table-hover table-striped table-bordered display" id="stdList">
                                    <!--<select name="inStdId" id='inStdId' onchange="getGEO(this)">-->
                                            <?php
                                            if ($rsT || isset($rsT[0])) {
                                                foreach ($rsT as $r):
                                                    $check = $this->My_model->get_where_row('tb_visit_home_calendar', array('tb_student_base_id' => $r['StdId']));
                                                    if (isset($check['id'])) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $r['std_number']; ?></td>
                                                            <td><img src="<?php echo $r['std_profile_picture']; ?>" width="80px" /><?php echo $r['std_fullname']; ?></td>
                                                            <td><button onclick="getGEO(<?php echo $r['StdId']; ?>)" class="btn btn-default">คลิกเพื่อเลือก</button></td>
                                                        </tr>
                                                        <!--<option  value="<?php echo $r['StdId']; ?>"><?php echo $r['std_number']; ?>.<?php echo $r['std_fullname']; ?></option>-->
                                                        <?php
                                                    }
                                                endforeach;
                                            }
                                            ?>
                                            </select>
                                        </table>
                                    </center>
                                </div>

                            </div>

                        </div>
                        <input type="hidden" name="inNewLat" id="inNewLat" />
                        <input type="hidden" name="inNewLong" id="inNewLong" />
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<script>

    function getGEO(e) {
//        alert(e+" "+$('#inNewLat').val()+","+$('#inNewLong').val());
        $.ajax({
            url: "<?php echo site_url('Visit_home/vh_insert'); ?>",
            method: "post",
            data: {inStdId: e, inAddLat: $('#inNewLat').val(), inAddLong: $('#inNewLong').val()},

            success: function (data) {
                alert("ปักหมุดสำเร็จ");

                location.reload();
                $('#vh-insert-geo-modal').modal("hide");
            }
        });

    }

    $('#stdList').DataTable({
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


</script>
