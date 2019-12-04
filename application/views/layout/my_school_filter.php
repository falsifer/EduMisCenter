<div class="row" id="MyHead">
    <div class="col-md-12  form-group">

        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-body">

                    <?php
                    $var = 4;
                    if (isset($term)) {
                        $var += 2;
                    }
                    if (isset($class)) {
                        $var += 4;
                    }
                    if (isset($room)) {
                        $var += 2;
                    }
                    $MyWidth = (80 / $var);
//                    echo $MyWidth;
                    ?>

                    <div style='width: <?php echo $MyWidth * 4; ?>%;float:left;margin:0% 2.5% 0% 2.5%;'>
                        <label class="control-label">ปีการศึกษา</label>
                        <select name="MyEdYear" id="MyEdYear" class="form-control" onchange="MyOnChange(this)">
                            <option value="">----เลือกปีการศึกษา----</option> 
                            <?php $YearNow = date('Y') + 537; ?>
                            <?php for ($iY = 1; $iY < 12; $iY++) { ?>
                                <?php $YearNow++; ?>
                                <option value="<?php echo $YearNow ?>"><?php echo $YearNow ?></option>                    
                            <?php } ?>
                        </select> 
                    </div>

                    <?php if (isset($term) && ($term == 'Y')): ?>
                        <div style='width: <?php echo $MyWidth * 2; ?>%;float:left;margin:0% 2.5% 0% 2.5%;'>
                            <label class="control-label">ภาคเรียน</label>
                            <select name="MyTerm" id="MyTerm" class="form-control" onchange="MyTermOnChange(this)">
                                <option value="">---เลือกภาคเรียน---</option>  
                            </select> 
                        </div>
                    <?php endif; ?>

                    <?php if (isset($class) && ($class == 'Y')): ?>
                        <div style='width: <?php echo $MyWidth * 4; ?>%;float:left;margin:0% 2.5% 0% 2.5%;'>
                            <label class="control-label">ระดับชั้น</label>
                            <select name="MyClass" id="MyClass" class="form-control" onchange="MyClassOnChange(this)">
                                <option value="">---เลือกระดับชั้น---</option>  
                            </select> 
                        </div>
                    <?php endif; ?>
                    <?php if (isset($room) && ($room == 'Y')): ?>
                        <div style='width: <?php echo $MyWidth * 2; ?>%;float:left;margin:0% 2.5% 0% 2.5%;'>
                            <label class="control-label">ห้อง</label>
                            <select name="MyRoom" id="MyRoom" class="form-control" onchange="MyRoomOnChange(this)" >
                                <option value="">---เลือกห้อง---</option> 
                            </select> 
                        </div>
                    <?php endif; ?>  

                </div>
            </div>
        </div>

    </div>
</div>


<script>
    
   
    
    var MyEdYearId = <?php echo get_edyear(); ?>;
    var MyTermId = 0;
    var MyClassId = 0;
    var MyLevelId = 0;
    
    
    $("#MyEdYear").val(MyEdYearId);
    $("#MyEdYear").change();

    function MyOnChange(e) {
        var MyY = $("#MyEdYear").val();
        $.ajax({
            url: "<?php echo site_url('MySchoolFilter/MyHead'); ?>",
            method: "post",
            data: {MyY: MyY, T: '<?php echo (isset($term)) ? $term : ''; ?>', C: '<?php echo (isset($class)) ? $class : ''; ?>', R: '<?php echo (isset($room)) ? $room : ''; ?>'},
            success: function (data) {
                $('#MyHead').html(data);
                $('#MyEdYear').val(MyY);

                if ($.isFunction(window.MyEdYearTest)) {
                    MyEdYearTest(e);
                }
            }
        });
    }

    function MyClassOnChange(e) {
        var MyC = $("#MyClass").val();
<?php if (isset($room) && ($room == 'Y')) { ?>
            $.ajax({
                url: "<?php echo site_url('MySchoolFilter/MyRoom'); ?>",
                method: "post",
                data: {MyC: MyC},
                success: function (data) {
                    $('#MyRoom').html(data);
                    if ($.isFunction(window.MyEdTest)) {
                        MyEdTest(e);
                    }
                }
            });
<?php } else { ?>
            if ($.isFunction(window.MyEdTest)) {
                MyEdTest(e);
            }
<?php } ?>

    }

</script>

