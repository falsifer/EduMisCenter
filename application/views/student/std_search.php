<!-- Modal -->
<div id="std-search" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="row">
                                <b>ข้อมูลพื้นฐาน</b>
                                <br></br>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="control-label">คัดกรองข้อมูล</label>
                                <select name="inType" id="inStdTitlename" class="form-control"  autofocus required="" >
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="1">คัดกรองจากรายได้ของผู้ปกครอง</option>
                                    <option value="2">คัดกรองจากเกรดเฉลี่ยของเด็ก</option>
                                </select>
                            </div>                            
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-danger btn-info"><i class="icon-save icon-large"></i> ตกลง</button></center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>