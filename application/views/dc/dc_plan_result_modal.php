<!-- Modal -->
<div id="dc-plan-result-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'result-modal-insert-form';
            $this->load->view('layout/my_school_print', $data);
            ?> 
            <div class="modal-body" style="padding:30px;">
                
                <div id='result-modal-insert-form'>
                    
                </div>
            </div>
        </div>
    </div>
</div>