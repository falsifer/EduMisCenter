<?php

class Roadstock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // นับจำนวนเรคคอร์ดโดยขึ้นอยู่กับผู้เข้าใช้งานระบบ
    public function count_rows_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->where("owner", $this->session->userdata("office_name"));
            return $this->db->from("tb_roadstock")->count_all_results();
            //
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    return $this->db->from("tb_roadstock")->count_all_results();
                    //
                } else {
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    return $this->db->from("tb_roadstock")->count_all_results();
                    //
                }
            } else {
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                return $this->db->from("tb_roadstock")->count_all_results();
                //
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            return $this->db->from("tb_roadstock")->count_all_results();
            //
        } else {
            return $this->db->from("tb_roadstock")->count_all_results();
            //
        }
    }

    // ดึงข้อมูลทั้งหมดจาก tb_roadstock และทำการแบ่งหน้า (session)
    function get_road_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $this->db->order_by("road_id asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $this->db->order_by("road_id asc");
                    $query = $this->db->get();
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                    //
                } else {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $this->db->order_by("road_id asc");
                    $query = $this->db->get();
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                    //
                }
            } else {
                $this->db->select("*")->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $this->db->order_by("road_id asc");
                $query = $this->db->get();
                if ($query->num_rows() != 0) {
                    return $query->result_array();
                }
                return array();
                //
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $this->db->order_by("province asc, road_id asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        } else {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->order_by("drr_buero asc, drr_office asc, road_id asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        }
    }

    // ดึงข้อมูลสายทางตาม session ไม่มีการแบ่งหน้า
    public function get_road_not_divide_page() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return array();
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $this->db->order_by("road_id ASC");
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    }
                    return array();
                } else {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $this->db->order_by("road_id ASC");
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    }
                    return array();
                }
            } else {
                $this->db->select("*")->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $this->db->order_by("road_id ASC");
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                return array();
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return array();
        } else {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return array();
        }
    }

    // หาความยาวตลอดสายทาง
    public function get_road_long_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select_sum("road_long");
            $this->db->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select_sum("road_long");
                    $this->db->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                } else {
                    $this->db->select_sum("road_long");
                    $this->db->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                }
            } else {
                $this->db->select_sum("road_long");
                $this->db->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                }
                return 0;
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select_sum("road_long")->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } else {
            $this->db->select_sum("road_long");
            $this->db->from("tb_roadstock");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        }
    }

    // หาความยาวของชนิดผว AC (session)
    public function get_road_ac_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select_sum("road_ac");
            $this->db->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select_sum("road_ac");
                    $this->db->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                } else {
                    $this->db->select_sum("road_ac");
                    $this->db->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                }
            } else {
                $this->db->select_sum("road_ac");
                $this->db->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                }
                return 0;
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select_sum("road_ac");
            $this->db->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } else {
            $this->db->select_sum("road_ac");
            $this->db->from("tb_roadstock");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        }
    }

    // หาความยาวชนิดผว CS (session)
    public function get_road_cs_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select_sum("road_cs");
            $this->db->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select_sum("road_cs");
                    $this->db->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                } else {
                    $this->db->select_sum("road_cs");
                    $this->db->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                }
            } else {
                $this->db->select_sum("road_cs");
                $this->db->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                }
                return 0;
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select_sum("road_cs");
            $this->db->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } else {
            $this->db->select_sum("road_cs");
            $this->db->from("tb_roadstock");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        }
    }

    // หาความยาวชนิดลูกรัง (session)
    public function get_road_lat_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select_sum("road_lat");
            $this->db->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select_sum("road_lat");
                    $this->db->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                } else {
                    $this->db->select_sum("road_lat");
                    $this->db->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                }
            } else {
                $this->db->select_sum("road_lat");
                $this->db->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                }
                return 0;
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select_sum("road_lat");
            $this->db->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } else {
            $this->db->select_sum("road_lat");
            $this->db->from("tb_roadstock");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        }
    }

    // หาความยาวชนิดคอนกรีต (session)
    public function get_road_concrete_with_session() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select_sum("road_concrete");
            $this->db->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select_sum("road_concrete");
                    $this->db->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                } else {
                    $this->db->select_sum("road_concrete");
                    $this->db->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        return $query->row_array();
                    }
                    return 0;
                }
            } else {
                $this->db->select_sum("road_concrete");
                $this->db->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                }
                return 0;
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select_sum("road_concrete");
            $this->db->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        } else {
            $this->db->select_sum("road_concrete");
            $this->db->from("tb_roadstock");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return 0;
        }
    }

    // รายงานโครงข่ายทางหลวงชนบท
    public function get_roadstock_report() {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("owner", $this->session->userdata("office_name"));
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("drr_office", $this->session->userdata("drr_office"));
                    $this->db->order_by("road_id ASC");
                    $query = $this->db->get();
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                    //
                } else {
                    $this->db->select("*")->from("tb_roadstock");
                    $this->db->where("owner", $this->session->userdata("office_name"));
                    $this->db->order_by("road_id ASC");
                    $query = $this->db->get();
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                    // 
                }
            } else {
                $this->db->select("*")->from("tb_roadstock");
                $this->db->where("drr_office", $this->session->userdata("drr_office"));
                $this->db->order_by("road_id ASC");
                $query = $this->db->get();
                if ($query->num_rows() != 0) {
                    return $query->result_array();
                }
                return array();
                // 
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        } else {
            $this->db->select("*")->from("tb_roadstock");
            $this->db->order_by("road_id ASC");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        }
    }

    // ค้นหาข้อมูลสายทางตามคำค้น
    public function roadstock_search($search) {
        if ($this->session->userdata("office_type") == "หมวดบำรุงทางหลวงชนบท") {
            $q = "SELECT * FROM tb_roadstock WHERE owner = '{$this->session->userdata("office_name")}' && (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                    . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%') ORDER BY road_id asc";
            $query = $this->db->query($q);
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
        } elseif ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                if ($this->session->userdata("responsible") == "งานตั้งหน่วยชั่งน้ำหนักยานพาหนะ") {
                    $q = "SELECT * FROM tb_roadstock WHERE drr_office = '{$this->session->userdata("drr_office")}' && (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                            . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%' OR owner LIKE '%$search%') ORDER BY road_id asc";
                    $query = $this->db->query($q);
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                } else {
                    $q = "SELECT * FROM tb_roadstock WHERE owner = '{$this->session->userdata("office_name")}' && (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                            . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%') ORDER BY road_id asc";
                    $query = $this->db->query($q);
                    if ($query->num_rows() != 0) {
                        return $query->result_array();
                    }
                    return array();
                    //
                }
            } else {
                $q = "SELECT * FROM tb_roadstock WHERE drr_office = '{$this->session->userdata("drr_office")}' && (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                        . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%' OR owner LIKE '%$search%') ORDER BY road_id asc";
                $query = $this->db->query($q);
                if ($query->num_rows() != 0) {
                    return $query->result_array();
                }
                return array();
            }
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $q = "SELECT * FROM tb_roadstock WHERE drr_buero = '{$this->session->userdata("drr_buero")}' && (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                    . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%' OR drr_office LIKE '%$search%' OR owner LIKE '%$search%') ORDER BY road_id asc";
            $query = $this->db->query($q);
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        } else {
            $q = "SELECT * FROM tb_roadstock WHERE (road_id LIKE '%$search%' OR road_name LIKE '%$search%' OR village LIKE '%$search%' "
                    . "OR tambon LIKE '%$search%' OR amphur LIKE '%$search%' OR province LIKE '%$search%' OR drr_buero LIKE '%$search%' OR drr_office LIKE '%$search%' OR owner LIKE '%$search%' ) ORDER BY road_id asc";
            $query = $this->db->query($q);
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
            //
        }
    }

    // หาจำนวนสายทางทั้งหมดที่เข้า QA 
    public function drr_buero_qa($buero) {
        $this->db->select("b.road_id")->from("tb_roadstock a");
        $this->db->join("tb_illegal_all b", "b.road_id = a.road_id");
        $this->db->where("a.drr_buero", $buero);
        $this->db->group_by("a.road_id");
        $query = $this->db->get();
        return $query->num_rows();
        die();
    }

    // ดึงข้อมูลสายทางตามสำนักงานทางหลวงชนบท
    public function get_road_qa() {
        if ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            // ระดับแขวง เลือกข้อมูลหมวดฯ
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            // ระดับสำนักงานฯ เลือกข้อมูลแขวง
        } else {
            // ในระดับกรมเลือกข้อมูลรายสำนักงาน
            $this->db->select("a.*, b.*, COUNT(b.road_id) AS count_road, COUNT(b.road_id) AS illegal_road")->from("tb_drr_office a");
            $this->db->join("tb_roadstock b", "b.drr_buero = a.office_name");
            $this->db->where("a.office_type", "สำนักงานทางหลวงชนบท");
            $this->db->group_by("b.drr_buero")->group_by("b.road_id");
            $this->db->order_by("a.office_index asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
        }
    }

    // ดึงรายชื่อเจ้าของหน่วยงานตาม session;
    public function get_owner_in_session() {
        if ($this->session->userdata("office_type") == "แขวงทางหลวงชนบท") {
            $this->db->select("owner")->from("tb_roadstock");
            $this->db->where("drr_office", $this->session->userdata("drr_office"));
            $this->db->group_by("owner")->order_by("owner asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
        } elseif ($this->session->userdata("office_type") == "สำนักงานทางหลวงชนบท") {
            $this->db->select("owner")->from("tb_roadstock");
            $this->db->where("drr_buero", $this->session->userdata("drr_buero"));
            $this->db->group_by("owner")->order_by("owner asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
        } else {
            $this->db->select("owner")->from("tb_roadstock");
            $this->db->group_by("owner")->order_by("owner asc");
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->result_array();
            }
            return array();
        }
    }
}
