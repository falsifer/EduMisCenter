<div class="box">
    <div class="box-heading">บัญชีเรียกชื่อนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('hr-homeroom'), "งานครูประจำชั้น"); ?></li>
        <li>บัญชีเรียกชื่อนักเรียน</li>
    </ul>
    <div class="box-body">
        <div class='row'>
            <div class='col-md-10 col-md-offset-1'>
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success"><i class="icon-calendar icon-large"></i> ค้นหาใบลาตั้งแต่วันที่ </button>
                        </div>
                        <input type="text" name="inSearchStartDate" id="inSearchStartDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" onchange="CalDate(this)" data-date-format="yyyy-mm-dd" placeholder="จากวันที่..." required/>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success"><i class="icon-calendar icon-large"></i> จนถึงวันที่ </button>
                        </div>
                        <input type="text" name="inSearchEndDate" id="inSearchEndDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" onchange="CalDate(this)" data-date-format="yyyy-mm-dd" placeholder="จนถึงวันที่..." required/>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" style="" onclick="ApproveSearch(this)"><i class="icon-search icon-large"></i> ค้นหา </button>

                </div>
                <hr/>
                <table class='table table-hover table-bordered display' id='StudentTable'>
                    <thead>
                        <tr>
                            <th style="text-align:center; width:5%;" rowspan="2">ที่</th>
                            <th class="sorting"  style="text-align:center; width:40%;" rowspan="2">ชื่อ-นามสกุล</th>
                            <th class="sorting"  style="text-align:center; width:10%; color: green;" colspan="2" >มา</th>
                            <th class="sorting"  style="text-align:center; width:10%; color: orange;" colspan="2">ลา</th>
                            <th class="sorting"  style="text-align:center; width:5%; color: red;" rowspan="2">ขาด</th>
                            <!--<th class="sorting"  style="text-align:center; width:30%;" rowspan="2">หมายเหตุ</th>-->
                        </tr>
                        <tr>
                            <th class="sorting"  style="text-align:center;  color: green;">มา</th>
                            <th class="sorting"  style="text-align:center;  color: green;">สาย</th>
                            <th class="sorting"  style="text-align:center;  color: orange;">ลาป่วย</th>
                            <th class="sorting"  style="text-align:center;  color: orange;">ลากิจ</th>
                        </tr>
                    </thead>
                    <tbody id='StudentTBody'>

                    </tbody>
                </table>
            </div>     
        </div>
    </div>
    
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
</script>
