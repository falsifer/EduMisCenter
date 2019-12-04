<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Management_model");
        $this->load->model('Hr_model');
    }

    // ระบบและเครือข่ายข้อมูลสารสนเทศทางการศึกษา
    public function km_network() {
        $data['rs'] = $this->My_model->get_all_order("tb_km_network", "km_network_date desc");
        $this->load->view("layout/header");
        $this->load->view("km_network/index", $data);
        $this->load->view("layout/footer");
    }

    // insert km network
    public function km_network_add() {
        $id = $_POST['id'];
        if ($id != "") {
            if ($_FILES['inKmNetworkImage1']['name'] != "") {
                $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
                @unlink("upload/" > $row['km_network_img1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage1");
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
                $arr = array("km_network_img1" => $filename1);
                $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
            }
            //
            if ($_FILES['inKmNetworkImage2']['name'] != "") {
                $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
                @unlink("upload/" > $row['km_network_img1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage2");
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
                $arr = array("km_network_img2" => $filename2);
                $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
            }
//
            if ($_FILES['inKmNetworkImage3']['name'] != "") {
                $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
                @unlink("upload/" > $row['km_network_img1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename3 = $data['file_name'];
                $arr = array("km_network_img3" => $filename3);
                $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
            }
//
            if ($_FILES['inKmNetworkImage4']['name'] != "") {
                $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
                @unlink("upload/" > $row['km_network_img1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename4 = $data['file_name'];
                $arr = array("km_network_img4" => $filename4);
                $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
            }
//
            if ($_FILES['inKmNetworkDoc']['name'] != "") {
                $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
                @unlink("upload/" > $row['km_network_img1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkDoc");
                $data = $this->upload->data();
                $filename5 = $data['file_name'];
                $arr = array("km_network_doc" => $filename5);
                $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
            }
//
            $arr = array(
                "km_network_date" => $this->input->post("inKmNetworkDate"),
                "km_network_topic" => $this->input->post('inKmNetworkTopic'),
                "km_network_purpose" => $this->input->post("inKmNetworkPurpose"),
                "km_network_detail" => $this->input->post("inKmNetworkDetail"),
                "km_network_owner" => $this->session->userdata('name'),
                "km_network_department" => $this->session->userdata('department')
            );
            $this->My_model->update_data("tb_km_network", array("id" => $id), $arr);
        } else {
            if ($_FILES['inKmNetworkImage1']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage1");
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
//
            if ($_FILES['inKmNetworkImage2']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage2");
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
//
            if ($_FILES['inKmNetworkImage3']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename3 = $data['file_name'];
            } else {
                $filename3 = "";
            }
//
            if ($_FILES['inKmNetworkImage4']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename4 = $data['file_name'];
            } else {
                $filename4 = "";
            }
//
            if ($_FILES['inKmNetworkDoc']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inKmNetworkDoc");
                $data = $this->upload->data();
                $filename5 = $data['file_name'];
            } else {
                $filename5 = "";
            }
//
            $arr = array(
                "km_network_date" => $this->input->post("inKmNetworkDate"),
                "km_network_topic" => $this->input->post('inKmNetworkTopic'),
                "km_network_purpose" => $this->input->post("inKmNetworkPurpose"),
                "km_network_detail" => $this->input->post("inKmNetworkDetail"),
                "km_network_img1" => $filename1,
                "km_network_img2" => $filename2,
                "km_network_img3" => $filename3,
                "km_network_doc" => $filename5,
                "km_network_owner" => $this->session->userdata('name'),
                "km_network_department" => $this->session->userdata('department')
            );
            $this->My_model->insert_data("tb_km_network", $arr);
        }
    }

    // edit data;
    public function km_network_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id));
        echo json_encode($row);
    }

    // delet data;
    public function km_network_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_km_network", array("id" => $id0));
        //
        @unlink("upload/" . $row["km_network_img1"]);
        @unlink("upload/" . $row["km_network_img2"]);
        @unlink("upload/" . $row["km_network_img3"]);
        @unlink("upload/" . $row["km_network_img4"]);
        @unlink("upload/" . $row["km_network_doc"]);
        $this->My_model->delete_data("tb_km_network", array("id" => $id));
    }

    // km network detail;
    public function km_network_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_km_network', array('id' => $id));
        $outp = "<div class='container'>"
                . "<div class='row'>";
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:3%;'>วันที่นำเสนอ</td>"
                . "<td class='data-show'>" . datethai($row['km_network_date']) . "</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>หัวข้อ</td><td class='data-show'>{$row['km_network_topic']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วัตถุประสงค์</td><td class='data-show'>{$row['km_network_purpose']}</td>"
                . "</tr>"
                . "<tr><td class='data-title'>รายละเอียดเพิ่มเติม</td><td class='data-show'>{$row['km_network_detail']}</td></tr>"
                . "<tr>";
        // แสดงเอกสาร
        if (file_exists("upload/" . $row["km_network_doc"]) && !empty($row["km_network_doc"])) {
            $outp .= "<tr><td class='data-title'>เอกสารประกอบ</td><td class='data-show'>" . anchor(base_url() . "upload/" . $row["km_network_doc"], "เอกสาร", array("target" => "_blank")) . "</td></tr>";
        }
        // แสดงภาพประกอบ
        $outp .= "<tr><td style='padding-top:20px;'>";
        if (file_exists("upload/" . $row['km_network_img1']) && !empty($row['km_network_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['km_network_img1'], "style" => "width:280px;height:260px;border:5px solid #f9a825;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['km_network_img2']) && !empty($row['km_network_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['km_network_img2'], "style" => "width:280px;height:260px;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['km_network_img3']) && !empty($row['km_network_img3'])) {
            $outp .= img(array('src' => "upload/" . $row['km_network_img3'], "style" => "width:280px;height:260px;")) . nbs(5);
        }
        $outp .= "</td></tr>";
        $outp .= "</table>";
        $outp .= "</div></div>";
        echo $outp;
    }

    // บันทึกการปฏิบัติงานของบุคลากร
    public function employee_activities() {
        $data['hr'] = $this->My_model->get_where_order("tb_human_resources_01", array("hr_department" => $this->session->userdata("department")), "hr_thai_name asc");
        $data['rs'] = $this->My_model->join2table_where_result('tb_human_resources_01 a', 'tb_employee_activities b', 'b.hr_id = a.id', array('activities_department' => $this->session->userdata('department')), 'b.activities_date_record desc');
        $this->load->view("layout/header");
        $this->load->view("employee_activities/index", $data);
        $this->load->view("layout/footer");
    }

    //
    public function employee_activities_insert() {
        $id = $_POST['id'];
        if ($id != "") {
            $arr = array(
                "hr_id" => $this->input->post('inHrId'),
                "activities_date_record" => $this->input->post('inHrDateRecord'),
                "hr_activities" => $this->input->post("inHrActivities"),
                'activities_begin_date' => $this->input->post('inActivitiesBeginDate'),
                'activities_end_date' => $this->input->post('inActivitiesEndDate'),
                'activities_comment' => $this->input->post('inActivitiesComment'),
                "activities_recorder" => $this->session->userdata("name"),
                "activities_department" => $this->session->userdata('department')
            );
            $this->My_model->update_data("tb_employee_activities", array("id" => $id), $arr);
        } else {
            $arr = array(
                "hr_id" => $this->input->post('inHrId'),
                "activities_date_record" => $this->input->post('inHrDateRecord'),
                "hr_activities" => $this->input->post("inHrActivities"),
                'activities_begin_date' => $this->input->post('inActivitiesBeginDate'),
                'activities_end_date' => $this->input->post('inActivitiesEndDate'),
                'activities_comment' => $this->input->post('inActivitiesComment'),
                "activities_recorder" => $this->session->userdata("name"),
                "activities_department" => $this->session->userdata('department')
            );
            $this->My_model->insert_data("tb_employee_activities", $arr);
        }
    }

    // edit data
    public function employee_activities_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row("tb_human_resources_01 a", "tb_employee_activities b", "b.hr_id = a.id", array("b.id" => $id));
        echo json_encode($row);
    }

    // delete;
    public function employee_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_employee_activities", array("id" => $id));
    }

    // การพัฒนาบุคลากรทางการศึกษา
    public function hr_development() {
        $data["rs"] = $this->Hr_model->get_hr_dev();
        $this->load->view("layout/header");
        $this->load->view("hr_development/index", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function hr_dev_insert() {
        $id = $_POST['id'];
        if ($id != "") {
            // ถ้าเลือกไฟล์โครงการ
            if ($_FILES['inUpgradeProject']['name']) {
                $row = $this->My_model->get_where_row("tb_hr_upgrade", array("id" => $id));
                @unlink("upload/" . $row['upgrade_project']);
                //
                $config = array(
                    'upload_path' => 'upload/',
                    'allowed_types' => 'pdf',
                    'max_size' => 0,
                    'file_name' => md5(date('YmdHis'))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload('inUpgradeProject');
                $data = $this->upload->data();
                //
                $arr = array("upgrade_project" => $data['file_name']);
                $this->My_model->update_data("tb_hr_upgrade", array("id" => $id), $arr);
            }if ($_FILES['inUpgradeReport']['name']) {
                $row = $this->My_model->get_where_row("tb_hr_upgrade", array("id" => $id));
                @unlink("upload/" . $row['upgrade_report']);
                //
                $config = array(
                    'upload_path' => 'upload/',
                    'allowed_types' => 'pdf',
                    'max_size' => 0,
                    'file_name' => md5(date('YmdHis'))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload('inUpgradeReport');
                $data = $this->upload->data();
                //
                $arr = array("upgrade_report" => $data['file_name']);
                $this->My_model->update_data("tb_hr_upgrade", array("id" => $id), $arr);
            }
            //
            $arr = array(
                "upgrade_date" => $this->input->post("inUpgradeDate"),
                "upgrade_topic" => $this->input->post("inUpgradeTopic"),
                "upgrade_place" => $this->input->post("inUpgradePlace"),
                "upgrade_days" => $this->input->post("inUpgradeDays"),
                "upgrade_loan" => $this->input->post("inUpgradeLoan"),
                "upgrade_amount" => $this->input->post("inUpgradeAmount"),
                "upgrade_recorder" => $this->session->userdata("name"),
                "upgrade_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data("tb_hr_upgrade", array("id" => $id), $arr);
        } else {
            // เอกสารงานโครงการ
            if (!empty($_FILES["inUpgradeProject"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inUpgradeProject");
                $data = $this->upload->data();
                $project_file = $data['file_name'];
            } else {
                $project_file = "";
            }
            // รายงานสรุปผล
            if (!empty($_FILES["inUpgradeReport"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inUpgradeReport");
                $data = $this->upload->data();
                $report_file = $data['file_name'];
            } else {
                $report_file = "";
            }
            //
            $arr = array(
                "upgrade_date" => $this->input->post("inUpgradeDate"),
                "upgrade_topic" => $this->input->post("inUpgradeTopic"),
                "upgrade_place" => $this->input->post("inUpgradePlace"),
                "upgrade_days" => $this->input->post("inUpgradeDays"),
                "upgrade_loan" => $this->input->post("inUpgradeLoan"),
                "upgrade_amount" => $this->input->post("inUpgradeAmount"),
                "upgrade_project" => $project_file,
                "upgrade_report" => $report_file,
                "upgrade_recorder" => $this->session->userdata("name"),
                "upgrade_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data('tb_hr_upgrade', $arr);
        }
    }

    //
    public function hr_dev_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_hr_upgrade", array("id" => $id));
        echo json_encode($row);
    }

    //
    public function hr_dev_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_hr_upgrade", array("id" => $id));
        @unlink("upload/" . $row['upgrade_project']);
        @unlink("upload/" . $row['upgrade_report']);
        $this->My_model->delete_data("tb_hr_upgrade", array("id" => $id));
    }

    // พิมพ์ข้อมูล
    public function hr_dev_print() {
        // รวมระยะเวลา
        $data['days'] = $this->My_model->get_sum('tb_hr_upgrade', 'upgrade_days');
        // จำนวนตน
        $data['person'] = $this->My_model->get_sum('tb_hr_upgrade', 'upgrade_amount');
        // จำนวนเงิน
        $data['loan'] = $this->My_model->get_sum('tb_hr_upgrade', 'upgrade_loan');
        $data['rs'] = $this->My_model->get_all_order('tb_hr_upgrade', 'upgrade_date asc');
        $this->load->view('hr_development/reports/hr_upgrade_report', $data);
    }

    // การส่งเสริมยกย่องเชิดชูเกียรติฯ
    public function hr_give_up() {
        $data['hr'] = $this->My_model->get_where_order('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')), 'hr_thai_name asc');
        $data['rs'] = $this->Management_model->get_give_up();
        $this->load->view("layout/header");
        $this->load->view("hr_give_up/index", $data);
        $this->load->view("layout/footer");
    }

    // add data;
    public function hr_give_up_add() {
        $id = $_POST['id'];

        if ($id != '') {
            if (!empty($_FILES["inGiveUpDocument"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpDocument");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $arr = array('give_up_document' => $data['file_name']);
                $this->My_model->update_data('tb_hr_give_up', array('id' => $id), $arr);
            }
            //
            if (!empty($_FILES["inGiveUpImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $arr = array('give_up_image1' => $data['file_name']);
                $this->My_model->update_data('tb_hr_give_up', array('id' => $id), $arr);
            }
            //
            if (!empty($_FILES["inGiveUpImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $arr = array('give_up_image2' => $data['file_name']);
                $this->My_model->update_data('tb_hr_give_up', array('id' => $id), $arr);
            }
            //
            if (!empty($_FILES["inGiveUpImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $arr = array('give_up_image3' => $data['file_name']);
                $this->My_model->update_data('tb_hr_give_up', array('id' => $id), $arr);
            }
            $arr = array(
                'give_up_date' => $this->input->post('inGiveUpDate'),
                'give_up_topic' => $this->input->post('inGiveUpTopic'),
                'give_up_office' => $this->input->post('inGiveUpOffice'),
                'give_up_comment' => $this->input->post('inGiveUpComment'),
                'give_up_recorder' => $this->session->userdata('name'),
                'give_up_department' => $this->session->userdata('department')
            );

            $this->My_model->update_data('tb_hr_give_up', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inGiveUpDocument"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpDocument");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $doc = $data['file_name'];
            } else {
                $doc = "";
            }
            //
            if (!empty($_FILES["inGiveUpImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
            } else {
                $img1 = "";
            }
            //
            if (!empty($_FILES["inGiveUpImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img2 = $data['file_name'];
            } else {
                $img2 = "";
            }
            //
            if (!empty($_FILES["inGiveUpImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inGiveUpImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img3 = $data['file_name'];
            } else {
                $img3 = "";
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('inHrId'),
                'give_up_date' => $this->input->post('inGiveUpDate'),
                'give_up_topic' => $this->input->post('inGiveUpTopic'),
                'give_up_office' => $this->input->post('inGiveUpOffice'),
                'give_up_document' => $doc,
                'give_up_image1' => $img1,
                'give_up_image2' => $img2,
                'give_up_image3' => $img3,
                'give_up_comment' => $this->input->post('inGiveUpComment'),
                'give_up_recorder' => $this->session->userdata('name'),
                'give_up_department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data('tb_hr_give_up', $arr);
        }
    }

    // update data;
    public function hr_give_up_edit() {
        $id = $_POST['id'];
        $row = $this->Management_model->get_give_up_row($id);
        echo json_encode($row);
    }

    // delete data;
    public function hr_give_up_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_hr_give_up', array('id' => $id));
        @unlink('upload/' . $row['give_up_document']);
        @unlink('upload/' . $row['give_up_image1']);
        @unlink('upload/' . $row['give_up_image2']);
        @unlink('upload/' . $row['give_up_image3']);
        $this->My_model->delete_data('tb_hr_give_up', array('id' => $id));
    }

}
