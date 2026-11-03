<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ajax - Danh sách lớp</title>
<link href="style/style.css" type="text/css" rel="stylesheet">
<script>
function sendajax(){
    var lop = document.getElementById("lop").value;
    var objds = document.getElementById("ds");
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if (xml.readyState == 4 && xml.status == 200) {
            objds.innerHTML = xml.responseText;
        }
    };
    var url = "ds.php?lop=" + encodeURIComponent(lop);
    xml.open("GET", url, true);   // true = bất đồng bộ
    xml.send();
}
window.onload = sendajax;  // hiển thị ngay danh sách của lớp đầu tiên
</script>
</head>
<body>
<h3>In danh sách theo từng lớp</h3>
<?php
include("inc/connect.inc");
function initClass($conn){
    $sql = "SELECT DISTINCT lop FROM sinhvien";
    $rs = mysqli_query($conn, $sql);
    $str = "Chọn lớp: <select id='lop' onchange='sendajax();'>";
    while ($row = mysqli_fetch_array($rs)) {
        $str .= "<option value='{$row['lop']}'>{$row['lop']}</option>";
    }
    $str .= "</select>";
    echo $str;
}
initClass($con);
?>
<hr>
<div id="ds">Danh sách</div>
</body>
</html>
