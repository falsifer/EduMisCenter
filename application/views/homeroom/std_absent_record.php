<div class="box">
    <div class="box-heading">บันทึกเวลามาเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกเวลามาเรียน</li>
    </ul>
    <div class="box-body">
        <?php
        $data['class'] = 'Y';
        $data['room'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>

        <div id="calendar">
        </div>        

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("homeroom/std_absent_record_modal"); ?>

<script>

    var cid = 0;
    var rid = 0;
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 500,
        locale: "th",
        selectable: true,

        dayClick: function (date) {

            cid = $("#MyClass").val();
            rid = $("#MyRoom").val();
            
//            alert(cid + "abc" + rid);
            var daynow = date.format();
            //--- Insert ครั้งแรก
            $.ajax({
                url: "<?php echo site_url('Homeroom/std_absent_record_insert'); ?>",
                method: "post",
                data: {daynow: daynow, cid: cid, rid: rid},
                success: function (data) {
                    $.ajax({
                        url: "<?php echo site_url('Homeroom/std_absent_record_edit'); ?>",
                        method: "post",
                        data: {daynow: daynow, cid: cid, rid: rid},
                        success: function (data) {
                            $('#RecordBody').html(data);
//                            $('#stdclass').val(stdclass);
//                            $('#stdlevel').val(stdlevel);
                            $('#daynow').val(daynow);
                            $('#std-absent-record-modal').modal('show');
                        }
                    });
                }
            });

        }
    }
    );



</script>
