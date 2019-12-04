<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// หน้าแรกของโปรแกรม
$route['eschool-mainpage'] = 'Eschool/mainpage';
// กำนหดค่าเริ่มต้นให้กับหน่วยงาน
$route['default_controller'] = 'Eschool';
$route['insert-organization'] = "Setting/insert_organization";




$route['update-organization-data'] = 'Setting/edit_organization';
// การ redirect ตาม department
$route['education-department-zone'] = "Eschool/education_zone";
$route["school-department-zone"] = 'Eschool/school_zone';
// Setting
//$route['login'] = 'Setting/login_view';
$route['login'] = 'Setting/do_login';
$route['login-to-zone'] = 'Eschool/get_user_zone';

$route['login-to-system'] = 'Setting/login_view';
$route['goout-from-system'] = "Setting/logout";
$route['administrator'] = 'Setting/admin_page'; // หน้าผู้ดูแลระบบ
$route['unit-group'] = 'Setting/unit_group'; // กลุ่มของหน่วยนับ;
$route['insert-unit-group'] = "Setting/unit_group_save"; // Save data;
$route['unit-group-edit'] = "Setting/unit_group_edit"; // edit unit group;
$route['unit-group-delete'] = 'Setting/unit_group_delete'; //delete unit group;
$route['unit'] = 'Setting/unit'; // หน่วยนับ
$route['unit-insert'] = "Setting/unit_save";
$route['insignia-information'] = 'Setting/insignia';
$route['insert-insignia-data'] = 'Setting/insignia_add';
$route['update-insignia-data'] = 'Setting/insignia_edit';
$route['delete-insignia-data'] = 'Setting/insignia_delete';

// กำหนดกลุ่มข้อมูล
$route['data-activities-define'] = 'Setting/data_define';
$route['insert-data-activities-define'] = 'Setting/insert_data_define';
$route['update-data-activities-define'] = 'Setting/update_data_define';
$route['delete-data-activities-define'] = 'Setting/delete_data_define';
$route['print-data-activities-define'] = 'Setting/print_data_define';
$route['data-define-setting'] = "Admin_school/data_define_setting_base";

// ประเภทเอกสาร
$route['document-type'] = 'Setting/document_type';
$route['insert-document-type'] = 'Setting/document_type_insert'; // Save
$route['update-document-type'] = 'Setting/document_type_edit'; // edit
// คลังเอกสาร
$route['stock-of-documents'] = "Accessories/documents_stock";
$route['insert-document-to-stock'] = "Accessories/document_stock_insert";
$route['update-document-from-stock'] = "Accessories/document_stock_update";
$route['delete-document-form-stock'] = "Accessories/document_stock_delete";

// คลังภาพ
$route['define-picture-group'] = 'Accessories/picture_group';
$route['insert-picture-group'] = 'Accessories/picture_group_add';
$route['update-picture-group'] = 'Accessories/picture_group_edit';
$route['delete-picture-group'] = 'Accessories/picture_group_delete';
//
$route['picture-stock'] = 'Accessories/picture_stock';
$route['insert-picture-stock'] = 'Accessories/insert_picture';
$route['edit-picture-stock'] = 'Accessories/edit_picture';
$route['delete-picture-stock'] = 'Accessories/delete_picture';

// ตำแหน่ง
$route['rank'] = 'Setting/rank';
$route['insert-rank'] = 'Setting/rank_add';
$route['update-rank'] = 'Setting/rank_edit';
$route['delete-rank-data'] = 'Setting/rank_delete';

// หน้าที่รับผิดชอบ 
$route['responsible'] = "Setting/responsible";
$route['insert-responsible'] = 'Setting/add_responsible_data';
$route['update-responsible'] = 'Setting/edit_responsible_data';
$route['delete-responsible'] = 'Setting/delete_responsible_data';

// องค์กรปกครองส่วนท้องถิ่น
$route['localgov-type'] = "Setting/localgov_type";
$route['localgov'] = 'Setting/localgov';
$route['localgov-type-insert'] = 'Setting/localgov_type_insert';
$route['edit-localgov-type'] = 'Setting/localgov_type_edit';
$route['delete-localgov-type'] = 'Setting/localgov_type_delete';

// ข้อมูลองค์กรปกครองส่วนท้องถิ่น
$route['localgov-detail'] = 'Setting/localgov_detail';
$route['insert-localgov-detail'] = 'Setting/localgov_add_view';

// ประเภทสถานศึกษา
$route['school-type'] = 'Setting/school_type';
$route['insert-school-type'] = 'Setting/school_type_insert';
$route['update-school-type'] = 'Setting/school_type_edit';
$route['delete-school-type'] = 'Setting/school_type_delete';

// ข้อมูลสถานศึกษา
$route['school'] = "Setting/school";
$route['insert-school'] = 'Setting/insert_school';
$route['update-school-data'] = "Setting/update_school";
$route['delete-school'] = 'Setting/delete_school';

// กำหนดผู้อำนวยการโรงเรียน
$route['school-director'] = "Setting/school_director";
$route['insert-school-director'] = 'Setting/school_director_insert';
$route['update-school-director'] = 'Setting/school_director_edit';
$route['delete-school-director'] = "Setting/school_director_delete";

// ผู้ใช้งานระบบ
$route['member'] = 'Setting/member';
$route['push-member-from-table'] = "setting/get_member";
$route['set-member-responsible/(:num)'] = 'setting/member_resonsible/$1';
$route['print-member-detail'] = 'Setting/print_member';
$route['hr-member-profile'] = "Hr_member_profile/Hr_member_profile_base";

// กำหนดสิทธิ์ในการเข้าถึงกลุ่มข้อมูล
$route['define-member-activities/(:num)'] = 'Setting/member_activities/$1';
$route['insert-member-activities-data'] = 'Setting/insert_member_activities';
$route['delete-member-activities-data'] = 'Setting/delete_member_activities';

// กำหนดคำนำหน้า
$route['human-prefix'] = 'Setting/human_prefix';
$route['insert-human-prefix'] = 'Setting/add_human_prefix';
$route['update-human-prefix'] = 'Setting/update_human_prefix';
$route['delete-human-prefix'] = 'Setting/delete_human_prefix';

// กำหนดข้อมูลรายวิชา
$route['subject-detail'] = 'Setting/subject_detail';
$route['insert-subject-detail'] = 'Setting/subject_detail_add';
$route['update-subject-detail'] = 'Setting/subject_detail_edit';
$route['delete-subject-detail'] = 'Setting/subject_detail_delete';

// กำหนดชั้นเรียน
$route['education-level'] = 'Setting/education_level';
$route['insert-education-level'] = 'Setting/education_level_add';
$route['update-education-level'] = 'Setting/education_level_edit';
$route['delete-education-level'] = 'Setting/education_level_delete';

// กำหนดประเภทชันเรียน (ประถม, มัธยม, ขายโอกาส)
$route['education-level-type'] = 'Setting/education_level_type';
$route['insert-education-level-type'] = 'Setting/education_level_type_add';
$route['update-education-level-type'] = 'Setting/education_level_type_edit';
$route['delete-education-level-type'] = 'Setting/education_level_type_delete';

// กำหนดกลุ่มการเรียนรู้
$route['education-group'] = 'Setting/education_group';
$route['insert-education-group'] = 'Setting/education_group_add';
$route['update-education-group'] = 'Setting/education_group_edit';
$route['delete-education-group'] = 'Setting/education_group_delete';

// กำหนดประเภทบุคลากร
$route['human-resources-type'] = 'Setting/human_resources_type';
$route['insert-human-resources-type'] = 'Setting/human_resources_type_add';
$route['update-human-resources-type'] = 'Setting/human_resources_type_edit';
$route['delete-human-resources-type'] = 'Setting/human_resources_type_delete';


//ทำเนียบบุคลากร
$route['oc-base'] = "Oc/oc_base";

//---- แบบประเมินผลการปฏิบัติงาน
$route['ap-base'] = "Ap/ap_base";

// กำหนดสไลด์หมุน
$route['carousel-setting'] = 'Setting/carousel_setting';
$route['insert-carousel-setting'] = 'Setting/carousel_setting_add';
$route['delete-carousel-setting'] = 'Setting/carousel_setting_delete';

// กิจกรรมของแต่ละบุคคล (Task list)
$route['insert-task-list'] = 'Accessories/task_list_add';
$route['update-task-list'] = 'Accessories/task_list_edit';
$route['delete-task-list'] = 'Accessories/task_list_delete';
$route['check-task-list'] = 'Accessories/task_list_check';

// ปฏิทินกิจกรรมของแต่ละคน
$route['get-event-calendar'] = 'Accessories/get_calendar';
$route['insert-calendar-task'] = 'Accessories/calendar_add';
$route['get-calendar-one-record'] = 'Accessories/get_calendar_row';
$route['update-resize-calendar'] = 'Accessories/update_calendar_resize';
$route['update-drop-calendar'] = 'Accessories/update_calendar_drop';



# ----------------------------------------------------------------------------+
# Router Group  งานวิชาการ
# Purpose       แหล่งเรียนรู้ภายใน-นอก
# Author        CH. Bundhit
# ----------------------------------------------------------------------------+
// 
$route['learning-center'] = "Vichakarn/km";
$route['insert-learning-center'] = "vichakarn/km_insert_view";
$route['km-insert'] = "vichakarn/km_insert";
$route['km-update'] = "vichakarn/km_update";
$route['km-edit'] = "vichakarn/km_edit";
$route['km-delete'] = "vichakarn/km_delete";
$route['km-base-detail'] = 'Vichakarn/km_detail';
$route['print-km-base-data/(:num)'] = 'Vichakarn/km_print/$1';

// หน้าหลักของฝ่ายวิชาการ
$route['vichakarn-department-system'] = "Vichakarn/index";

# ----------------------------------------------------------------------------+
# Router Group  supervision
# Purpose       ระบบนิเทศการศึกษา
# Author        
# Comment       
# ----------------------------------------------------------------------------+
// Print data
$route['supervision-print-data'] = 'Supervision/supervision_print';


// กำหนดตารางนิเทศการจัดการเรียนการสอน
$route['supervision-schedule'] = 'Supervision/supervision_schedule';
$route['insert-supervision-schedule'] = 'Supervision/supervision_schedule_add';
$route['update-supervision-schedule'] = 'Supervision/supervision_schedule_edit';
$route['delete-supervision-schedule'] = 'Supervision/supervision_schedule_delete';
$route['print-supervision-schedule'] = 'Supervision/supervision_schedule_print';

// กำหนดการในตารางการนิเทศฯ
$route['supervision-schedule-detail/(:num)'] = 'Supervision/supervision_schedule_detail/$1';
$route['insert-supervision-schedule-detail'] = 'Supervision/supervision_schedule_detail_add';
$route['update-supervision-schedule-detail'] = 'Supervision/supervision_schedule_detail_edit';
$route['delete-supervision-schedule-detail'] = 'Supervision/supervision_schedule_detail_delete';
$route['print-supervision-schedule-detail/(:num)'] = 'Supervision/supervision_schedule_detail_print/$1';

// กำหนดแผนการนิเทศ (supervision-plan)
$route['supervision-plan'] = 'Supervision/supervision_plan';
$route['insert-supervision-plan'] = 'Supervision/supervision_plan_add';
$route['update-supervision-plan'] = 'Supervision/supervision_plan_edit';
$route['delete-supervision-plan'] = 'Supervision/supervision_plan_delete';

// รายละเอียดแผนการนิเทศ (supervison-plan-detail)
$route['supervision-plan-detail/(:num)'] = 'Supervision/supervision_plan_detail/$1';
$route['insert-supervision-plan-detail'] = 'Supervision/supervision_plan_detail_add';
$route['update-supervision-plan-detail'] = 'Supervision/supervision_plan_detail_edit';
$route['delete-supervision-plan-detail'] = 'Supervision/supervision_plan_detail_delete';
$route['print-supervision-plan-detail/(:num)'] = 'Supervision/supervsion_plan_detail_print/$1';

// บันทึกการสังเกตการณ์สอน
$route['supervision-observ-information/(:num)'] = 'Supervision/supervision_observ/$1';
$route['insert-supervision-observ-information'] = 'Supervision/supervision_observ_add';
$route['update-supervision-observ-information'] = 'Supervision/supervision_observ_edit';
$route['delete-supervision-observ-information'] = 'Supervision/supervision_observ_delete';

// ส่วนประกอบต่าง ๆ ในห้องเรียน
$route['insert-observ-classroom-component'] = 'Supervision/classroom_component_add';

// ส่วนของเนื้อหา
$route['insert-observ-content'] = 'Supervision/observ_content_add';
$route['delete-observ-content'] = 'Supervision/observ_content_delete';

// ส่วนของความคิดรวบยอด
$route['insert-observ-concept'] = 'Supervision/observ_concept_add';
$route['delete-observ-concept'] = 'Supervision/observ_concept_delete';

// ส่วนของพฤติกรรมครู
$route['insert-observ-teacher-activities'] = 'Supervision/observ_teacher_activities_add';
$route['delete-observ-teacher-activities'] = 'Supervision/observ_teacher_activities_delete';

// ส่วนของพฤติกรรมนักเรียน
$route['insert-observ-student-activities'] = 'Supervision/observ_student_activities_add';
$route['delete-observ-student-activities'] = 'Supervision/observ_student_activities_delete';

// ส่วนของกิจกรรมการเรียนการสอน
$route['insert-observ-study-activities'] = 'Supervision/observ_study_activities_add';
$route['update-observ-study-activities'] = 'Supervision/observ_study_activities_edit';
$route['delete-observ-study-activities'] = 'Supervision/observ_study_activities_delete';

// ส่วนของการประเมินผล
$route['insert-observ-valuation'] = 'Supervision/observ_valuation_add';
$route['delete-observ-valuation'] = 'Supervision/observ_valuation_delete';

// ส่วนของการใช้สื่อหรือนวัตกรรม
$route['insert-observ-media'] = 'Supervision/observ_media_add';
$route['delete-observ-media'] = 'Supervision/observ_media_delete';

// ส่วนของการใช้คำถามของครู
$route['insert-observ-teacher-question'] = 'Supervision/observ_teacher_question_add';
$route['delete-observ-teacher-question'] = 'Supervision/observ_teacher_question_delete';

// ส่วนของการใช้คำถามของนักเรียน
$route['insert-observ-student-question'] = 'Supervision/observ_student_question_add';
$route['delete-observ-student-question'] = 'Supervision/observ_student_question_delete';

// สรุปจุดแข็งและจุดที่ควรพัฒนา
$route['insert-observ-strength'] = 'Supervision/observ_strength_add';
$route['delete-observ-strength'] = 'Supervision/observ_strength_delete';

// สรุปจุดอ่อนและจุดที่ควรพัฒนา
$route['insert-observ-weakness'] = 'Supervision/observ_weakness_add';
$route['delete-observ-weakness'] = 'Supervision/observ_weakness_delete';

// บันทึกการนิเทศระดับที่ 1
$route['supervision-destination-note/(:num)'] = 'Supervision/supervision_destination_note/$1';
$route['insert-supervision-destination-note'] = 'Supervision/supervision_destination_note_add';
$route['update-supervision-destination-note'] = 'Supervision/supervision_destination_note_edit';
$route['delete-supervision-destination-note'] = 'Supervision/supervision_destination_note_delete';

// ตารางแบบนิเทศการจัดการเรียนรู้ระดับที่ 1
$route['define-destination-note-level-1'] = 'Supervision/supervision_destination_note_level_1_define';
$route['push-ds-level-1'] = 'Supervision/supervision_push_level_1';
$route['insert-ds-level-1'] = 'Supervision/supervision_level_1_add';
$route['cancel-define-destination-note-level-1'] = 'Supervision/supervision_destination_note_1_define_delete';
$route['print-define-destination-note'] = 'Supervision/supervision_define_destination_note_print';

// บันทึกการนิเทศระดับที่ 2
$route['supervision-destination-note-level-2/(:num)/(:num)'] = 'Supervision/supervision_destination_note_level_2/$1/$2';

// บันทึกการนิเทศระดับที่ 3
$route['supervision-destination-note-level-3/(:num)/(:num)/(:num)'] = 'Supervision/supervision_destination_note_level_3/$1/$2/$3';
$route['insert-supervision-destination-note-level-3'] = 'Supervision/supervision_destination_note_level_3_add';
$route['define-supervision-level3-score'] = 'Supervision/supervision_destination_note_level_3_edit';
$route['cancel-supervision-level3-score'] = 'Supervision/supervision_destination_note_level_3_delete';


// บันทึกรายละเอียดการนิเทศ
$route['insert-supervision-destination-note-detail'] = 'Supervision/supervision_destination_note_detail_add';
$route['update-supervision-destination-note-detail'] = 'Supervision/supervision_destination_note_detail_edit';
$route['delete-supervision-destination-note-detail'] = 'Supervision/supervision_destination_note_detail_delete';

// ข้อคิดเห็น-ข้อตกลง
$route['insert-supervision-destination-opinion'] = 'Supervision/supervsion_destination_add';
$route['delete-supervision-destination-opinion'] = 'Supervision/supervsion_destination_delete';

// สรุปผล-ข้อคิดเห็นของผู้นิเทศ
$route['insert-supervision-summary'] = 'Supervision/supervision_summary_add';
$route['delete-supervision-summary'] = 'Supervision/supervision_summary_delete';

// บันทึก-สรุปผลการนิเทศ (ข้อมูลทั่วไป)
$route['supervision-final/(:num)'] = 'Supervision/supervision_final/$1';
$route['insert-supervision-final'] = 'Supervision/supervision_final_add';
$route['update-supervision-final'] = 'Supervision/supervision_final_edit';
$route['delete-supervision-final'] = 'Supervision/supervision_final_delete';

// บันทึก-สรุปผลการนิเทศ (ตารางข้อมูล)
$route['insert-supervision-final-detail'] = 'Supervision/supervision_final_detail_add';
$route['update-supervision-final-detail'] = 'Supervision/supervision_final_detail_edit';
$route['delete-supervision-final-delete'] = 'Supervision/supervision_final_detail_delete';

// บันทึก-สรุปผลการนิเทศ (ความคิดเห็น/สรุปผล)
$route['insert-supervision-final-opinion'] = 'Supervision/supervision_final_opinion_add';
$route['delete-supervision-final-opinion'] = 'Supervision/supervision_final_opinion_delete';


// กำหนดกิจกรรมย่อยลำดับที่ 1
$route['define-education-supervision-task'] = 'Supervision/supervision_define_task';
$route['insert-define-education-supervision-task'] = 'Supervision/supervision_task_add';
$route['update-define-education-supervision-task'] = 'Supervision/supervision_task_edit';
$route['delete-define-education-supervision-task'] = 'Supervision/supervision_task_delete';

// กำหนดกิจกรรมย่อยลำดับที่ 2
$route['define-supervision-task_level2/(:num)'] = 'Supervision/supervision_task_level2/$1';
$route['insert-define-supervision-task-level-2'] = 'Supervision/supevision_task_level_2_add';
$route['update-define-supervision-task-level-2'] = 'Supervision/supevision_task_level_2_edit';
$route['delete-define-supervision-task-level-2'] = 'Supervision/supevision_task_level_2_delete';

// กำหนดกิจกรรมย่อยลำดับที่ 3
$route['define-supervision-task-level3/(:num)/(:num)'] = 'Supervision/supervision_task_level3/$1/$2';
$route['insert-define-supervision-task-level-3'] = 'Supervision/supervision_task_level3_add';
$route['update-define-supervision-task-level-3'] = 'Supervision/supervision_task_level3_edit';
$route['delete-define-supervision-task-level-3'] = 'Supervision/supervision_task_level3_delete';

$route['educational-supervision'] = 'Supervision/index';
$route['print-supervision-form'] = 'Supervision/form_view';


# ----------------------------------------------------------------------------+
# Router Group  ทำเนียบบุคลากร
# Purpose       บริหารจัดการข้อมูลบุคลากรทั้งส่วนของกองการศึกษาและส่วนของโรงเรียน
# Author        CH. Bundhit
# ----------------------------------------------------------------------------+
// 01-ข้อมูลทั่วไป
$route['human_resources'] = 'human_resources/index';
$route['insert-human-resources-part-1'] = 'Human_resources/insert_hr_01';
$route['update-human-resources-part-1'] = "Human_resources/update_hr_01";
$route['delete-human-resources-part-1'] = 'Human_resources/delete_hr_01';
$route['print-human-resources-part-1/(:num)'] = 'Human_resources/print_hr_01/$1';
//02-ข้อมูลที่อยู่
$route['human-resources-part-02/(:num)'] = 'Human_resources/hr02/$1';
$route['insert-human-resources-02'] = 'Human_resources/hr02_insert';
$route['update-human-resources-02/(:num)'] = 'Human_resources/hr02_update/$1';
$route['delete-human-resources-02'] = 'Human_resources/hr02_delete';
$route['print-human-resources-02/(:num)'] = 'Human_resources/hr02_print/$1';
//03-ข้อมูลครอบครัว
$route['human-resources-part-03/(:num)'] = 'Human_resources/hr03/$1';
$route['insert-human-resources-part-03'] = 'Human_resources/hr03_insert';
$route['update-human-resources-part-03'] = 'Human_resources/hr03_update';
$route['delete-human-resources-part-03'] = 'Human_resources/hr03_delete';
$route['print-human-resources-part-03/(:num)'] = 'Human_resources/hr03_print/$1';
//04 ประวัติการทำงาน
$route['human-resources-part-04/(:num)'] = 'Human_resources/hr04/$1';
$route['insert-human-resources-part-04'] = 'Human_resources/hr04_add';
$route['update-human-resources-part-04'] = 'Human_resources/hr04_edit';
$route['delete-human-resources-part-04'] = 'Human_resources/hr04_delete';
$route['print-human-resources-part-04/(:num)'] = 'Human_resources/hr04_print/$1';
//05 ประวัติการรับราชการ
$route['human-resources-part-05/(:num)'] = 'Human_resources/hr05/$1';
$route['insert-human-resources-part-05'] = 'Human_resources/hr05_add';
$route['update-human-resources-part-05'] = 'Human_resources/hr05_edit';
$route['delete-human-resources-part-05'] = 'Human_resources/hr05_delete';
$route['print-human-resources-part-05/(:num)'] = 'Human_resources/hr05_print/$1';
// 06 ประวัติการสอน
$route['human-resources-part-06/(:num)'] = 'Human_resources/hr06/$1';
$route['insert-human-resources-part-06'] = 'Human_resources/hr06_add';
$route['update-human-resources-part-06'] = 'Human_resources/hr06_edit';
$route['delete-human-resources-part-06'] = 'Human_resources/hr06_delete';
$route['print-human-resources-part-06/(:num)'] = 'Human_resources/hr06_print/$1';
// 07 ประวัติการสอน
$route['human-resources-part-07/(:num)'] = 'Human_resources/hr07/$1';
$route['insert-human-resources-part-07'] = 'Human_resources/hr07_add';
$route['update-human-resources-part-07'] = 'Human_resources/hr07_edit';
$route['delete-human-resources-part-07'] = 'Human_resources/hr07_delete';
$route['print-human-resources-part-07/(:num)'] = 'Human_resources/hr07_print/$1';
// 08 ประวัติการเลื่อนตำแหน่ง
$route['human-resources-part-08/(:num)'] = 'Human_resources/hr08/$1';
$route['insert-human-resources-part-08'] = 'Human_resources/hr08_add';
$route['update-human-resources-part-08'] = 'Human_resources/hr08_edit';
$route['delete-human-resources-part-08'] = 'Human_resources/hr08_delete';
$route['print-human-resources-part-08/(:num)'] = 'Human_resources/hr08_print/$1';
// 09 ประวัติการสร้างผลงาน
$route['human-resources-part-09/(:num)'] = 'Human_resources/hr09/$1';
$route['insert-human-resources-part-09'] = 'Human_resources/hr09_add';
$route['update-human-resources-part-09'] = 'Human_resources/hr09_edit';
$route['delete-human-resources-part-09'] = 'Human_resources/hr09_delete';
$route['print-human-resources-part-09/(:num)'] = 'Human_resources/hr09_print/$1';
// 10 ข้อมูลใบประกอบวิชาชีพ
$route['human-resources-part-10/(:num)'] = 'Human_resources/hr10/$1';
$route['insert-human-resources-part-10'] = 'Human_resources/hr10_add';
$route['update-human-resources-part-10'] = 'Human_resources/hr10_edit';
$route['delete-human-resources-part-10'] = 'Human_resources/hr10_delete';
$route['print-human-resources-part-10/(:num)'] = 'Human_resources/hr10_print/$1';
// 11 ข้อมูลการลาทุกประเภท
$route['human-resources-part-11/(:num)'] = 'Human_resources/hr11/$1';
$route['insert-human-resources-part-11'] = 'Human_resources/hr11_add';
$route['update-human-resources-part-11'] = 'Human_resources/hr11_edit';
$route['delete-human-resources-part-11'] = 'Human_resources/hr11_delete';
$route['print-human-resources-part-11/(:num)'] = 'Human_resources/hr11_print/$1';
$route['print_human_resources-part-11-summary/(:num)'] = 'Human_resources/hr11_summary_print/$1';
// 12 ข้อมูลการกระทำผิด
$route['human-resources-part-12/(:num)'] = 'Human_resources/hr12/$1';
$route['insert-human-resources-part-12'] = 'Human_resources/hr12_add';
$route['update-human-resources-part-12'] = 'Human_resources/hr12_edit';
$route['delete-human-resources-part-12'] = 'Human_resources/hr12_delete';
$route['print-human-resources-part-12/(:num)'] = 'Human_resources/hr12_print/$1';
// 13-ประวัติการรับเครื่องราชอิสริยาภรณ์
$route['human-resources-part-13/(:num)'] = 'Human_resources/hr13/$1';
$route['insert-human_resources-part-13'] = 'Human_resources/hr_13_insert';
$route['update-human-resources-part-13'] = 'Human_resources/hr_13_edit';
$route['delete-human-resources-part-13'] = 'Human_resources/hr_13_delete';
$route['print-human-resources-part-13/(:num)'] = 'Human_resources/hr_13_print/$1';
// 14- ข้อมูลด้านอื่น ๆ
$route['human-resources-part-14/(:num)'] = 'Human_resources/hr14/$1';
$route['insert-human-resources-part-14'] = 'Human_resources/hr14_insert';
$route['update-human-resources-part-14'] = 'Human_resources/hr14_update';
$route['delete-human-resources-part-14'] = 'Human_resources/hr14_delete';
$route['print-human-resources-part-14/(:num)'] = 'Human_resources/hr_14_print/$1';
// 15 ประวัติการศึกษา
$route['human-resources-part-15/(:num)'] = 'Human_resources/hr15/$1';
$route['insert-human-resources-part-15'] = 'Human_resources/hr15_add';
$route['update-human-resources-part-15'] = 'Human_resources/hr15_edit';
$route['delete-human-resources-part-15'] = 'Human_resources/hr15_delete';
$route['print-human-resources-part-15/(:num)'] = 'Human_resources/hr15_print/$1';

# ----------------------------------------------------------------------------+
# Router Group  human_planing
# Purpose       การวางแผนอัตรากำลัง
# Author        CH. Bundhit
# ----------------------------------------------------------------------------+
$route['human-planing'] = 'HumanPlaning/index';
$route['insert-human-resources-plan-year'] = 'HumanPlaning/hr_plan_add';
$route['update-human-resources-plan-year'] = 'HumanPlaning/hr_plan_edit';
$route['delete-human-resources-plan-year'] = 'HumanPlaning/hr_plan_delete';

// รายละเอียดการวางแผนอัตรากำลังในแต่ละรอบ 3 ปี
$route['human-plan-detail/(:num)'] = 'HumanPlaning/hr_plan_detail/$1';
$route['insert-human-plan-detail'] = 'HumanPlaning/hr_plan_detail_add';
$route['update-human-plan-detail'] = 'HumanPlaning/hr_plan_detail_edit';
$route['delete-human-plan-detail'] = 'HumanPlaning/hr_plan_detail_delete';
$route['print-human-plan-detail/(:num)'] = 'HumanPlaning/hr_plan_detail_print/$1';

// บันทึกข้อมูลแผนอัตรากำลัง
$route['insert-human-planing-detail'] = 'HumanPlaning/human_planing_detail_add';


#---------------+---------------------------------------------------------------
#   Title       |   Assessment การประเมินผลการปฏิบัติงาน
#---------------+---------------------------------------------------------------
#   Author      |   Mr.Hidemi Minakawa
#   Date        |   06/01/2019
#   Last Update |   -
#---------------+---------------------------------------------------------------
// หน้าหลักแสดงในลักษณะ TAB
$route['human-assessment'] = 'HumanAssessment/index';

// กำหนดรายการกิจกรรมสำหรับการประเมิน
$route['assessment-definetion-group'] = 'HumanAssessment/assessment_group';
$route['insert-assessment-definetion-group'] = 'HumanAssessment/assessment_group_add';
$route['update-assessment-definetion-group'] = 'HumanAssessment/assessment_group_edit';
$route['delete-assessment-definetion-group'] = 'HumanAssessment/assessment_group_delete';

// กำหนดรายการประเมินย่อย
$route['assessment-definetion-topic/(:num)'] = 'HumanAssessment/assessment_topic/$1';
$route['insert-assessment-definetion-topic'] = 'HumanAssessment/assessment_topic_add';
$route['update-assessment-definetion-topic'] = 'HumanAssessment/assessment_topic_edit';
$route['delete-assessment-definetion-topic'] = 'HumanAssessment/assessment_topic_delete';

// รายละเอียดการประเมินผลการปฏิบัติงาน
$route['human-assessment-activities/(:num)'] = 'HumanAssessment/assessment_activities/$1';
$route['insert-human-assessment-activities'] = 'HumanAssessment/assessment_activities_add';
$route['delete-human-assessment-activities'] = 'HumanAssessment/assessment_activities_delete';
$route['print-human-assessment-activities/(:num)'] = 'HumanAssessment/assessment_activities_print/$1';
$route['print-human-assessment-activities-form/(:num)'] = 'HumanAssessment/assessment_activites_form_print/$1';



##====================================================================#
# คลังแบบฟอร์มเอกสาร 
#====================================================================#
// 
$route['documents-stock'] = 'Accessories/documents_stock';
// คลังภาพ
$route['picture-stock'] = 'Accessories/picture_stock';

//// สารบรรณอิเลคทรอนิกส์ (รับ-ส่งหนังสือ)
//$route['electornic-documents'] = 'Accessories/edoc';
//$route['send-document-to'] = 'Accessories/outbox_send';
//$route['update-outbox-document'] = 'Accessories/outbox_send_edit';
//$route['delete_document-to-send'] = 'Accessories/outbox_send_delete';
//$route['go-to-inbox'] = "Accessories/inbox";
//$route['go-to-outbox'] = "Accessories/outbox";
//// ตรวจสอบหนังสือออก
//$route['check-edoc/(:num)'] = 'Accessories/outbox_check_status/$1';
//สารบรรณอิเลคทรอนิกส์(รับ-สง่หนังสอื )
$route['electornic-documents'] = 'Accessories/edoc';
$route['send-document-to'] = 'Accessories/outbox_send';
$route['update-outbox-document'] = 'Accessories/outbox_send_edit';
$route['delete_document-to-send'] = 'Accessories/outbox_send_delete';
$route['go-to-inbox'] = "Accessories/inbox";
$route['go-to-outbox'] = "Accessories/outbox";
$route['open-inbox'] = 'Accessories/open_inbox';
$route['edoc-fast-define'] = 'Accessories/edoc_fast_define';
$route['insert-edoc-fast-define'] = 'Accessories/edoc_fast_define_add';
$route['update-edoc-fast-define'] = 'Accessories/edoc_fast_define_edit';
$route['delete-edoc-fast-define'] = 'Accessories/edoc_fast_define_delete';
$route['edoc-permission-define'] = 'Accessories/edoc_permission_define';
$route['insert-edoc-permission-define'] = 'Accessories/edoc_permission_define_add';
$route['update-edoc-permission-define'] = 'Accessories/edoc_permission_define_edit';
$route['delete-edoc-permission-define'] = 'Accessories/edoc_permission_define_delete';

// บริหารงานทั่วไป 
$route['network-of-km'] = 'Management/km_network'; // show km network
$route['insert-network-of-km'] = 'Management/km_network_add'; // insert km network
$route['km-network-show-detail'] = 'Management/km_network_detail'; // show detail
$route['update-network-of-km'] = "Management/km_network_edit"; // edit data;
$route['delete-network-of-km'] = "Management/km_network_delete"; //delete;
//
// บันทึกการมาปฏิบัติงาน
$route['record-employee-activities'] = "Management/employee_activities";
$route['insert-employee-activities'] = "Management/employee_activities_insert";
$route['update-employee-activities'] = "Management/employee_activities_edit";
$route['delete-employee-activities'] = "Management/employee_activities_delete";
//---- บันทึกเวลาบุคลากร
$route['hr-absent-record-base'] = "Hr_absent_record/Hr_absent_record_base";
//----ใบลาออนไลน์
$route['leave-online'] = "Hr_absent_record/hr_leave_online";
$route['e-leave'] = "Electronic_Leave/electronic_leave_base";
// การพัฒนาบุคลากรทางการศึกษา
$route['human_resources_development'] = "Management/hr_development";
$route['insert_human_resources_dev'] = "Management/hr_dev_insert";
$route['update-human-resources-dev'] = 'Management/hr_dev_edit';
$route['delete-human-resources-dev'] = 'Management/hr_dev_delete';
$route['print-human-resources-dev'] = 'Management/hr_dev_print';

// การส่งเสริมยกย่องเชิดชูเกียรติ/รางวัลเกียรติยศ
$route['human-resources-give-up'] = 'Management/hr_give_up';
$route['insert-human-resources-give-up'] = 'Management/hr_give_up_add';
$route['update-human-resources-give-up'] = 'Management/hr_give_up_edit';
$route['delete-human-resources-give-up'] = 'Management/hr_give_up_delete';


// การจัดสรรงบประมาณ

$route['school-loan'] = "SchoolLoan/index";
$route['loan-managment'] = 'SchoolLoan/index';
$route['insert-loan-managment'] = 'SchoolLoan/loan_add';
$route['update-loan-management'] = 'SchoolLoan/loan_edit';
$route['delete-loan-management'] = 'SchoolLoan/loan_delete';
// รายละเอียดการเบิกจ่ายงบประมาณ
$route['loan-payment-detail/(:num)'] = 'SchoolLoan/loan_payment/$1';
$route['insert-loan-payment-detail'] = 'SchoolLoan/loan_payment_add';
$route['update-loan-payment-detail'] = 'SchoolLoan/loan_payment_edit';
$route['delete-loan-payment-detail'] = 'SchoolLoan/loan_payment_delete';
$route['print-loan-payment-detail/(:num)'] = 'SchoolLoan/loan_payment_print/$1';

// การจัดสรรงบประมาณให้โรงเรียนที่ร้องขอ
$route['loan-management-external'] = 'SchoolLoan/loan_management_ext';
$route['insert-loan-management-external'] = 'SchoolLoan/loan_management_ext_add';
$route['update-loan-management-external'] = 'SchoolLoan/loan_management_ext_edit';
$route['delete-loan-management-external'] = 'SchoolLoan/loan_management_ext_delete';
// รายละเอียดค่าใช้จ่าย
$route['loan-payment-detail_ext/(:num)'] = 'SchoolLoan/loan_payment_ext/$1';

# ----------------------------------------------------------------------------+
# Router Group  ระบบการวางแผนพัฒนาการศึกษาและปฏิทินการปฏิบัติงาน
# Purpose       1) จัดทำแผนงานโครงการแ 2) กำหนดรายละเอียดปฏิทินการศึกษา
# Author        CH. Bundhit
# ----------------------------------------------------------------------------+
# 
// กำหนดยุทธศาสตร์ของจังหวัด
$route['provice-strategies-definetion'] = 'EducationPlan/province_strategies';
$route['provice-strategic-definetion'] = 'EducationPlan/province_strategic';
$route['insert-province-strategies'] = 'EducationPlan/province_strategies_insert';
$route['update-province-strategies'] = 'EducationPlan/province_strategies_edit';
$route['delete-province-strategies'] = 'EducationPlan/province_strategies_delete';

// กำหนดยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น
$route['localgov-strategic-definetion'] = "EducationPlan/localgov_strategic";
$route['localgov-strategies-definetion'] = "EducationPlan/localgov_strategies";
$route['insert-localgov-strategies'] = "EducationPlan/localgov_strategies_insert";
$route['update-localgov-strategies'] = "EducationPlan/localgov_strategies_edit";
$route['delete-localgov-strategies'] = "EducationPlan/localgov_strategies_delete";

// กำหนดยุทธศาสตร์กอง
$route['education-strategic-definetion'] = "EducationPlan/education_strategic";
$route['education-strategies-definetion'] = "EducationPlan/education_strategies";

// กำหนดยุทธศาสตร์โรงเรียน
$route['school-strategic-definetion'] = "EducationPlan/school_strategic";
$route['school-strategies-definetion'] = "EducationPlan/school_strategies";

// กำหนดยุทธศาสตร์ย่อย
$route['localgov-sub-strategies'] = "EducationPlan/localgov_sub_st";
$route['insert-localgov-sub-strategies'] = 'EducationPlan/localgov_sub_st_add';
$route['update-localgov-sub-strategies'] = 'EducationPlan/localgov_sub_st_edit';
$route['delete-localgov-sub-strategies'] = 'EducationPlan/localgov_sub_st_delete';

// กำหนดประเภทแผนงานโครงการ
$route['localgov-type-of-plan'] = 'EducationPlan/localgov_plan_type';
$route['insert-localgov-plan-type'] = 'EducationPlan/localgov_plan_add';
$route['update-localgov-plan-type'] = 'EducationPlan/localgov_plan_edit';
$route['delete-localgov-plan-type'] = 'EducationPlan/localgov_plan_delete';

// การจัดทำแผน

$route['school-planing'] = "EducationPlan/school";
$route['project-planing'] = "EducationPlan/project_planing";
$route['education-planing'] = "EducationPlan/index";
$route['insert-education-plan'] = 'EducationPlan/insert_plan';
$route['update-education-plan'] = 'EducationPlan/edit_plan';
$route['delete-education-plan'] = "EducationPlan/delete_plan";

// ดึงข้อมูลจากตาราง project
$route['push-data-form-project'] = 'EducationPlan/get_project_detail';

// วัตถุประสงค์
$route['project-purpose/(:num)'] = 'EducationPlan/project_purpose/$1';
$route['project-plan-purpose/(:num)'] = 'EducationPlan/project_plan_purpose/$1';
$route['insert-project-purpose'] = 'EducationPlan/project_purpose_add';
$route['update-project-purpose'] = 'EducationPlan/project_purpose_edit';

// เป้าหมาย (ผลผลิตของโครงการ
$route['project-goal/(:num)'] = 'EducationPlan/project_goal/$1';
$route['project-plan-goal/(:num)'] = 'EducationPlan/project_plan_goal/$1';
$route['insert-project-goal'] = 'EducationPlan/project_goal_add';
$route['edit-project-goal'] = 'EducationPlan/project_goal_edit';
$route['delete-project-goal'] = 'EducationPlan/project_goal_delete';

// วิธีการดำเนินงาน
$route['project-plan-timeline/(:num)'] = 'EducationPlan/project_plan_timeline/$1';

// การติดตามและประเมินผล
$route['project-plan-evaluation/(:num)'] = 'EducationPlan/project_plan_evaluation/$1';


// งบประมาณที่ผ่านมา
$route['project-loan/(:num)'] = "EducationPlan/project_loan/$1";
$route['project-plan-loan/(:num)'] = "EducationPlan/project_plan_loan/$1";
$route['insert-loan-year'] = 'EducationPlan/loan_year_add';
$route['update-loan-year'] = 'EducationPlan/loan_year_edit';
$route['delete-loan-year'] = 'EducationPlan/loan_year_delete';

// KPI
$route['project-kpi/(:num)'] = "EducationPlan/project_kpi/$1";
$route['project-plan-kpi/(:num)'] = "EducationPlan/project_plan_kpi/$1";
$route['insert-project-kpi'] = 'EducationPlan/project_kpi_add';
$route['update-project-kpi'] = 'EducationPlan/project_kpi_edit';
$route['delete-project-kpi'] = 'EducationPlan/project_kpi_delete';

// Project destination
$route['project-destination/(:num)'] = "EducationPlan/project_destination/$1";
$route['project-plan-destination/(:num)'] = "EducationPlan/project_plan_destination/$1";
$route['insert-project-destination'] = 'EducationPlan/project_destination_add';
$route['update-project-destination'] = 'EducationPlan/project_destination_edit';
$route['delete-project-destination'] = 'EducationPlan/project_destination_delete';

// พิมพ์ข้อมูลโครงการ
//$route['print-project/(:num)'] = 'EducationPlan/project_print/$1';
$route['print-project-plan-all'] = 'EducationPlan/project_plan_print_all';
$route['print-project-plan/(:num)'] = 'EducationPlan/project_plan_print/$1';

// ระบบส่งเสริมสนับสนุน กำกับดูแลติดตามและประเมินผลคุณภาพการศึกษาของสถานศึกษาในสังกัด
$route['education-evaluation'] = "EducationEvaluation/education_evaluation";
$route['insert-education-evaluation-data'] = 'EducationEvaluation/insert_evaluation';
$route['update-education-evaluation-data'] = 'EducationEvaluation/edit_evaluation';
$route['delete-education-evaluation-data'] = 'EducationEvaluation/delete_evaluation';
$route['print-education-evaluation-data/(:num)'] = 'EducationEvaluation/print_evaluation/$1';

// กำหนดรายการงานส่งเสริม
$route['education-evaluation-category'] = 'EducationEvaluation/ev_category';
$route['insert-evaluation-category'] = 'EducationEvaluation/ev_category_add';
$route['update-evaluation-category'] = 'EducationEvaluation/ev_category_edit';
$route['delete-evaluation-category'] = 'EducationEvaluation/ev_category_delete';

// กำหนดรายการงานย่อย
$route['education-evaluation-activities'] = 'EducationEvaluation/ev_activities';
$route['insert-education-evaluation-activities'] = 'EducationEvaluation/ev_activities_add';
$route['update-education-evaluation-activities'] = 'EducationEvaluation/ev_activities_edit';
$route['delete-education-evaluation-activities'] = 'EducationEvaluation/ev_activities_delete';

// ขั้นตอนการดำเนินงาน
$route['education-evaluation-progress/(:num)'] = 'EducationEvaluation/ev_progress/$1';
$route['insert-education-evaluation-progress'] = 'EducationEvaluation/ev_progress_add';
$route['update-education-evaluation-progress'] = 'EducationEvaluation/ev_progress_edit';
$route['delete-education-evaluation-progress'] = 'EducationEvaluation/ev_progress_delete';
$route['print-education-evaluation-progress/(:num)'] = 'EducationEvaluation/ev_progress_print/$1';

// ค่าใช้จ่ายในการดำเนินงาน
$route['education-evaluation-payment/(:num)'] = 'EducationEvaluation/ev_payment/$1';
$route['insert-education-evaluation-payment'] = 'EducationEvaluation/ev_payment_add';
$route['update-education-evaluation-payment'] = 'EducationEvaluation/ev_payment_edit';
$route['delete-education-evaluation-payment'] = 'EducationEvaluation/ev_payment_delete';
$route['print-education-evaluation-payment/(:num)'] = 'EducationEvaluation/ev_payment_print/$1';

// เอกสาร-ภาพประกอบ
$route['education-evaluation-documents/(:num)'] = 'EducationEvaluation/ev_documents/$1';
$route['insert-education-evaluation-documents'] = 'EducationEvaluation/ev_documents_add';
$route['update-education-evaluation-documents'] = 'EducationEvaluation/ev_documents_edit';
$route['delete-education-evaluation-documents'] = 'EducationEvaluation/ev_documents_delete';

// พิมพ์ข้อมูล
$route['education-evaluation-print/(:num)'] = 'EducationEvaluation/ev_print/$1';




// mission vission
$route['vision'] = 'EducationPlan/vision';
$route['purpose'] = 'EducationPlan/purpose';
$route['mission'] = 'EducationPlan/mission';



# ----------------------------------------------------------------------------+
# Router Group  km-base
# Purpose       ระบบแหล่งเรียนรู้ภายในท้องถิ่น
# Author        Fluke
# Comment       C = Learning_centers/M = Vichakarn_model/V = learning_centers
# ----------------------------------------------------------------------------+
//
$route['km-base'] = "Learning_centers/km_base";
$route['km-insert-view'] = "Learning_centers/km_insert_view";
$route['km-insert'] = "Learning_centers/km_insert";
$route['km-update'] = "Learning_centers/km_update";
$route['km-edit'] = "Learning_centers/km_edit";
$route['km-delete'] = "Learning_centers/km_delete";
$route['km-base-detail'] = 'Learning_centers/km_detail';

# ----------------------------------------------------------------------------+
# Router Group  std-base
# Purpose       ข้อมูลนักเรียน
# Author        Fluke
# Comment       C = student / M = My_model / V = student
# ----------------------------------------------------------------------------+
//
$route['std-base'] = "Student/std_base";
$route['std-insert-view'] = "Student/std_insert_view";
$route['std-insert'] = "Student/std_insert";
$route['std-edit'] = "Student/std_edit";
$route['std-update'] = "Student/std_update";
$route['std-delete'] = "Student/std_delete";
$route['std-base-detail'] = "Student/std_detail";
$route['std-search'] = "Student/std_search";

$route['student-management-base'] = "Student/student_management_base";

# ----------------------------------------------------------------------------+
# Router Group  public-relationship
# Purpose       งานประชาสัมพันธ์
# Author        Fluke
# Comment       C = Public_relations / M = My_model / V = public_relations
# ----------------------------------------------------------------------------+
//
$route['public-relationship'] = "Public_relations/pr_base";
$route['insert-public-relations'] = "Public_relations/pr_insert";
$route['pr-edit'] = "Public_relations/pr_edit";
$route['pr-update'] = "Public_relations/pr_update";
$route['pr-delete'] = "Public_relations/pr_delete";
$route['pr-base-detail'] = "Public_relations/pr_detail";
$route['print-pr-base-detail/(:num)'] = 'Public_relations/pr_print/$1';

# ----------------------------------------------------------------------------+
# Router Group  school-qa-report
# Purpose       งานประกันคุณภาพ
# Author        
# Comment       
# ----------------------------------------------------------------------------+
//
//$route['school-qa-report'] = 'Vichakarn/school_qa_report';
$route['school-qa-report'] = 'Qa/qa_report';

// QA
$route['qa-report'] = 'Qa/qa_report';
$route['qa-base'] = 'Qa/qa_base';
$route['qa-insert-view'] = 'Qa/qa_insert_view';
$route['qa-insert'] = 'Qa/qa_insert';
$route['qa-edit'] = 'Qa/qa_edit';
$route['qa-update'] = 'Qa/qa_update';

$route['qa-insert-sub-view'] = 'Qa/qa_insert_sub_view';
$route['qa-insert-sub'] = 'Qa/qa_insert_sub';

$route['qa-insert-issue-view'] = 'Qa/qa_insert_issue_view';
$route['qa-insert-issue'] = 'Qa/qa_insert_issue';

# ----------------------------------------------------------------------------+
# Router Group  ev-base
# Purpose       งานประเมินคุณภาพ
# Author        
# Comment       
# ----------------------------------------------------------------------------+
//
$route['ev-base'] = "Evaluation_form/index";
$route['ev-form'] = "Evaluation_form/ev_form";
$route['ev-insert-view'] = "Evaluation_form/ev_insert_view";
$route['ev-insert-name'] = "Evaluation_form/ev_insert_name";
$route['ev-delete'] = "Evaluation_form/ev_delete";
$route['ev-modal'] = "Evaluation_form/ev_modal";


//------------งานคัดเลือกหนังสือ------------//
//- C = book_selection / M = My_model / V = book_selection -//
$route['bs-base'] = "Book_selection/bs_base";
$route['bs-insert-view'] = "Book_selection/bs_insert_view";
$route['bs-insert'] = "Book_selection/bs_insert";
$route['bs-edit'] = "Book_selection/bs_edit";
$route['bs-update'] = "Book_selection/bs_update";
$route['bs-delete'] = "Book_selection/bs_delete";
$route['bs-base-detail'] = "Book_selection/bs_detail";
//------------------งานคัดเลือกหนังสือจบ--------------/
//- C = edu_research / M = My_model / V = edu_research -//
$route['er-base'] = "Edu_research/er_base";
$route['er-insert-view'] = "Edu_research/er_insert_view";
$route['er-insert'] = "Edu_research/er_insert";
$route['er-edit'] = "Edu_research/er_edit";
$route['er-update'] = "Edu_research/er_update";
$route['er-delete'] = "Edu_research/er_delete";
$route['er-base-detail'] = "Edu_research/er_detail";
//------------งานอาคารและสถานที่------------//
//- C = building / M = My_model / V = building -//
$route['bd-base'] = 'Building/bd_base';
$route['bd-insert-view'] = 'Building/bd_insert_view';
$route['bd-insert'] = "Building/bd_insert";
$route['bd-edit'] = "Building/bd_edit";
$route['bd-update'] = "Building/bd_update";
$route['bd-delete'] = "Building/bd_delete";
$route['bd-base-detail'] = "Building/bd_detail";


# ----------------------------------------------------------------------------+
# Router Group  vocational
# Purpose       งานอาชีวศึกษา
# Author        Mr.Hidemi Minakawa
# Comment       -
# ----------------------------------------------------------------------------+
// กำหนดประเภทสถานประกอบการ 
$route['company-type'] = 'Vocational/company_type';

//
$route['vocational-company'] = 'Vocational/company'; // ข้อมูลสถานประกอบการ
#------------------------------------
# Edutech Team
#------------------------------------
//------------�?�?ิทิ�?�?�?ิ�?ัติ�?า�?------------
$route['ed-activity-planing'] = 'Vichakarn/activity_plan';
$route['activity-planing'] = 'Eschool/activity_plan';

//------�?าร�?ัดทำระเ�?ีย�?�?�?ะ�?�?ว�?�?ิ�?ัติเ�?ี�?ยว�?ั�?�?า�?ด�?า�?วิ�?า�?าร�?อ�?สถา�?ศึ�?ษา----
$route['operational-regulation'] = 'school/Vichakarn/op_regulation';


//-------------พัฒนาหลักสูตร ---------
$route['development-course'] = 'school/Vichakarn/dc_index';
$route['dc-base-setting'] = "Dc/dc_base_setting"; //โครงสร้างรายวิชา
$route['insert-course'] = "Dc/dc_insert_base";
//$route['insert-course'] = 'dc/dc_insert_base'
//$route['curriculum'] = "Dc/dc_base"; //�?า�?�?ลุ�?�?ห�?�?า�?ร�?
$route['curriculum'] = "Develop_courses/index"; //�?า�?�?ลุ�?�?ห�?�?า�?ร�?
//Develop_courses/dc_base
//$route['course'] = 'Develop_courses/index';//�?า�?เ�?�?�?
$route['course'] = 'Dc/dc_base'; //�?า�?เ�?�?�?
$route['dc-insert-gl'] = 'Develop_courses/dc_insert_gl';
$route['dc-insert-std'] = 'Develop_courses/dc_insert_std';
$route['dc-insert-kpi'] = 'Develop_courses/dc_insert_kpi';
$route['dc-insert-1'] = 'Develop_courses/dc_insert_1';
$route['dc-insert-2'] = 'Develop_courses/dc_insert_2';
$route['dc-insert-3'] = 'Develop_courses/dc_insert_3';
$route['dc-edit'] = 'Develop_courses/dc_edit';
$route['course-structure'] = "Ep/ep_base"; //�?า�?�?�?�?�?ารสอ�?�?ลุ�?�?
$route['teaching-plan'] = "Ep/ep_plan";
//------------------------------------
//------------�?ัด�?ารห�?อ�?เรีย�?-----------
$route['ed-room'] = 'school/Vichakarn/ed_room';
$route['ed-room-admin'] = 'school/Vichakarn/ed_room_admin';
$route['ed-homeroom'] = 'school/Vichakarn/ed_homeroom';
$route['hr-homeroom'] = "Homeroom/hr_homeroom_base";
$route['ed-schedule'] = 'school/Schedule/ed_schedule';
$route['ed-schedule-report'] = 'school/Schedule/ed_schedule_report';
$route['ed-schedule-report-individual'] = 'school/Schedule/ed_schedule_report_individual';
$route['ed-section'] = 'school/Schedule/ed_schedule_section';
$route['ed-course-teacher'] = 'school/Schedule/ed_schedule_teacher';
$route['ed-schedule-individual'] = 'school/Schedule/ed_schedule_report_individual_list';

//------------�?า�?วัด�?ล�?ระเมิ�?�?ล---------
$route['ed-evaluation'] = 'school/Vichakarn/ed_evaluation';
$route['homeroom-check-in'] = 'school/Vichakarn/homeroom_checkin';
$route['classroom-check-in'] = 'school/Vichakarn/classroom_checkin';
$route['report-exam-01'] = 'school/Exam/report_exam_01';



//------------สมรรถ�?ะ �?ุณลั�?ษณ�? อ�?า�?�?ิด-----------
$route['ed-capacity'] = 'Ed_capacity/ed_capacity';
$route['ed-capacity-insert-view'] = 'Ed_capacity/ed_capacity_insert_view';
$route['ed-capacity-insert'] = 'Ed_capacity/ed_capacity_insert';
$route['ed-capacity-edit'] = 'Ed_capacity/ed_capacity_edit';
$route['ed-capacity-update'] = 'Ed_capacity/ed_capacity_update';

$route['ed-charactor'] = 'Ed_charactor/ed_charactor';
$route['ed-charactor-insert-view'] = 'Ed_charactor/ed_charactor_insert_view';
$route['ed-charactor-insert'] = 'Ed_charactor/ed_charactor_insert';
$route['ed-charactor-edit'] = 'Ed_charactor/ed_charactor_edit';
$route['ed-charactor-update'] = 'Ed_charactor/ed_charactor_update';

$route['ed-rw-analysis'] = 'Ed_rw_analysis/ed_rw_analysis';
$route['ed-rw-analysis-insert-view'] = 'Ed_rw_analysis/ed_rw_analysis_insert_view';
$route['ed-rw-analysis-insert'] = 'Ed_rw_analysis/ed_rw_analysis_insert';
$route['ed-rw-analysis-edit'] = 'Ed_rw_analysis/ed_rw_analysis_edit';
$route['ed-rw-analysis-update'] = 'Ed_rw_analysis/ed_rw_analysis_update';

$route['ed-capacity-insert-sub-view'] = 'Ed_capacity/ed_capacity_insert_sub_view';
$route['ed-capacity-insert-sub'] = 'Ed_capacity/ed_capacity_insert_sub';

$route['ed-charactor-insert-sub-view'] = 'Ed_charactor/ed_charactor_insert_sub_view';
$route['ed-charactor-insert-sub'] = 'Ed_charactor/ed_charactor_insert_sub';

$route['ed-rw-analysis-insert-sub-view'] = 'Ed_rw_analysis/ed_rw_analysis_insert_sub_view';
$route['ed-rw-analysis-insert-sub'] = 'Ed_rw_analysis/ed_rw_analysis_insert_sub';
$route['ed-rw-analysis-insert-score-view'] = 'Ed_rw_analysis/ed_rw_analysis_insert_score_view';
$route['ed-rw-analysis-insert-score'] = 'Ed_rw_analysis/ed_rw_analysis_insert_score';

$route['student-kpi'] = "Kpi_input/kpi_base";
$route['student-register-base'] = "Student/std_register_base";
$route['student-register'] = "Student/std_register";

//----------------�?ั�?ทึ�?�?ิ�?�?รรม---------------\\
$route['ed-activity'] = 'Ed_activity/ed_activity';
$route['ed-activity-insert-view'] = 'Ed_activity/ed_activity_insert_view';
$route['ed-activity-insert'] = 'Ed_activity/ed_activity_insert';
$route['ed-activity-insert-score-view'] = 'Ed_activity/ed_activity_insert_score_view';
$route['ed-activity-insert-score'] = 'Ed_activity/ed_activity_insert_score';
$route['ed-activity-edit'] = 'Ed_activity/ed_charactor_edit';
$route['ed-activity-update'] = 'Ed_activity/ed_charactor_update';


//----------------new ed-capacity --------------
$route['ed-capacity-insert-sub-view'] = 'Ed_capacity/ed_capacity_insert_sub_view';
$route['ed-capacity-insert-sub'] = 'Ed_capacity/ed_capacity_insert_sub';
$route['ed-capacity-insert-score-view'] = 'Ed_capacity/ed_capacity_insert_score_view';
$route['ed-capacity-insert-score'] = 'Ed_capacity/ed_capacity_insert_score';
$route['ed-capacity-detail'] = 'Ed_capacity/ed_capacity_detail';

//----------------new ed-charactor--------------
$route['ed-charactor-insert-sub-view'] = 'Ed_charactor/ed_charactor_insert_sub_view';
$route['ed-charactor-insert-sub'] = 'Ed_charactor/ed_charactor_insert_sub';
$route['ed-charactor-insert-score-view'] = 'Ed_charactor/ed_charactor_insert_score_view';
$route['ed-charactor-insert-score'] = 'Ed_charactor/ed_charactor_insert_score';

//----------------new ed-rw-analysis --------------
$route['ed-rw-analysis-insert-sub-view'] = 'Ed_rw_analysis/ed_rw_analysis_insert_sub_view';
$route['ed-rw-analysis-insert-sub'] = 'Ed_rw_analysis/ed_rw_analysis_insert_sub';
$route['ed-rw-analysis-insert-score-view'] = 'Ed_rw_analysis/ed_rw_analysis_insert_score_view';
$route['ed-rw-analysis-insert-score'] = 'Ed_rw_analysis/ed_rw_analysis_insert_score';
$route['ed-rw-analysis-form'] = 'Ed_rw_analysis/index';


//----------�?�?ะ�?�?ว--------
$route['gd-base'] = "Guidance/gd_base";
$route['gd-edit'] = "Guidance/gd_edit";

//--------ระบบพัสดุ---------
$route['home_parcel'] = 'parcel/Home_parcel/index';
$route['parcel'] = 'parcel/Approve_purchase/listdata';
$route['department'] = 'parcel/Department/index';
$route['seller'] = 'parcel/Seller/index';
$route['purchaser'] = 'parcel/Purchaser/index';
$route['committee'] = 'parcel/Committee/index';
$route['number'] = 'parcel/Number/index';
$route['material'] = 'parcel/Material/index';
$route['articles'] = 'parcel/Articles/index';
$route['unspsc'] = 'parcel/Unspec/index';
$route['plan'] = 'parcel/Plan/index';
$route['plan_month/:num'] = 'parcel/Plan_month/index';
$route['approve_purchase'] = 'parcel/Approve_purchase/index';
$route['carry'] = 'parcel/Carry/index';
$route['egp'] = 'parcel/Egp/index';
$route['purchase-project-list/(:num)'] = 'parcel/Approve_purchase/get_purchase_list_by_project/$1';
//$route['selling'] = 'Percel/selling';
//----------------�?า�?สภา�?ั�?เรีย�?---------------\\
$route['student-council'] = "Student_council/student_council";
$route['student-council-insert-view'] = "Student_council/student_council_insert_view";
$route['student-council-insert'] = "Student_council/student_council_insert";
$route['student-council-edit'] = "Student_council/student_council_edit";
$route['student-council-update'] = "Student_council/student_council_update";
$route['student-council-delete'] = "Student_council/student_council_delete";
$route['student-council-base-detail'] = "Student_council/student_council_detail";


//----------------�?า�?ทัศ�?ศึ�?ษา---------------\\
$route['field-trips'] = "Field_trips/field_trips_base";
$route['field-trips-insert-view'] = "Field_trips/field_trips_insert_view";
$route['field-trips-insert'] = "Field_trips/field_trips_insert";
$route['field-trips-edit'] = "Field_trips/field_trips_edit";
$route['field-trips-update'] = "Field_trips/field_trips_update";
$route['field-trips-delete'] = "Field_trips/field_trips_delete";
$route['field-trips-base-detail'] = "Field_trips/field_trips_detail";

//------------�?า�?อัตรา�?ำลั�?-------
$route['manpower-planning'] = "Manpower/index";

$route['icare'] = "Icare/index";
$route['hr-homeroom-sdq'] = "Icare/hr_homeroom_sdq_base";
//---- พี่น้ำ

$route['sdq-base'] = 'Icare/sdq_base';
$route['sdq-type'] = 'Icare/sdq_type';
$route['sdq-topic'] = 'Icare/sdq_topic';
$route['sdq-temp-print'] = 'Icare/sdq_temp_print';
$route['home-base'] = 'Icare/home_base';
$route['activity-base'] = 'Icare/activity_base';
$route['help-base'] = 'Icare/help_base';
$route['report-base'] = 'Icare/report_base';
$route['correction-base'] = 'Icare/correction_base';

//-----งานเยี่ยมบ้าน-----
$route['visit-home'] = 'Visit_home/index';
$route['vh-base'] = 'Visit_home/vh_base';
$route['vh-insert-view'] = 'Visit_home/vh_insert_view';
$route['vh-insert'] = 'Visit_home/vh_insert';
$route['vh-base-detail'] = 'Visit_home/vh_base_detail';
$route['vh-edit'] = 'Visit_home/vh_edit';
$route['vh-update'] = 'Visit_home/vh_update';
$route['vh-delete'] = 'Visit_home/vh_delete';



$route['eq-base'] = "Icare/eq_base";


//----------------งานควบคุมภายใน---------------\\
$route['internal-control'] = "Internal_control/internal_control_base";
$route['internal-control-insert-view'] = "Internal_control/internal_control_insert_view";
$route['internal-control-insert'] = "Internal_control/internal_control_insert";
$route['internal-control-edit'] = "Internal_control/internal_control_edit";
$route['internal-control-update'] = "Internal_control/internal_control_update";
$route['internal-control-delete'] = "Internal_control/internal_control_delete";
$route['internal-control-detail'] = "Internal_control/internal_control_detail";

//------------งานปกครอง-------
$route['adm-base'] = "School_administrator/std_base";


//---------------
$route['taching-media'] = "Media_online/ms_base";
$route['online-classroom'] = "Media_online/mo_base";

//----------ระบบการเงิน-------
$route['financial-system'] = "school/Account/financial";
$route['expense'] = "school/Account/expense";
$route['ta-loan'] = "school/Account/loan";
$route['ta-loan-clearing'] = "school/Account/loan_clearing";
//----------ระบบบัญชี-------
$route['accounting-system'] = "school/Account/accounting";
$route['acc-code'] = "school/Account/accounting_code";

$route['tr-base'] = "Teach_results/tr_base";


//----------------admin โรงเรียน

$route['admin-school-base'] = 'Admin_school/admin_school_base';
$route['admin-school-base-member'] = 'Admin_school/member';
$route['school-member-permission/(:num)'] = 'Admin_school/member_activities/$1';
//---- จัดการข้อมูลพื้นฐานโรงเรียน
$route['school-base'] = "Manage_school/ms_base";
$route['position-hierarchy'] = "Admin_school/hr_position_base";


//------งานทะเบียน-------
$route['course-register'] = 'Course_register/index';
//---- ลงทะเบียนเรียน
$route['cr-base'] = "Course_register/cr_base";
$route['just-print'] = "School_registration/school_registration_base";

//--บันทึกเวลามาเรียน
$route['std-absent-record-base'] = 'Homeroom/std_absent_record_base';


//----รายงานผลการปฏิบัติงาน----
$route['rec-report-base'] = 'Rec_report/rec_report_base';
$route['rec-report-detail'] = 'Rec_report/rec_report_detail';
$route['rec-report-insert'] = 'Rec_report/rec_report_insert';
$route['rec-report-base-detail'] = 'Rec_report/rec_report_base_detail';
$route['rec-report-edit'] = 'Rec_report/rec_report_edit';
$route['rec-report-update'] = 'Rec_report/rec_report_update';
$route['rec-report-delete'] = 'Rec_report/rec_report_delete';


//---- งานเลื่อนชั้น แจ้งจบ 
$route['class-management'] = "Course_register/class_management_base";

$route['education-chat'] = "Education_chat/education_chat_base";



// คลังแสง

$route['arsenal-base'] = 'Arsenal/arsenal_base';
$route['arsenal-insert'] = 'Arsenal/arsenal_insert';
$route['arsenal-delete'] = 'Arsenal/arsenal_delete';
$route['arsenal-edit'] = 'Arsenal/arsenal_edit';


//---- ปพ.5
$route['pp5'] = "PP5/PP5_base";


//---------หน้าจอนักเรียน--------
$route['ed-exam-score'] = "StudentBase/index";



//----------Import SIS--------
$route['import-sis-std'] = 'StudentImport/index';



//---------E-Document---------
$route['edocument'] = 'Edocument/index';
$route['edocument-inbox'] = 'Edocument/inbox';
$route['edocument-register'] = 'Edocument/edoc_rc_register';
$route['edocument-outbox'] = 'Edocument/edoc_outbox';
$route['edocument-assignment'] = 'Edocument/edoc_assignment';


//-------งานครูผู้สอน---------
$route['teaching-task-base'] = "Teaching_task/teaching_task_base";
$route['teaching-task-development'] = "Teaching_task/teaching_task_development";


$route['student-self-score'] = "Student_self/student_self_score";
$route['dc-base'] = "Dc/dc_base";



$route['school-information'] = "School_information/school_information_base";

$route['hr-homeroom-wnh'] = "Homeroom/hr_homeroom_wnh_base";

$route['course-management'] = "Teacher/course_management";

$route['hr-homeroom-std'] = "Homeroom/hr_homeroom_std_base";
$route['school-administrator-base'] = "School_administrator/school_administrator_base";
//
//require_once( BASEPATH .'database/DB.php' );
//$db =& DB();
//$query = $db->get( 'tb_router' );
//$result = $query->result();
//
//   foreach($result as $r)
//   {
//        $route[ $r->tb_route_name ] = $r->tb_route_path;
////       $rout["'".$r['tb_rout_name']."'"] = "'".$r['tb_rout_path']."'";
//   }