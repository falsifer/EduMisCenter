<div class="box">
    <div class="box-heading">การพัฒนากระบวนการเรียนรู้/บทเรียนออนไลน์
        <button type="button" class="btn btn-primary btn-insert-course pull-right" onclick="insert_view(this)"><i class="icon-home icon-large"></i> บทเรียนออนไลน์ของฉัน</button>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การพัฒนากระบวนการเรียนรู้/บทเรียนออนไลน์</li>
    </ul>
    <style>

        .mycardcontent {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            margin: auto;
            text-align: left;
            font-family: arial;
            margin-top: 30px;
            padding: 10px;


        }
        .mycardcontent:hover {
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
        }

    </style>

    <div class="box-body"> 

        <div class="row">
            <div class="col-md-10 col-md-offset-1" id="MyMediaOnlineBody">
                <div class="row">          
                    <div style="margin-bottom: 10px;text-align: left">
                        <button type="button" class="btn btn-success" style="height: 50px;" id="" onclick="AllBlog(this)"><i class="icon-list icon-large"></i> เนื้อหาทั้งหมด </button>  
                        <button type="button" class="btn btn-warning" style="height: 50px;" id="" onclick="NewBlog(this)"><i class="icon-bell icon-large"></i> เนื้อหามาใหม่ </button>  
                        <button type="button" class="btn btn-info" style="height: 50px;" id="" onclick="MostViewBlog(this)"><i class="icon-user icon-large"></i> เนื้อหาที่คนเข้าชมมากที่สุด </button> 
                        <button type="button" class="btn btn-primary" style="height: 50px;" id="" onclick="MostLikedBlog(this)"><i class="icon-thumbs-up icon-large"></i> เนื้อหาที่คนชื่นชอบมากที่สุด </button> 
                        <button type="button" class="btn btn-danger" style="height: 50px;" id="" onclick="PinBlog(this)"><i class="icon-pushpin icon-large"></i> เนื้อหาที่ปักหมุดไว้ </button> 
                        <button type="button" class="btn btn-primary" style="height: 50px;" data-toggle="collapse" data-target="#MyBlogFilter"><i class="icon-filter icon-large"></i>ตัวกรองข้อมูล</button>  
                        <!--<button type="button" class="btn btn-primary" style="height: 50px;" onclick="insert_view(this)"><i class="icon-file icon-large"></i> เนื้อหาของฉัน</button>-->  
                    </div>
                </div>
                <div class="row collapse" id="MyBlogFilter">
                    <div class="col-md-3" >
                        <label class="control-label">ระดับชั้น</label>
                        <select name="inBlogVisibility" id="inBlogVisibility" class="form-control" >
                            <option value="">--เลือกข้อมูล--</option>
                            <option value="Public">มัธยมศึกษาตอนต้น</option>
                        </select>
                    </div>
                    <div class="col-md-2" >
                        <label class="control-label">ชั้นปี</label>
                        <select name="inBlogVisibility" id="inBlogVisibility" class="form-control">
                            <option value="">--เลือกข้อมูล--</option>
                            <option value="Public">มัธยมศึกษาปีที่ 1</option>
                        </select>
                    </div>
                    <div class="col-md-3" >
                        <label class="control-label">กลุ่มสาระ</label>
                        <select name="inBlogVisibility" id="inBlogVisibility" class="form-control" >
                            <option value="">--เลือกข้อมูล--</option>
                            <option value="Public">ภาษาไทย</option>
                        </select>
                    </div>
                    <div class="col-md-2" >
                        <label class="control-label">รายวิชา</label>
                        <select name="inBlogVisibility" id="inBlogVisibility" class="form-control" >
                            <option value="">--เลือกข้อมูล--</option>
                            <option value="Public">ภาษาไทย</option>
                        </select>
                    </div>
                    <div class="col-md-2" >
                        <button type="button" class="btn btn-primary" style="margin-top: 25px;"><i class="icon-search icon-large"></i> ค้นหา</button>  
                    </div>
                </div>
                <br>
                <div class="row">
                    <table class="table table-striped table-bordered display" id="BlogTable">
                        <thead>
                            <tr style="display: none">
                                <th style="text-align: center;">content</th>                                
                            </tr> 
                        </thead>
                        <tbody id="BlogContentList">

                            <?php // foreach ($rs as $r): ?>
<!--                                <tr>
        <td>
            <div class="mycardcontent" style="border:solid 3px blueviolet;">
                <button type="button" class="btn btn-link  pull-right" id="" onclick="PinBlog(this)">
                    <i class="icon-pushpin icon-large"></i>  
                </button>                                        
                <div class="row">
                    <div class="col-md-3">
                            <?php echo img("images/avata.png"); ?>
                    </div>
                    <div class="col-md-8 ">
                        <div class="row">
                            <h1 class="pull-left"><?php echo $r['tb_blog_title']; ?></h1>
                        </div>
                        <div class="row">
                            <?php echo $r['tb_blog_content']; ?>                                   
                        </div>
                        <div class="row" style="margin-top: 30px ">

                            <button type="button" class="btn btn-link"onclick="StdList(this)">
                                <i class="icon-eye-open icon-large" style="margin-right: 10px;"> </i>
                                สาธารณะ
                            </button>
                            <button type="button" class="btn btn-link"onclick="StdList(this)">
                                <i class="icon-user icon-large" style="margin-right: 10px;"> </i>
                                เยี่ยมชม 0 ครั้ง
                            </button>
                            <button type="button" class="btn btn-link"onclick="StdList(this)">
                                <i class="icon-thumbs-up icon-large" style="margin-right: 10px;"></i>
                                ถูกใจ 0 คน
                            </button>
                                                                                <button type="button" class="btn btn-link"onclick="StdList(this)">
                                                                                    <i class="icon-share icon-large" style="margin-right: 10px;"></i>
                                                                                    เผยแพร่ข้อมูล
                                                                                </button>
                            <button type="button" style="margin-left: 10px;"class="btn btn-primary" id="" onclick="StdList(this)"><i class="icon-play icon-large"></i> เข้าสู่เนื้อหา</button>
                        </div>
                    </div>
                </div>
            </div> 
        </td>
    </tr>-->
                            <?php // endforeach; ?>  

                        </tbody>
                    </table>
                </div>  

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("mo/blog_detail_modal"); ?>
<script>
    var blogid = 0;
//base
    function AllBlog(e) {
        $.ajax({url: "<?php echo site_url('Media_online/blog_base_all_blog'); ?>", success: function (data) {
                $("#BlogContentList").html(data);
                BlogTableReload();

            }});
    }
//-- detail
    function BlogDetail(e) {
        blogid = e.id;
        $.ajax({url: "<?php echo site_url('Media_online/blog_detail'); ?>", method: "POST", data: {id: blogid}, success: function (data) {

                $("#blog-detail-modal").modal("show");
                $("#BlogDetail").html(data);
                $("#MySchoolAreaId").val("BlogDetail");
            }});
    }
</script>
<script>
//    function BlogTableReload() {
    $('#BlogTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });

    window.onload = function () {
        var CourseId = "";
        $.ajax({
            url: "<?php echo site_url('Media_online/get_onload'); ?>",
            method: "POST",
            data: {id: '<?php echo $this->input->get("sc_id"); ?>'},
            success: function (data) {
                $('#CourseId').val(data);
            }
        });
        BlogTableReload();
    };
</script>

<script>
    function insert_view(e) {
        $.ajax({url: "<?php echo site_url('Media_online/media_online_insert_view'); ?>", success: function (data) {
                $("#MyMediaOnlineBody").html(data);
                MyTextareareload();
            }});
    }

    function insert_view_close(e) {
        location.reload();
    }

    function EditBlog(e) {
//        $('InsertNewBox').collapse();
        $.ajax({
            url: "<?php echo site_url('Media_online/blog_edit'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#inId").val(data.id);

                $("#inBlogTitle").val(data.tb_blog_title);
                $("#inBlogVisibility").val(data.tb_blog_visibility);
                $("#inSchoolClassId").val(data.tb_ed_school_class_id);
                $("#inGroupLearning").val(data.tb_group_learning_id);
                CKEDITOR.instances.inBlogContent.setData(data.tb_blog_content);

            }
        });
    }

    function InsertBlog(e) {
        var Content = CKEDITOR.instances.inBlogContent.getData();
        $.ajax({
            url: "<?php echo site_url('Media_online/blog_insert'); ?>",
            method: "POST",
            data: {id: $("#inId").val(), glid: $("#inGroupLearning").val(), scid: $("#inSchoolClassId").val(), title: $("#inBlogTitle").val(), content: Content, visib: $("#inBlogVisibility").val()},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#inId").val("");
                $("#inBlogTitle").val("");
                $("#inBlogContent").val("");
                location.reload();
            }
        });
    }

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    function MyTextareareload() {
        CKEDITOR.replace('inBlogContent');
        function CKupdate() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        }
    }

</script>
