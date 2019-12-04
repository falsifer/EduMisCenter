<!-- Modal -->
<div id="info-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                งานส่งเสริมการจัดการศึกษา เป็นงานที่สนับสนุนและส่งเสริมให้สถานศึกษาในสังกัดเขตพื้นที่การศึกษา สามารถจัดการศึกษาขั้นพื้นฐานได้อย่างมีประสิทธิภาพ โดยเน้น
                การบูรณาการการจัดการศึกษาทั้งการศึกษาในระบบ นอกระบบ และตามอัธยาศัย ไปสู่
                การศึกษาตลอดชีพ นำแหล่งเรียนรู้และภูมิปัญญาท้องถิ่นใช้ประกอบการเรียนการสอน  
                ส่งเสริมสุขภาพกายและสุขภาพจิตให้สมบูรณ์ จัดสวัสดิการ สวัสดิภาพ และกองทุนเพื่อ
                การศึกษา  ที่จะเป็นการช่วยเหลือผู้เรียนปกติ ด้อยโอกาส พิการ และมีความสามารถพิเศษ 
                อีกทั้งส่งเสริมให้บุคคล ครอบครัว ชุมชน สถาบันทางศาสนา สถานประกอบการ องค์กร
                ปกครองส่วนท้องถิ่น และเอกชน ร่วมจัดการศึกษาที่จะส่งผลต่อคุณภาพชีวิตของผู้เรียน

            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        var doc = $("#inEvDocument").val();
        var doc_ext = $("#inEvDocument").val().split('.').pop().toLowerCase();
        var img1 = $("#inEvImage1").val();
        var img1_ext = $("#inEvImage1").val().split('.').pop().toLowerCase();
        var img2 = $("#inEvImage2").val();
        var img2_ext = $("#inEvImage2").val().split('.').pop().toLowerCase();
        var img3 = $("#inEvImage3").val();
        var img3_ext = $("#inEvImage3").val().split('.').pop().toLowerCase();
        var img4 = $("#inEvImage4").val();
        var img4_ext = $("#inEvImage4").val().split('.').pop().toLowerCase();
        //
        if (doc != '' && jQuery.inArray(doc_ext, ['pdf', 'doc', 'docx'])) {
            alert('ไฟล์เอกสารประกอบจะต้องเป็นชนิด pdf หรือ doc หรือ docx เท่านั้น');
            return false;
        }
        //
        if ((img1 != '' && jQuery.inArray(img1_ext, ['jpg']) == -1)) {
            alert('ภาพประกอบลำดับที่ 1 จะต้องเป็นชนิด jpg เท่านั้น');
            $("file:").filestyle("clear");
            return false;
        }
        //
        if ((img2 != '' && jQuery.inArray(img2_ext, ['jpg']) == -1)) {
            alert('ภาพประกอบลำดับที่ 2 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        //
        if ((img3 != '' && jQuery.inArray(img3_ext, ['jpg']) == -1)) {
            alert('ภาพประกอบลำดับที่ 3 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        //
        if ((img4 != '' && jQuery.inArray(img4_ext, ['jpg']) == -1)) {
            alert('ภาพประกอบลำดับที่ 4 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-education-evaluation-data'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>