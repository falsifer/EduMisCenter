<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Approve_purchase_model");
        $this->load->model("parcel/Parcel_model");
    }

    public function index() {
        $data['yearly'] = $this->My_model->get_row('tb_parcel');
        $data['list'] = $this->My_model->get_where_order('tb_parcel_purchase',array(/*'parcel_status'=>'อนุมัติ'*/),'');

        $this->db->select("*")->from('tb_parcel_product')->where(array('tb_school_id' => $this->session->userdata('sch_id')));
        $data['prod'] = $this->db->get()->result_array();

        load_view($this, 'parcel/asset', $data);
    }
    
    public function report() {
        $data['yearly'] = $this->My_model->get_row('tb_parcel');
        $data['list'] = $this->Parcel_model->get_asset_list();
        load_view($this, 'parcel/asset_report', $data);
    }
    

    public function parcel_rc_insert() {
        $id = $this->input->post('id');
        $purchase_id = $this->input->post('inParcelPurchaseId');
        $parcel_rc_status = $this->input->post('inParcelRcStatus');
        $parcel_rc_fine = $this->input->post('inParcelRcFine');
        $parcel_rc_note = $this->input->post('inParcelRcNote');

        if ($purchase_id != null && $purchase_id != "") {
            $this->My_model->update_data('tb_parcel_purchase', array('id' => $purchase_id), array('parcel_status' => 'ตรวจรับ'));
        }

        $arr = array(
            'tb_parcel_purchase_id' => $purchase_id,
            'tb_parcel_rc_status' => $parcel_rc_status,
            'tb_parcel_rc_fine' => $parcel_rc_fine,
            'tb_parcel_rc_note' => $parcel_rc_note,
            'tb_parcel_rc_recorder' => $this->session->userdata('name')
        );
        if ($id != null && $id != "") {
            $this->My_model->update_data('tb_parcel_rc', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_parcel_rc', $arr);
        }
    }

    public function parcel_rc_edit() {
        $purchase_id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_parcel_rc', array('tb_parcel_purchase_id' => $purchase_id));
        echo json_encode($rs);
    }

    public function get_parcel_control_no($parcel_purchase_item_id) {
        $item = $this->My_model->get_where_row('tb_parcel_purchase_itm', array('id' => $parcel_purchase_item_id));
        $product = $this->My_model->get_where_row('tb_parcel_product', array('id' => $item['parcel_product_id']));
        $chk = $this->Edutech_model->get_max_where_col('tb_parcel_control', 'tb_parcel_control_no', 'tb_parcel_control_no like \'' . $product['code_mat'] . '%\'');
        if (isset($chk['col'])) {
            $tmp = explode("-", $chk['col']);
            return $product['code_mat'] . "-" . insert_zero_f_position($tmp[count($tmp) - 1] + 1, 4);
        } else {
            return $product['code_mat'] . "-" . "0001";
        }
    }

    public function parcel_control_insert() {
        $purchase_id = $this->input->post('id');
        $usage = $this->input->post('usage');
        $itemList = $this->My_model->get_where_order('tb_parcel_purchase_itm', array('parcel_purchase_id' => $purchase_id),'id');
        if (count($itemList) > 0) {
            foreach ($itemList as $it) {
                $arr = array(
                    'tb_parcel_purchase_item_id' => $it['id'],
                    'tb_parcel_control_no' => $this->get_parcel_control_no($it['id']),
                    'tb_parcel_control_rc_date' => date('Y-m-d'),
                    'tb_parcel_control_status' => 'ใช้งานได้',
                    'tb_parcel_control_usage' => $usage,
                    'tb_parcel_control_update_date' => date('Y-m-d'),
                    'tb_parcel_control_recorder' => $this->session->userdata('name')
                );
                $this->My_model->insert_data('tb_parcel_control', $arr);
            }
        }
    }

    public function send_approve() {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $arr = array(
            'parcel_status' => $status
        );
        if ($id != '') {

            $this->My_model->update_data("tb_parcel_purchase", array("id" => $id), $arr);
        }
    }

    public function get_report7() {
        $parcel_id = $this->input->post('id');
        $out = "ใบตรวจรับการจัดซื้อ/จัดจ้าง";
//        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $rs = $this->My_model->get_where_row('tb_parcel_rc', array('tb_parcel_purchase_id' => $parcel_id));
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        $sell = $this->My_model->get_where_row('tb_parcel_seller', array('id' => $rsBill['parcel_seller_id']));

        $out = "<div style=\"padding: 10px 40px;width: 90%;\">
                    <div style=\"width:100%;text-align: center;\">
                      <div style=\"font-weight:bold;font-size:18px;\">ใบตรวจรับการจัดซื้อ/จัดจ้าง</div>        
                    </div>
 
    </div>
<div style=\"clear:both;padding: 20px 40px;width: 90%;\">
    <div style=\"float:right;width:50%;line-height: 35px;marging-left:50%\">
    " . thaidigit(datethaifull(date('Y-m-d'))) . "
    </div>
    <div style=\"clear:both;\"></div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามใบสั่งซื้อสั่งจ้าง  เลขที่ " . thaidigit($rsBill['order_num'] . "/" . $rsBill['year_parcel']) . " ลงวันที่   
        " . thaidigit(datethaifull($rsBill['parcel_order_date'])) . " " . $this->session->userdata('department') . " 
        ได้ตกลงซื้อกับ " . $sell['name_seller'] . " สำหรับ " . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจง เป็นจำนวนเงินทั้งสิ้น " . thaidigit(number_format($sum['parcel_price'])) . " บาท (" . convert($sum['parcel_price']) . ")";

        $out .= "<div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        คณะกรรมการตรวจรับพัสดุ ได้ตรวจรับงาน แล้ว ผลปรากฎ ดังนี้ 	
        </div>";

        $out .= "<ul style='list-style-type: none'> 
                <li>๑. ผลการตรวจรับ</li>";
        if ($rs['tb_parcel_rc_status'] == "ครบถ้วนตามสัญญา") {
            $out .= "<li style=\"padding-left:10px;\">  
                    <input type=\"checkbox\" value=\"ถูกต้อง\" checked> ถูกต้อง <br>
                    <input type=\"checkbox\" value=\"ครบถ้วนตามสัญญา\" checked> ครบถ้วนตามสัญญา <br>
                    <input type=\"checkbox\" value=\"ไม่ครบถ้วนตามสัญญา\" > ไม่ครบถ้วนตามสัญญา
                </li>";
        } else {
            $out .= "<li style=\"padding-left:10px;\"> 
                    <input type=\"checkbox\" value=\"ถูกต้อง\" > ถูกต้อง <br>
                    <input type=\"checkbox\" value=\"ครบถ้วนตามสัญญา\" > ครบถ้วนตามสัญญา <br>
                    <input type=\"checkbox\" value=\"ไม่ครบถ้วนตามสัญญา\" checked> ไม่ครบถ้วนตามสัญญา
                </li>";
        }


        $out .= "<li>๒. ค่าปรับ</li>";

        if ($rs['tb_parcel_rc_fine'] == "0") {
            $out .= "<li style=\"padding-left:10px;\">  
                    <input type=\"checkbox\" value=\"มีค่าปรับ\" > มีค่าปรับ <br>
                    <input type=\"checkbox\" value=\"ไม่มีค่าปรับ\" checked> ไม่มีค่าปรับ
                </li>";
        } else {
            $out .= "<li style=\"padding-left:10px;\">  
                    <input type=\"checkbox\" value=\"มีค่าปรับ\" checked> มีค่าปรับ เป็นเงินทั้งสิ้น " . thaidigit(number_format($rs['tb_parcel_rc_fine'])) . " บาท (" . convert($rs['tb_parcel_rc_fine']) . ")<br>
                    <input type=\"checkbox\" value=\"ไม่มีค่าปรับ\" > ไม่มีค่าปรับ
                </li>";
        }

        $out .= "<li>๓. การเบิกจ่ายเงิน</li>
                </ul>";

        $out .= "

    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เบิกจ่ายเงิน เป็นจำนวนเงินทั้งสิ้น " . thaidigit(number_format($sum['parcel_price'] - $rs['tb_parcel_rc_fine'])) . " บาท (" . convert(($sum['parcel_price'] - $rs['tb_parcel_rc_fine'])) . ")	
    </div>
     <div style=\"width:40%;float:right;line-height: 35px;margin-top:40px;text-align:center\">";
        $rcApp = explode(",", $rsBill['parcel_approve_rc']);
        foreach ($rcApp as $it) {
            $rr = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $it));
            if (isset($rr['hr_thai_name'])) {
                $out .= "<p style=\"margin-top:40px;\">(ลงชื่อ)...........................กรรมการ</p>
        <p>(" . $rr['hr_thai_symbol'] . $rr['hr_thai_name'] . " " . $rr['hr_thai_lastname'] . ")</p>";
            }
        }
        $out .= "</div>";
        if ($rs['tb_parcel_rc_note'] != null && $rs['tb_parcel_rc_note'] != "") {
            $out .= "<div style=\"width:40%;float:left;line-height: 35px;margin-top:80px;text-align:left\">";
            $out .= "หมายเหตุ : " . $rs['tb_parcel_rc_note'] . "<br>";
            $out .= "<div style=\"margin-top:50px;\">ลงชื่อ.......................</div>";
            $out .= "(" . $this->session->userdata('name') . ")";
            $out .= "</div>";
        }
        $out .= "</div>";


        echo $out;
    }

    public function get_report8() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        $sell = $this->My_model->get_where_row('tb_parcel_seller', array('id' => $rsBill['parcel_seller_id']));

        $out = "<div style=\"padding: 10px 40px;width: 90%;\">
                    <div style=\"float: left;width:10%;text-align: center;\">
                        <img src='" . base_url('images/krut.jpg') . "' width=\"58\" />
                    </div>
    <div style=\"float: right;text-align: center;width: 90%\">
        
        <h2>บันทึกข้อความ</h2>
                    </div>
    </div>
<div style=\"clear:both;padding: 20px 40px;width: 90%;\">
    <div style=\"width:100%;padding-left: 20px;\">
        <b>ส่วนราชการ</b>" . $this->session->userdata('department') . "
    </div>

    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">";

        if (isset($rsBill['order_num'])) {
            $out .= "<b>ที่</b>" . nbs(5) . thaidigit($rsBill['order_num'] . "/" . $rsBill['year_parcel']) . nbs(10) . "";
        } else {
            $out .= "<b>ที่</b>" . nbs(5) . " " . nbs(10) . "";
        }

        $out .= " <b>วันที่ " . thaidigit(datethai(date('Y-m-d'))) . "</b>
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรื่อง</b>" . nbs(5) . "ขออนุมัติเบิกจ่ายเงิน ค่าจัดซื้อ
    </div>
    <hr>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรียน</b>" . nbs(5) . "ผู้อำนวยการ" . $this->session->userdata('department') . "
    </div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ " . $rsBill['parcel_department'] . $this->session->userdata('department') . " ได้ขอดำเนินการซื้อวัสดุสำนักงาน กับ  " . $sell['name_seller'] . " 
        ตามใบสั่งซื้อ เลขที่  " . thaidigit($rsBill['order_num'] . "/" . $rsBill['year_parcel']) . " ลงวันที่ " . thaidigit(datethaifull($rsBill['parcel_order_date']));

        $rr = 1;
        $total = 0;
        $stotal = 0;
        foreach ($rs as $r) {
            $rr++;
            $total = $total + $r['parcel_price'];
            $stotal = $stotal + $r['parcel_std_price'];
        }

        $out .= "
             <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ " . $rsBill['parcel_order_rc'] . " ได้ส่งมอบพัสดุดังกล่าว  ด้วยความเรียบร้อยและตามที่คณะกรรมการได้ตรวจรับพัสดุเรียบร้อยแล้ว เห็นควรอนุมัติจ่ายเงินเป็นค่าพัสดุ ให้กับ " . $sell['name_seller'] . " เป็นเงินทั้งสิ้น " . thaidigit(number_format($total)) . " บาท (" . convert($total) . ") 
    </div>
    <div style=\"width:100%;padding-left: 50px;line-height: 35px;\">
    จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรด อนุมัติให้ดำเนินการ ตามรายละเอียดในรายงานขอซื้อดังกล่าวข้างต้น
    </div>
     <div style=\"width:30%;float:right;line-height: 35px;margin-top:40px;text-align:center\">
       <p>(" . $this->session->userdata('name') . ")
<BR>เจ้าหน้าที่           
</p>
           
    </div>
    <div style=\"width:50%;line-height: 35px;margin-top:40px;\">
       <ul style='list-style-type: none'> 
       <li><input type=\"checkbox\"> เห็นชอบ</li>
       <li><input type=\"checkbox\"> อนุมัติ</li>
       <li><input type=\"checkbox\"> ไม่อนุมัติ เพราะ........................</li>
</ul>
           
    </div>
    <div style=\"width:50%;line-height: 35px;margin-top:40px;text-align:center\">
       <p>(.............................................)
<BR>ผู้อำนวยการ" . $this->session->userdata('department') . "           
</p>
           
    </div>
</div>";

        echo $out;
    }

}

/* End of file Approve_purchase.php */
/* Location: .//C/Users/supun/Desktop/controller/Approve_purchase.php */