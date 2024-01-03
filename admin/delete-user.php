<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

     // chọn đúng id muốn xóa trong data
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // Đảm bảo chỉ có 1 người dùng được tìm nạp
    if (mysqli_num_rows($result) == 1) {
        // tạo biến tìm tên avatar
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        // delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    // FOR LATER
    // xóa cả bài đănng của user đó,dùng lại delete post
    //SELECT thumbnail FROM posts WHERE author_id=$id";
    // chọn lọc thumanil từ post nơi user
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    //nếu thumbnails_result:số bài đăng > 0
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            // chạy vòng lặp xóa
            if ($thumbnail_path) {
                //unlink ham xoa ten file ,địa chỉ thumbnail_path
                unlink($thumbnail_path);
            }
        }
    }




    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
