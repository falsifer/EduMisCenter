<div class="container-fluid">
    <!-- Left side -->
    <div class="col-md-9">
        <div class="databox" style="padding-top:10px;border:1px solid #C9302C;">
            <h3>ปฏิทินการศึกษา</h3>
            <div id="calendar"></div>
        </div>

        <!-- TAB -->
        <div class="databox" style="margin-top:20px;border:1px solid #449D44;">
            <div id="exTab2" class="container-fluid">	
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#1" data-toggle="tab"><b>กิจกรรมเดือน <?php echo month_num(date("m")); ?> <?php echo (date("Y") + 543); ?></b></a>
                    </li>
                    <li><a href="#2" data-toggle="tab"><b>กิจกรรมทั้งปีการศึกษา</b></a>
                    </li>
                    <li><a href="#3" data-toggle="tab"><b>อื่น ๆ</b></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="1" style="padding-top:10px;">
                        <h4>กิจกรรมการศึกษาประจำเดือน <?php echo month_num(date("m")); ?></h4>
                        <table class="table table-hove table-striped table-hover table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort" rowspan="2">ที่</th>
                                    <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                    <th class="no-sort" rowspan="2">กิจกรรม</th>
                                    <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                    <th class="no-sort" rowspan="2">สถานที่</th>
                                    <th class="no-sort" colspan="3">สถานะ</th>
                                    <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                        <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th class="no-sort">No Action</th>
                                    <th class="no-sort">In Action</th>
                                    <th class="no-sort">Success</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:center;">1</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td></td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">2</td>
                                    <td>5 ธันวาคม 2561</td>
                                    <td>วันคล้ายวันประสูติในหลวง ร.9</th>
                                    <td>อ.นฤมล อุดรพิมพ์</td>
                                    <td>ห้องประชุมโรงเรียน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">3</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">4</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">5</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="2" style="padding-top:10px;">
                        <h4>กิจกรรมการศึกษาตลอดปีการศึกษา</h4>
                        <table class="table table-hove table-striped table-hover table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort" rowspan="2">ที่</th>
                                    <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                    <th class="no-sort" rowspan="2">กิจกรรม</th>
                                    <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                    <th class="no-sort" rowspan="2">สถานที่</th>
                                    <th class="no-sort" colspan="3">สถานะ</th>
                                    <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                        <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th class="no-sort">No Action</th>
                                    <th class="no-sort">In Action</th>
                                    <th class="no-sort">Success</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:center;">1</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td></td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">2</td>
                                    <td>5 ธันวาคม 2561</td>
                                    <td>วันคล้ายวันประสูติในหลวง ร.9</th>
                                    <td>อ.นฤมล อุดรพิมพ์</td>
                                    <td>ห้องประชุมโรงเรียน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">3</td>
                                    <td>22 พฤศจิกายน 2561</td>
                                    <td>วันลอยกระทง</th>
                                    <td>อ.นพรัตน์ วงศ์จันทร์</td>
                                    <td>สระน้ำสาธารณะของหมู่บ้าน</td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="3" style="padding-top:10px;">
                        <div style="min-height: 200px;">ข้อมูลอื่น ๆ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Right side -->
    <div class="col-md-3">
        <div class="row" style="margin-top:0px;text-align:center;">
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('stock-of-documents'); ?>';"><?php echo img("images/folder.png"); ?> คลังเอกสารต่าง ๆ</button>
            </div>
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('picture-stock'); ?>';"><?php echo img("images/picture.png"); ?> คลังภาพสำนักงาน</button>
            </div>
        </div>

        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('human_resources'); ?>';"><?php echo img("images/workers.png"); ?> ทำเนียบบุคลากร</button>
            </div>
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('human_resources'); ?>';"><?php echo img("images/employee.png"); ?> ข้อมูลอัตรากำลัง</button>
            </div>
        </div>

        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" class="btn btn-danger btn-submenu" onclick="javascript:location.href = '<?php echo site_url('learning-center'); ?>';"><?php echo img("images/tourist.png"); ?> แหล่งเรียนรู้</button>
            </div>
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" class="btn btn-danger btn-submenu" onclick="javascript:location.href = '<?php echo site_url('network-of-km'); ?>';"><?php echo img("images/network.png"); ?> เครือข่ายสารสนเทศ</button>
            </div>
        </div>
        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('electornic-documents'); ?>';"><?php echo img("images/file.png"); ?> รับ-ส่งหนังสือ</button>
            </div>
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('documents-stock'); ?>';"><?php echo img("images/users.png"); ?> การนิเทศการศึกษา</button>
            </div>
        </div>
        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" class="btn btn-success btn-submenu"><?php echo img("images/money.png"); ?> จัดสรรงบประมาณ</button>
            </div>
            <div class="col-md-6" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('record-employee-activities'); ?>';"><?php echo img("images/tick-box.png"); ?> บันทึกการปฏิบัติงาน</button>
            </div>

        </div>
    </div>
</div>
<script>
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 550,
        locale: "th",
        events: [
            {
                title: 'วันหยุดไม่ทำงาน',
                start: '2018-11-01',
                end: '2018-11-01',
                url: 'http://www.google.com',
                /*rendering: 'background',*/
                color: '#ff9f89'
            },
            {
                title: 'Long Event',
                start: '2018-11-07',
                end: '2018-11-10',
                color: '#d4e157'

            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-11-09T16:00:00',
                color: '#bcaaa4'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-11-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2018-11-11',
                end: '2018-11-13',
                color: '#1de9b6'
            },
            {
                title: 'วันลอยกระทง',
                start: '2018-11-22',
                end: '2018-11-13'
            },
            {
                title: 'Meeting',
                start: '2018-11-12T10:30:00',
                end: '2018-11-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2018-11-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2018-11-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2018-11-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2018-11-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2018-11-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2018-11-28'
            }
        ]

    });
</script>