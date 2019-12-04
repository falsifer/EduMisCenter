$(".tableresp").on('click', '.rs-dropdown-toggle', function (event) {

    if ($('.rs-dropdown-menu').length) {
        var elm = $('.rs-dropdown-menu'),
                docHeight = $(document).height(),
                docWidth = $(document).width(),
                btn_offset = $(this).offset(),
                btn_width = $(this).outerWidth(),
                btn_height = $(this).outerHeight(),
                elm_width = elm.outerWidth(),
                elm_height = elm.outerHeight(),
                table_offset = $(".tableresp").offset(),
                table_width = $(".tableresp").width(),
                table_height = $(".tableresp").height(),
                tableoffright = table_width + table_offset.left,
                tableoffbottom = table_height + table_offset.top,
                rem_tablewidth = docWidth - tableoffright,
                rem_tableheight = docHeight - tableoffbottom,
                elm_offsetleft = btn_offset.left,
                elm_offsetright = btn_offset.left + btn_width,
                elm_offsettop = btn_offset.top + btn_height,
                btn_offsetbottom = elm_offsettop,
                left_edge = (elm_offsetleft - table_offset.left) < elm_width,
                top_edge = btn_offset.top < elm_height,
                right_edge = (table_width - elm_offsetleft) < elm_width,
                bottom_edge = (tableoffbottom - btn_offsetbottom) < elm_height;

        console.log(tableoffbottom);
        console.log(btn_offsetbottom);
        console.log(bottom_edge);
        console.log((tableoffbottom - btn_offsetbottom) + "|| " + elm_height);
        // console.log(elm_width + " element width");              
        // console.log(elm_height + " element height");

        // console.log(table_width + " table width");
        // console.log(table_offset.left + " table offset left");
        // console.log(tableoffright + " table offright");
        // console.log(docWidth + " document width");
        // console.log(rem_tablewidth + " rem table width");

        // console.log(docHeight + " doc height");
        // console.log(table_height + " table height");
        // console.log(table_offset.top + " table offset top");
        // console.log(tableoffbottom + " table offbottom");
        // console.log(rem_tableheight + " rem table height");

        // console.log(btn_offset.left + " btn offset left");
        // console.log(btn_offset.top + " btn offset top");

        var table_offset_bottom = docHeight - (table_offset.top + table_height);
        // console.log(table_offset_bottom + " table_offset_bottom");

        var touchTableBottom = (btn_offset.top + btn_height + (elm_height * 2)) - table_offset.top;
        // console.log(touchTableBottom + " touchTableBottom");
        // console.log(table_height + " table_height");
        // console.log(btn_height + " btn_height");
        // console.log(elm_height + " elm_height");

        var bottomedge = touchTableBottom > table_offset_bottom;

        if (left_edge) {
            $(this).addClass('left-edge');
        } else {
            $('.rs-dropdown-menu').removeClass('left-edge');
        }
        if (bottom_edge) {
            $(this).parent().addClass('dropup');
            // $(this).parent().removeClass('dropdown');
        } else {
            $(this).parent().removeClass('dropup');
            // $(this).parent().addClass('dropdown');
        }

    }
});
//use if table height is below 300
var table_smallheight = $('.tableresp'),
        positioning = table_smallheight.parent();

if (table_smallheight.height() < 320) {
    positioning.addClass('positioning');
    $('.tableresp .rs-dropdown,.tableresp .dropup').css('position', 'static');

} else {
    positioning.removeClass('positioning');
    $('.tableresp .rs-dropdown,.tableresp .dropup').css('position', 'relative');

}