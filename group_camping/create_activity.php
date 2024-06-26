<?php
require_once("../db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activity_name = $_POST['activity_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $organizer_email = $_POST['organizer_email'];

    if (empty($activity_name) || empty($location) || empty($start_date) || empty($end_date) || empty($organizer_email)) {
        exit("請填入必要欄位");
    }

    $sql = "INSERT INTO activities (activity_name, description, location, start_date, end_date, organizer_email)
            VALUES ('$activity_name', '$description', '$location', '$start_date', '$end_date', '$organizer_email')";

    if ($conn->query($sql) === TRUE) {
        echo "成功建立揪團";
    } else {
        echo "建立揪團錯誤: " . $conn->error;
    }

    $conn->close();
    header("location: activities_list.php"); // 重定向回列表頁面
}
?>

<title>建立揪團</title>
<?php include("../index.php") ?>

<main class="main-content">
    <div class="container">
        <h1 class="mt-4">我要揪團</h1>
        <form action="create_activity.php" method="post" class="mb-3">
            <div class="row row-cols-1 mb-1">
                <div class="form-group col-7 mb-2">
                    <label for="activity_name" class="form-label">揪團名稱</label>
                    <input type="text" class="form-control" id="activity_name" name="activity_name" required>
                </div>
                <div class="form-group col-7 mb-2">
                    <label for="description" class="form-label">簡述</label>
                    <textarea rows="4" class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group col-7 mb-2">
                    <label for="location" class="form-label">地點</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group col-7 mb-2">
                    <label for="start_date" class="form-label">開始日期</label>
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="form-group col-7 mb-2">
                    <label for="end_date" class="form-label">結束日期</label>
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                </div>
                <div class="form-group col-7 mb-2">
                    <label for="organizer_email" class="form-label">團主 Email</label>
                    <input type="text" class="form-control" id="organizer_email" name="organizer_email" required>
                </div>
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-neumorphic">
                    <i class="fa-solid fa-calendar-check"></i> 建立揪團
                </button>
                <a href="activities_list.php" class="btn btn-neumorphic ms-2">
                    <i class="fa-solid fa-calendar-xmark"></i> 取消揪團
                </a>
            </div>
        </form>
    </div>
</main>