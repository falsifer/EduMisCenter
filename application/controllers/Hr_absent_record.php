<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 6/3/2562
  | Last edit	6/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Hr_absent_record extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    public function hr_absent_record_base() {

        $data['rs'] = $this->My_model->join2table_where_result('tb_human_resources_01 a','tb_hr_absent_record b','a.id=b.tb_hr_id','tb_hr_absent_record_date=DATE_FORMAT(NOW(),\'%Y-%m-%d\')','a.hr_thai_name,a.hr_thai_lastname');
        
        
        $this->load->view("layout/header");
        $this->load->view("hr_absent_record/hr_absent_record",$data);
        $this->load->view("layout/footer");
    }

    //---- Insert(1)
    public function hr_absent_record_insert() {
        $daynow = $_POST['daynow'];
        $checknumrow = $this->My_model->count_record_where('tb_hr_absent_record', array('tb_hr_absent_record_date' => $daynow));
        $hrlist = $this->Chairatto_model->get_where_table('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')));
//        print_r($checknumrow);
        if ($checknumrow == 0) {
            foreach ($hrlist as $r) {
                $arr = array(
                    'tb_hr_absent_record_status' => "C",
                    'tb_hr_id' => $r["id"],
                    'tb_hr_absent_record_date' => $daynow,
                    "tb_hr_absent_record_recorder" => $this->session->userdata('name'),
                    "tb_hr_absent_record_department" => $this->session->userdata('department'),
                    'tb_hr_absent_record_createdate' => date('Y-m-d')
                );
                $this->My_model->insert_data("tb_hr_absent_record", $arr);
            }
        }
    }

    //---- end(1)
    //
    //---- start(2)
    function hr_absent_record_edit() {
        $daynow = $_POST['daynow'];
        $this->db->select("a.*,b.*, b.id as id, a.id as bid");
        $this->db->from("tb_hr_absent_record a");
        $this->db->join("tb_human_resources_01 b", "b.id = a.tb_hr_id");
        $this->db->where("a.tb_hr_absent_record_date", $daynow);
        $this->db->where("b.hr_department", $this->session->userdata('department'));
        $query = $this->db->get();

        $output = "";
        foreach ($query->result() as $row) {
            $output .= "<div class = \"col-md-4\" >";
            //-----A
//            $output .= "<div class = \"panel col-md-3\" >";
            $output .= "<div class = \"panel panel-default\" >";
            $output .= "<div class=\"panel-footer\">";

            //-----D
            $output .= "<center>";
            $output .= "<h4 id=\"inHrName\">" . $row->hr_thai_symbol . $row->hr_thai_name . " " . $row->hr_thai_lastname . "</h4>";

            //-----D
            //-----J
//            $output .= "<div class=\"col-md-12\">";
             $output .= img(array('src' => hr_path($row->id, $this->session->userdata('sch_id')) . $row->hr_image, "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
//            $output .= "</div>";
            $output .= "</center>";
            //-----J
            $output .= "</div>";


            //                            <div class="panel " style="height: 100%"> 
//                    <center><h3>Tool</h3></center></div>
//                    
            //-----B
            $output .= "<center>";
            //-----C
            $output .= "<div class=\"row\">";



            //-----E
            if ($row->tb_hr_absent_record_status == "C") {
                $output .= "<div class=\"col-md-12\" style=\"margin: 5px 0px;\">";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"c" . $row->id . "\" value=\"C\" id=\"c" . $row->id . "\" onchange=\"clearcheck(this)\" checked/>" . "มา";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"a" . $row->id . "\" value=\"A\" id=\"a" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ขาด";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"s" . $row->id . "\" value=\"S\" id=\"s" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลาป่วย";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"e" . $row->id . "\" value=\"E\" id=\"e" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลากิจ";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "</div>";
            }
            //-----E
            //-----F
            if ($row->tb_hr_absent_record_status == "A") {
                $output .= "<div class=\"col-md-12\" style=\"margin: 5px 0px;\">";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"c" . $row->id . "\" value=\"C\" id=\"c" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "มา";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"a" . $row->id . "\" value=\"A\" id=\"a" . $row->id . "\" onchange=\"clearcheck(this)\" checked/>" . "ขาด";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"s" . $row->id . "\" value=\"S\" id=\"s" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลาป่วย";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"e" . $row->id . "\" value=\"E\" id=\"e" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลากิจ";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "</div>";
            }
            //-----F
            //-----G
            if ($row->tb_hr_absent_record_status == "S") {
                $output .= "<div class=\"col-md-12\" style=\"margin: 5px 0px;\">";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"c" . $row->id . "\" value=\"C\" id=\"c" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "มา";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"a" . $row->id . "\" value=\"A\" id=\"a" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ขาด";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"s" . $row->id . "\" value=\"S\" id=\"s" . $row->id . "\" onchange=\"clearcheck(this)\" checked/>" . "ลาป่วย";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"e" . $row->id . "\" value=\"E\" id=\"e" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลากิจ";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "</div>";
            }
            //-----G
            //-----H
            if ($row->tb_hr_absent_record_status == "E") {
                $output .= "<div class=\"col-md-12\" style=\"margin: 5px 0px;\">";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"c" . $row->id . "\" value=\"C\" id=\"c" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "มา";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"a" . $row->id . "\" value=\"A\" id=\"a" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ขาด";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"s" . $row->id . "\" value=\"S\" id=\"s" . $row->id . "\" onchange=\"clearcheck(this)\"/>" . "ลาป่วย";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" name=\"e" . $row->id . "\" value=\"E\" id=\"e" . $row->id . "\" onchange=\"clearcheck(this)\" checked/>" . "ลากิจ";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "</div>";
            }
            //-----H
            //-----I
            $output .= "<div class=\"col-md-12\" style=\"margin: 5px 0px;\">";
            $output .= "หมายเหตุ&nbsp;<textarea class=\"form-control\" name=\"note" . $row->id . "\" id=\"note" . $row->id . "\" >" . $row->tb_hr_absent_record_note . "</textarea>";
            $output .= "</div>";
            //-----I
            //-----C
            //-----B
            $output .= "</center>";

            //-----A

            $output .= "</div>";
            $output .= "</div>";

            $output .= "<input type=\"hidden\" name=\"inBid" . $row->id . "\" id=\"inBid" . $row->id . "\" value=\"" . $row->bid . "\">";
            $output .= "<input type=\"hidden\" name=\"inId[]\" id=\"inId[]\" value=\"" . $row->id . "\">";
            $output .= "</div>";
        }

        echo $output;
    }

    //---- end(2)
    //---- update(4)
    public function hr_absent_record_update() {
        $status = $this->input->post('status');
        $note = $this->input->post('note');
        $bid = $this->input->post('bid');

        $arr = array(
            'tb_hr_absent_record_status' => $status,
            'tb_hr_absent_record_note' => $note
        );
        $this->My_model->update_data("tb_hr_absent_record", array('id' => $bid), $arr);
    }

    //---- end(4)
}
