<?php
require 'config/database.php';
// lấy id từ post
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // chọn đúng id muốn xóa
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    //  Đảm bảo chỉ có 1 bản ghi/bài đăng được tìm nạp
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        //tao biến tên và tìm địa chỉ 
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            //unlink ham xoa ten file ,xao hinh anh địa chỉ
            unlink($thumbnail_path);

            // delete post from database, litmit 1
            $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);

            if (!mysqli_errno($connection)) {
                //hien thi thong bao va tra ve trang admin
                $_SESSION['delete-post-success'] = "Post deleted successfully";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
