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
  | Create Date 15/1/2019
  | Last edit	15/4/2019
  | Comment	ปรับโครงสร้างตาม
  | ----------------------------------------------------------------------------
 */

Class Homeroom extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Homeroom_model");
        $this->load->model("Std_model");
    }

//----------------- หน้าครูประจำชั้น -----------------------//

    public function hr_homeroom_base() {
        $data['HomeroomList'] = $this->Homeroom_model->get_ed_homeroom_w_hr_id();
        $room = $this->Homeroom_model->get_ed_homeroom_w_hr_id();
        if (isset($room[0]->ed_roomid)) {
            $data['absentStdStat'] = $this->Homeroom_model->get_all_absent_by_room_id($room[0]->ed_roomid);
        }
        $this->load->view("layout/header");
        $this->load->view("homeroom/hr_homeroom_base", $data);
        $this->load->view("layout/footer");
    }

    public function absent_record_tbody() {
        $RoomId = $_POST['roomid'];
        $DateNow = $_POST['datenow'];
        $StdList = $this->Std_model->get_std_base_w_roomid_return_array($RoomId);
        $output = "";

        foreach ($StdList as $r) {

            $StdStatus = $this->Homeroom_model->get_std_absent_record_w_stdid_n_date($r['StdId'], $DateNow);

            if (!$StdStatus) {
                $arr = array(
                    'tb_student_absent_record_status' => "C",
                    'tb_student_base_id' => $r['StdId'],
                    'tb_std_absent_record_date' => $DateNow,
                    "tb_student_absent_record_recorder" => $this->session->userdata('name'),
                    "tb_student_absent_record_department" => $this->session->userdata('department'),
                    'tb_student_absent_record_createdate' => date('Y-m-d')
                );
                $this->My_model->insert_data("tb_std_absent_record", $arr);
                $StdStatus = $this->Homeroom_model->get_std_absent_record_w_stdid_n_date($r['StdId'], $DateNow);
            }

            $output .= "<tr id='myrow" . $StdStatus['ed_absent_record_id'] . "'>";
            $output .= "<td style='text-align:center; '>" . $r['std_number'] . "</td>";
            $output .= "<td style='text-align:center; '><img   src='" . $r['std_profile_picture'] . "' style='height: 30px;margin-right:5px;'/>" . $r['std_fullname'] . "</td>";

            $AbsentArray = array('C', 'L', 'S', 'E', 'A');
            foreach ($AbsentArray as $r) {
                $output .= "<td class='TdSelect' style='text-align:center; padding: 0px;' ";
                if ($StdStatus['std_record_status'] == $r) {
                    $output .= "><i class='icon-ok' ></i>";
                } else {
                    $output .= "onclick='UpdateStatus(\"" . $r . "," . $StdStatus['ed_absent_record_id'] . "\")' >";
                }
                $output .= "</td>";
            }

            $output .= "<td style='text-align:center; '><input type='text' class='form-control' placeholder='หมายเหตุ....'/></td>";
            $output .= "</tr>";
        }
        echo $output;
    }

    public function std_absent_record_update_status() {
        $MyArray = $_POST['myarray'];
        $DateNow = $_POST['datenow'];

        $DataArray = explode(',', $MyArray);

        $Status = $DataArray[0];
        $RecordId = $DataArray[1];

        $arr = array(
            'tb_student_absent_record_status' => $Status,
            'tb_std_absent_record_date' => $DateNow,
            'tb_student_absent_record_createdate' => date('Y-m-d')
        );
        $this->My_model->update_data("tb_std_absent_record", array('id' => $RecordId), $arr);

        //--------- Reload 
        $StdStatus = $this->Homeroom_model->get_std_absent_record_by_recordid($RecordId);
//        $record = $this->My_model->get_where_row('tb_std_absent_record', array('id' => $RecordId));

        $output = "";
//get_std_base_w_roomid_return_array
        $StdList = $this->Std_model->get_std_base_w_stdid_return_row($StdStatus['StdId']);

        $output .= "<td style='text-align:center; '>" . $StdList[0]['std_number'] . "</td>";
        $output .= "<td style='text-align:center; '><img   src='" . $StdList[0]['std_profile_picture'] . "' style='height: 30px;margin-right:5px;'/>" . $StdList[0]['std_fullname'] . "</td>";

        $AbsentArray = array('C', 'L', 'S', 'E', 'A');
        foreach ($AbsentArray as $r) {
            $output .= "<td class='TdSelect' style='text-align:center; padding: 0px;' ";
            if ($StdStatus['std_record_status'] == $r) {
                $output .= "><i class='icon-ok '></i>";
            } else {
                $output .= "onclick='UpdateStatus(\"" . $r . "," . $StdStatus['ed_absent_record_id'] . "\")' >";
            }
            $output .= "</td>";
        }
        $output .= "<td style='text-align:center; '><input type='text' class='form-control' placeholder='หมายเหตุ....'/></td>";

        echo $output;
    }

    //----------------บันทึกเวลามาเรียน-------------------------------//
    //---------เรียก View---------//
    public function std_absent_record_base() {
        $this->load->view("layout/header");
        $this->load->view("homeroom/std_absent_record");
        $this->load->view("layout/footer");
    }

    //---------นำข้อมูลเข้า database---------//
    //---- Insert(1)
    public function std_absent_record_insert() {
        $daynow = $_POST['daynow'];
        $cid = $_POST['cid'];
        $rid = $_POST['rid'];

        $checknumrow = $this->Homeroom_model->count_record_where($daynow);
        $student = $this->Homeroom_model->std_base($cid, $rid);
        if ($checknumrow == 0) {
            foreach ($student as $std) {
                $arr = array(
                    'tb_student_absent_record_status' => "C",
                    'tb_student_base_id' => $std["stdid"],
                    'tb_std_absent_record_date' => $daynow,
                    "tb_student_absent_record_recorder" => $this->session->userdata('name'),
                    "tb_student_absent_record_department" => $this->session->userdata('department'),
                    'tb_student_absent_record_createdate' => date('Y-m-d')
                );
                $this->My_model->insert_data("tb_std_absent_record", $arr);
            }
        }
    }

    //---- end(1)
    //---- edit(3)
    public function std_absent_record_edit() {
        $daynow = $_POST['daynow'];
        $cid = $_POST['cid'];
        $rid = $_POST['rid'];
        echo $this->Homeroom_model->std_absent_rec_edit($daynow, $cid, $rid);
    }

    //---- end(3)
    //
    //---- update(4)
    public function std_absent_record_update() {
        $status = $this->input->post('status');
        $note = $this->input->post('note');
        $bid = $this->input->post('bid');

        $arr = array(
            'tb_student_absent_record_status' => $status,
            'tb_student_absent_record_note' => $note
        );
        $this->My_model->update_data("tb_std_absent_record", array('id' => $bid), $arr);
    }

    //---- end(4)
//    //---- update(2) (บันทึกทั้งหมด)
//    public function std_absent_record_update0() {
//        $inid = $this->input->post('inId');
//        console_log($inid);
//        $status = "C";
//
//        foreach ($inid as $i) {
//            $innote = $this->input->post('note' . $i);
//            if ($i != "" || $i != 0) {
//                $incheck = $this->input->post('c' . $i);
//                $inabsent = $this->input->post('a' . $i);
//                $insick = $this->input->post('s' . $i);
//                $inerrand = $this->input->post('e' . $i);
//            }
//
//            if ($incheck != "") {
//                $status = $incheck;
//            }
//            if ($inabsent != "") {
//                $status = $inabsent;
//            }
//            if ($insick != "") {
//                $status = $insick;
//            }
//            if ($inerrand != "") {
//                $status = $inerrand;
//            }
//
//            $inbid = $this->input->post('inBid' . $i);
//
//            if ($inbid == "" | $inbid == 0) {
//                $arr = array(
//                    'tb_student_absent_record_status' => $status,
//                    'tb_student_base_id' => $i,
//                    'tb_student_absent_record_note' => $innote,
//                    'tb_std_absent_record_date' => date('Y-m-d'),
//                    "tb_student_absent_record_recorder" => $this->session->userdata('name'),
//                    "tb_student_absent_record_department" => $this->session->userdata('department'),
//                    'tb_student_absent_record_createdate' => date('Y-m-d')
//                );
//                $this->My_model->insert_data("tb_std_absent_record", $arr);
//            } else {
//                $arr = array(
//                    'tb_student_absent_record_status' => $status,
//                    'tb_student_base_id' => $i,
//                    'tb_student_absent_record_note' => $innote
//                );
//                $this->My_model->update_data("tb_std_absent_record", array('id' => $inbid), $arr);
//            }
//        }
//    }
//
//    //---- end(2)


    public function hr_homeroom_wnh_base() {
        $roomid = $this->input->get('room_id');
        $Student = $this->Std_model->get_std_base_w_roomid_return_array($roomid);
        $output = "";


        if ($Student) {
            foreach ($Student as $Std) {
                $output .= "<tr>";
                $output .= "<td style='width: 10%;text-align: center;'>" . $Std['std_number'] . "</td>";
                $output .= "<td style='width: 15%;text-align: center;'>" . $Std['std_code'] . "</td>";
                $output .= "<td style='width: 40%;text-align: center;'>" . $Std['std_fullname'] . "</td>";

                $this->db->select_max("id")->from("tb_std_wnh");
                $this->db->where("std_id", $Std['StdId']);

                $MyQ = $this->db->get()->row_array();
                $MyMax = $MyQ['id'];
                $MyRecord = $this->My_model->get_where_row('tb_std_wnh', array('id' => $MyMax));
                if (isset($MyRecord['tb_std_wnh_w'])) {
                    $output .= "<td style='width: 10%;text-align: center;'>" . $MyRecord['tb_std_wnh_w'] . "</td>";
                } else {
                    $output .= "<td style='width: 10%;text-align: center;'></td>";
                }

                if (isset($MyRecord['tb_std_wnh_h'])) {
                    $output .= "<td style='width: 10%;text-align: center;'>" . $MyRecord['tb_std_wnh_h'] . "</td>";
                } else {
                    $output .= "<td style='width: 10%;text-align: center;'></td>";
                }
                $output .= "<td style='width: 15%;text-align: center;'>";
                $output .= "<button type='button' class='btn btn-success' onclick='HrHomeRoomWNH(this)' id='" . $Std['StdId'] . "' ><i class='glyphicon glyphicon-scale'></i> บันทึก</button>";
                $output .= "</td>";
                $output .= "</tr>";
            }
        }


        $data['Student'] = $output;
        $this->load->view("layout/header");
        $this->load->view("homeroom/hr_homeroom_wnh_base", $data);
        $this->load->view("layout/footer");
    }

    public function student_wnh_show() {
        $id = $this->input->post('id');
        $Student = $this->Std_model->get_std_base_w_stdid_return_row($id);
        $output = "";

        $output .= "<div class='row'>";

        $output .= "<div class='col-md-4 form-group'>";
        $output .= "<div class='container-fluid'>";
        $output .= "<div class='pricing hover-effect'>";
        $output .= "<div class='pricing-head'>";
        $output .= "<h3>ข้อมูลนักเรียน</h3>";
        $output .= "</div>";
        $output .= "<div class='row'>";
        $output .= "<div class='col-md-10 form-group col-md-offset-1'>";
        $output .= "<br/>";

        if ($Student[0]['std_profile_picture'] != "") {
            $output .= "<center><img name='Stdpic' id='Stdpic' src='" . $Student[0]['std_profile_picture'] . "' style='width:150px;height: 200px;'/></center>";
        } else {
            $output .= "<center><img name='Stdpic' id='Stdpic' src='" . base_url() . "/images/no-image.jpg' style='width:150px;height: 200px;'/></center>";
        }


        $output .= "<label class='control-label' id='inStdname'  style='margin-top:10px;'>" . $Student[0]['std_fullname'] . "</label><br/>";
        $output .= "<label class='control-label' id='inStdCode' style='margin-top:10px;'>รหัสประจำตัว " . $Student[0]['std_code'] . "</label><br/>";
        $output .= "<label class='control-label' id='inStdClass'  style='margin-top:10px;'>" . $Student[0]['std_classname'] . "</label>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='col-md-8 form-group'>";

        $output .= "<form method='post' id='wnh-form' enctype='multipart/form-data'>";

        $output .= "<div class='row'>";
        $output .= "<input type='hidden' name='StdId' id='StdId' value='" . $Student[0]['StdId'] . "'/>";
        $output .= "<div class='col-md-5 form-group'>";
        $output .= "<label class='control-label'>น้ำหนัก (กิโลกรัม)</label>";
        $output .= "<input type='text' name='inW' id='inW' class='form-control' />";
        $output .= "</div>";

        $output .= "<div class='col-md-5 form-group'>";
        $output .= "<label class='control-label'>ส่วนสูง (เซนติเมตร)</label>";
        $output .= "<input type='text' name='inH' id='inH' class='form-control'/>";
        $output .= "</div>";

        $output .= "<button type='button' class='btn btn-success' style='margin-top:25px;' onclick='InsertWnH()' ><i class='icon-save icon-large'></i> บันทึก</button>";
        $output .= "</div>";

        $output .= "</form>";

        $output .= "<div class='row'>";
        $output .= "<table class='table table-hover table-striped table-bordered display' id='example'>";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style='width: 10%;text-align: center;'>ที่</th>";
        $output .= "<th style='width: 30%;text-align: center;'>วันที่บันทึก</th>";
        $output .= "<th style='width: 15%;text-align: center;'>น้ำหนัก</th>";
        $output .= "<th style='width: 15%;text-align: center;'>ส่วนสูง</th>";
        $output .= "<th style='width: 15%;text-align: center;'>ผู้บันทึก</th>";
        $output .= "<th style='width: 15%;text-align: center;'></th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";

        $Record = $this->My_model->get_where_order('tb_std_wnh', array('std_id' => $id), 'id asc');
        $i = 1;
        foreach ($Record as $r) {

            $output .= "<tr>";

            $output .= "<td style='width: 10%;text-align: center;'>" . $i . "</td>";
            $output .= "<td style='width: 30%;text-align: center;'>" . datethaifull($r['tb_std_wnh_createdate']) . "</td>";
            $output .= "<td style='width: 15%;text-align: center;'>" . $r['tb_std_wnh_w'] . " กิโลกรัม</td>";
            $output .= "<td style='width: 15%;text-align: center;'>" . $r['tb_std_wnh_h'] . " เซนติเมตร</td>";
            $output .= "<td style='width: 15%;text-align: center;'>" . $r['tb_std_wnh_recorder'] . "</td>";
            $output .= "<td style='width: 15%;text-align: center;'>";
            $output .= "<button type='button' class='btn btn-danger' id='" . $r['id'] . "' onclick='DeleteThis(this)' ><i class='icon-trash icon-large'></i> ลบ</button>";
            $output .= "</td>";

            $output .= "</tr>";

            $i++;
        }



        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";


        $output .= "</div>";

        echo $output;
    }

    public function insert_wnh() {
        $W = $this->input->post('W');
        $H = $this->input->post('H');
        $StdId = $this->input->post('StdId');


        $arr = array(
            'std_id' => $StdId,
            'tb_std_wnh_h' => $H,
            'tb_std_wnh_w' => $W,
            "tb_std_wnh_recorder" => $this->session->userdata('name'),
            "tb_std_wnh_department" => $this->session->userdata('department'),
            'tb_std_wnh_createdate' => date('Y-m-d')
        );
        $this->My_model->insert_data("tb_std_wnh", $arr);
    }

    public function delete_wnh() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_std_wnh', array('id' => $id));
    }

    public function hr_homeroom_std_base() {
        $roomid = $this->input->get('room_id');
        $Student = $this->Std_model->get_std_base_w_roomid_return_array($roomid);
        $output = "";


        if ($Student) {
            $count = count($Student);
            foreach ($Student as $Std) {

                $output .= "<tr>";
                $output .= "<td style='width: 10%;text-align: center;'>";
                $output .= "<select name='" . $Std['tb_classroom_id'] . "' id='" . $Std['tb_classroom_id'] . "' class='form-control'  onchange='StdNumberChange(this)'>";

                for ($i = 1; $i <= $count; $i++) {
                    if ($i != $Std['std_number']) {
                        $output .= "<option value='" . $i . "'>" . $i . "</option>";
                    } else {
                        $output .= "<option value='" . $Std['std_number'] . "' selected>" . $Std['std_number'] . "</option>";
                    }
                }



                $output .= "</select>";

                $output .= "</td>";

                $output .= "<td style='width: 15%;text-align: center;'>" . $Std['std_code'] . "</td>";
                $output .= "<td style='width: 40%;text-align: center;'>";
                $output .= "<span class='pull-left' ><img   src='" . $Std['std_profile_picture'] . "' style='width: 50px;margin-right:10px;'/>" . $Std['std_fullname'] . "</span>";
                $output .= "</td>";
                $output .= "<td style='width: 15%;text-align: center;'>" . $Std['std_nickname'] . "</td>";
                $output .= "<td style='width: 20%;text-align: center;'>";
                $output .= "&nbsp;<button type='button' class='btn btn-warning' id='" . $Std['StdId'] . "' onclick='EditThisStd(this)'><i class='icon icon-pencil icon-large'></i> แก้ไข</button>";
                $output .= "</td>";
                $output .= "</tr>";
            }
//             print_r($Student);
        }


        $data['Student'] = $output;
        $this->load->view("layout/header");
        $this->load->view("homeroom/hr_homeroom_std_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_student_by_id() {
        $id = $_POST['id'];
        echo json_encode($this->Std_model->get_std_base_w_stdid_return_row($id));
    }

    public function change_std_number() {
        $arr = array(
            'tb_ed_classroom_number' => $this->input->post('number'),
        );
        $this->My_model->update_data("tb_ed_classroom", array('id' => $this->input->post('id')), $arr);
    }

    public function update_student_base() {
        $id = $this->input->post('inStdId');

        if ($_FILES['inStdPicture']['name'] != "") {

            $config = array(
                "upload_path" => std_path($id, $this->session->userdata('sch_id')),
//                "allowed_types" => "jpg|png|jpeg|JPG|PNG|JPEG",
                "allowed_types" => "*",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inStdPicture");
            $data = $this->upload->data();

//            $config = array(
//                "upload_path" => std_path($id, $this->session->userdata('sch_id')),
//                "allowed_types" => "jpg|png|jpeg",
//                "max_size" => 0,
//                "file_name" => md5(date("YmdHis"))
//            );
//            $this->upload->initialize($config);
//            $this->upload->do_upload("inStdPicture");
//            $data = $this->upload->data();
//            $this->load->library("image_lib");
//            $config['image_library'] = "gd2";
//            $config["source_image"] = std_path($id, $this->session->userdata('sch_id')) . $data['file_name'];
//            $config['maintain_ratio'] = TRUE;
//            $config['width'] = 400;
//            $config['height'] = 500;
//            $this->image_lib->initialize($config);
//            $this->image_lib->resize();
            //
//            $ImageName = $data['file_name'];

            if ($id != "") {
//                $row = $this->My_model->get_where_row("tb_human_resources_01", array("id" => $id));
//                @unlink("upload/" . $row['inHrImage']);
                $arr = array(
                    "pic_name" => $data['file_name'],
                    "own_id" => $id,
                );
                $this->My_model->insert_data("tb_std_picture", $arr);
            }
        }


        $arr = array(
            'std_code' => $this->input->post('inStdCode'),
            'std_titlename' => $this->input->post('inStdTitlename'),
            'std_firstname' => $this->input->post('inStdFirstname'),
            'std_lastname' => $this->input->post('inStdLastname'),
            'std_birthday' => $this->input->post('inStdBirthday'),
//            'std_gender' => $this->input->post('inStdId'),
            'std_nickname' => $this->input->post('inStdNickname'),
            'std_nationality' => $this->input->post('inStdNationality'),
            'std_ethnicity' => $this->input->post('inStdEthnicity'),
            'std_religion' => $this->input->post('inStdReligion'),
            'std_idcard' => $this->input->post('inStdIdcard'),
            'std_bloodtype' => $this->input->post('inStdBloodtype'),
        );
        $this->My_model->update_data("tb_student_base", array('id' => $id), $arr);
    }

    public function hr_homeroom_vh_calendar_base() {
        $roomid = $this->input->get('room_id');
        $Student = $this->Std_model->get_std_base_w_roomid_return_array($roomid);
        $output = "";
        $output2 = "";
        if ($Student) {
            $output .= "<option value=''>---เลือกข้อมูล---</option>";
            foreach ($Student as $Std) {
                $output .= "<option value='" . $Std['StdId'] . "'>เลขที่ " . $Std['std_number'] . " | " . $Std['std_code'] . " | " . $Std['std_fullname'] . "</option>";

                $Checker = $this->My_model->get_where_row('tb_visit_home_calendar', array('tb_student_base_id' => $Std['StdId']));
//                
                $output2 .= "<tr>";
                if (count($Checker) > 0) {
                    $output2 .= "<td style='text-align: center;'>" . datethaifull($Checker['tb_visit_home_calendar_date']) . "</td>";
                } else {
                    $output2 .= "<td style='text-align: center;'></td>";
                }

                $output2 .= "<td style='text-align: center;'>" . $Std['std_fullname'] . "</td>";

                if (count($Checker) > 0) {
                    $output2 .= "<td style='text-align: center;'>" . $Checker['tb_visit_home_calendar_location'] . "</td>";
                } else {
                    $output2 .= "<td style='text-align: center;'></td>";
                }

                if (count($Checker) > 0) {
                    if ($Checker['tb_visit_home_calendar_status'] == 1) {
                        $output2 .= "<td style='text-align: center;'><font color='green'>ถูกเยี่ยมแล้ว</font></td>";
                    } else {
                        $output2 .= "<td style='text-align: center;'><font color='orange'>ยังไม่ถูกเยี่ยม</font></td>";
                    }
                    $output2 .= "<td style='text-align: center;'>"
                            . "<button type='button' class='btn btn-warning' onclick='EditThis(this)' id='{$Checker['id']}' ><i class='icon-pencil icon-large'></i> แก้ไข</button>";
                } else {
                    $output2 .= "<td style='text-align: center;'><font color='red'>ยังไม่ลงวันเยี่ยม</font></td>";
                    $output2 .= "<td style='text-align: center;'>"
                            . "<button type='button' class='btn btn-warning' onclick='InsertThis(this)' id='{$Std['StdId']}' ><i class='icon-pencil icon-large'></i> แก้ไข</button>";
                }


//                $output2 .= "<button type='button' class='btn btn-danger' onclick='DeleteThis(this)' id='" . $Checker['id'] . "' ><i class='icon-trash icon-large'></i> ลบ</button>";
                $output2 .= "</td>";
                $output2 .= "</tr>";
            }
        }

        $data['Student_list'] = $output;
        $data['Tbody'] = $output2;
        $this->load->view("layout/header");
        $this->load->view("homeroom/hr_homeroom_vh_calendar_base", $data);
        $this->load->view("layout/footer");
    }

    public function hr_homeroom_vh_calendar_insert() {
        $id = $this->input->post('id');

        $arr = array(
            'tb_student_base_id' => $this->input->post('inStdId'),
            'tb_visit_home_calendar_date' => $this->input->post('inVitsitHomeCalendarDate'),
            'tb_visit_home_calendar_location' => $this->input->post('inVitsitHomeCalendarLocation'),
            'tb_visit_home_recorder' => $this->session->userdata('name'),
            'tb_visit_home_department' => $this->session->userdata('department'),
            'tb_visit_home_createdate' => date('Y-m-d'),
        );
        if ($id != "") {
            $this->My_model->update_data("tb_visit_home_calendar", array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_visit_home_calendar", $arr);
        }
    }

    public function hr_homeroom_vh_calendar_edit() {
        $id = $this->input->post('id');
        echo json_encode($this->My_model->get_where_row('tb_visit_home_calendar', array('id' => $id)));
    }

//    public function hr_homeroom_vh_calendar_delete() {
//        $id = $this->input->post('id');
//        $this->My_model->delete_data('tb_visit_home_calendar', array('id' => $id));
//    }
    //---------- * งานเยี่ยมบ้านนักเรียน โอนมาจาก CI Visit_home

    public function visit_home_base() {
        $rid = $this->input->get('room_id');
        if (!isset($rid)) {
            if ($this->session->userdata('status') == "" && $this->session->userdata('status') !== "ผู้ปฏิบัติงาน") {
                redirect("/");
            }
        } else {


            $this->load->library('googlemaps');
            $config['apiKey'] = 'AIzaSyCYSxq9C7QyPsOOTjwLA3y_EtYlDvX5Im0';

            $scRS = $this->My_model->get_where_row('tb_school', array('id' => $this->session->userdata('sch_id')));

            if (isset($scRS['sc_lat'])) {
                $config['center'] = $scRS['sc_lat'] . ',' . $scRS['sc_long'];
            } else {
                $config['center'] = '15.5611959,101.9955651';
            }


            $config['zoom'] = '14';
            $config['onclick'] = 'get_GEO(event.latLng.lat(), event.latLng.lng())';
            $this->googlemaps->initialize($config);


            $rs = $this->Std_model->get_std_base_w_roomid_return_array($rid);
            if ($rs) {
                foreach ($rs as $r) {
                    $marker = array();
                    $addRS = $this->My_model->get_where_row('tb_std_address', array('std_id' => $r['StdId']));
                    if (isset($addRS['add_lat']) && isset($addRS['add_long'])) {
                        $marker['position'] = $addRS['add_lat'] . ',' . $addRS['add_long'];
                    }
//            } else {
//                $marker['position'] = $r['add_no'] . ' หมู่ ' . $r['add_moo'] . ' ตำบล' . $r['add_tambol'] . ' อำเภอ' . $r['add_amphur'] . ' จังหวัด' . $r['add_province'] . ' ' . $r['add_zipcode'];
//            }
//                    $pic = $this->My_model->get_where_row('tb_std_picture', array('own_id' => $r->StdId));

                    if (isset($r['std_profile_picture']) && !file_exists($r['std_profile_picture'])) {
                        $marker['icon'] = $r['std_profile_picture'];
                        $marker['icon_scaledSize'] = '28, 32';
                    } else {
                        $marker['icon'] = base_url('images/map_point.png');
                        $marker['icon_scaledSize'] = '30, 32';
                    }

                    $marker['infowindow_content'] = $this->get_marker_content($r['std_fullname'], $r['StdId']);
                    $this->googlemaps->add_marker($marker);
                }
            }
//
//            $map = $this->googlemaps->create_map();
//            echo $map['html'] . $map['js'];
            $data['rsT'] = $rs;
            $data['map'] = $this->googlemaps->create_map();

            $this->load->view('layout/header');
            $this->load->view('homeroom/visit_home/index', $data);
            $this->load->view('layout/footer');
        }
    }

    function vh_base_default() {
        //row_array
//        $data['std'] = $this->Std_model->get_std_base_w_stdid($rid);
        $std_add = $this->Std_model->get_std_info($this->input->post('std_id'));
        echo json_encode($std_add);
    }

    function get_marker_content($tmp, $std_id) {
        $check = $this->My_model->get_where_row('tb_visit_home_calendar', array('tb_student_base_id' => $std_id));
        $v = "";
        if (isset($check['tb_visit_home_calendar_status'])) {
            $v = "<div class='panel'>";
            if ($check['tb_visit_home_calendar_status'] == 1) {
                $row = $this->My_model->get_where_row('tb_visit_home_result', array('tb_student_base_id' => $check['tb_student_base_id']));
                $v .= '<button type="button" class="btn btn-success" id="' . $row['id'] . '"  onclick=\'ShowDetailModal(this)\'>';
                $v .= '<i class="glyphicon glyphicon-editglyphicon glyphicon-edit"></i> ดูรายงานการเยี่ยมบ้าน ' . $tmp . '</button>';
            } elseif ($check['tb_visit_home_calendar_status'] == 0) {
                $v .= '<button type="button" class="btn btn-success" id="' . $check['tb_student_base_id'] . '"  onclick=\'ShowInsertModal(this)\'>';
                $v .= '<i class="glyphicon glyphicon-editglyphicon glyphicon-edit"></i> บันทึกเยี่ยมบ้าน ' . $tmp . '</button>';
            }
            $v .= "</div>";
        }
        return $v;
    }

    function get_position_list($rid) {
//        $this->db->select("std.*,std.id as stdId,add.*");
//        $this->db->from('tb_student_base std');
//        $this->db->join('tb_std_address add', 'std.id=add.std_id');
//        $this->db->where(array('tb_student_base_department' => $this->session->userdata('department')))->order_by('std.id');
//        $this->db->limit(50);
//        


        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as stdId");
        $this->db->select("a.*,b.*,c.*,d.*,e.*,f.*");
        $this->db->select("add.*");
        $this->db->from("tb_student_base a");
        $this->db->join('tb_std_address add', 'a.id=add.std_id');
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");
        $this->db->where("a.tb_student_base_status", 'S');
        if ($rid != "") {
            $this->db->where("c.id", $rid);
        }
        $this->db->where(array('a.tb_student_base_department' => $this->session->userdata('department')));
        $this->db->order_by("b.tb_ed_classroom_number asc");


        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

// 
    public function vh_base() {

        if ($this->session->userdata('status') == "") {
            redirect("/");
        }

        $data['rs'] = $this->My_model->get_all_order('tb_visit_home', 'std_name ASC');

        $this->load->view("layout/header");
        $this->load->view("visit_home/vh_base", $data);
        $this->load->view("layout/footer");
    }

    public function vh_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("visit_home/vh_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function vh_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_visit_home', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function vh_insert_2() {
        if ($_FILES['inVhImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg1");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }
        if ($_FILES['inVhImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        $arr = array(
            "std_name" => $this->input->post('inStdName'),
            "std_no" => $this->input->post('inStdNo'),
            "std_class" => $this->input->post('inStdClass'),
            "tech_name" => $this->input->post('inTechName'),
            "date_visit" => $this->input->post('inDateVisit'),
            "addv_detail" => $this->input->post('inAddvDetail'),
            "addc_name" => $this->input->post('inAddcName'),
            "addc_detail" => $this->input->post('inAddcDetail'),
            "father_name" => $this->input->post('inFatherName'),
            "father_career" => $this->input->post('inFatherCareer'),
            "father_salary" => $this->input->post('inFatherSalary'),
            "mother_name" => $this->input->post('inMotherName'),
            "mother_career" => $this->input->post('inMotherCareer'),
            "mother_salary" => $this->input->post('inMotherSalary'),
            "parent_name" => $this->input->post('inParentName'),
            "parent_career" => $this->input->post('inParentCareer'),
            "parent_salary" => $this->input->post('inParentSalary'),
            "home_structure" => $this->input->post('inHomeStructure'),
            "home_relation" => $this->input->post('inHomeRelation'),
            "std_task" => $this->input->post('inStdTask'),
            "parent_training" => $this->input->post('inParentTraining'),
            "parent_assistance" => $this->input->post('inParentAssistance'),
            "tech_comment" => $this->input->post('inTechComment'),
            "home_distance" => $this->input->post('inHomeDistance'),
            "vh_img1" => $filename1,
            "vh_img2" => $filename2
        );
        $this->My_model->insert_data('tb_visit_home', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function vh_base_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//

        $outp .= "<div class=\"row\">";

        $outp .= "<div class=\"col-md-6\">";
        if (file_exists("upload/" . $row['vh_img1']) && !empty($row['vh_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['vh_img1'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "<div class=\"col-md-6\">";
        if (file_exists("upload/" . $row['vh_img2']) && !empty($row['vh_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['vh_img2'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "</div>";
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่อนักเรียน</td>"
                . "<td class='data-show'>{$row['std_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชั้น</td>"
                . "<td class='data-show'>{$row['std_class']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เลขที่</td>"
                . "<td class='data-show'>{$row['std_no']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ครูประจำชั้น/ครูที่ปรึกษา</td>"
                . "<td class='data-show'>{$row['tech_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>วันที่ออกเยี่ยม</td>"
                . "<td class='data-show'>{$row['date_visit']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สถานที่ไปเยี่ยม</td>"
                . "<td class='data-show'>{$row['addv_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สถานที่ประกอบอาชีพ</td>"
                . "<td class='data-show'>{$row['addc_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>ที่ตั้งสถานที่ประกอบอาชีพ</td>"
                . "<td class='data-show'>{$row['addc_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลบิดา</td>"
                . "<td class='data-show'>{$row['father_name']}</td>"
                . "</tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['father_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['father_salary']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลมารดา</td>"
                . "<td class='data-show'>{$row['mother_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['mother_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['mother_salary']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลผู้ปกครอง</td>"
                . "<td class='data-show'>{$row['parent_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['parent_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['parent_salary']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สภาพบ้านและสภาพแวดล้อม</td>"
                . "<td class='data-show'>{$row['home_structure']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ความสัมพันธ์ในครอบครัว</td>"
                . "<td class='data-show'>{$row['home_relation']}</td>"
                . "<tr>"
                . "<td class='data-title'>การช่วยงานของนักเรียนในครอบครัว</td>"
                . "<td class='data-show'>{$row['std_task']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ผู้ปกครองช่วยอบรมดูแลนักเรียนอย่างไร</td>"
                . "<td class='data-show'>{$row['parent_training']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สิ่งที่ผู้ปกครองต้องการความช่วยเหลือจากโรงเรียน</td>"
                . "<td class='data-show'>{$row['parent_assistance']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ความเห็น/ข้อเสนอของครูในการเยี่ยมบ้าน</td>"
                . "<td class='data-show'>{$row['tech_comment']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ระยะทางจากบ้านมาโรงเรียน</td>"
                . "<td class='data-show'>{$row['home_distance']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

    //--- End Code Detail ---//
    //
    //
    //----- Code Edit ------//
    public function vh_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function vh_update() {

        $id = $_POST['id'];
        if ($_FILES['inVhImg1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
            @unlink("upload/" . $row['vh_img1']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg1");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("vh_img1" => $data['file_name']);
            $this->My_model->update_data("tb_visit_home", array("id" => $id), $arr);
        }

        if ($_FILES['inVhImg2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
            @unlink("upload/" . $row['vh_img2']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("vh_img2" => $data['file_name']);
            $this->My_model->update_data("tb_visit_home", array("id" => $id), $arr);
        }
        $arr = array(
            "std_name" => $this->input->post('inStdName'),
            "std_no" => $this->input->post('inStdNo'),
            "std_class" => $this->input->post('inStdClass'),
            "tech_name" => $this->input->post('inTechName'),
            "date_visit" => $this->input->post('inDateVisit'),
            "addv_detail" => $this->input->post('inAddvDetail'),
            "addc_name" => $this->input->post('inAddcName'),
            "addc_detail" => $this->input->post('inAddcDetail'),
            "father_name" => $this->input->post('inFatherName'),
            "father_career" => $this->input->post('inFatherCareer'),
            "father_salary" => $this->input->post('inFatherSalary'),
            "mother_name" => $this->input->post('inMotherName'),
            "mother_career" => $this->input->post('inMotherCareer'),
            "mother_salary" => $this->input->post('inMotherSalary'),
            "parent_name" => $this->input->post('inParentName'),
            "parent_career" => $this->input->post('inParentCareer'),
            "parent_salary" => $this->input->post('inParentSalary'),
            "home_structure" => $this->input->post('inHomeStructure'),
            "home_relation" => $this->input->post('inHomeRelation'),
            "std_task" => $this->input->post('inStdTask'),
            "parent_training" => $this->input->post('inParentTraining'),
            "parent_assistance" => $this->input->post('inParentAssistance'),
            "tech_comment" => $this->input->post('inTechComment'),
            "home_distance" => $this->input->post('inHomeDistance')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_visit_home', array('id' => $id), $arr);
        }
    }

    public function vh_insert() {

        $id = $this->input->post('inStdId');

        $arr = array(
            "add_lat" => $this->input->post('inAddLat'),
            "add_long" => $this->input->post('inAddLong'),
        );

        $rs = $this->My_model->get_where_row('tb_std_address', array('std_id' => $id));

        if (isset($rs['id'])) {
            $this->My_model->update_data('tb_std_address', array('std_id' => $id), $arr);
        } else {
            $arr = array(
                "add_lat" => $this->input->post('inAddLat'),
                "add_long" => $this->input->post('inAddLong'),
                "std_id" => $id
            );
            $this->My_model->insert_data('tb_std_address', $arr);
        }

//        if ($id != "") {
//            $this->My_model->update_data('tb_std_address', array('std_id' => $id), $arr);
//        } else {
//            $this->My_model->insert_data('tb_std_address', $arr);
//        }
//        $id = $this->db->insert_id();
    }

    function hr_homeroom_vh_get_std_by_id() {
        $id = $this->input->post('id');

        $sql = "select a.*,c.* from tb_outsider a inner JOIN
tb_std_family b on b.tb_outsider_id = a.id
inner join tb_student_base std 
on b.std_id = std.id
inner join tb_fm_career c on c.tb_outsider_id = a.id 
where std.id='" . $id . "' and tb_outsider_parent=1 ";

        $q = $this->db->query($sql);
        $parent = $q->row_array();


        $std = $this->Std_model->get_std_base_w_stdid_return_row($id);

        $arr = array(
            'StdId' => $std[0]['StdId'],
            'inVhStdTitleName' => $std[0]['std_titlename'],
            'inVhStdFirstName' => $std[0]['std_firstname'],
            'inVhStdLastName' => $std[0]['std_lastname'],
            'inVhStdClassName' => $std[0]['std_classname'],
            'inVhStdIdCard' => $std[0]['std_idcard'],
            'inVhStdNickName' => $std[0]['std_nickname'],
            'inVhStdCode' => $std[0]['std_code'],
            'inVhStdPicture' => $std[0]['std_profile_picture'],
            'inVhPrTitleName' => $parent['tb_outsider_titlename'],
            'inVhPrFirstName' => $parent['tb_outsider_firstname'],
            'inVhPrLastName' => $parent['tb_outsider_lastname'],
            'inVhPrRelation' => $parent['tb_outsider_about'],
            'inVhPrCareer' => $parent['cr_career_name'],
            'inVhPrCareerSalary' => $parent['cr_income'],
//            'inVhPrPhone'=>$parent[''],
//            'inVhPrEducation'=>$parent[''],
            'inVhPrIdcard' => $parent['tb_outsider_idcard'],
        );
        echo json_encode($arr);
//        echo json_encode($this->My_model->get_where_row('tb_student_base', array('id' => $id)));
    }

    function hr_homeroom_vh_insert() {
        $id = "";

        $arr = array(
            "std_name" => $this->input->post('inStdName'),
            "std_no" => $this->input->post('inStdNo'),
            "std_class" => $this->input->post('inStdClass'),
            "tech_name" => $this->input->post('inTechName'),
            "date_visit" => $this->input->post('inDateVisit'),
            "addv_detail" => $this->input->post('inAddvDetail'),
            "addc_name" => $this->input->post('inAddcName'),
            "addc_detail" => $this->input->post('inAddcDetail'),
            "father_name" => $this->input->post('inFatherName'),
            "father_career" => $this->input->post('inFatherCareer'),
            "father_salary" => $this->input->post('inFatherSalary'),
            "mother_name" => $this->input->post('inMotherName'),
            "mother_career" => $this->input->post('inMotherCareer'),
            "mother_salary" => $this->input->post('inMotherSalary'),
            "parent_name" => $this->input->post('inParentName'),
            "parent_career" => $this->input->post('inParentCareer'),
            "parent_salary" => $this->input->post('inParentSalary'),
            "home_structure" => $this->input->post('inHomeStructure'),
            "home_relation" => $this->input->post('inHomeRelation'),
            "std_task" => $this->input->post('inStdTask'),
            "parent_training" => $this->input->post('inParentTraining'),
            "parent_assistance" => $this->input->post('inParentAssistance'),
            "tech_comment" => $this->input->post('inTechComment'),
            "home_distance" => $this->input->post('inHomeDistance')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_visit_home', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_visit_home', array('id' => $id), $arr);
        }
    }

    function hr_homeroom_vh_insert_cl() {
//        $VhClId = $this->input->post('VhClId');
        $student_id = $this->input->post('StdId');

        $arr = array(
            "tb_student_base_id" => $student_id,
            "tb_visit_home_result_date" => (date('Y') + 543) . "-" . date('m-d'),
            "`31`" => $this->input->post('in31'),
            "`32`" => $this->input->post('in32'),
            "`33`" => $this->input->post('in33'),
            "`341`" => $this->input->post('in341'),
            "`342`" => $this->input->post('in342'),
            "`35`" => $this->input->post('in35'),
            "`36`" => $this->input->post('in36'),
            "`37`" => $this->input->post('in37'),
            "`38`" => $this->input->post('in38'),
            "`41`" => $this->input->post('in41'),
            "`42`" => $this->input->post('in42'),
            "`431`" => $this->input->post('in431'),
            "`432`" => $this->input->post('in432'),
            "`433`" => $this->input->post('in433'),
            "`44`" => $this->input->post('in44'),
            "`45`" => $this->input->post('in45'),
            "`46`" => $this->input->post('in46'),
            "`47`" => $this->input->post('in47'),
            "`48`" => $this->input->post('in48'),
            "`49`" => $this->input->post('in49'),
            "`410`" => $this->input->post('in410'),
            "`411`" => $this->input->post('in411'),
            "`412`" => $this->input->post('in412'),
            "`tb_visit_home_result_reporter`" => $this->input->post('inVhReporter'),
            "`tb_visit_home_result_att`" => $this->input->post('inVhAtt'),
            "`tb_visit_home_image1`" => $this->input->post('inVhImage1'),
            "`tb_visit_home_image2`" => $this->input->post('inVhImage2'),
            "`tb_visit_home_parent_image`" => "",
            "`tb_vh_parent_title_name`" => $this->input->post('inVhPrTitleName'),
            "`tb_vh_parent_first_name`" => $this->input->post('inVhPrFirstName'),
            "`tb_vh_parent_last_name`" => $this->input->post('inVhPrLastName'),
            "`tb_vh_parent_relation`" => $this->input->post('inVhPrRelation'),
            "`tb_vh_parent_career`" => $this->input->post('inVhPrCareer'),
            "`tb_vh_parent_salary`" => $this->input->post('inVhPrCareerSalary'),
            "`tb_vh_parent_phone`" => $this->input->post('inVhPrPhone'),
            "`tb_vh_parent_education`" => $this->input->post('inVhPrEducation'),
            "`tb_vh_parent_idcard`" => $this->input->post('inVhPrIdcard'),
            "`tb_visit_home_result_recorder`" => $this->session->userdata('name'),
            "`tb_visit_home_result_createdate`" => date('Y-m-d')
        );

//        if ($id != "") {
//            $this->My_model->update_data('tb_visit_home_result', array('tb_visit_home_calendar_id' => $VhClId), $arr);
//        } else {
        $id = $this->My_model->insert_data('tb_visit_home_result', $arr);
//        }
        if ($_FILES['inVhImage1']['name'][0] != "") {
            $total = count($_FILES['inVhImage1']['name']);
            $file = "";
            for ($i = 0; $i < $total; $i++) {

                $_FILES['file']['name'] = $_FILES['inVhImage1']['name'][$i];
                $_FILES['file']['type'] = $_FILES['inVhImage1']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['inVhImage1']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['inVhImage1']['error'][$i];
                $_FILES['file']['size'] = $_FILES['inVhImage1']['size'][$i];

                $uploadPath = other_unique_path($this->session->userdata('sch_id'), 'tb_visit_home_result_image1', $id);

                $config = array(
                    "upload_path" => $uploadPath,
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );

                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data = $this->upload->data();
                if ($i > 0) {
                    $file .= "," . $data['file_name'];
                } else {
                    $file .= $data['file_name'];
                }
            }

            $arr = array("tb_visit_home_image1" => $file);
            if ($id != "") {
                $this->My_model->update_data('tb_visit_home_result', array('id' => $id), $arr);
            }
        }

        if ($_FILES['inVhImage2']['name'][0] != "") {
            $total = count($_FILES['inVhImage2']['name']);
            $file = "";
            for ($i = 0; $i < $total; $i++) {

                $_FILES['file']['name'] = $_FILES['inVhImage2']['name'][$i];
                $_FILES['file']['type'] = $_FILES['inVhImage2']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['inVhImage2']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['inVhImage2']['error'][$i];
                $_FILES['file']['size'] = $_FILES['inVhImage2']['size'][$i];

                $uploadPath = other_unique_path($this->session->userdata('sch_id'), 'tb_visit_home_result_image2', $id);

                $config = array(
                    "upload_path" => $uploadPath,
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );

                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data = $this->upload->data();
                if ($i > 0) {
                    $file .= "," . $data['file_name'];
                } else {
                    $file .= $data['file_name'];
                }
            }

            $arr = array("tb_visit_home_image2" => $file);
            if ($id != "") {
                $this->My_model->update_data('tb_visit_home_result', array('id' => $id), $arr);
            }
        }

        $arr = array("tb_visit_home_calendar_status" => 1);
        if ($id != "") {
            $this->My_model->update_data('tb_visit_home_calendar', array('tb_student_base_id' => $student_id), $arr);
        }
    }

    public function hr_homeroom_vh_delete_cl() {
        $id = $_POST['id'];
        $school_id = $this->session->userdata('sch_id');
        $row = $this->My_model->get_where_row('tb_visit_home_result', array('id' => $id));
        $this->My_model->delete_data('tb_visit_home_result', array('id' => $id));

        $uploadPath1 = other_unique_path($school_id, 'tb_visit_home_result_image1', $id);
        @unlink($uploadPath1);
        $uploadPath2 = other_unique_path($school_id, 'tb_visit_home_result_image2', $id);
        @unlink($uploadPath2);

        
        $arr = array("tb_visit_home_calendar_status" => 0);
        if ($id != "") {
            $this->My_model->update_data('tb_visit_home_calendar', array('tb_student_base_id' => $row['tb_student_base_id']), $arr);
        }
    }

    public function hr_homeroom_vh_show_detail() {
        $output = "";
        $id = $this->input->post('id');
        $row = $this->My_model->get_where_row('tb_visit_home_result', array('id' => $id));
        $calendar = $this->My_model->get_where_row('tb_visit_home_calendar', array('id' => $id));

        $student = $this->Std_model->get_std_base_w_stdid_return_row($row['tb_student_base_id']);

//        $output .= $row['id'];

        $output .= "<div class='row' id='For1'>";
        $output .= "<div class='col-md-12'>";

        $output .= "<legend>๑. ข้อมูลส่วนตัวนักเรียน</legend>";
        $output .= "<div class='col-md-3' style='margin-top:20px;'>";
        $output .= "<center>";
        $output .= "<img src='{$student[0]['std_profile_picture']}' name='inVhStdPicture' id='inVhStdPicture' class='' style='width: 90%;height: 190px;' />";
        $output .= "</center>";
        $output .= "</div>";
        $output .= "<div class='col-md-9' style='margin-top:25px;'>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr><td class='data-title' style='width:20%;'>ชื่อ - นามสกุล</td><td class='data-show' colspan='3'>" . $student[0]['std_fullname'] . "</td></tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>ชั้น</td><td class='data-show' colspan='3'>" . $student[0]['std_classname'] . "</td></tr>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:40%;'>เลขบัตรประจำตัวประชาชน</td><td class='data-show'>" . $student[0]['std_idcard'] . "</td>"
//                . "<td class='data-title' style='width:20%;'>ชื่อเล่นนักเรียน</td><td class='data-show'>" . $student[0]['std_nickname'] . "</td>"
                . "</tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>เลขประจำตัวนักเรียน</td><td class='data-show' colspan='3'>" . $student[0]['std_code'] . "</td></tr>";

        $output .= "</table>";
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";


        $output .= "<div class='row' id='For2'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>๒. ผู้ปกครองนักเรียน</legend>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่อ - นามสกุล</td><td class='data-show'>" . $row['tb_vh_parent_title_name'] . $row['tb_vh_parent_first_name'] . " " . $row['tb_vh_parent_last_name'] . "</td>"
                . "<td class='data-title' style='width:20%;'>ความสัมพันธ์กับนักเรียน</td><td class='data-show'>" . $row['tb_vh_parent_relation'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:20%;'>อาชีพ</td><td class='data-show'>" . $row['tb_vh_parent_career'] . "</td>"
                . "<td class='data-title' style='width:20%;'>รายได้/เดือน</td><td class='data-show'>" . $row['tb_vh_parent_salary'] . " บาท</td>"
                . "</tr>";

        $output .= "<tr><td class='data-title' style='width:20%;'>เบอร์โทรศัพท์</td><td class='data-show' colspan='3'>" . $row['tb_vh_parent_phone'] . "</td></tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>จบการศึกษาสูงสุด</td><td class='data-show' colspan='3'>" . $row['tb_vh_parent_education'] . "</td></tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>เลขที่บัตรประชาชน</td><td class='data-show' colspan='3'>" . $row['tb_vh_parent_idcard'] . "</td></tr>";


        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row' id='For3'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>๓. ความสัมพันธ์ในครอบครัว</legend>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;' >สมาชิกในครอบครัวมีเวลาอยู่ร่วมกัน</td><td class='data-show' colspan='3'>" . $row['31'] . " ชั่วโมงต่อวัน</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>กรณีที่ผู้ปกครองไม่อยู่บ้านฝากเด็กนักเรียนอยู่บ้านกับใคร</td><td class='data-show' colspan='3'>" . $row['32'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>รายได้ครัวเรือนเฉลี่ยต่อคน (รวมรายได้ครัวเรือน หารด้วยจำนวนสมาชิกทั้งหมด) </td><td class='data-show' colspan='3'>" . $row['33'] . " บาท</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:20%;'>นักเรียนได้รับค่าใช้จ่ายจาก</td><td class='data-show'>" . $row['341'] . "</td>"
                . "<td class='data-title' style='width:20%;'>นักเรียนได้เงินมาโรงเรียนวันละ</td><td class='data-show' >" . $row['342'] . " บาท</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>สิ่งที่ผู้ปกครองต้องการให้โรงเรียนช่วยเหลือนักเรียน</td><td class='data-show' colspan='3'>" . $row['35'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>ความช่วยเหลือที่ครอบครัวเคยได้รับจากหน่วยงานหรือต้องการได้รับการช่วยเหลือ</td><td class='data-show' colspan='3'>" . $row['37'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>ข้อห่วงใยของผู้ปกครองที่มีต่อนักเรียน</td><td class='data-show' colspan='3'>" . $row['38'] . "</td>"
                . "</tr>";
        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row' id='For4'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>๔. พฤติกรรมและความเสี่ยง</legend>";
        $output .= "<table style='width:95%;float:right;'>";


        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>สภาพร่างกาย</td><td class='data-show' colspan='3'>" . $row['41'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>สวัสดิการหรือความปลอดภัย</td><td class='data-show' colspan='3'>" . $row['42'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:20%;'>ระยะทางระหว่างบ้านไปโรงเรียน</td><td class='data-show'>" . $row['431'] . " กิโลเมตร</td>"
                . "<td class='data-title' style='width:20%;'>ใช้เวลาเดินทาง</td><td class='data-show' >" . $row['432'] . " บาท</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>วิธีการเดินทาง</td><td class='data-show' colspan='3'>" . $row['433'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>สภาพที่อยู่อาศัย </td><td class='data-show' colspan='3'>" . $row['44'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>ภาระงานความรับผิดชอบของนักเรียนที่มีต่อครอบครัว</td><td class='data-show' colspan='3'>" . $row['45'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>กิจกรรมยามว่างหรืองานอดิเรก</td><td class='data-show' colspan='3'>" . $row['46'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>พฤติกรรมการใช้สารเสพติด</td><td class='data-show' colspan='3'>" . $row['47'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>พฤติกรรมการใช้ความรุนแรง</td><td class='data-show' colspan='3'>" . $row['48'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>พฤติกรรมทางเพศ</td><td class='data-show' colspan='3'>" . $row['49'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>การติดเกม</td><td class='data-show' colspan='3'>" . $row['410'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>การเข้าถึงสื่อคอมพิวเตอร์และอินเตอร์เน็ตที่บ้าน</td><td class='data-show' colspan='3'>" . $row['411'] . "</td>"
                . "</tr>";

        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>การใช้เครื่องมือสื่อสารอิเล็กทรอนิกส์</td><td class='data-show' colspan='3'>" . $row['412'] . "</td>"
                . "</tr>";
        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "<div id='ForReporter'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>ผู้ให้ข้อมูลนักเรียน</legend>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>ผู้ให้ข้อมูลนักเรียน</td><td class='data-show' colspan='3'>" . $row['tb_visit_home_result_reporter'] . "</td>"
                . "</tr>";

        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row' id='ForOther'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>รูปภาพ/ภาพถ่ายประกอบการเยี่ยมบ้านนักเรียน</legend>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:50%;'>ภาพถ่ายที่แนบมาคือ</td><td class='data-show' colspan='3'>" . $row['tb_visit_home_result_att'] . "</td>"
                . "</tr>";

        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row' id='ForHouse'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>รูปชุดที่ ๑ ภาพถ่ายสภาพบ้านนักเรียน</legend>";
        $school_id = $this->session->userdata('sch_id');

        $FileArray = explode(",", $row['tb_visit_home_image1']);
        foreach ($FileArray as $FA) {
            $uploadPath = other_unique_path($school_id, 'tb_visit_home_result_image1', $row['id']);
            $link = base_url() . $uploadPath . "/" . $FA;
            $output .= "<div class='col-md-6'>";
            $output .= "<a target='_blank' href='" . $link . "'>";
            $output .= "<img class='img-thumbnail' src='" . $link . "'  style='width: 100%;'/>";
            $output .= "</a>";
            $output .= "</div>";
        }

        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row' id='ForInsideHouse'>";
        $output .= "<div class='col-md-12' style='margin-top:25;'>";
        $output .= "<legend>รูปชุดที่ ๒ ภาพถ่ายสภาพในบ้านนักเรียน</legend>";

        $FileArray = explode(",", $row['tb_visit_home_image2']);
        foreach ($FileArray as $FA) {
            $uploadPath = other_unique_path($school_id, 'tb_visit_home_result_image2', $row['id']);
            $link = base_url() . $uploadPath . "/" . $FA;
            $output .= "<div class='col-md-6'>";
            $output .= "<a target='_blank' href='" . $link . "'>";
            $output .= "<img class='img-thumbnail' src='" . $link . "'  style='width: 100%;'/>";
            $output .= "</a>";
            $output .= "</div>";
        }

        $output .= "</div>";
        $output .= "</div>";

        echo $output;
    }

}
