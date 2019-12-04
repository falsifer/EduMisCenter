<?php

//---------------------------------------------+
function datethaifull($date) {
    $day = substr("$date", 8, 2);
    $month = substr("$date", 5, 2);
    $month = (int) $month - 1;
    $year = substr("$date", 0, 4);
    if ((($year + 543) < (date('Y') + 543)) || (($year + 543) == (date('Y') + 543))) {
        $year = $year + 543;
    }
    $thaimonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $month = $thaimonth[$month];
    return (int) $day . str_repeat(" ", 3) . $month . str_repeat(" ", 3) . "พ.ศ. " . substr($year, 0, 4);
}

//---------------------------------------------+
function datethai($date) {
    $day = substr("$date", 8, 2);
    $month = substr("$date", 5, 2);
    $month = (int) $month - 1;
    $year = substr("$date", 0, 4);
    if ((($year + 543) < (date('Y') + 543)) || (($year + 543) == (date('Y') + 543))) {
        $year = $year + 543;
    }
    $thaimonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $month = $thaimonth[$month];
    return (int) $day . " " . $month . "  " . substr($year, 0, 4);
}

//---------------------------------------------+
function shortdate($date) {
    $day = substr("$date", 8, 2);
    $month = substr("$date", 5, 2);
    $month = (int) $month - 1;
    $year = substr("$date", 0, 4);
    if ((($year + 543) < (date('Y') + 543)) || (($year + 543) == (date('Y') + 543))) {
        $year = $year + 543;
    }
    $thaimonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $month = $thaimonth[$month];
    return (int) $day . " " . $month . "  " . substr($year, 2, 2);
}

// แปลงจากตัวเลขเป็นชื่อเดือน (ภาษาไทย)
function month_num($month_num) {
    switch ($month_num) {
        case 1:
            $month_cap = "มกราคม";
            break;
        case 2:
            $month_cap = "กุมภาพันธ์";
            break;
        case 3:
            $month_cap = "มีนาคม";
            break;
        case 4:
            $month_cap = "เมษายน";
            break;
        case 5:
            $month_cap = "พฤษภาคม";
            break;
        case 6:
            $month_cap = "มิถุนายน";
            break;
        case 7:
            $month_cap = "กรกฎาคม";
            break;
        case 8:
            $month_cap = "สิงหาคม";
            break;
        case 9:
            $month_cap = "กันยายน";
            break;
        case 10:
            $month_cap = "ตุลาคม";
            break;
        case 11:
            $month_cap = "พฤศจิกายน";
            break;
        default:
            $month_cap = "ธันวาคม";
            break;
    }
    return $month_cap;
}

// แปลงจากตัวเลขเป็นชื่อเดือน (ภาษาไทย)
function week_short_num($week_num, $local) {
    switch ($week_num) {
        case 1:
            if ($local == 'TH') {
                $week_num = "จ.";
            } else {
                $week_num = "mon";
            }
            break;
        case 2:
            if ($local == 'TH') {
                $week_num = "อ.";
            } else {
                $week_num = "tue";
            }
            break;
        case 3:
            if ($local == 'TH') {
                $week_num = "พ.";
            } else {
                $week_num = "wed";
            }
            break;
        case 4:
            if ($local == 'TH') {
                $week_num = "พฤ.";
            } else {
                $week_num = "thu";
            }
            break;
        case 5:
            if ($local == 'TH') {
                $week_num = "ศ.";
            } else {
                $week_num = "fri";
            }
            break;
        case 6:
            if ($local == 'TH') {
                $week_num = "ส.";
            } else {
                $week_num = "sat";
            }
            break;
        case 7:
            if ($local == 'TH') {
                $week_num = "อา.";
            } else {
                $week_num = "sun";
            }
            break;
    }
    return $week_num;
}

function datediff($edate, $bdate) {
    return (strtotime($edate) - strtotime($bdate)) / ( 60 * 60 * 24 );  // 1 day = 60*60*24
}

// ฟังก์ชั่นแสดงปีงบประมาณตามระบบปีงบประมาณราชการไทย
function loan_year($year) {
    if (($year == date("Y")) && (date("m") == 10 || date("m") == 11 || date("m") == 12)) {
        $year++;
        return ($year + 543);
    } else {
        return ($year + 543);
    }
//
}

// แปลงเลขอารบิกเป็นเลขไทย
function thaidigit($num) {
    return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}

// แปลงเลขเดือนเป็นตัวอักษรเดือน
function month_text($month) {
    return str_replace(array('10', '11', '12', '01', '02', '03', '04', '05', '06', '07', '08', '09'), array('ตุลาคม', 'พฤศจิกายน', 'ธันวาคม', "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน"), $month);
}

// แปลงค่า array key เป็นเดือน (เริ่ม ต.ค. - ก.ย.)
function array_month($key) {
    switch ($key) {
        case "0":
            $month_char = "ตุลาคม";
            break;
        case "1":
            $month_char = "พฤศจิกายน";
            break;
        case "2":
            $month_char = "ธันวาคม";
            break;
        case "3":
            $month_char = "มกราคม";
            break;
        case "4":
            $month_char = "กุมภาพันธ์";
            break;
        case "5":
            $month_char = "มีนาคม";
            break;
        case "6":
            $month_char = "เมษายน";
            break;
        case "7":
            $month_char = "พฤษภาคม";
            break;
        case "8":
            $month_char = "มิถุนายน";
            break;
        case "9":
            $month_char = "กรกฎาคม";
            break;
        case "10":
            $month_char = "สิงหาคม";
            break;
        case "11":
            $month_char = "กันยายน";
            break;
    }
    return $month_char;
}

// แปลงเงินจากตัวเลขเป็นตัวอักษร

function convert($number) {
    $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $number = str_replace(",", "", $number);
    $number = str_replace(" ", "", $number);
    $number = str_replace("บาท", "", $number);
    $number = explode(".", $number);
    if (sizeof($number) > 2) {
        return 'ทศนิยมหลายตัวนะจ๊ะ';
        exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for ($i = 0; $i < $strlen; $i++) {
        $n = substr($number[0], $i, 1);
        if ($n != 0) {
            if ($i == ($strlen - 1) AND $n == 1) {
                $convert .= 'เอ็ด';
            } elseif ($i == ($strlen - 2) AND $n == 2) {
                $convert .= 'ยี่';
            } elseif ($i == ($strlen - 2) AND $n == 1) {
                $convert .= '';
            } else {
                $convert .= $txtnum1[$n];
            }
            $convert .= $txtnum2[$strlen - $i - 1];
        }
    }

    $convert .= 'บาท';
    if (sizeof($number) > 1) {
        if ($number[1] == '0' OR $number[1] == '00' OR
                $number[1] == '') {
            $convert .= 'ถ้วน';
        } else {
            $strlen = strlen($number[1]);
            for ($i = 0; $i < $strlen; $i++) {
                $n = substr($number[1], $i, 1);
                if ($n != 0) {
                    if ($i == ($strlen - 1) AND $n == 1) {
                        $convert .= 'เอ็ด';
                    } elseif ($i == ($strlen - 2) AND
                            $n == 2) {
                        $convert .= 'ยี่';
                    } elseif ($i == ($strlen - 2) AND
                            $n == 1) {
                        $convert .= '';
                    } else {
                        $convert .= $txtnum1[$n];
                    }
                    $convert .= $txtnum2[$strlen - $i - 1];
                }
            }
            $convert .= 'สตางค์';
        }
    } else {
        $convert .= 'ถ้วน';
    }
    return $convert;
}

// add day with date;
function AddDayWithDate($date, $days) {
    $date = strtotime("+" . $days . " days", strtotime($date));
    return date("Y-m-d", $date);
}

/*
  ## วิธีใช้งาน
  $x = '9123568543241.25';
  echo  $x  . "=>" .convert($x);
 *
 */

// เปลี่ยนชื่อสายทางยาว ๆ ลดให้สั้นลงโดยเปลี่ยนจาก แยกทางหลวงหมายเลข เป็น แยก ทล.
function road_short_name($name) {
    return str_replace(array("แยกทางหลวงหมายเลข", "แยกทางหลวงชนบท"), array("แยก ทล.", "แยก ทช."), $name);
}

// เปลี่ยนชื่ออำเภอยาวให้สั้นลง
function amphur_short_name($amphur) {
    return str_replace("อำเภอ", "อ.", $amphur);
}

// เปลี่ยนชื่อจังหวัดยาวให้สั้น
function province_short_name($province) {
    return str_replace(array("พระนครศรีอยุธยา", "กรุงเทพมหานคร"), array("อยุธยา", "กทม."), $province);
}

// อักขระพิเศษ
function em($word) {
    $word = str_replace("@", "%40", $word);
    $word = str_replace("`", "%60", $word);
    $word = str_replace("¢", "%A2", $word);
    $word = str_replace("£", "%A3", $word);
    $word = str_replace("¥", "%A5", $word);
    $word = str_replace("|", "%A6", $word);
    $word = str_replace("«", "%AB", $word);
    $word = str_replace("¬", "%AC", $word);
    $word = str_replace("¯", "%AD", $word);
    $word = str_replace("º", "%B0", $word);
    $word = str_replace("±", "%B1", $word);
    $word = str_replace("ª", "%B2", $word);
    $word = str_replace("µ", "%B5", $word);
    $word = str_replace("»", "%BB", $word);
    $word = str_replace("¼", "%BC", $word);
    $word = str_replace("½", "%BD", $word);
    $word = str_replace("¿", "%BF", $word);
    $word = str_replace("À", "%C0", $word);
    $word = str_replace("Á", "%C1", $word);
    $word = str_replace("Â", "%C2", $word);
    $word = str_replace("Ã", "%C3", $word);
    $word = str_replace("Ä", "%C4", $word);
    $word = str_replace("Å", "%C5", $word);
    $word = str_replace("Æ", "%C6", $word);
    $word = str_replace("Ç", "%C7", $word);
    $word = str_replace("È", "%C8", $word);
    $word = str_replace("É", "%C9", $word);
    $word = str_replace("Ê", "%CA", $word);
    $word = str_replace("Ë", "%CB", $word);
    $word = str_replace("Ì", "%CC", $word);
    $word = str_replace("Í", "%CD", $word);
    $word = str_replace("Î", "%CE", $word);
    $word = str_replace("Ï", "%CF", $word);
    $word = str_replace("Ð", "%D0", $word);
    $word = str_replace("Ñ", "%D1", $word);
    $word = str_replace("Ò", "%D2", $word);
    $word = str_replace("Ó", "%D3", $word);
    $word = str_replace("Ô", "%D4", $word);
    $word = str_replace("Õ", "%D5", $word);
    $word = str_replace("Ö", "%D6", $word);
    $word = str_replace("Ø", "%D8", $word);
    $word = str_replace("Ù", "%D9", $word);
    $word = str_replace("Ú", "%DA", $word);
    $word = str_replace("Û", "%DB", $word);
    $word = str_replace("Ü", "%DC", $word);
    $word = str_replace("Ý", "%DD", $word);
    $word = str_replace("Þ", "%DE", $word);
    $word = str_replace("ß", "%DF", $word);
    $word = str_replace("à", "%E0", $word);
    $word = str_replace("á", "%E1", $word);
    $word = str_replace("â", "%E2", $word);
    $word = str_replace("ã", "%E3", $word);
    $word = str_replace("ä", "%E4", $word);
    $word = str_replace("å", "%E5", $word);
    $word = str_replace("æ", "%E6", $word);
    $word = str_replace("ç", "%E7", $word);
    $word = str_replace("è", "%E8", $word);
    $word = str_replace("é", "%E9", $word);
    $word = str_replace("ê", "%EA", $word);
    $word = str_replace("ë", "%EB", $word);
    $word = str_replace("ì", "%EC", $word);
    $word = str_replace("í", "%ED", $word);
    $word = str_replace("î", "%EE", $word);
    $word = str_replace("ï", "%EF", $word);
    $word = str_replace("ð", "%F0", $word);
    $word = str_replace("ñ", "%F1", $word);
    $word = str_replace("ò", "%F2", $word);
    $word = str_replace("ó", "%F3", $word);
    $word = str_replace("ô", "%F4", $word);
    $word = str_replace("õ", "%F5", $word);
    $word = str_replace("ö", "%F6", $word);
    $word = str_replace("÷", "%F7", $word);
    $word = str_replace("ø", "%F8", $word);
    $word = str_replace("ù", "%F9", $word);
    $word = str_replace("ú", "%FA", $word);
    $word = str_replace("û", "%FB", $word);
    $word = str_replace("ü", "%FC", $word);
    $word = str_replace("ý", "%FD", $word);
    $word = str_replace("þ", "%FE", $word);
    $word = str_replace("ÿ", "%FF", $word);
    return $word;
}

// เติม 0 น้ำหน้าตัวเลข (ทั้งหมด 4 ตำแหน่ง
function insert_zero($number) {
    if (strlen($number) == 1) {
        return "000" . $number;
    } elseif (strlen($number) == 2) {
        return "00" . $number;
    } elseif (strlen($number) == 3) {
        return "0" . $number;
    } else {
        return $number;
    }
}

// เติม 0 น้ำหน้าตัวเลข (ทั้งหมด $pos ตำแหน่ง)
function insert_zero_f_position($number, $pos) {

    $cnt = strlen($number);
    $str = $number;
    for ($i = 0; $i < ($pos - $cnt); $i++) {
        $str = "0" . $str;
    }

    return $str;
}

// เพิ่มจำนวนวันจากวันที่กำหนด (จะได้วันที่ออกมา)
function add_day($date, $days) {
    return date('Y-m-d', (strtotime($days . ' day', strtotime($date))));
}

// นับตัวอักษาแบบ utf-8
function utf8_strlen($str) {
    $c = strlen($str);
    $l = 0;
    for ($i = 0; $i < $c; ++$i) {
        if ((ord($str[$i]) & 0xC0) != 0x80) {
            ++$l;
        }
    }
    return $l;
}

// ค้นหาข้อมูลตามคำค้น
function text_search($action) {
    ?>
    <span class="pull-right">
        <?php echo form_open($action, array("class" => "navbar-form", "role" => "form")); ?>
        <div class="input-group">
            <?php echo form_input(array("type" => "text", "name" => "txtSearch", "class" => "form-control", "style" => "width:320px;", "placeholder" => "ระบุคำค้น...", "required" => "required")); ?>
            <div class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i> ค้นหา</button>
            </div>
        </div>
        <?php echo form_hidden("current_page", current_url()); ?>
        <?php echo form_close(); ?>
    </span>
    <?php
}

// รับค่าเดือนและส่งกลับ--่> เดือน+ปี
function month_with_year($month) {
    switch ($month) {
        case "ตุลาคม":
            return $month . ' ' . (loan_year(date("Y")) - 1);
            break;
        case "พฤศจิกายน":
            return $month . ' ' . (loan_year(date("Y")) - 1);
            break;
        case "ธันวาคม":
            return $month . ' ' . (loan_year(date("Y")) - 1);
            break;
        case "มกราคม":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "กุมภาพันธ์":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "มีนาคม":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "เมษายน":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "พฤษภาคม":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "มิถุนายน":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "กรกฎาคม":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "สิงหาคม":
            return $month . ' ' . loan_year(date("Y"));
            break;
        case "กันยายน":
            return $month . ' ' . loan_year(date("Y"));
            break;
    }
}

// function resize and create image thumbnail
function resizeImage($filename) {
    $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
    $config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => $target_path,
        'maintain_ratio' => TRUE,
        'create_thumb' => TRUE,
        'thumb_marker' => '_thumb',
        'width' => 150,
        'height' => 150
    );


    $this->load->library('image_lib', $config_manip);
    if (!$this->image_lib->resize()) {
        echo $this->image_lib->display_errors();
    }


    $this->image_lib->clear();
}

// ปีงบประมาณ Y/m/d
function get_budget_year($date) {

    $cdate = date_parse_from_format('Y-m-d', $date);
    $dateArray = $cdate;
    $year = $dateArray['year'];
// ค.ศ.
    if ((intval(date('o')) + 543 - intval($dateArray['year'])) >= 543 && (intval(date('o')) + 543 - intval($dateArray['year'])) > 300) {
        $year = intval($dateArray['year'] + 543);
        $cdate = date_parse_from_format('Y-m-d', $year . "-" . $dateArray['month'] . "-" . $dateArray['day']);
        $sbdate = date_parse_from_format('Y-m-d', (intval($year) - 1) . "-10-1");
        $ebdate = date_parse_from_format('Y-m-d', $year . "-9-30");
    } else {
// พ.ศ.
        $year = intval($dateArray['year']);
        $yearTmp = intval($dateArray['year']) - 543;
        $cdate = date_parse_from_format('Y-m-d', $yearTmp . "-" . $dateArray['month'] . "-" . $dateArray['day']);
        $sbdate = date_parse_from_format('Y-m-d', (intval($yearTmp) - 1) . "-10-1");
        $ebdate = date_parse_from_format('Y-m-d', $yearTmp . "-9-30");
    }





    if ($cdate >= $sbdate && $cdate <= $ebdate) {
        return $year; //ปีงบประมาณปัจจุบัน
    } elseif ($cdate < $sbdate) {
        return (intval($year) - 1); //ปีงบประมาณก่อนหน้า
    } elseif ($cdate > $ebdate) {
        return (intval($year) + 1); //ปีงบประมาณถัดไป
    }
}

function std_path($stdid, $schoolid) {
    $MyPath = "upload/" . $schoolid . "/std/" . $stdid . "/";
    if (!file_exists($MyPath)) {
        mkdir($MyPath, 0777, true);
    }
    return $MyPath;
}

function hr_path($hrid, $schoolid) {
    $MyPath = "upload/" . $schoolid . "/hr/" . $hrid . "/";
    if (!file_exists($MyPath)) {
//        mkdir($dir, 755, true);
        mkdir($MyPath, 0777, true);
    }
    return $MyPath;
}

function other_path($schoolid) {
    $MyPath = "upload/" . $schoolid . "/other/";
    if (!file_exists($MyPath)) {
        mkdir($MyPath, 0777, true);
    }
    return $MyPath;
}

// คะนวณเกรด
function StudentGrade($score) {
    $returngrade = 0;
    if ($score < 50) {
        $returngrade = 0;
    } else {
        if ($score >= 50 & $score <= 54) {
            $returngrade = 1;
        } elseif ($score >= 55 & $score <= 59) {
            $returngrade = 1.5;
        } elseif ($score >= 60 & $score <= 64) {
            $returngrade = 2;
        } elseif ($score >= 65 & $score <= 69) {
            $returngrade = 2.5;
        } elseif ($score >= 70 & $score <= 74) {
            $returngrade = 3;
        } elseif ($score >= 75 & $score <= 79) {
            $returngrade = 3.5;
        } elseif ($score >= 80 & $score <= 100) {
            $returngrade = 4;
        }
    }
    return $returngrade;
}

function subject_type_to_head_course($subject_type) {
    $return = "";

    switch ($subject_type) {

        case "พื้นฐาน":
            $return = "มาตรฐานการเรียนรู้/ตัวชี้วัด";
            break;
        default :
            $return = "จุดประสงค์การเรียนรู้";
    }

    return $return;
}

function GenfileImages($filename, $member_id, $school_id) {
    $output = "";
    $MyFile = explode(".", $filename);

    $img = "";

    $pnt = 0;

    $pnt = sizeof($MyFile) - 1;

    switch ($MyFile[$pnt]) {
        case "jpg":
            $img = "picture.png";
            break;
        case "jpeg":
            $img = "picture.png";
            break;
        case "png":
            $img = "picture.png";
            break;
        case "pdf":
            $img = "doc-pdf.png";
            break;
        case "doc":
            $img = "doc-word.png";
            break;
        case "docx":
            $img = "doc-word.png";
            break;
        case "xls":
            $img = "doc-excel.png";
            break;
        case "xlsx":
            $img = "doc-excel.png";
            break;
        case "xlsm":
            $img = "doc-excel.png";
            break;
        default :
            $img = "folder.png";
    }

    $output .= "<a href='" . base_url() . hr_path($member_id, $school_id) . $filename . "' target='_BLANK' style='float:left;margin:5px 0px 5px 2px;color:white;'>";
    $output .= "<div style='height: 40px;background-color: grey;border-radius: 5px;padding:5px;'>";
    $output .= "<img class='img-thumbnail' src='" . base_url() . "images/doc-images/" . $img . "' style='width: 30px;margin-right:10px;float:left'/>";
    $output .= "<div style='float:left;font-size:0.8em;'>";
    $output .= $filename;
    $output .= "</div>";
    $output .= "</div>";

    $output .= "</a>";

    return $output;
}

function GenLink($filename, $path) {
    $output = "";
    $MyFile = explode(".", $filename);

    $img = "";

    $pnt = 0;

    $pnt = sizeof($MyFile) - 1;

    switch ($MyFile[$pnt]) {
        case "jpg":
            $img = "picture.png";
            break;
        case "jpeg":
            $img = "picture.png";
            break;
        case "png":
            $img = "picture.png";
            break;
        case "pdf":
            $img = "doc-pdf.png";
            break;
        case "doc":
            $img = "doc-word.png";
            break;
        case "docx":
            $img = "doc-word.png";
            break;
        case "xls":
            $img = "doc-excel.png";
            break;
        case "xlsx":
            $img = "doc-excel.png";
            break;
        case "xlsm":
            $img = "doc-excel.png";
            break;
        default :
            $img = "folder.png";
    }

    $output .= "<a href='" . base_url() . $path . $filename . "' target='_BLANK' style='float:left;margin:5px 0px 5px 2px;color:white;'>";
    $output .= "<div style='height: 40px;background-color: grey;border-radius: 5px;padding:5px;'>";
    $output .= "<img class='img-thumbnail' src='" . base_url() . "images/doc-images/" . $img . "' style='width: 30px;margin-right:10px;float:left'/>";
    $output .= "<div style='float:left;font-size:0.8em;'>";
    $output .= $filename;
    $output .= "</div>";
    $output .= "</div>";

    $output .= "</a>";

    return $output;
}

function get_edyear() {
    $edyear = date('Y') + 543;
    if (date('m') < 5) {
        $edyear -= 1;
    }
    return $edyear;
}

function datethaitoage($MyDate) {
    if ($MyDate == null | $MyDate == "0000-00-00") {
        return 0;
    } else {
        $exp = explode('-', $MyDate);
        $MyYear = $exp[0] - 543;
        $GoDate = $MyYear . "-" . $exp[1] . "-" . $exp[2];
        $age = floor((time() - strtotime($GoDate)) / 31556926);
        return $age;
    }
}

function datetoage($MyDate) {
    if ($MyDate == null | $MyDate == "0000-00-00") {
        return 0;
    } else {
        $age = floor((time() - strtotime($MyDate)) / 31556926);
        return $age;
    }
}

function qa_path() {
    $MyPath = "upload/qa_tools/" . get_edyear() . "/";
    if (!file_exists($MyPath)) {
        mkdir($MyPath, 0777, true);
    }
    return $MyPath;
}

function load_view($context, $view, $data=null) {

    $context->load->view('layout/header');
    if ($data != null) {
        $context->load->view($view, $data);
    } else {
        $context->load->view($view);
    }
    $context->load->view('layout/footer');
}

function aaa($context) {

    $member_id = $context->session->userdata('member_id');
    $data_define = $context->uri->segment(1);
    $department = $context->session->userdata('department');

    $context->db->select('a.id')->from('tb_data_define a');
    $context->db->join("tb_member_activities b", "b.data_define_id = a.id");
    $context->db->where('a.data_address', $data_define);
    $context->db->where('a.department', $department);
    $context->db->where('b.member_id', $member_id);
    $query = $context->db->get()->result_array();

    if (count($query) <= 0) {
        redirect("/");
    }
}

function load_datatable($tabName, $btExArr, $title, $colStr,$footer=null,$pagelength=null) {
    $view = "";


    foreach ($btExArr as $bt) {
        $view .= "$.fn.dataTable.ext.buttons." . $bt['name'] . " = {
        text: '<i class=\"" . $bt['icon'] . "\"></i> " . $bt['title'] . "',";
        
        if($bt['class']==null||$bt['class']==""){
            $view.="
        className: 'btn btn-default',";
        }else{
           $view.="
        className: '".$bt['class']."',";
         
        }
        $view.="
        action: function (e, dt, node, config) {
            " . $bt['fn'] . "
        }
    };";
    }

    $view .= "$('#".$tabName."').DataTable({
        buttons: [";

    foreach ($btExArr as $bt) {
        $view .= "'" . $bt['name'] . "',";
    }
    

    $view .= "{
        extend: 'print',
        
        text: '<i class=\"icon-print\"></i> พิมพ์ข้อมูล',
        className: 'btn btn-default',
        title: '". $title . "',
        exportOptions: {
        columns: [" . $colStr . "]
        },
        customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '0.8em' );
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                        $(win.document.body).find( 'th' )
                        .addClass( 'compactth' )
                        .css( 'text-align', 'center' ).css('background-color','#eee');
                }
        },
        {
        extend: 'excel',
        text: '<i class=\"icon-download\"></i> ส่งออกข้อมูล',
        className: 'btn btn-default',
        title: '" . $title . "',
        exportOptions: {
        columns: [" . $colStr . "]
        }
        },
        {
        extend: 'copy',
        text: '<i class=\"icon-copy\"></i> คัดลอกข้อมูล',
                className: 'btn btn-default',
                title: '" . $title . "',
                exportOptions: {
                columns: [" . $colStr . "]
                }
                }],";
//        $view .= "        \"responsive\": true,
//        \"stateSave\": true,";
    

    
    if(isset($pagelength)){
        $view .= "\"pageLength\":".$pagelength.",";
    }

        $view .= "\"language\": {
            \"lengthMenu\": \"แสดง _MENU_ แถวต่อหน้า\",
\"zeroRecords\": \"## ไม่มีข้อมูล ##\",
 \"info\": \"แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า\",
 \"infoEmpty\": \"\",
 \"infoFiltered\": \"\",
 \"sSearch\": \"ระบุคำค้น\",
 \"sPaginationType\": \"full_numbers\",
 \"paginate\": {
\"previous\": \"ก่อนหน้า\",
 \"next\": \"ถัดไป\",
 }
},";
    
    if($footer!=null&&$footer!=""){
        $view.=$footer;
    }
    
    $view.="
}).buttons().container().css('margin-bottom','10px').insertBefore('div#".$tabName."_wrapper .row:eq(0)');
$('.sorting_asc').removeClass('sorting_asc');
";

    echo $view;
}

function other_unique_path($schoolid, $table, $id) {
    $MyPath = "upload/" . $schoolid . "/other/" . $table . $id;
    if (!file_exists($MyPath)) {
        mkdir($MyPath, 0777, true);
    }
    return $MyPath;
}
