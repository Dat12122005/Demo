<?php

require "connect.php";
global $conn;
$fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : null;
$dob = isset($_POST["dob"]) ? $_POST["dob"] : null;
$gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
$hometown = isset($_POST["hometown"]) ? $_POST["hometown"] : null;
$level = isset($_POST["level"]) ? $_POST["level"] : null;
$group = isset($_POST["group"]) ? $_POST["group"] : null;
$id = isset($_POST["kid"]) ? $_POST["kid"] : null;
$updatesql = "UPDATE students SET fullname='$fullname',dob='$dob',gender='$gender',hometown='$hometown',level='$level',`group`='$group' WHERE id=$id";
mysqli_query($conn, $updatesql);
header("location:list.php");
?>