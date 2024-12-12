<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   
</head>

<body>
<div class="container">
    <div style="text-align: center;"><h2>Bảng sinh viên</h2></div>
    <div id="search" style="margin-bottom: 20px;">
        <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm" class="form-control" onkeyup="searchTable()" />
        <button type="button" class="btn btn-primary mt-2" onclick="searchTable()" style="background-color:rgb(240, 89, 89);">Tìm Kiếm</button>
        <button type="button" class="btn btn-secondary mt-2" onclick="window.location.href='../html/index.html'" style="background-color: rgb(240, 89, 89);;">Thêm sinh viên</button>
    </div>

    <table class="table table-bordered" id="studentTable">
        <thead class="thead" style="background-color: rgba(109, 142, 232, 0.432);">
        <tr>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Quê quán</th>
            <th>Trình độ học vấn</th>
            <th>Nhóm</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
            require_once ("connect.php");
            global $conn;

            $lksql = "SELECT * FROM `students`";
            $result = mysqli_query($conn, $lksql);
            while ($row = mysqli_fetch_assoc($result)) {
                switch ($row['level']) {
                    case '0':
                        $lv = 'Tiến sĩ';
                        break;
                    case '1':
                        $lv = 'Thạc sĩ';
                        break;
                    case '2':
                        $lv = 'Kỹ sư';
                        break;
                    case '3':
                        $lv = 'Khác';
                        break;
                }
        ?>
        <tr>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td><?php echo $row['gender'] == 1 ? 'Nam' : 'Nữ'; ?></td>
            <td><?php echo $row['hometown']; ?></td>
            <td><?php echo $lv; ?></td>
            <td><?php echo "Nhóm " . $row['group']; ?></td>
            <td>
                <a href="edit.php?kid=<?php echo $row['id'] ?>" class="btn" style="background-color: rgba(109, 142, 232, 0.432);;">Sửa</a>
                <a onclick="return confirm('Bạn có muốn xóa sinh viên này không')" href="delete.php?kid=<?php echo $row['id'] ?>" class="btn btn-danger" style="background-color: rgb(240, 89, 89)">Xóa</a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

</div>
<script>
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("studentTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j] && cells[j].innerText.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none";
        }
    }
</script>
</body>
</html>
