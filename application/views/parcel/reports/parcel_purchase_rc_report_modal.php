<div id="parcel-rc-report-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:90%">
        <div class="modal-content">
            <?php
            $data['MyHeadTitle'] = 'เอกสารตรวจรับการจัดซื้อจัดจ้าง';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>
            <div class="modal-body" style="padding:20px 40px;">
                <textarea class='editor'  name='inReceiptOrderRpt' id="inReceiptOrderRpt">
                    
                </textarea>
                <textarea class='editor'  name='inOrderPaymentRpt' id="inOrderPaymentRpt">
                    
                </textarea>
            </div>
        </div>

    </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 1123,
        width: 850,
        elements: "inSchedule",
        plugins: "print",
        toolbar: "print"
    });
</script>