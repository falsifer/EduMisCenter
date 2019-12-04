<div class="box">
    <div class="box-heading">เทียบโอนผลการเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-evaluation', "งานวัดผลและประเมินผล"); ?></li>
        <li>เทียบโอนผลการเรียน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">

                    <?php
                    $data['term'] = 'Y';
                    $data['class'] = 'Y';
                    $data['room'] = 'Y';
                    $this->load->view('layout/my_school_filter', $data);
                    ?>      


                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th class="sorting" style="text-align: center; width: 10%">เลขที่</th>
                                <th class="sorting" style="text-align: center; width: 20%">รหัสนักเรียน</th>
                                <th class="sorting" style="text-align: center; width: 40%">ชื่อ-นามสกุล</th>
                                <th class="sorting" style="text-align: center; width: 15%">คะแนนเก็บ(70)</th>
                                <th class="sorting" style="text-align: center; width: 15%">คะแนนสอบ(30)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">2</td>
                                <td style="text-align: center;">3</td>
                                <td style="text-align: center;">
                                    <input type="text" name="inCourseCode" id="inCourseCode" class="form-control" required/>
                                </td>
                                <td style="text-align: center;">
                                    <input type="text" name="inCourseCode" id="inCourseCode" class="form-control" required/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
//    function ReloadTable() {
        $('#example').DataTable({
            "responsive": true,
            "stateSave": true,
            "bSort": false,
            "ordering": true,
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
//    }
</script>
