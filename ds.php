<?php
include("inc/connect.inc");
$lop = isset($_GET['lop']) ? $_GET['lop'] : '';

// Dùng prepared statement để tránh SQL injection
$stmt = mysqli_prepare($con, "SELECT masv, hoten, diachi FROM sinhvien WHERE lop=?");
mysqli_stmt_bind_param($stmt, "s", $lop);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);

$str = "<table>
    <tr class=hd>
        <td>TT</td>
        <td>Mã số</td>
        <td>Họ tên</td>
        <td>Địa chỉ</td>
    </tr>";
$tt = 1;
while ($row = mysqli_fetch_array($rs)) {
    $str .= "<tr>
        <td>{$tt}</td>
        <td>{$row['masv']}</td>
        <td>{$row['hoten']}</td>
        <td>{$row['diachi']}</td>
    </tr>";
    $tt++;
}
$str .= "</table>";   // chú ý: phải là .= (đề gốc thiếu dấu =)

echo $str;
?>
