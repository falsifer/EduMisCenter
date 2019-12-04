<!-- Modal -->
<div id="ic-element-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;" id="ElementResultBody">
                
                <div class="container-fluid">
                    <div class="row">
                        <center><h3>โรงเรียนสระพังวิทยา</h3></center>
                    </div>
                    <div class="row">
                        <center><h4>รายงานการประเมินองค์ประกอบขอองการควบคุมภายใน</h4></center>
                    </div>
                    <div class="row">
                        <center><h4>สำหรับระยะเวลาดำเนินงานสิ้นสุด วันที่ 30 เดือน กันยายน พ.ศ. 2561</h4></center>
                    </div>
                    <div class="row">   
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th class="sorting" style="text-align: center; width:60%;">องค์ประกอบของการควบคุมภายใน</th>
                                    <th class="sorting" style="text-align: center; width:40%;">ผลการประเมิน / ข้อสรุป</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td style="text-align: center;"><?php echo $r['tb_internal_control_edyear']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_internal_control_edyear']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="post" id="ic-topic-insert-form" enctype="multipart/form-data">

                    </form>
                </div>
                
            </div>
        </div>

    </div>
</div>
<script>
</script>