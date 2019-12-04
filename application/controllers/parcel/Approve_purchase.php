<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve_purchase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Approve_purchase_model");
    }

    public function listdata() {
//        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
//        $this->load->view('parcel/inc/header',$data);

        $data['yearly'] = $this->My_model->get_row('tb_parcel');
        $data['plan'] = $this->Approve_purchase_model->get_all_plan($data['yearly']['year_parcel']);
        $data['parcel_plan'] = $this->My_model->get_where_order('tb_parcel_plan', array('year_parcel' => $data['yearly']['year_parcel']), 'month_plan,week_plan');


        $this->load->view('layout/header');
        $this->load->view('parcel/parcel', $data);
        $this->load->view("layout/footer");
//        $this->load->view('parcel/inc/footer');
    }
    
    public function get_list_data(){
        
        $row = 1;

                                    foreach ($plan as $r) {
                                        ?>
                                        <tr>
                                            <?php
                                            $rsBG = $this->My_model->sum_where('tb_project_plan_budget', 'project_plan_budget', array('project_id' => $r['id']));
                                            $budget = $rsBG['project_plan_budget'];
                                            $rsBG2 = $this->My_model->get_where_row('tb_project_plan_budget', array('project_id' => $r['id']));
                             
                                            ?>
                                            <td style="text-align: center"><?php echo $row; ?></td>
                                            <td style="width:100px;"><?php echo $r['project_name']; ?></td>
                                            <?php
                                            if(isset($rsBG2['id'])){
                                            $rsBGD = $this->My_model->sum_where('tb_project_plan_budget_detail', 'tb_project_plan_budget_amt', array('tb_project_plan_budget_id' => $rsBG2['id']));
                                            $budgetD = $rsBGD['tb_project_plan_budget_amt'];
                                            
                                            ?>
                                            <td style="width:100px;"><?php echo ($budgetD==0)?"ยังไม่ได้โอน":"โอนแล้ว(". number_format($budgetD).")"; ?></td>
                                            <?php
                                            }else{
                                             ?>
                                            <td style="width:100px;"><?php echo ($budgetD==0)?"ยังไม่ได้โอน":"โอนแล้ว(". number_format($budgetD).")"; ?></td>
                                            <?php   
                                            }
                                            ?>
                                            <td style="text-align: right"><?php echo number_format($rsBG['project_plan_budget']); ?></td>
                                            <?php
                                            $purchase = 0;
                                            $this->load->model('Approve_purchase_model');
                                            $rsP = $this->Approve_purchase_model->get_purchase_by_project($r['project_name']);
                                            if (isset($rsP['purchase'])) {
                                                $purchase = $rsP['purchase'];
                                            }
                                            ?>
                                            <td style="text-align: right"><?php echo number_format($purchase); ?></td>
                                            <td style="text-align: right"><?php echo number_format($budget - $purchase); ?></td>
                                            <td><?php echo $r['responsible']; ?></td>
                                            <td style="text-align: center">
                                                <button class="btn btn-primary btn-purchase" project='<?php echo $r['project_name']; ?>' id='<?php echo $r['id']; ?>' >
                                                    <i class="icon-edit" title="แก้ไข"  ></i> ระบบจัดซื้อจัดจ้าง
                                                </button>
                                          
                                            </td>
                                        </tr>
                                        <?php
                                        $row++;
                                    }
    }

    public function index() {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
//        $this->load->view('parcel/inc/header',$data);

        $data['yearly'] = $this->My_model->get_row('tb_parcel');

        $this->load->view('layout/header');
        $this->load->view('parcel/approve_purchase', $data);
        $this->load->view("layout/footer");
//        $this->load->view('parcel/inc/footer');
    }

    public function get_plan() {
        $txt = $_POST['txt'];
        //tb_localgov_plan_type plan_type ในฐานข้อมูลเป็น แผนงานการศึกษา แผนงานบริหารงานทั่วไป ?????
//        $value = $this->My_model->get_where_order('tb_project_school', array('project_department' => $this->session->userdata('department')), 'main_plan_name');

        $this->db->distinct();

        $this->db->select('main_plan_name');

        $this->db->where(array('project_department' => $this->session->userdata('department'), 'responsible' => $txt));

        $this->db->order_by('main_plan_name');

        $value = $this->db->get('tb_project_school')->result_array();

        echo json_encode($value);
    }

    public function get_project_plan() {
//        $txt = $_POST['txt'];
        $txtP = $_POST['txtP'];

        $this->db->distinct();

        $this->db->select('project_name');

        $this->db->where(array('project_department' => $this->session->userdata('department'), 'main_plan_name' => $txtP));

        $this->db->order_by('project_name');

        $value = $this->db->get('tb_project_school')->result_array();
        $out = "";
        foreach ($value as $r) {
            $out .= "<option value='" . $r['project_name'] . "'>" . $r['project_name'] . "</option>";
        }
        echo $out;
        //echo json_encode($value);
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

    public function insert_project_plan() {
        $id = $_POST['id'];
        $prc = "";

        foreach ($this->input->post('inPurchaseRC') as $ar) {
            $prc .= $ar . ",";
        }

        $arr = array(
            'parcel_seller_id' => $this->input->post('inSeller'),
            'parcel_department' => $this->input->post('inDeparPlan'),
            'parcel_plan' => $this->input->post('inSchPlan'),
            'parcel_project_plan' => $this->input->post('inSchProjectPlan'),
            'parcel_purpose' => $this->input->post('inParcelPurpose'),
            'parcel_use_date' => $this->input->post('inUseDay'),
            'parcel_order_rc' => $this->input->post('inSeller'),
            'parcel_approve_rc' => $prc,
            'parcel_resposible' => $this->input->post('inSeller'),
            'parcel_resposible_leader' => $this->input->post('inSeller'),
            'order_num' => $this->input->post('inOrderNum'),
            'parcel_order_date' => $this->input->post('inOrderNumDate'),
            'receipt_order' => $this->input->post('inReceiptOrder'),
            'parcel_receipt_date' => $this->input->post('inReceiptOrdeDate'),
            'bill_num' => $this->input->post('inBillNum'),
            'parcel_bill_date' => $this->input->post('inBillNumDate'),
            'year_parcel' => $this->input->post('year_parcel'),
            'department' => $this->session->userdata('department'),
            'parcel_status' => 'ฉบับร่าง'
        );
        if ($id != '') {

            $this->My_model->update_data("tb_parcel_purchase", array("id" => $id), $arr);
            echo json_encode(array('id' => $id));
        } else {
            $this->My_model->insert_data('tb_parcel_purchase', $arr);
            echo json_encode(array('id' => $this->db->insert_id()));
        }
    }

    public function insert_project_plan_itm() {
        $id = $_POST['parcel_id'];
        $arr = array(
            'parcel_purchase_id' => $id,
            'parcel_seq' => $this->input->post('inParcelSeq'),
            'parcel_product_id' => $this->input->post('inParcelProductId'),
            'parcel_product_amt' => $this->input->post('inParcelProductAmt'),
            'parcel_std_price' => $this->input->post('inParcelStdPrice'),
            'parcel_std_type' => $this->input->post('inParcelStdType'),
            'parcel_price' => $this->input->post('inParcelPrice'),
        );

        $rs = $this->My_model->insert_data('tb_parcel_purchase_itm', $arr);

        if ($rs) {
            $tmp = "<tr>";
            $tmp .= '<td style="text-align: center;">';
            $tmp .= $this->input->post('inParcelSeq');
            $tmp .= '</td>';
            $tmp .= '<td>';
            $tmp .= $this->input->post('inParcelProductName');
            $tmp .= "<p style='font-size:0.8em;font-style: italic;color:#AFAFAE'>" . $this->input->post('inParcelProduct') . "</p>";
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($this->input->post('inParcelProductAmt')) . ' ' . $this->input->post('inParcelUnitMat');
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: center;">';
            $tmp .= $this->input->post('inParcelStdType');
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($this->input->post('inParcelStdPrice'));
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($this->input->post('inParcelPrice'));
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($this->input->post('inParcelProductAmt') * $this->input->post('inParcelPrice'));
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: center;">';
            $tmp .= '<button class="btn btn-danger"><i class="icon-trash"></i> ลบ</button>';
            $tmp .= '</td>';
            $tmp .= ' </tr>';

            echo $tmp;
        }
    }

    public function get_project_plan_itm() {
        $id = $_POST['parcel_id'];

        $rs = $this->My_model->get_where_order('tb_parcel_purchase_itm', array('parcel_purchase_id' => $id), 'parcel_seq');

        foreach ($rs as $r) {
            $tmp = "<tr>";
            $tmp .= '<td style="text-align: center;">';
            $tmp .= $r['parcel_seq'];
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $prs = $this->My_model->get_where_row('tb_parcel_product', array('id' => $r['id']));
            $tmp .= $prs['name_mat'];
            $tmp .= "<p style='font-size:0.8em;font-style: italic;color:#AFAFAE'>" . isset($r['tb_parcel_purchase_itm_detail']) ? $r['tb_parcel_purchase_itm_detail'] : "&bnsp;" . "</p>";
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($r['parcel_product_amt']) . ' ' . $prs['unit_mat'];
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: center;">';
            $tmp .= $r['parcel_std_type'];
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($r['parcel_std_price']);
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($r['parcel_price']);
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: right;">';
            $tmp .= number_format($r['parcel_product_amt'] * $r['parcel_price']);
            $tmp .= '</td>';
            $tmp .= '<td style="text-align: center;">';
            $tmp .= '<button class="btn btn-danger"><i class="icon-trash"></i> ลบ</button>';
            $tmp .= '</td>';

            $tmp .= ' </tr>';

            echo $tmp;
        }
    }

    public function get_product() {
        $this->db->select("*")->from('tb_parcel_product')->where(array('tb_school_id' => $this->session->userdata('sch_id')));
        $prod = $this->db->get()->result_array();
        $rest = "";
        foreach ($prod as $r) {
            $rs = $this->My_model->get_where_row('tb_parcel_category', array('id' => $r['category_id']));
            $rest .= "<option data-subtext=\"" . $rs['name_cat'] . "\">" . $r['name_mat'] . "</option>";
        }
        echo $rest;
//        echo json_encode($prod);
    }

    public function get_purchase_list() {
        $project_id = $this->input->post('id');

        redirect('purchase-project-list/' . $project_id);
    }

    public function get_purchase_list_by_project($project_id) {

        $data['yearly'] = $this->My_model->get_row('tb_parcel');
        $data['list'] = $this->Approve_purchase_model->get_purchase_list_by_project($project_id);
        $data['project_id'] = $project_id;
        $this->db->select("*")->from('tb_parcel_product')->where(array('tb_school_id' => $this->session->userdata('sch_id')));
        $data['prod'] = $this->db->get()->result_array();
        $this->load->view('layout/header');
        $this->load->view('parcel/project_purchase', $data);
        $this->load->view("layout/footer");
    }

    public function get_purchase_list_for_approve() {

        $data['yearly'] = $this->My_model->get_row('tb_parcel');
        $data['list'] = $this->Approve_purchase_model->get_purchase_list_for_approve();
        $data['listApp'] = $this->Approve_purchase_model->get_purchase_list_was_approved();

//        $data['project_id'] = $project_id;
        $this->db->select("*")->from('tb_parcel_product')->where(array('tb_school_id' => $this->session->userdata('sch_id')));
        $data['prod'] = $this->db->get()->result_array();
        $this->load->view('layout/header');
        $this->load->view('parcel/project_purchase_md', $data);
        $this->load->view("layout/footer");
    }

    public function get_purchase_edit() {
        $parcel_id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        echo json_encode($rs);
    }

    public function purchase_delete() {
        $parcel_id = $this->input->post('id');
        $this->My_model->delete_data('tb_parcel_purchase_itm', array('parcel_purchase_id' => $parcel_id));
        $this->My_model->delete_data('tb_parcel_purchase', array('id' => $parcel_id));
    }

    public function get_report1() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
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
            $out .= "<b>ที่</b>" . nbs(5) . $rsBill['order_num'] . "/" . $rsBill['year_parcel'] . nbs(10) . "";
        } else {
            $out .= "<b>ที่</b>" . nbs(5) . " " . nbs(10) . "";
        }

        $out .= " <b>วันที่ " . datethai(date('Y-m-d')) . "</b>
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรื่อง</b>" . nbs(5) . "รายงานขอซื้อขอจ้าง
    </div>
    <hr>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรียน</b>" . nbs(5) . "ผู้อำนวยการ" . $this->session->userdata('department') . "
    </div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย " . $rsBill['parcel_department'] . $this->session->userdata('department') . " มีความประสงค์จะขอซื้อวัสดุสำนักงาน ของโครงการ " . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจง  งานพัสดุได้ตรวจสอบแล้วเห็นควรจัดซื้อตามเสนอ และเพื่อให้เป็นไปตามพระราชบัญญัติการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ. 2560 ข้อ 56 วรรคหนึ่ง (2) (ข) และระเบียบกระทรวง การคลังว่าด้วยการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ. 2560 ข้อ 22 ข้อ 79 ข้อ 25 (5) และกฎกระทรวงกำหนดวงเงินการจัดซื้อจัดจ้างพัสดุโดยวิธีเฉพาะเจาะจง วงเงินการจัดซื้อจัดจ้างที่ไม่ทำข้อตกลงเป็นหนังสือ และวงเงินการจัดซื้อจัดจ้างในการแต่งตั้งผู้ตรวจรับพัสดุ พ.ศ. 2560 ข้อ 1 และข้อ 5 จึงขอรายงานขอซื้อ ซึ่งมีรายละเอียด ดังต่อไปนี้ ";

//        $out .= "จำนวน " . sizeof($rs) . " รายการ เพื่อใช้" . $rsBill['parcel_purpose'] . "
//         ซึ่งได้รับอนุมัติเงินจาก 
//        จำนวน " . number_format($sum['parcel_price']) . " บาท   ซึ่งมีรายละเอียด ดังต่อไปนี้ ";

        $out .= "<ul style='list-style-type: none;'>
                <li>1.เหตุผลความจำเป็นที่ต้องซื้อ  " . $rsBill['parcel_purpose'] . "</li>
                    <li>2.รายละเอียดของพัสดุจัดซื้อ </li>
";
        $rr = 1;
        $total = 0;
        $stotal = 0;
        foreach ($rs as $r) {
            $product = $this->My_model->get_where_row('tb_parcel_product', array('id' => $r['parcel_product_id']));
            $out .= "<li style='padding-left:10px;'>2." . $rr . "." . $product['name_mat'] . " จำนวน " . $r['parcel_product_amt'] . " รายการ  เป็นเงิน " . number_format($r['parcel_price'] * $r['parcel_product_amt']) . " บาท</li>";
            $rr++;
            $total = $total + ($r['parcel_price'] * $r['parcel_product_amt']);
            $stotal = $stotal + ($r['parcel_std_price'] * $r['parcel_product_amt']);
        }
        $out .= "<li>3.ราคากลางและรายละเอียดของราคากลางจำนวน " . number_format($stotal) . " บาท (" . convert($stotal) . ") โดยสืบราคาจากท้องตลาด</li>";

        $prs = $this->My_model->get_where_row('tb_project_school', array('project_name' => trim($rsBill['parcel_project_plan'])));
        $out .= "<li>4.วงเงินที่จะซื้อ เงิน" . isset($prs['project_budget']) ? $prs['project_budget'] : ".................." . " จำนวน " . number_format($total) . " บาท (" . convert($total) . ")</li>";
        $out .= "<li>5.กำหนดเวลาที่ต้องการใช้พัสดุนั้น หรือให้งานนั้นแล้วเสร็จ  กำหนดเวลาการส่งมอบพัสดุ หรือให้งานแล้วเสร็จภายใน " . $r['parcel_use_date'] . " วัน นับถัดจากวันลงนามในสัญญา</li>";
        $out .= "<li>6.วิธีที่จะซื้อ และเหตุผลที่ต้องซื้อ  ดำเนินการด้วยวิธีเฉพาะเจาะจงเนื่องจากการจัดซื้อจัดจ้างพัสดุที่มีการผลิต จำหน่าย ก่อสร้าง หรือให้บริการทั่วไป และมีวงเงินในการจัดซื้อจัดจ้างครั้งหนึ่งไม่เกินวงเงินตามที่กำหนดในกฎกระทรวง</li>";
        $out .= "<li>7.หลักเกณฑ์การพิจารณาคัดเลือกข้อเสนอ  การพิจารณาคัดเลือกข้อเสนอโดยใช้เกณฑ์ราคา</li>";
        $out .= "<li>8.การขออนุมัติแต่งตั้งคณะกรรมการต่าง ๆ</li>";
        $out .= "<li>การแต่งตั้งผู้ตรวจรับพัสดุ</li>";
        $out .= "</ul>
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

    public function get_report2() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        $out = "<div style=\"padding: 10px 40px;width: 90%;\">
                    <div style=\"width:100%;text-align: center;\">
                        <img src='" . base_url('images/krut.jpg') . "' width=\"58\" />
                            <div style=\"font-weight:bold;\">คำสั่ง " . $this->session->userdata('department') . "<br>
                                ที่        <br>
                                เรื่อง แต่งตั้งผู้ตรวจรับพัสดุสำหรับ " . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " โดยวิธีเฉพาะเจาะจง

                            </div>
                            <div>...............................................</div>
                    </div>
 
    </div>
<div style=\"clear:both;padding: 20px 40px;width: 90%;\">

    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย " . $this->session->userdata('department') . " มีความประสงค์จะ  
        " . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจง  และเพื่อให้เป็นไปตามระเบียบกระทรวงการคลังว่าด้วยการจัดซื้อจัดจ้างและ
        การบริหารพัสดุภาครัฐ พ.ศ. ๒๕๖๐ จึงขอแต่งตั้งรายชื่อต่อไปนี้เป็น  ผู้ตรวจรับพัสดุ 
        สำหรับการ" . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจง ";


        $out .= "
             <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ตรวจรับพัสดุ
        <ul style=\"list-style: none;\">";
        $rcAppArr = explode(",", $rsBill['parcel_approve_rc']);
        $i = 1;
        foreach ($rcAppArr as $it) {
            $rc = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $it));
            if (isset($rc['hr_thai_name'])) {
                $out .= "<li>" . thaidigit($i) . ". " . $rc['hr_thai_symbol'] . $rc['hr_thai_name'] . " " . $rc['hr_thai_lastname'] . "</li>";
                $i++;
            }
        }
        $out .= "</ul>
    </div>
    <div style=\"width:100%;padding-left: 50px;line-height: 35px;\">
        อำนาจและหน้าที่ทำการตรวจรับพัสดุให้เป็นไปตามเงื่อนไขของสัญญาหรือข้อตกลงนั้น
    </div>
     <div style=\"width:40%;float:right;line-height: 35px;margin-top:40px;text-align:center\">
     <p style=\"margin-bottom:45px;\">สั่ง ณ วันที่ " . thaidigit(datethaifull(date('Y-m-d'))) . "</p>
       <p>(.............................................)
<BR>ผู้อำนวยการ" . $this->session->userdata('department') . "           
</p>
           
    </div>
</div>";

        echo $out;
    }

    public function get_report3() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
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
            $out .= "<b>ที่</b>" . nbs(5) . $rsBill['order_num'] . "/" . $rsBill['year_parcel'] . nbs(10) . "";
        } else {
            $out .= "<b>ที่</b>" . nbs(5) . " " . nbs(10) . "";
        }

        $out .= " <b>วันที่ " . datethai(date('Y-m-d')) . "</b>
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรื่อง</b>" . nbs(5) . "รายงานผลการพิจารณาและขออนุมัติสั่งซื้อสั่งจ้าง
    </div>
    <hr>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรียน</b>" . nbs(5) . "ผู้อำนวยการ" . $this->session->userdata('department') . "
    </div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอรายงานผลการพิจารณา" . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " โดยวิธีเฉพาะเจาะจง ดังนี้ ";

        $out .= "<center>
            <table style=\"width:95%;margin-top:20px;\" border=\"1\" bordercolor=\"black\" cellspacing=\"0\" cellpadding=\"4\">
            <tr>
                <td style=\"text-align:center;fobt-weight:bold\">รายการพิจารณา</td>
                <td style=\"text-align:center;fobt-weight:bold\">รายชื่อผู้ยื่นข้อเสนอ</td>
                <td style=\"text-align:center;fobt-weight:bold\">ราคาที่เสนอ*</td>
                <td style=\"text-align:center;fobt-weight:bold\">ราคาที่ตกลงซื้อหรือจ้าง*</td>
            </tr>
            <tr>
            <td>
            ";

        $total = 0;
        $stotal = 0;
        foreach ($rs as $r) {
            $product = $this->My_model->get_where_row('tb_parcel_product', array('id' => $r['parcel_product_id']));
            $out .= $product['name_mat'] . ",";
            $total = $total + ($r['parcel_price'] * $r['parcel_product_amt']);
            $stotal = $stotal + ($r['parcel_std_price'] * $r['parcel_product_amt']);
        }
        $out .= " จำนวน ๑ โครงการ</td>";

        $sell = $this->My_model->get_where_row('tb_parcel_seller', array('id' => $r['parcel_seller_id']));
        $out .= " <td>" . $sell['name_seller'] . "</td>";

        $out .= "<td style=\"text-align:right;\">" . thaidigit(number_format($total)) . "</td>
            <td style=\"text-align:right;\">" . thaidigit(number_format($total)) . "</td>
            </tr></table></center>
    </div>
    <div style=\"width:100%;padding-left: 50px;line-height: 35px;margin-top:20px;\">
    ราคาที่เสนอ และราคาที่ตกลงซื้อหรือจ้าง เป็นราคารวมภาษีมูลค่าเพิ่มและภาษีอื่น ค่าขนส่ง ค่าจดทะเบียน และค่าใช้จ่ายอื่นๆ ทั้งปวง โดยเกณฑ์การพิจารณาผลการยื่นข้อเสนอครั้งนี้ จะพิจารณาตัดสินโดยใช้หลักเกณฑ์ราคา ";
        $out .= $this->session->userdata('department') . "พิจารณาแล้ว เห็นสมควรจัดซื้อจากผู้เสนอราคาดังกล่าว
    </div>
    <div style=\"width:100%;padding-left: 50px;line-height: 35px;margin-top:20px;\">
    จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรดอนุมัติให้สั่งซื้อสั่งจ้างจากผู้เสนอราคาดังกล่าว
    </div>
     <div style=\"width:30%;float:right;line-height: 35px;margin-top:40px;text-align:center\">
       <p>(" . $this->session->userdata('name') . ")
<BR>เจ้าหน้าที่           
</p>
           
    </div>
    <div style=\"width:50%;line-height: 35px;margin-top:40px;\">
       <ul style='list-style-type: none'> 
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

    public function get_report4() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        $out = "<div style=\"padding: 10px 40px;width: 90%;\">
                    <div style=\"width:100%;text-align: center;\">
                        <img src='" . base_url('images/krut.jpg') . "' width=\"58\" />
                            <div style=\"font-weight:bold;\">ประกาศ" . $this->session->userdata('department') . "<br>
                                เรื่อง ประกาศผู้ชนะการเสนอราคา" . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . "
 <br>
                                โดยวิธีเฉพาะเจาะจง

                            </div>
                            <div>...............................................</div>
                    </div>
 
    </div>
<div style=\"clear:both;padding: 20px 40px;width: 90%;\">

    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ " . $this->session->userdata('department') . " ได้มีโครงการ  
        " . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจงนั้น ";


        $out .= "
             <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $total = 0;
        foreach ($rs as $r) {
            $product = $this->My_model->get_where_row('tb_parcel_product', array('id' => $r['parcel_product_id']));
            $out .= $product['name_mat'] . ",";
            $total = $total + ($r['parcel_price'] * $r['parcel_product_amt']);
        }
        $out .= " จำนวน ๑ โครงการ ผู้ได้รับการคัดเลือก ได้แก่ ";
        $sell = $this->My_model->get_where_row('tb_parcel_seller', array('id' => $r['parcel_seller_id']));
        $out .= $sell['name_seller'];
        $out .= " โดยเสนอราคา เป็นเงินทั้งสิ้น " . thaidigit(number_format($total)) . " บาท (" . convert($total) . ") รวมภาษีมูลค่าเพิ่มและภาษีอื่น ค่าขนส่ง ค่าจดทะเบียน และค่าใช้จ่ายอื่นๆ ทั้งปวง
    </div>

     <div style=\"width:40%;float:right;line-height: 35px;margin-top:40px;text-align:center\">
     <p style=\"margin-bottom:45px;\">ประกาศ ณ วันที่ " . thaidigit(datethaifull(date('Y-m-d'))) . "</p>
       <p>(.............................................)
<BR>ผู้อำนวยการ" . $this->session->userdata('department') . "           
</p>
           
    </div>
</div>";

        echo $out;
    }

    public function get_report5() {
        $parcel_id = $this->input->post('id');
        $out = "ใบสั่งซื้อ";
        echo $out;
    }

    public function get_report6() {
        $parcel_id = $this->input->post('id');
        $period = $this->input->post('period');
        //$out = "แจ้งลงนามในสัญญา ภายใน ".$period;
        $out = "";
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
        $school = $this->My_model->get_where_row('tb_school', array('id' => $this->session->userdata('sch_id')));
        $out = "<div style=\"padding: 10px 40px;width: 90%;\">
                    <div style=\"width:100%;\">
                    <div style=\"float:left;width:20%;margin-top:40px;\">ที่</div>
                    <div style=\"float:left;width:60%\"><center>
                        <img src='" . base_url('images/krut.jpg') . "' width=\"58\" />
                        </center></div> 
                        <div style=\"float:right;width:20%;margin-top:40px;\">" . $this->session->userdata('department') . "
                        <br>อำเภอ" . $school['sc_address_amphur'] . "  
                        <br>จังหวัด" . $school['sc_address_province'] . " " . $school['sc_address_zipcode'] . " 
                        </div>
                        
                    </div>
 
    </div>
<div style=\"clear:both;padding: 20px 40px;width: 90%;\">
    <div style=\"width:50%;line-height: 35px;margin-left:50%\">
    " . thaidigit(datethaifull(date('Y-m-d'))) . "
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรื่อง</b>" . nbs(5) . "แจ้งลงนามในสัญญา
    </div>";
        $sell = $this->My_model->get_where_row('tb_parcel_seller', array('id' => $rsBill['parcel_seller_id']));

        $out .= "<div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรียน</b>" . nbs(5) . "ผู้จัดการ" . $sell['name_seller'] . "
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>อ้างถึง</b>" . nbs(5) . "ประกาศผู้ชนะการเสนอราคา" . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " โดยวิธีเฉพาะเจาะจง
    </div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ " . $this->session->userdata('department') . " ต้องการ   
        " . $rsBill['parcel_purpose'] . " ของ" . $rsBill['parcel_project_plan'] . " 
        โดยวิธีเฉพาะเจาะจงและตามหนังสือที่อ้างถึง " . $sell['name_seller'];
        $total = 0;
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        foreach ($rs as $r) {
            $product = $this->My_model->get_where_row('tb_parcel_product', array('id' => $r['parcel_product_id']));
            $total = $total + ($r['parcel_price'] * $r['parcel_product_amt']);
        }
        $out .= " ได้เสนอราคาเป็นเงินทั้งสิ้น " . thaidigit(number_format($total)) . " บาท (" . convert($total) . ") ซึ่งได้เป็นราคารวมภาษีมูลค่าเพิ่มแล้ว นั้น ";


        $out .= "</div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $this->session->userdata('department') . " พิจารณาแล้ว ตกลงซื้อเป็นเงินทั้งสิ้น " . thaidigit(number_format($total)) . " บาท (" . convert($total) . ")  และขอให้ไปทำสัญญาภายใน ".$period." นับถัดจากวันที่ได้รับหนังสือฉบับนี้

    </div>
    <div style=\"width:100%;padding-left: 50px;line-height: 35px;\">
    จึงเรียนมาเพื่อโปรดพิจารณา 
    </div>

     <div style=\"width:40%;float:right;line-height: 35px;margin-top:40px;text-align:center\">
     <p style=\"margin-bottom:45px;\">ขอแสดงความนับถือ</p>
       <p>(.............................................)
<BR>ผู้อำนวยการ" . $this->session->userdata('department') . "           
</p>
           
    </div>
</div>";

        echo $out;
    }

    public function get_report7() {
        $parcel_id = $this->input->post('id');
        $out = "ใบตรวจรับการจัดซื้อ/จัดจ้าง";
        echo $out;
    }

    public function get_report8() {
        $parcel_id = $this->input->post('id');
        $out = "";
        $rs = $this->Approve_purchase_model->get_purchase_list($parcel_id);
        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $parcel_id));
        $rsBill = $this->My_model->get_where_row('tb_parcel_purchase', array('id' => $parcel_id));
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
            $out .= "<b>ที่</b>" . nbs(5) . $rsBill['order_num'] . "/" . $rsBill['year_parcel'] . nbs(10) . "";
        } else {
            $out .= "<b>ที่</b>" . nbs(5) . " " . nbs(10) . "";
        }

        $out .= " <b>วันที่ " . datethai(date('Y-m-d')) . "</b>
    </div>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรื่อง</b>" . nbs(5) . "ขออนุมัติเบิกจ่ายเงิน ค่าจัดซื้อ
    </div>
    <hr>
    <div style=\"width:100%;padding-left: 20px;line-height: 35px;\">
        <b>เรียน</b>" . nbs(5) . "ผู้อำนวยการ" . $this->session->userdata('department') . "
    </div>
    <div style=\"width:100%;line-height: 35px;\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ " . $rsBill['parcel_department'] . $this->session->userdata('department') . " ได้ขอดำเนินการซื้อวัสดุสำนักงาน กับ  " . $rsBill['parcel_order_rc'] . " 
        ตามใบสั่งซื้อ เลขที่  " . $rsBill['order_num'] . "/" . $rsBill['year_parcel'] . " ลงวันที่ " . datethaifull($rsBill['parcel_order_date']);

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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ " . $rsBill['parcel_order_rc'] . " ได้ส่งมอบพัสดุดังกล่าว  ด้วยความเรียบร้อยและตามที่คณะกรรมการได้ตรวจรับพัสดุเรียบร้อยแล้ว เห็นควรอนุมัติจ่ายเงินเป็นค่าพัสดุ ให้กับ " . $rsBill['parcel_order_rc'] . " เป็นเงินทั้งสิ้น " . number_format($total) . " บาท (" . convert($total) . ") 
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