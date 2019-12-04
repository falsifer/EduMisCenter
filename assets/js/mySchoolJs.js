function date_thai_name(date) {
    var DateArray = date.split('-');

    var day = "วันที่ " + DateArray[2] + " ";
    var month = "";
    var year = " พ.ศ." + DateArray[0];

    switch (DateArray[1]) {
        case "01":
            month = "มกราคม";
            break;
        case "02":
            month = "กุมภาพันธ์";
            break;
        case "03":
            month = "มีนาคม";
            break;
        case "04":
            month = "เมษายน";
            break;
        case "05":
            month = "พฤษภาคม";
            break;
        case "06":
            month = "มิถุนายน";
            break;
        case "07":
            month = "กรกฎาคม";
            break;
        case "08":
            month = "สิงหาคม";
            break;
        case "09":
            month = "กันยายน";
            break;
        case "10":
            month = "ตุลาคม";
            break;
        case "11":
            month = "พฤศจิกายน";
            break;
        case "12":
            month = "ธันวาคม";
            break;
    }

    var datethaifull = day + month +  year;
    return datethaifull;
}


