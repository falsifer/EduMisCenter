<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Accessories
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     คลังแบบฟอร์มเอกสารต่าง ๆ
  | Author	นายบัณฑิต ไชยดี
  | Create Date 19/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Accessories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Accessories_model");
    }

    // คลังแบบฟอร์ม,เอกสารต่าง ๆ
    public function documents_stock() {
        $data['doc_type'] = $this->My_model->get_all_order("tb_document_type", "document_type asc");
        $data['rs'] = $this->My_model->join2table_result('tb_document_type a', 'tb_document_stock b', 'b.document_type_id = a.id', 'b.doc_in_date desc, doc_name asc');
        $this->load->view("layout/header");
        $this->load->view("accessories/documents_stock", $data);
        $this->load->view("layout/footer");
    }

    // insert documents;
    public function document_stock_insert() {
        $id = $_POST['id'];
        if ($id != "") {
            if ($_FILES['inDocFile']['name'] != '') {
                $row = $this->My_model->get_where_row("tb_document_stock", array("id" => $id));
                @unlink("upload/" . $row['doc_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx|xls|xlsx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inDocFile");
                $data = $this->upload->data();
                $arr = array("doc_file" => $data['file_name']);
                $this->My_model->update_data("tb_document_stock", array("id" => $id), $arr);
            }
            //
            $arr = array(
                "document_type_id" => $this->input->post('inDocumentTypeId'),
                "doc_in_date" => $this->input->post('inDocInDate'),
                "doc_name" => $this->input->post('inDocumentsName'),
                "doc_comment" => $this->input->post('inDocComment'),
                "doc_owner" => $this->input->post('inDocOwner'),
                "doc_recorder" => $this->session->userdata("name"),
                "doc_responsible" => $this->session->userdata("responsible"),
                "doc_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data("tb_document_stock", array("id" => $id), $arr);
        } else {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inDocFile");
            $data = $this->upload->data();
            $arr = array(
                "document_type_id" => $this->input->post('inDocumentTypeId'),
                "doc_in_date" => $this->input->post('inDocInDate'),
                "doc_name" => $this->input->post('inDocumentsName'),
                "doc_file" => $data['file_name'],
                "doc_comment" => $this->input->post('inDocComment'),
                "doc_owner" => $this->input->post('inDocOwner'),
                "doc_recorder" => $this->session->userdata("name"),
                "doc_responsible" => $this->session->userdata("responsible"),
                "doc_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_document_stock", $arr);
        }
    }

    // edit
    public function document_stock_update() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_document_type a', "tb_document_stock b", "b.document_type_id = a.id", array("b.id" => $id));
        echo json_encode($row);
    }

    // delete
    public function document_stock_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_document_stock", array("id" => $id));
        @unlink("upload/" . $row['doc_file']);
        $this->My_model->delete_data("tb_document_stock", array("id" => $id));
    }

    #====================================================================
    #
    # คลังภาพสำนักงาน 
    # 
    #====================================================================
    // 

    public function picture_stock() {
        $data['rs'] = $this->My_model->get_where_order('tb_picture_stock', array('picture_owner' => $this->session->userdata('name')), 'picture_name asc');
        $this->load->view("layout/header");
        $this->load->view("accessories/picture_stock", $data);
        $this->load->view("layout/footer");
    }

    // insert picture;
    public function insert_picture() {
        $id = $_POST['id'];
        if ($id != "") {
            if ($_FILES['inPictureFile']['name'] != '') {
                $row = $this->My_model->get_where_row("tb_picture_stock", array("id" => $id));
                @unlink("upload/" . $row['picture_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPictureFile");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                //
                $arr = array(
                    "picture_name" => $this->input->post("inPictureName"),
                    "picture_file" => $data['file_name'],
                    "picture_comment" => $this->input->post("inPictureComment"),
                );
                $this->My_model->update_data('tb_picture_stock', array('id' => $id), $arr);
            }
        } else {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inPictureFile");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $arr = array(
                "picture_name" => $this->input->post("inPictureName"),
                "picture_file" => $data['file_name'],
                "picture_comment" => $this->input->post("inPictureComment"),
                "picture_owner" => $this->session->userdata("name"),
                "picture_responsible" => $this->session->userdata('responsible'),
                'picture_department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data("tb_picture_stock", $arr);
        }
    }

    // edit picture stock
    public function edit_picture() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_picture_stock", array("id" => $id));
        echo json_encode($row);
    }

    // delete picture
    public function delete_picture() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_picture_stock", array("id" => $id));
        @unlink("upload/" . $row['picture_file']);
        $this->My_model->delete_data('tb_picture_stock', array('id' => $id));
    }

    #====================================================================
    #
    # สารบรรณอิเลคทรอนิกส์ (edoc)
    # 
    #====================================================================
    //     

    public function edoc() {
        $data['rs'] = $this->Accessories_model->get_edoc();
        $this->load->view("layout/header");
        $this->load->view("edoc/index", $data);
        $this->load->view("layout/footer");
    }

    // Inbox
    public function inbox() {
        if ($this->session->userdata('status') == "") {
            redirect('login');
        }
        $data['rs'] = $this->My_model->get_where_order("tb_edoc_outbox", array("outbox_send_to" => $this->session->userdata('department')), "outbox_date ASC");
        $this->load->view("layout/header");
        $this->load->view('edoc/inbox', $data);
        $this->load->view("layout/footer");
    }

    // Outbox
    public function outbox() {
        if ($this->session->userdata('status') == "") {
            redirect('login');
        }
        $data['school'] = $this->My_model->get_where_order("tb_school", array('sc_thai_name !=' => $this->session->userdata('department')), "sc_thai_name asc");
        $data['department'] = $this->My_model->get_where_order("tb_inside_office", array('inside_office !=' => $this->session->userdata('department')), "inside_office asc");
        $data['rs'] = $this->My_model->get_where_order("tb_edoc_outbox", array("outbox_department" => $this->session->userdata("department")), "outbox_date desc");
        $this->load->view("layout/header");
        $this->load->view('edoc/outbox', $data);
        $this->load->view("layout/footer");
    }

    // send document (insert to mysql);
    public function outbox_send() {
        $id = $_POST['id'];
        if ($id != '') {
            if ($_FILES['inOutboxFile']['name'] != '') {
                $row = $this->My_model->get_where_row('tb_edoc_outbox', array('id' => $id));
                @unlink('upload/' . $row['outbox_file']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inOutboxFile");
                $data = $this->upload->data();
                $arr = array('outbox_file' => $data['file_name']);
                $this->My_model->update_data('tb_edoc_outbox', array('id' => $id), $arr);
            }
            //
            $arr = array(
                "outbox_date" => $this->input->post("inOutboxDate"),
                "outbox_send_no" => $this->input->post("inOutboxSendNo"),
                "outbox_topic" => $this->input->post("inOutboxTopic"),
                "outbox_attach" => $this->input->post("inOutboxAttach"),
                "outbox_detail" => $this->input->post("inOutboxDetail"),
                "outbox_level" => $this->input->post("inOutboxLevel"),
                "outbox_owner" => $this->session->userdata("name"),
                "outbox_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data('tb_edoc_outbox', array('id' => $id), $arr);
        } else {
            $school = $this->input->post('inOutboxSendTo');
            for ($i = 0; $i < count($school); $i++) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inOutboxFile");
                $data = $this->upload->data();
                $arr = array(
                    "outbox_date" => $this->input->post("inOutboxDate"),
                    "outbox_send_no" => $this->input->post("inOutboxSendNo"),
                    "outbox_send_to" => $school[$i],
                    "outbox_topic" => $this->input->post("inOutboxTopic"),
                    "outbox_attach" => $this->input->post("inOutboxAttach"),
                    "outbox_detail" => $this->input->post("inOutboxDetail"),
                    "outbox_level" => $this->input->post("inOutboxLevel"),
                    "outbox_file" => $data['file_name'],
                    "outbox_owner" => $this->session->userdata("name"),
                    "outbox_department" => $this->session->userdata("department")
                );
                $this->My_model->insert_data('tb_edoc_outbox', $arr);
            }
        }
    }

    // edit data;
    public function outbox_send_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_edoc_outbox', array('id' => $id));
        echo json_encode($row);
    }

    // ลบหนังสือรับ-ส่ง
    public function outbox_send_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_edoc_outbox", array("id" => $id));
        @unlink("upload/" . $row['outbox_file']);
        $this->My_model->delete_data("tb_edoc_outbox", array("id" => $id));
    }

}
