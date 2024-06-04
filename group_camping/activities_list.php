<?php
require_once("../db_connect.php");

// $sqlAll = "SELECT * FROM activities";
// $result = $conn->query($sqlAll);

if (isset($_GET["search"])) :
    $search = $_GET["search"];
    $sql = "SELECT activity_name, description, location, start_date, end_date FROM activities WHERE location LIKE '%$search%' AND valid = 1";
    // $result = $conn->query($sql);
    $pageTitle = "有關 \"" . $search . "\" 的結果";
else :
    $sql = "SELECT * FROM activities WHERE valid = 1";
    // $result = $conn->query($sql);
    $pageTitle = "揪團列表";
endif;
$result = $conn->query($sql);

// $sql = "SELECT * FROM activities";

// if (isset($_GET["search"])) {
//     $search = $_GET["search"];
//     // 使用預備語句來防止SQL注入攻擊
//     $stmt = $conn->prepare("SELECT activity_name, description, location, start_date, end_date FROM activities WHERE location LIKE ?");
//     $search_param = "%$search%";
//     $stmt->bind_param("s", $search_param);
//     $stmt->execute();
//     $result = $stmt->get_result();
// } else {
//     $result = $conn->query($sql);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>揪團列表</title>
    <?php include("../css.php") ?>
</head>

<body>
    <div class="container">
        <h1 class="mt-4"><?php echo $pageTitle ?></h1>
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start gap-3 mb-3">
                <form action="" class="m-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <?php if (isset($_GET["search"])) : ?>
                    <a href="activities_list.php" class="btn btn-primary"><i class="fa-solid fa-right-from-bracket"></i> 返回列表</a>
                <?php else : ?>
                    <a href="create_activity.php" class="btn btn-primary">
                        <i class="fa-solid fa-hand"></i> 我要揪團
                    </a>
                <?php endif; ?>
            </div>
            <div>
                <?php if (!isset($_GET["search"])) : ?>
                    <a href="my_activities.php" class="btn btn-primary">
                        <i class="fa-solid fa-calendar-check"></i> 我的揪團
                    </a>
                <?php else : ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- 搜尋、建立揪團 -->

        <?php if ($result->num_rows > 0) : ?>
            <table class='table table-bordered'>
                <thead class='thead-light text-nowrap'>
                    <tr>
                        <th>活動名稱</th>
                        <th>描述</th>
                        <th>地點</th>
                        <th>開始日期</th>
                        <th>結束日期</th>
                        <th>了解更多</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["activity_name"]  ?></td>
                            <td><?php echo $row["description"] ?></td>
                            <td><?php echo $row["location"] ?></td>
                            <td><?php echo $row["start_date"] ?></td>
                            <td><?php echo $row["end_date"] ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href='activity_information.php?id=<?php echo $row["activity_id"] ?>' class='btn btn-primary btn-sm'>
                                    <i class='fa-solid fa-circle-info'></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            <?php else : ?>
                沒有關於<?php echo $search; ?>的活動
            <?php endif; ?>

            <?php $conn->close(); ?>
            </table>
    </div>
    <?php include("../js.php") ?>
</body>

</html>