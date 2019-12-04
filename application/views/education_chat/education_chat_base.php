<div class="box">
    <div class="box-heading">ห้องเรียนออนไลน์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ห้องเรียนออนไลน์</li>
    </ul>
    <div class="box-body">   
        <div class="row">
            <div class="col-md-12">
                <div class="panel-footer">


                    <center><h2>ห้องเรียนออนไลน์ระดับชั้นมัธยมศึกษาปีที่ 3 ห้องที่ 6 </h2></center>
                    <span class="pull-right">
                        <h4>ชื่อนนนนนนนนน นามสกุลลลลลล</h4>
                    </span>
                </div>

            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-2">
                <div class="panel panel-default" style="height: 100%"> 
                    <div class="panel-footer"><center><h3>Tool</h3></center></div>
                    <div class="panel-body">
                        <style>
                            #mydiv {
                                position: absolute;
                                z-index: 9;
                                background-color: #f1f1f1;
                                text-align: center;
                                border: 1px solid #d3d3d3;
                                height: 250px;
                                width: 200px;
                            }

                            #mydivheader {
                                padding: 10px;
                                cursor: move;
                                z-index: 10;
                                background-color: #2196F3;
                                color: #fff;
                            }
                        </style>
                        <div id="mydiv" style="display:none">
                            <div id="mydivheader"   onmouseup="PanelLocationEvent(this)">
                            </div>
                            <img src="" id="imagedrag" name="imagedrag" style="display:box; width:120px; height:120px; margin-top: 10px"/>
                            <center>
                                <input type="text" name="imgSizeX" id="imgSizeX" class="form-control" style="width: 120px;" value="120" placeholder="ขนาดแนวตั้ง"/> 
                                <input type="text" name="imgSizeY" id="imgSizeY" class="form-control" style="width: 120px;" value="120" placeholder="ขนาดแนวนอน"/>

                            </center>

                            <center>
                                <button type="button" class="btn btn-link" id="imgok" onclick="ImgEvent(this)"><i class="icon-ok icon-large" ></i> ตกลง</button>
                                <button type="button" class="btn btn-link" id="imgremove" onclick="ImgEvent(this)"" ><i class="icon-remove icon-large" ></i> ปิด</button>
                            </center>
                            <div class="row">
                                <input type="file" name="selectedImage" id="selectedImage" class="filestyle" />
                            </div>
                        </div>
                        <center><button type="button" class="btn btn-link" id="pen" onclick="SetEvent(this)"><i class="icon-pencil icon-large" ></i> Pen</button></center>
                        <br>
                        <center><button type="button" class="btn btn-link" id="txt" onclick="SetEvent(this)"><i class="icon-font icon-large" ></i> Text</button></center>
                        <br>
                        <center><button type="button" class="btn btn-link" ><i class="icon-user icon-large"></i> Student list</button></center>
                        <br>
                        <center><button type="button" class="btn btn-link" id="imgnew" onclick="ImgEvent(this)"><i class="icon-picture icon-large"></i> Image</button></center>
                        <br>
                        <center><button type="button" class="btn btn-link" ><i class="icon-film icon-large"></i> Video</button></center>


                    </div>
                </div>
            </div>
            <div>

                <img src="" name="imgname" id="imgname"style="display : none ; height: 100px; width: 100px;"/>

                <center>
                    <canvas id="myCanvas" name="myCanvas" width="1000" height="1000"
                            style="border:10px solid #c3c3c3;">
                    </canvas>
                    <!--<video autoplay id="myVideo" name="myVideo" width="200" height="200" style="border:10px solid #c3c3c3;">-->

                    <!--</video>-->
                </center>
            </div>
        </div>   
        <br>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-footer">
                        <span class="pull-right">
                            <button type="button" class="btn btn-link btn-user"><i class="icon-user icon-large"></i></button>
                            <button type="button" class="btn btn-link btn-setting"><i class="icon-gear icon-large"></i></button>
                            <button type="button" class="btn btn-link btn-exit"><i class="icon-remove icon-large"></i></button>
                        </span>

                        <center>

                        </center>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div id="ScBar" name="ScBar" style="border:1px ;width:100%;height:300px;overflow:auto">
                                <div class="col-md-12" id="ChatBody">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <form method="post" id="insert-log-insert-form" enctype="multipart/form-data">
                        <input type="hidden" value="1" name="inGroupId" id="inGroupId" class="form-control"/>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" id="inChatContent" name="inChatContent" class="form-control" placeholder="Text here.." >
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-insert"><i class="icon-file icon-large"></i> แนบไฟล์</button>
                                    <button type="button" class="btn btn-info" onclick="insertlog(this)"><i class="icon-play icon-large" ></i> ส่งข้อความ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    //My Drag and drop
    dragElement(document.getElementById("mydiv"));

    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

</script>

<script>
//    var canvas = document.getElementById('myCanvas');
//    var video = document.getElementById('myVideo');
//    var stream = canvas.captureStream(25);
//    video.srcObject = stream;
// about steam

// Optional frames per second argument.

// Set the source of the <video> element to be the stream from the <canvas>.


//    var leftVideo = document.getElementById('leftVideo');
//    var rightVideo = document.getElementById('rightVideo');
//
//    leftVideo.onplay = function () {
//        // Set the source of one <video> element to be a stream from another.
//        var stream = leftVideo.captureStream();
//        rightVideo.srcObject = stream;
//    };

    // about img 
    function ImgEvent(e) {
        Imgtake();
        var MyLocation = $("#mydiv").offset();
        var MyClo = $("#myCanvas").offset();

        var MyXL = MyClo.left;
        var MyXT = MyClo.top;
//        alert(MyXL);

//        alert($("#myCanvas").offsetleft);
        MypX = MyLocation.left - MyXL;
        MypY = MyLocation.top - MyXT;
//        alert(MypX);

        switch (e.id) {
            case "imgnew":
                document.getElementById("mydiv").style.display = "block";
                break;
            case "imgok":
                dropimg(MypX, MypY);
                break;
            case "imgremove":
                document.getElementById("mydiv").style.display = "none";
                break;
        }

    }

    // about txt 
    function txtEvent(e) {
        var MyLocation = $("#mydiv").offset();
        var MyClo = $("#myCanvas").offset();

        var MyXL = MyClo.left;
        var MyXT = MyClo.top;
//        alert(MyXL);

//        alert($("#myCanvas").offsetleft);
        MypX = MyLocation.left - MyXL;
        MypY = MyLocation.top - MyXT;
//        alert(MypX);

        switch (e.id) {
            case "imgnew":
                document.getElementById("mydiv").style.display = "block";
                break;
            case "imgok":
                dropimg(MypX, MypY);
                break;
            case "imgremove":
                document.getElementById("mydiv").style.display = "none";
                break;
        }

    }



    //---- My Drag and drop (img)
    var MypX = 0;
    var MypY = 0;

    function DragEvent(e) {

        switch (e.id) {
            case "imgok":

                break;
            case "imgremove":
                break;
        }
    }

    context = document.getElementById('myCanvas').getContext("2d");
    var url = "";
    var EventType = "pen";

    $("#selectedImage").change(function (e) {
        var URL = window.URL;
        url = URL.createObjectURL(e.target.files[0]);
        $("#imagedrag").fadeIn("fast").attr('src', url);
    });
    function SetEvent(e) {
        EventType = e.id;
    }
    function dropimg(mouseX, mouseY) {
        var tmpImg = new Image();
        var sizeX = $("#imgSizeX").val();
        var sizeY = $("#imgSizeY").val();
        tmpImg.src = url;
        tmpImg.onload = function () {
            context.drawImage(tmpImg, mouseX, mouseY, sizeX, sizeY);
        };
    }

    $('#myCanvas').mousedown(function (e) {



        var mouseX = e.pageX - this.offsetLeft;
        var mouseY = e.pageY - this.offsetTop;

        paint = true;
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
        redraw();

    });

    $('#myCanvas').mousemove(function (e) {


        if (paint) {
            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
            redraw();
        }
    });

    $('#myCanvas').mouseup(function (e) {
        paint = false;
    });

    $('#myCanvas').mouseleave(function (e) {
        paint = false;
    });

    var clickX = new Array();
    var clickY = new Array();
    var clickDrag = new Array();
    var paint;

    function addClick(x, y, dragging)
    {
        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
    }

    function redraw() {
//        context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas

        context.strokeStyle = "#df4b26";
        context.lineJoin = "round";
        context.lineWidth = 5;
        for (var i = 0; i < clickX.length; i++) {
            context.beginPath();
            if (clickDrag[i] && i) {
                context.moveTo(clickX[i - 1], clickY[i - 1]);
            } else {
                context.moveTo(clickX[i] - 1, clickY[i]);
            }
            context.lineTo(clickX[i], clickY[i]);
            context.closePath();
            context.stroke();
        }
    }



</script>
<script>
//    setInterval(function () {
//        refresh();
//        Imgtake();
//    }, 1);
    var MyMemberId = 0;
    var MyGroupId = 0;
//    
//    var MyC = document.getElementById("myCanvas");
//    
//    function Imgtake() {
//        var img = MyC.toDataURL("image/png");
//        $.ajax({
//            url: "<?php echo site_url('Education_chat/Education_canvas_insert'); ?>",
//            method: "post",
//            data: {data: img}
//        });
//    }

    function refresh() {
        // about capture canvas 


        MyGroupId = $("#inGroupId").val();
        $.ajax({
            url: "<?php echo site_url('Education_chat/Education_chat_refresh'); ?>",
            method: "post",
            data: {GId: MyGroupId},
            success: function (data) {
                $("#ChatBody").html(data);
                $("#ScBar").scrollTop(10000);
            }
        });
    }

    function insertlog(e) {
        $.ajax({
            url: "<?php echo site_url('Education_chat/insert_log'); ?>",
            method: "post",
            data: new FormData($("#insert-log-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#inChatContent").val("");
            }
        });
    }


</script>