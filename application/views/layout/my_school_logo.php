<?php
$rs = $this->db->select("*")->from("tb_school")->where("sc_thai_name", $this->session->userdata('department'))->get()->row_array();
if ($rs['sc_logo'] != "") {
    $logo = 'upload/' . $rs['sc_logo'];
} else {
    $logo = 'images/icon/kmitl-logo.png';
}
?>
<div style='width:100%;height: 70px;padding: 10px;'>
    <div style='width:100%;margin: 0px 10px 0px 10px;'>
        <div style='width: 30%;float: left;'>
            <img src="<?php echo base_url() . $logo; ?>" style='height:60px;'/>
        </div>
        <div style='width: 50%;float: right;text-align:right;'>
            <span style="color:#999999;font-size:0.8em;"><?php echo $rs['sc_thai_name']; ?> </span>
    <!--        <p style="color:#999999;font-size:0.8em;">วันที่ <?php echo datethaifull(date('Y-m-d')); ?></p>-->
        </div>
    </div> 
</div>
<hr/>

