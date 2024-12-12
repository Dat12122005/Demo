<?php
require_once ("connect.php");
global $conn;
$eid = $_GET['kid'];
$edit_sql = "SELECT * FROM students WHERE id=$eid";
$result = mysqli_query($conn, $edit_sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sửa Thông Tin Sinh Viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="card mb-4" style="display: grid ;justify-content: center;align-items: center;;">
        <div class="card-header " style="background-color:rgb(240, 89, 89) ;">Nhập Thông Tin Sinh Viên</div>
        <div class="card-body" style=" width: 500px;">
            <form action="update.php" method="post" >
                <input type="hidden" name="kid" value="<?php echo $eid ?>">

                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên:</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Nhập họ tên" name="fullname" value="<?php echo $row['fullname'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="dob">Ngày sinh:</label>
                    <input type="date" class="form-control" id="dob" placeholder="Nhập quê quán" name="dob" value="<?php echo $row['dob'] ?>" required></div>
                <div class="mb-3">
                    <label>Giới tính:</label></div>
                    <div class="gender" style="display:flex; gap:2rem;">Nam:<input name="gender" type="radio" value=1>   Nữ:<input name="gender" type="radio" value=0> 
                 </div>
                        
              

                <div class="mb-3">
                    <label for="hometown" class="form-label">Quê quán:</label>
                    <input type="text" class="form-control" id="hometown" placeholder="Nhập quê quán" name="hometown" value="<?php echo $row['hometown'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Trình độ học vấn:</label>
                    <select class="form-select" id="level" name="level" required>
                        <option><?php switch ($row['level']) {
                                case '0':
                                    $lv='Tiến sĩ';
                                    break;
                                case '1':
                                    $lv='Thạc sĩ';
                                    break;
                                case '2':
                                    $lv='Kỹ sư';
                                    break;
                                case '3':
                                    $lv='Khác';
                                    break;
                            }
                            echo $lv ?></option>
                        <option disabled>--------</option>
                        <option value="0">Tiến sĩ</option>
                        <option value="1">Thạc sĩ</option>
                        <option value="2">Kỹ sư</option>
                        <option value="3">Khác</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="group" class="form-label">Nhóm:</label>
                    <input type="number" class="form-control" id="group" placeholder="Nhập ID nhóm" name="group" value="<?php echo $row['group'] ?>" required>
                </div>

                <button type="submit" class="btn btn-danger w-100 mb-2" onclick="return confirm('Bạn có xác nhận muốn sửa không')" style="background-color: rgb(240, 89, 89);"">Cập nhập thông tin</button>
                <button type="button" class="btn btn-secondary w-100" onclick="window.location.href='./php/list.php'" style="background-color: rgb(240, 89, 89);">Quay lại trang chủ</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>