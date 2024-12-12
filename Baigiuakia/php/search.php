<?php
$conn = new mysqli('localhost', 'root', '', 'QLSV_buivietdat');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$searchKey = '';
if (isset($_GET['search'])) {
    $searchKey = $_GET['search'];
    $sql = "SELECT * FROM students WHERE fullname LIKE '%$searchKey%' OR hometown LIKE '%$searchKey%'";
} else {
    $sql = "SELECT * FROM students";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tìm kiếm học viên</title>
</head>
<body>
    <h2>Tìm kiếm học viên</h2>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Nhập tên hoặc quê quán" value="<?php echo $searchKey; ?>">
        <button type="submit">Tìm kiếm</button>
    </form>

    <h3>Kết quả tìm kiếm</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Quê quán</th>
            <th>Trình độ học vấn</th>
            <th>Nhóm</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . ($row['gender'] == 1 ? 'Nam' : 'Nữ') . "</td>";
                echo "<td>" . $row['hometown'] . "</td>";
                echo "<td>";
                switch ($row['level']) {
                    case 0: echo "Tiến sĩ"; break;
                    case 1: echo "Thạc sĩ"; break;
                    case 2: echo "Kỹ sư"; break;
                    default: echo "Khác"; break;
                }
                echo "</td>";
                echo "<td>Nhóm " . $row['groupid'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không tìm thấy kết quả</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
