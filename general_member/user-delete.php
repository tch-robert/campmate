<?php
require_once("../db_connect.php");

if(!isset($_GET["id"])){
    echo "請循正常管道進入此頁";
    exit;
}

$id=$_GET["id"];

$sql="UPDATE users SET valid=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

header("location: users.php");