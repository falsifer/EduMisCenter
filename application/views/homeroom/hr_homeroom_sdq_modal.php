<!-- Modal -->
<style>
    .TdSelect{
        width: 10%;
        text-align: center;
        cursor: pointer;
    }
    .TdSelect:hover {
        background-color: wheat;
    }

    th{
        background-color: whitesmoke;
    }
    .modal-body{
        height: 800px;
        overflow-y: auto;
    }

    .row-title{font-size:0.8em;line-height:20px;}
    .row-content{font-size:0.9em;margin-left:10px;line-height:20px;border-bottom: 1px dashed #ccc;}
</style>
<div id="hr-homeroom-sdq-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;height: 600px;overflow-y: auto;" >
        <div class="modal-content" >            
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'ElectronicLeaveDetailBody';
            $this->load->view('layout/my_school_print', $data);
            ?>  
            <div class="row" style="padding:30px;">
                <div id="SDQ">
                    <div id='SDQHead' >
                        <?php $this->load->view('layout/my_school_logo'); ?>
                    </div>
                    <div id='SDQChart' >
                    </div>
                    <div id='SDQBody' >
                    </div>
                </div>

            </div>            
        </div>
    </div>
</div>
<script>


    function SelectThisTd(e) {
        var str = e.id;
        var res = str.split(",");

        var status = res[0];
        var SdqId = res[1];
        var SdqScore = res[2];


        $.ajax({
            url: '<?php echo site_url('Icare/student_insert_sdq_score'); ?>',
            method: 'post',
            data: {Score: SdqScore, StdId: $('#StdId').val(), Assessor: $('#Assessor').val(), SdqId: SdqId, status: status, term: Term, edyear: EdYear},
            success: function (data) {
                $.ajax({
                    url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
                    method: 'post',
                    data: {id: $('#StdId').val(), term: Term, edyear: EdYear, Assessor: $('#Assessor').val()},
                    success: function (data) {
                        $("#SDQBody").html(data);
                        $('#hr-homeroom-sdq-modal').modal('show');
                    }
                });
            }
        });
    }
</script>    