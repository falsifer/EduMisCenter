<div style='margin: 5px'>
    <!--<button type="button" class="btn btn-primary" onclick="PrintThisArea(this)" style='float:left;'><i class="icon-print icon-large" > สั่งพิมพ์</i></button>-->
         <button type='button' class='btn btn-primary' onclick="PrintThisArea(this)" style='float:left;'><i class='icon-print icon-large'></i> สั่งพิมพ์</button>
                       
    <input type='hidden' id='MySchoolAreaId' value=''>
    <input type='hidden' id='MySchoolCss' value='

           <link rel="stylesheet" href="<?php echo base_url("assets/css/main.css") ?>" type="text/css"/>
           <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mycss.css" type="text/css"/> 
           <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.css") ?>" type="text/css">
           <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.min.js"></script>

           <script src="<?php echo base_url(); ?>assets/js/charts/jquery.canvasjs.min.js"></script>

           '>

    <input type='hidden' id='MySchoolHeadPrint' value=''>

<!--    <input type='hidden' id='MySchoolAreaId' value='
    <?php
    if ($AreaID != "") {
        echo $AreaID;
    }
    ?>
   '>-->
</div>
<script>
    var newWin = "";
    var MyCss = $('#MySchoolCss').val();

    function PrintThisArea(e) {
        my_school_hidden_element('no-print', 'none');

        var head = $('#' + str).html();
        var style = "<style type='text/css'>@font-face {font-family: THSarabun;src: url('<?php echo base_url() ?>assets/fonts/THSarabun.ttf');font-weight: bold;}body{font-family:'THSarabun';font-size:1.6em;}.school-row-title{font-size:0.6em;line-height:20px;}.school-row-content{font-size:0.7em;margin-left:20px;line-height:20px;border-bottom: 1px dashed #ccc;}</style>";
        var str = $('#MySchoolAreaId').val();
        var MyArea = $('#' + str).html();

        var MyPrint = '<html><head><title></title>' + MyCss + style + '</head><body>' + MyArea + '</body></html>';
        newWin = window.open('', '', 'height=600,width=1200');
        newWin.document.write(MyPrint);
        setInterval(function () {

//            newWin.addEventListener('load', newWin.MySchoolChart(), true);
            newWin.print();
            newWin.close();
        }, 1000);
        my_school_hidden_element('no-print', 'display');
    }




</script>
